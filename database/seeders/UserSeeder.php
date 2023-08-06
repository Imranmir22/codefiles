<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role as ModelsRole;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(
            [
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('password'),
            ]
            );
            $role = ModelsRole::where('name', 'admin')->first();
            $user->assignRole($role);
    }
}
