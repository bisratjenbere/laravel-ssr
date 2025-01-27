<?php

namespace Database\Seeders;

use App\enum\PermissionsEnum;
use App\enum\RolesEnum;
use App\Models\Feature;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    $userRole = Role::create(['name' => RolesEnum::User->value]);
    $adminRole = Role::create(['name' => RolesEnum::Admin->value]);
    $commenter = Role::create(['name' => RolesEnum::Commenter->value]);
    $manageFeaturesPermission = Permission::create(['name' => PermissionsEnum::ManageFeatures->value]);
    $manageUsersPermission = Permission::create(['name' => PermissionsEnum::manageUsers->value]);
    $manageUpvotesPermission = Permission::create(['name' =>PermissionsEnum::UpvoteDownvote->value]);
    $manageCommentsPermission = Permission::create(['name' => PermissionsEnum::manageComments->value]);

    $userRole->syncPermissions($manageUpvotesPermission);
    $adminRole->syncPermissions([$manageFeaturesPermission,$manageUsersPermission,$manageCommentsPermission, $manageUpvotesPermission]);
    $commenter->syncPermissions([$manageUpvotesPermission, $manageCommentsPermission]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'jenberehenok@gmail.com',
            'password' => bcrypt('bshhyhej'),
        ])->assignRole(RolesEnum::User);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'commenter@example.com',
        ])->assignRole(RolesEnum::Commenter);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@example.com',
        ])->assignRole(RolesEnum::Admin);
        Feature::factory(100)->create();



    }
}
