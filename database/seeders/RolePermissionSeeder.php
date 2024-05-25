<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Persmisson

        $permissions = [
            'manage categories',
            'manage tools',
            'manage project',
            'manage project tools',
            'manage wallets',
            'manage applicants',

            'apply job',
            'topup wallet',
            'withdraw wallet',
        ];



        //Best Practice simpan permission & sync
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        //Client
        $clientRole = Role::firstOrCreate([
            'name' => 'project_client'
        ]);
        $clientPermissions = [
            'manage project',
            'manage project tools',
            'manage applicants',
            'topup wallet',
            'withdraw wallet',
        ];
        $clientRole->syncPermissions($clientPermissions);

        //Frelancer
        $freelancerRole = Role::firstOrCreate([
            'name' => 'project_freelancer'
        ]);
        $freelancerPermission = [
            'apply job',
            'withdraw wallet',
        ];
        $freelancerRole->syncPermissions($freelancerPermission);

        //SuperAdmin
        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin'
        ]);
        $superAdminPermission = [
            'manage categories',
            'manage tools',
            'manage project',
            'manage project tools',
            'manage wallets',
            'manage applicants',
            'apply job',
            'topup wallet',
            'withdraw wallet',
        ];
        $superAdminRole->syncPermissions($superAdminPermission);

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'occupation' => 'Owner',
            'connect' => 20,
            'avatar' => 'images/default-avatar.img',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($superAdminRole);

        //di create untuk setting2

        $wallet = new Wallet([
            'balance' => 0,
        ]);

        $user->wallet();
    }
}
