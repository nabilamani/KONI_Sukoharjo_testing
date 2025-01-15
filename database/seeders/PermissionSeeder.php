<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat atau perbarui role
        $roles = [
            'admin',
            'pengurus'
        ];

        foreach ($roles as $roleName) {
            $role = Role::updateOrCreate(['name' => $roleName], ['name' => $roleName]);

            // Buat atau perbarui permission
            $permission = Permission::updateOrCreate(
                ['name' => 'menu_' . $roleName],
                ['name' => 'menu_' . $roleName]
            );

            // Kaitkan permission ke role
            $role->givePermissionTo($permission);
        }

        // Tambahkan semua permissions ke role admin
        $roleAdmin = Role::where('name', 'admin')->first();
        $allPermissions = Permission::all();
        $roleAdmin->syncPermissions($allPermissions);

        // Pastikan admin (id 1) mendapatkan semua role dan permission
        $adminUser = User::find(1);
        if ($adminUser) {
            $adminUser->syncRoles($roles);
            $adminUser->syncPermissions($allPermissions);
        }
    }
}




// namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;
// use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Role;

// class PermissionSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         $role_admin = Role::updateOrCreate(
//             [
//                 'name' => 'admin'   
//             ],
//             ['name' => 'admin']
//         );
//         $role_pengurus = Role::updateOrCreate(
//             [
//                 'name' => 'pengurus'   
//             ],
//             ['name' => 'pengurus']
//         );
        
//         $permission = Permission::updateOrCreate(
//             [
//                 'name' => 'menu_admin'   
//             ],
//             ['name' => 'menu_admin']
//         );

//         $role_admin->givePermissionTo($permission);

//         $user = User::find(1);

//         $user->assignRole('admin');
//     }
// }
