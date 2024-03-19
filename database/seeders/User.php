<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class User
    extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
             'first_name' => 'Admin',
             'last_name'  => 'Adminov',
             'email' => 'admin@adminov.com',
             'password' => Hash::make('12345'),
             'role_id' => Role::getId(Role::$adminRoleCode),
             'enabled' => 1
         ]);
    }
}
