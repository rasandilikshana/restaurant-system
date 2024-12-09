<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\StaffMember;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     public function run()
     {
         // Ensure roles are created first if not already
         $roles = Role::all();

         // Create staff members for each user with roles
         $staff = [
             ['user_id' => 1, 'role_id' => $roles->where('name', 'Admin')->first()->id],
             ['user_id' => 2, 'role_id' => $roles->where('name', 'Manager')->first()->id],
             ['user_id' => 3, 'role_id' => $roles->where('name', 'Chef')->first()->id],
             ['user_id' => 4, 'role_id' => $roles->where('name', 'Waiter')->first()->id],
             ['user_id' => 5, 'role_id' => $roles->where('name', 'Cashier')->first()->id],
         ];

         foreach ($staff as $staffMember) {
             StaffMember::create($staffMember);
         }
     }
}
