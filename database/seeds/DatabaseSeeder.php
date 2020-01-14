<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('users');
        Storage::makeDirectory('users');

        Storage::deleteDirectory('manual_layouts');
        Storage::makeDirectory('manual_layouts');

        factory(\App\Models\Administracion\Role::class, 1)->create(['name' => 'admin']);
        factory(\App\Models\Administracion\Role::class, 1)->create(['name' => 'user']);
        factory(\App\Models\Administracion\Role::class, 1)->create(['name' => 'test']);

        factory(\App\User::class, 1)->create([
            'name' => 'admin',
            'email' => 'soporte@hallmg.com',
            'password' => bcrypt('secret'),
            'id_role' => \App\Models\Administracion\Role::ADMIN
        ]);

        factory(\App\Models\Administracion\Employee::class, 5)->create();
    }
}
