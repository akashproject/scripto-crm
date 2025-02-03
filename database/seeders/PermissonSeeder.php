<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $permissions = [
        'create',
        'read',
        'update',
        'delete',
    ];
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // create permissions
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}