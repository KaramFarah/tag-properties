<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Dashboard\City;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            // [
            //     'name' => 'Dubai',
            //     'country_code' => 'AE'
            // ],
            // [
            //     'name' => 'Abu Dhabi',
            //     'country_code' => 'AE'
            // ],
            // [
            //     'name' => 'Ras Al Khaimah',
            //     'country_code' => 'AE'
            // ],
            // [
            //     'name' => 'Sharjah',
            //     'country_code' => 'AE'
            // ],
            // [
            //     'name' => 'Ajman',
            //     'country_code' => 'AE'
            // ],
            // [
            //     'name' => 'Ain',
            //     'country_code' => 'AE'
            // ],
            [
                'name' => 'Lattaika',
                'country_code' => 'SY'
            ],
            [
                'name' => 'Damascus',
                'country_code' => 'SY'
            ],
            [
                'name' => 'Aleppo',
                'country_code' => 'SY'
            ],
            [
                'name' => 'Hama',
                'country_code' => 'SY'
            ],
            [
                'name' => 'Tartus',
                'country_code' => 'SY'
            ],
            [
                'name' => 'Homs',
                'country_code' => 'SY'
            ],
        ];

        foreach($cities as $_item){
            $city = City::firstOrCreate($_item);
        }

    }
}
