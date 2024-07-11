<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'title' => 'Admin',
            ],
            [
                'title' => 'Registered',
            ],
            [
                'title' => 'Agent',
            ],
            [
                'title' => 'DOS', //Supervisor
            ],
        ];

        foreach($roles as $_item){
            $role = Role::firstOrCreate([
                'title' => $_item['title']
            ]);
            // echo $role->title . ' - Done' . PHP_EOL;
        }
    }
}
