<?php

namespace App\Service;

use App\Models\User as Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User
{
    public function create($data) : ?Model
    {
        $data['password'] = Hash::make($data['password']);

        $user = Model::create($data);

        return $user;
    }

    public function update(Model $model, array $data = [], $relationsData = []) : ?Model
    {
        $saveSuccessful = false;

        try {
            DB::beginTransaction();
            foreach ($data as $i => $d) {
                if (in_array($i, $model->getFillable())) {
                    if ($i === 'password') {
                        $model->{$i} = Hash::make($d);
                    } else {
                        $model->{$i} = $d;
                    }
                }
            }

            foreach ($relationsData as $relationsDataKey => $relationsDataEach) {
                foreach ($relationsDataEach as $procedure => $rdata) {
                    array_walk(
                        $rdata,
                        fn(string|int $rd) => $model->{$relationsDataKey}()->{$procedure}($rdata)
                    );
                }
            }

            $model->save();
            DB::commit();
            $saveSuccessful = true;
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
        }

        return $saveSuccessful ? $model : null;
    }
}
