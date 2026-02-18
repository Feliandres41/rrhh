<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // 🔄 Limpiar cache de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        /*crea los permisoss*/

        $permissions = [
            'manage collaborators',
            'manage contracts',
            'extend contracts',
            'terminate contracts',
            'view reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        /*crea los roles*/

        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $hr = Role::firstOrCreate(['name' => 'HR']);
        $viewer = Role::firstOrCreate(['name' => 'Viewer']);

        /*permisos a roles*/

        // Admin - todos los permisos
        $admin->givePermissionTo(Permission::all());

        // HR - gestión operativa
        $hr->givePermissionTo([
            'manage collaborators',
            'manage contracts',
            'extend contracts',
            'terminate contracts',
        ]);

        // Viewer - solo lectura
        $viewer->givePermissionTo([
            'view reports',
        ]);
    }
}
