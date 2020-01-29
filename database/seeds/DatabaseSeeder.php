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

        Storage::deleteDirectory('processed_files');
        Storage::makeDirectory('processed_files');

        factory(\App\Models\Administracion\Role::class, 1)->create(['name' => 'admin']);
        factory(\App\Models\Administracion\Role::class, 1)->create(['name' => 'user']);
        factory(\App\Models\Administracion\Role::class, 1)->create(['name' => 'test']);

        factory(\App\User::class, 1)->create([
            'name' => 'admin',
            'email' => 'soporte@hallmg.com',
            'password' => bcrypt('secret'),
            'id_role' => \App\Models\Administracion\Role::ADMIN
        ]);

        factory(\App\Models\Administracion\Employee::class, 2)->create();

        factory(\App\Models\Administracion\hierarchical_levels_positions::class, 1)->create(['level' => 1, 'name' => 'Operativo']);
        factory(\App\Models\Administracion\hierarchical_levels_positions::class, 1)->create(['level' => 2, 'name' => 'Administrativo']);
        factory(\App\Models\Administracion\hierarchical_levels_positions::class, 1)->create(['level' => 3, 'name' => 'Especializado']);
        factory(\App\Models\Administracion\hierarchical_levels_positions::class, 1)->create(['level' => 4, 'name' => 'Supervisión']);
        factory(\App\Models\Administracion\hierarchical_levels_positions::class, 1)->create(['level' => 5, 'name' => 'Coordinación']);
        factory(\App\Models\Administracion\hierarchical_levels_positions::class, 1)->create(['level' => 6, 'name' => 'Jefatura']);
        factory(\App\Models\Administracion\hierarchical_levels_positions::class, 1)->create(['level' => 7, 'name' => 'Gerencia']);
        factory(\App\Models\Administracion\hierarchical_levels_positions::class, 1)->create(['level' => 8, 'name' => 'Dirección de Área']);
        factory(\App\Models\Administracion\hierarchical_levels_positions::class, 1)->create(['level' => 9, 'name' => 'Dirección General']);

        factory(\App\Models\Administracion\Gender::class, 1)->create(['name' => 'Masculino']);
        factory(\App\Models\Administracion\Gender::class, 1)->create(['name' => 'Femenino']);
        factory(\App\Models\Administracion\Gender::class, 1)->create(['name' => 'Indistinto']);

        factory(\App\Models\Administracion\MaritalStatus::class, 1)->create(['name' => 'Indistinto']);
        factory(\App\Models\Administracion\MaritalStatus::class, 1)->create(['name' => 'Soltero']);
        factory(\App\Models\Administracion\MaritalStatus::class, 1)->create(['name' => 'Casado']);
        factory(\App\Models\Administracion\MaritalStatus::class, 1)->create(['name' => 'Divorciado']);
        factory(\App\Models\Administracion\MaritalStatus::class, 1)->create(['name' => 'Viudo']);

        factory(\App\Models\Administracion\WorkShift::class, 1)->create(['name' => 'Diurno', 'up_start' => '9:00', 'up_end' => '14:00', 'down_start' => '15:00', 'down_end' => '18:00']);
        factory(\App\Models\Administracion\WorkShift::class, 1)->create(['name' => 'Nocturno']);
    }
}
