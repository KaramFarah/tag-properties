<?php

namespace App\Models\Dashboard;

use App\Models\Dashboard\Unit;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use App\Models\Dashboard\BaseModel;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class Floor extends BaseModel implements HasMedia
{
    use InteractsWithMedia;
    protected $guarded = ['unit_id'];
    public function units(){
        return $this->belongsToMany(Unit::class);
    }
    public function registerMediaConversions(Media $media = null):void
    {
        $this->addMediaConversion('thumb')
             ->crop(Manipulations::CROP_TOP_RIGHT, 150, 150);
        $this->addMediaConversion('website-preview')
             ->crop(Manipulations::CROP_TOP_RIGHT, 746, 528);
    }
    public function getThumbImageAttribute(){
        $images = $this->getMedia('floor-photos')->all();
        if($images){
            return $images;
        }
    }
    public function getWebsitePreviewAttribute(){
        $images = $this->getMedia('floor-photos')->first();
        if($images){
            return $images->getUrl('website-preview');
        }
    }
}
