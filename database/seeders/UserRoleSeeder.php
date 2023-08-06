<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as ModelsRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsRole::create([
            'name'=>'admin',
            'guard_name'=>'web'
        ]);
        ModelsRole::create([
            'name'=>'user',
            'guard_name'=>'web'
        ]);
    }
}
