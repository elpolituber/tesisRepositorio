<?php

namespace Database\Seeders;

use App\Models\Authentication\Permission;
use App\Models\Authentication\Role;
use App\Models\Authentication\Route;
use App\Models\Authentication\User;
use App\Models\Ignug\Catalogue;
use Illuminate\Database\Seeder;
use App\Models\Ignug\State;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        State::factory()->create([
            'code' => '1',
            'name' => 'ACTIVE',
        ]);
        State::factory()->create([
            'code' => '2',
            'name' => 'INACTIVE',

        ]);
        State::factory()->create([
            'code' => '3',
            'name' => 'DELETED',
        ]);

        $system = Catalogue::factory()->create([
            'code' => Catalogue::SYSTEM_ATTENDANCE,
            'name' => 'Attendance',
            'type' => Catalogue::TYPE_SYSTEMS,
        ]);

        $role = Role::factory()->create([
            'code' => Role::ADMINISTRATOR,
            'name' => 'Attendance',
            'system_id' => $system->id
        ]);

        $user = User::factory()->create(['username' => '1234567890']);
        $user->roles()->attach($role->id);

        $system = Catalogue::factory()->create([
            'code' => Catalogue::SYSTEM_CECY,
            'name' => 'Cecy',
            'type' => Catalogue::TYPE_SYSTEMS,
        ]);

        $role = Role::factory()->create([
            'code' => Role::TEACHER,
            'name' => 'Teacher',
            'system_id' => $system->id
        ]);

        $user = User::factory()->create(['username' => '1234567891']);
        $user->roles()->attach($role->id);

        $module = Catalogue::factory()->create([
            'code' => Catalogue::MODULE_ATTENDANCE,
            'name' => 'Attendance',
            'type' => Catalogue::TYPE_MODULES,
        ]);

        $route1 = Route::factory()->create([
            'uri'=>'/attendance/asistencia-laboral',
            'module_id' => $module->id
        ]);

        $route2 = Route::factory()->create([
            'uri'=>'/attendance/administracion-asistencia-laboral',
            'module_id' => $module->id
        ]);

        $roles = Role::all();
        foreach ($roles as $role) {
            Permission::factory()->create([
                'route_id' => $route1->id,
                'role_id' => $role->id,
            ]);

            Permission::factory()->create([
                'route_id' => $route2->id,
                'role_id' => $role->id,
            ]);
        }

        Route::factory()->times(5)->create([
            'parent_id' => $route1->id,
            'module_id' => $module->id
        ]);

        Route::factory()->times(5)->create([
            'parent_id' => $route2->id,
            'module_id' => $module->id
        ]);

    }
}
/*
            drop schema if exists authentication cascade;
            drop schema if exists attendance cascade;
            drop schema if exists ignug cascade;
            drop schema if exists job_board cascade;
            drop schema if exists web cascade;
            drop schema if exists teacher_eval cascade;
            drop schema if exists community cascade;

            create schema authentication;
            create schema attendance;
            create schema ignug;
            create schema job_board;
            create schema web;
            create schema teacher_eval;
            create schema community;
 */
