<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as AuthManager;
use App\Service\User as Service;
use Illuminate\Support\Facades\Session;

class Auth
    extends Controller
{

    protected ?Service $service = null;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function loginCheck(Request $request)
    {
        if(\Illuminate\Support\Facades\Auth::attempt($request->only(['email', 'password']))) {
           $permissions = array_map(
                fn(array $permission) => $permission['code']    ,
                AuthManager::user()->permissions->toArray()
            );

            Session::put(
                'userPermissions',
                $permissions
            );

            return redirect(route('home'));
        } else {
            $request
                ->session()
                ->flash(
                    'flash',
                    [
                        'type' => 'danger',
                        'message' => 'Invalid email or password'
                    ]
                );

            return redirect(route('login'));
        }
    }

    public function registration(RegistrationRequest $request)
    {
        $data = $request->validated();

        $data['role_id'] = Role::getId(Role::$regularRoleCode);

        $user = $this
            ->service
            ->create($data);

        if (!is_null($user)) {
            return redirect(route('login'));
        }

        return view('registration');
    }

    public function logout()
    {
        Session::flush();
        AuthManager::logout();

        return redirect(route('login'));
    }
}
