<?php

namespace Database\Seeders;

use App\Models\Dashboard\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'name' => 'Unit',
                'type' => 'main'
            ],
            [
                'name' => 'Lead',
                'type' => 'main'
            ],
            [
                'name' => 'Gym',
                'type' => 'interests'
            ],
            [
                'name' => 'Swinming Pool',
                'type' => 'interests'
            ],
            [
                'name' => 'Garden',
                'type' => 'interests'
            ],
            [
                'name' => 'Technology',
                'type' => 'interests'
            ],
            [
                'name' => 'Business',
                'type' => 'interests'
            ],
            [
                'name' => 'Design',
                'type' => 'interests'
            ],
            [
                'name' => 'See View',
                'type' => 'interests'
            ],
            [
                'name' => 'Sunset',
                'type' => 'interests'
            ],
            [
                'name' => 'Lake View',
                'type' => 'interests'
            ],
            [
                'name' => 'Apartment',
                'type' => 'interests'
            ],
            [
                'name' => 'Villa',
                'type' => 'interests'
            ],
            [
                'name' => 'Hotel Apartment',
                'type' => 'interests'
            ],
            [
                'name' => 'Townhouse',
                'type' => 'interests'
            ],
            [
                'name' => 'Air Conditioning',
                'type' => 'interests'
            ],
            [
                'name' => 'Fire Place Facility',
                'type' => 'interests'
            ],
            [
                'name' => 'Store Room',
                'type' => 'interests'
            ],
            [
                'name' => 'Garage Facility',
                'type' => 'interests'
            ],
            [
                'name' => 'Play Ground',
                'type' => 'interests'
            ],
            [
                'name' => 'Hight Class Door',
                'type' => 'interests'
            ],
            [
                'name' => 'Ferniture Include',
                'type' => 'interests'
            ],
            [
                'name' => 'Floor Heating System',
                'type' => 'interests'
            ],
            [
                'name' => 'Fire Security',
                'type' => 'interests'
            ],
            [
                'name' => 'Marbel Floor',
                'type' => 'interests'
            ],
            [
                'name' => 'Garden Include',
                'type' => 'interests'
            ],
            [
                'name' => 'Pets',
                'type' => 'interests'
            ],
            [
                'name' => 'Property Investment Insights',
                'type' => 'blog'
            ],
            [
                'name' => 'Local Real Estate Market Trends',
                'type' => 'blog'
            ],
            [
                'name' => 'Home Buying and Selling Tips',
                'type' => 'blog'
            ],
            [
                'name' => 'Community and Lifestyle',
                'type' => 'blog'
            ],
            [
                'name' => 'Air Conditioning',
                'type' => 'features'
            ],
            [
                'name' => 'Garage Facility',
                'type' => 'features'
            ],
            [
                'name' => 'Swiming Pool',
                'type' => 'features'
            ],
            [
                'name' => 'Fire Security',
                'type' => 'features'
            ],
            [
                'name' => 'Marbel Floor',
                'type' => 'features'
            ],
            [
                'name' => 'Ferniture Include',
                'type' => 'features'
            ],
            [
                'name' => 'Play Ground',
                'type' => 'features'
            ],
            [
                'name' => 'Fire Place Facility',
                'type' => 'features'
            ],
            [
                'name' => 'Garden Include',
                'type' => 'features'
            ],
            [
                'name' => 'Floor Heating System',
                'type' => 'features'
            ],
            [
                'name' => 'Hight Class Door',
                'type' => 'features'
            ],
            [
                'name' => 'Store Room',
                'type' => 'features'
            ],
            [
                'name' => 'Gas',
                'type' => 'features'
            ],
            // [
            //     'name' => 'Recreation and Family',
            //     'type' => 'features'
            // ],
            [
                'name' => 'Recreation and Family',
                'type' => 'features'
            ],
            [
                'name' => 'Health and Fitness',
                'type' => 'features'
            ],
            [
                'name' => 'Laundry and Kitchen',
                'type' => 'features'
            ],
            [
                'name' => 'Building',
                'type' => 'features'
            ],
            [
                'name' => 'Business and Security',
                'type' => 'features'
            ],
            [
                'name' => 'Miscellaneous',
                'type' => 'features'
            ],
            [
                'name' => 'Technology',
                'type' => 'features'
            ],
            [
                'name' => 'Features',
                'type' => 'features'
            ],
            [
                'name' => 'Cleaning and Maintenance',
                'type' => 'features'
            ],
         
            [
                'name' => 'Barbeque Area ',
                'type' => 'features',
                // 'parent' => 'Recreation and Family'
            ],
            [
                'name' => 'Day Care Center',
                'type' => 'features',
                // 'parent' => 'Recreation and Family'
            ],
            [
                'name' => 'Lawn or Garden',
                'type' => 'features',
                // 'parent' => 'Recreation and Family'
            ],
            [
                'name' => 'Cafeteria or Canteen',
                'type' => 'features',
                // 'parent' => 'Recreation and Family'
            ],
            [
                'name' => 'Kids Play Area',
                'type' => 'features',
                // 'parent' => 'Recreation and Family'
            ],
            [
                'name' => 'First Aid Medical Center',
                'type' => 'features',
                // 'parent' => 'Health and Fitness'
            ],
            [
                'name' => 'Gym or Health Club',
                'type' => 'features',
                // 'parent' => 'Health and Fitness'
            ],
            [
                'name' => 'Jacuzzi',
                'type' => 'features',
                // 'parent' => 'Health and Fitness'
            ],
            [
                'name' => 'Swimming Pool',
                'type' => 'features',
                // 'parent' => 'Health and Fitness'
            ],
            [
                'name' => 'Steam Room',
                'type' => 'features',
                // 'parent' => 'Health and Fitness'
            ],
            [
                'name' => 'Sauna',
                'type' => 'features',
                // 'parent' => 'Health and Fitness'
            ],
            [
                'name' => 'Facilities for Disabled',
                'type' => 'features',
                // 'parent' => 'Health and Fitness'
            ],
            [
                'name' => 'Laundry Room',
                'type' => 'features',
                // 'parent' => 'Laundry and Kitchen'
            ],
            [
                'name' => 'Laundry Facility',
                'type' => 'features',
                // 'parent' => 'Laundry and Kitchen'
            ],
            [
                'name' => 'Shared Kitchen',
                'type' => 'features',
                // 'parent' => 'Laundry and Kitchen'
            ],
            [
                'name' => 'Balcony or Terrace',
                'type' => 'features',
                // 'parent' => 'Building'
            ],
            [
                'name' => 'Lobby in Building',
                'type' => 'features',
                // 'parent' => 'Building'
            ],
            [
                'name' => 'Service Elevators',
                'type' => 'features',
                // 'parent' => 'Building'
            ],
            [
                'name' => 'Prayer Room',
                'type' => 'features',
                // 'parent' => 'Building'
            ],
            [
                'name' => 'Reception/Waiting Room',
                'type' => 'features',
                // 'parent' => 'Building'
            ],
            [
                'name' => 'Business Center',
                'type' => 'features',
                // 'parent' => 'Business and Security'
            ],
            [
                'name' => 'Conference Room',
                'type' => 'features',
                // 'parent' => 'Business and Security'
            ],
            [
                'name' => 'Security Staff',
                'type' => 'features',
                // 'parent' => 'Business and Security'
            ],
            [
                'name' => 'CCTV Security',
                'type' => 'features',
                // 'parent' => 'Business and Security'
            ],
            [
                'name' => 'ATM Facility',
                'type' => 'features',
                // 'parent' => 'Miscellaneous'
            ],
            [
                'name' => 'Maids Room',
                'type' => 'features',
                // 'parent' => 'Miscellaneous'
            ],
            [
                'name' => '24 Hours Concierge',
                'type' => 'features',
                // 'parent' => 'Miscellaneous'
            ],
            [
                'name' => 'Broadband Internet',
                'type' => 'features',
                // 'parent' => 'Technology'
            ],
            [
                'name' => 'Satellite/Cable TV',
                'type' => 'features',
                // 'parent' => 'Technology'
            ],
            [
                'name' => 'Intercom',
                'type' => 'features',
                // 'parent' => 'Technology'
            ],
            [
                'name' => 'Double Glazed Windows',
                'type' => 'features',
                // 'parent' => 'Features'
            ],
            [
                'name' => 'Centrally Air-Conditioned',
                'type' => 'features',
                // 'parent' => 'Features'
            ],
            [
                'name' => 'Central Heating',
                'type' => 'features',
                // 'parent' => 'Features'
            ],
            [
                'name' => 'Electricity Backup',
                'type' => 'features',
                // 'parent' => 'Features'
            ],
            [
                'name' => 'Storage Areas',
                'type' => 'features',
                // 'parent' => 'Features'
            ],
            [
                'name' => 'Study Room',
                'type' => 'features',
                // 'parent' => 'Features'
            ],
            [
                'name' => 'Waste Disposal',
                'type' => 'features',
                // 'parent' => 'Cleaning and Maintenance'
            ],
            [
                'name' => 'Maintenance Staff',
                'type' => 'features',
                // 'parent' => 'Cleaning and Maintenance'
            ],
            [
                'name' => 'Cleaning Services',
                'type' => 'features',
                // 'parent' => 'Cleaning and Maintenance'
            ],
            // [
            //  HERE STARTS THE TEXT TAGS
            //Building
            [
                'name' => 'Completion Year',
                'type' => 'features',
                'value_type' => 'text'
            ],
            [
                'name' => 'Elevators in Building',
                'type' => 'features',
                'value_type' => 'text'
            ],
            //Miscellaneous
            [
                'name' => 'View',
                'type' => 'features',
                'value_type' => 'text'
            ],
            [
                'name' => 'Floor',
                'type' => 'features',
                'value_type' => 'text'
            ],
            [
                'name' => 'Other Main Features',
                'type' => 'features',
                'value_type' => 'text'
            ],
            [
                'name' => 'Other Rooms',
                'type' => 'features',
                'value_type' => 'text'
            ],
            [
                'name' => 'Other Facilities',
                'type' => 'features',
                'value_type' => 'text'
            ],
            [
                'name' => 'Land Area',
                'type' => 'features',
                'value_type' => 'text'
            ],
        ];

        foreach($items as $_item){
            $tag = Tag::firstOrCreate($_item);
            // echo $tag->name . ' - Done' . PHP_EOL;
        }
        $tag = Tag::where('name' , 'Cleaning and Maintenance')->first();
        $cleaning = Tag::where('name' , 'Cleaning Services')
                    ->orWhere('name' , 'Maintenance Staff')
                    ->orWhere('name' , 'Waste Disposal')->get();
        foreach($cleaning as $x){
            $x->update([
                'parent_id' => $tag->id,
            ]);
        }

        $tag = Tag::where('name' , 'Features')->first();
        $features = Tag::where('name' , 'Double Glazed Windows')
        ->orWhere('name' , 'Centrally Air-Conditioned')
        ->orWhere('name' , 'Electricity Backup')
        ->orWhere('name' , 'Storage Areas')
        ->orWhere('name' , 'Study Room')
        ->orWhere('name' , 'Air Conditioning')
        ->orWhere('name' , 'Garage Facility')
        ->orWhere('name' , 'Swiming Pool')
        ->orWhere('name' , 'Fire Security')
        ->orWhere('name' , 'Marbel Floor')
        ->orWhere('name' , 'Ferniture Include')
        ->orWhere('name' , 'Play Ground')
        ->orWhere('name' , 'Fire Place Facility')
        ->orWhere('name' , 'Garden Include')
        ->orWhere('name' , 'Floor Heating System')
        ->orWhere('name' , 'Store Room')
        ->orWhere('name' , 'Gas')
        ->orWhere('name' , 'Central Heating')->get();
        foreach($features as $y){
            $y->update([
                'parent_id' => $tag->id,
            ]);
        }

        $tag = Tag::where('name' , 'Technology')->first();
        $technology = Tag::where('name' , 'Broadband Internet')
        ->orWhere('name' , 'Satellite/Cable TV')
        ->orWhere('name' , 'Intercom')->get();
        foreach($technology as $z){
            $z->update([
                'parent_id' => $tag->id,
            ]);
        }

        $tag = Tag::where('name' , 'Miscellaneous')->first();
        $miscellaneous = Tag::where('name' , 'ATM Facility')
        ->orWhere('name' , 'Maids Room')
        ->orWhere('name' , 'View')
        ->orWhere('name' , 'Floor')
        ->orWhere('name' , 'Other Main Features')
        ->orWhere('name' , 'Other Rooms')
        ->orWhere('name' , 'Other Facilities')
        ->orWhere('name' , 'Land Area')
        ->orWhere('name' , '24 Hours Concierge')->get();
        foreach($miscellaneous as $c){
            $c->update([
                'parent_id' => $tag->id,
            ]);
        }

        $tag = Tag::where('name' , 'Business and Security')->first();
        $business_and_security = Tag::where('name' , 'Business Center')
        ->orWhere('name' , 'Conference Room')
        ->orWhere('name' , 'Security Staff')
        ->orWhere('name' , 'CCTV Security')->get();
        foreach($business_and_security as $a){
            $a->update([
                'parent_id' => $tag->id,
            ]);
        }

        $tag = Tag::where('name' , 'Building')->first();
        $building = Tag::where('name' , 'Balcony or Terrace')
        ->orWhere('name' , 'Lobby in Building')
        ->orWhere('name' , 'Service Elevators')
        ->orWhere('name' , 'Prayer Room')
        ->orWhere('name' , 'Completion Year')
        ->orWhere('name' , 'Elevators in Building')
        ->orWhere('name' , 'Reception/Waiting Room')->get();
        foreach($building as $s){
            $s->update([
                'parent_id' => $tag->id,
            ]);
        }

        $tag = Tag::where('name' , 'Laundry and Kitchen')->first();
        $laundry_and_kitchen = Tag::where('name' , 'Laundry Room')
        ->orWhere('name' , 'Laundry Facility')
        ->orWhere('name' , 'Shared Kitchen')->get();
        foreach($laundry_and_kitchen as $d){
            $d->update([
                'parent_id' => $tag->id,
            ]);
        }

        $tag = Tag::where('name' , 'Health and Fitness')->first();
        $healt_an_fitness = Tag::where('name' , 'First Aid Medical Center')
        ->orWhere('name' , 'Gym or Health Club')
        ->orWhere('name' , 'Jacuzzi')
        ->orWhere('name' , 'Swimming Pool')
        ->orWhere('name' , 'Steam Room')
        ->orWhere('name' , 'Sauna')
        ->orWhere('name' , 'Facilities for Disabled')->get();
        foreach($healt_an_fitness as $t){
            $t->update([
                'parent_id' => $tag->id,
            ]);
        }

        $tag = Tag::where('name' , 'Recreation and Family')->first();
        $recreation_an_family = Tag::where('name' , 'Barbeque Area ')
        ->orWhere('name' , 'Day Care Center')
        ->orWhere('name' , 'Lawn or Garden')
        ->orWhere('name' , 'Cafeteria or Canteen')
        ->orWhere('name' , 'Kids Play Area')->get();
        foreach($recreation_an_family as $w){
            $w->update([
                'parent_id' => $tag->id,
            ]);
        }
    }
}
