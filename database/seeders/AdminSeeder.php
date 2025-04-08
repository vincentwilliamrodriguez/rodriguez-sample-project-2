<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@sample.com',
                'role' => 'admin'
            ],
            [
                'name' => 'Basic',
                'email' => 'basic@sample.com',
                'role' => 'basic'
            ],
        ];

        $roles = [
            'admin' => ['all-permissions'],
            'basic' => [''],
        ];

        $permissions = [
            'create-users', 'read-users', 'update-users', 'delete-users',
            'create-tasks', 'read-tasks', 'update-tasks', 'delete-tasks',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        foreach ($roles as $roleName => $perms) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            if ($perms === ['all-permissions']) {
                $role->givePermissionTo($permissions);
            }
        }

        foreach ($users as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'),
                    'remember_token' => 'ik3zCT8cbW07WVH6lxhOrMHdLi0QqgJ9HDpcw4cyIXf9iGrlrBEcIHRPj8t3',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            $user->assignRole($userData['role']);
        }
    }
}
