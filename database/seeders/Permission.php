<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Permission
    extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Permission::factory()->create([
             'code' => 'book.store',
             'description'  => 'Запаметяване на книга.',
        ]);

        \App\Models\Permission::factory()->create([
            'code' => 'book.update',
            'description'  => 'Редакция на книга.',
        ]);

        \App\Models\Permission::factory()->create([
            'code' => 'book.destroy',
            'description'  => 'Изтриване на книга',
        ]);

        \App\Models\Permission::factory()->create([
            'code' => 'book.show',
            'description'  => 'Преглед на книга/книги.',
        ]);
    }
}
