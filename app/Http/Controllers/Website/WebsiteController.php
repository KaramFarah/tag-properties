<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Tag;
use App\Models\Dashboard\Unit;
use Share;

class WebsiteController extends Controller
{
    public function getShareLinks(){

        $shareLinks = Share::page('https://' . config('panel.live_domain') , 'Share title')
        ->facebook()
        ->whatsapp()
        ->linkedin()
        ->getRawLinks();
        return $shareLinks;
    }

    public function getRecentProperties($limit = 5)
    {
        return Unit::latest()
        ->with('media', 'project' , 'tags' , 'installments' , 'floors' , 'places')
        ->where('published' , 1)->limit($limit)
        ->get();
    }

    public function getFeaturedProperties($limit = 5)
    {
        return Unit::latest()
        ->with('media', 'project' , 'tags' , 'installments' , 'floors' , 'places')
        ->where('published' , 1)->where('featuered', 1)->limit($limit)
        ->get();
    }

    public function getEmirates(){
        return [
            ''               => '-- Choose',
            'Abu Dhabi'      => 'Abu Dhabi',
            'Dubai'          => 'Dubai',
            'Ras Al Khaimah' => 'Ras Al Khaimah',
            'Sharjah'        => 'Sharjah',
            'Ajman'          => 'Ajman',

        ];
    }
}
