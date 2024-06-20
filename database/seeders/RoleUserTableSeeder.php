<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        #Add Admin user to Admin Role
        User::findOrFail(1)->roles()->sync(1);
    }
}
