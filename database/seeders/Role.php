<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role as RoleModel;

class Role
    extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Role::factory()->create([
            'code'  => RoleModel::$adminRoleCode,
            'name' => 'Администратор',
            'description' => 'Потребител с ниво достъп администратор',
        ]);

        \App\Models\Role::factory()->create([
             'code'  => RoleModel::$regularRoleCode,
             'name' => 'Редови',
             'description' => 'Потребител с ниво достъп редови',
         ]);
    }
}
