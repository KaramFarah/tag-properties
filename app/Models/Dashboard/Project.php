<?php

namespace App\Models\Dashboard;

use App\Helpers\DashboardHelper;
use \DateTimeInterface;
use Illuminate\Support\Str;
use App\Models\Dashboard\City;
use App\Models\Dashboard\Unit;
use App\Models\Dashboard\Range;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\DB;
use App\Models\Dashboard\Installment;
use App\Models\Dashboard\NearbyPlace;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    public $table = 'projects';

    protected static function boot() {
        parent::boot();
        static::saving(function ($model) {
            $model->id ? $id = $model->id : $id = DB::table('projects')->max('id') + 1;
            $model->slug = Str::of($model->name . ' ' . $id)->slug('-');
        });
    }

    protected $types = [
        'off-plan',
        'sale',
    ];

    protected $guarded = ['developers', 'attachments'];
    
    public const PROJECT_STATUS_OFFPLAN = 1;
    public const PROJECT_STATUS_READY = 2;

    static public function getStatusesAttribute()
    {
        return [
            self::PROJECT_STATUS_OFFPLAN => __('Off Plan'),
            self::PROJECT_STATUS_READY => __('Ready')
        ];
    }
    
    public function getStatusTextAttribute(){
        return $this->status ? Str::ucFirst($this->statuses[$this->status]) : '';
    }

    public function registerMediaConversions(Media $media = null):void
    {
        $this->addMediaConversion('thumb')
             ->crop(Manipulations::CROP_TOP_RIGHT, 300, 300);
        $this->addMediaConversion('website')
             ->crop(Manipulations::CROP_TOP_RIGHT, 415, 279);
        $this->addMediaConversion('featured')
             ->crop(Manipulations::CROP_TOP_RIGHT, 354, 237);
        $this->addMediaConversion('quick-view')
             ->fit(Manipulations::FIT_CROP, 470, 580);
        $this->addMediaConversion('print')
             ->fit(Manipulations::FIT_STRETCH, 600);
    }

    public function getThumbImageAttribute(){
        return $this->getMedia('projects');
    }
    public function getWebsiteImageAttribute(){
        $image = $this->getMedia('projects')->last();
        if($image){
            return $image->getUrl('website');
        }
    }
    
    public function getAttachmentsAttribute()
    {
        return $this->getMedia('projects');
    }

    public function getCoverImageAttribute()
    {
        if ($_cover = $this->attachments->first()){
            return $_cover->getUrl();
        }
    }

    public function getAllPhotosAttribute()
    {
        $_collection = collect($this->attachments);
        $merged = $_collection->merge($this->photos);

        return $merged->all();
    }

    public function getProjectPhotosAttribute()
    {
        return $this->getMedia('project-photos');
    }

    public function getAvailabilityListAttribute()
    {
        return $this->getMedia('availability-list');
    }

    public function getPaymentPlanAttribute()
    {
        return $this->getMedia('payment-plan');
    }

    public function getBrochureAttribute()
    {
        return $this->getMedia('brochure');
    }

    public function developers() : BelongsToMany
    {
        return $this->belongsToMany(Developer::class, 'project_developer');
    }

    public function units(): HasMany
    {
        return $this->hasMany(Unit::class)->where('published', 1);
    }
    public function Ranges(){
        return $this->belongsToMany(Range::class);
    }
    public function places(){
        return $this->belongsToMany(NearbyPlace::class);
    }

    public function installments(){
        return $this->belongsToMany(Installment::class);
    }

    public function cities()
    {
        return $this->belongsToMany(City::class);
    }

    public function getFullLocationAttribute(){
        
        return $this->community ?? 'No Location Info';
    }
    // public function getFullLocationAttribute(){
    //     $location = '';
        
    //     if ($this->cities) {
    //         foreach($this->cities as $_city){
    //             $location .= ($location ? ', ' : '') . $_city->name;
    //         }
    //     }

    //     $location .= ($location ? ', ' : '') . $this->community;

    //     $location .= ($location ? ', ' : '') . $this->province;

    //     $country = DashboardHelper::countries()[$this->country] ?? '';
    //     $country ? ($location .= ($location ? ', ' : '') . $country) : '';

    //     return $location;
    // }

    public function getMinPriceAttribute()
    {
        return $this->ranges()->orderBy('min_price')->first()->min_price ?? 0;
    }

    public function getMaxSizeAttribute()
    {
        return $this->ranges()->orderByDesc('max_size')->first()->max_size ?? 0;
    }

    public function getMinSizeAttribute()
    {
        return $this->ranges()->orderBy('min_size')->first()->min_size ?? 0;
    }

    public function getHasHospitalAttribute(){
        $places = $this->places;
        foreach($places as $place){
            if($place->main_type == 'hospital')
            return true;
        }
        return false;
    }
    public function getGetHospitalAttribute(){
        //resturant hospital shopping school
        $places = $this->places;
        $buf = array();
        foreach($places as $place){
            if($place->main_type == 'hospital')
            array_push($buf , $place);
        }
        return $buf;
    }

    public function getHasShoppingAttribute(){
        $places = $this->places;
        foreach($places as $place){
            if($place->main_type == 'shopping')
            return true;
        }
        return false;
    }
    public function getGetShoppingAttribute(){
        //resturant hospital shopping school
        $places = $this->places;
        $buf = array();
        foreach($places as $place){
            if($place->main_type == 'shopping')
            array_push($buf , $place);
        }
        return $buf;
    }

    public function getHasSchoolAttribute(){
        $places = $this->places;
        foreach($places as $place){
            if($place->main_type == 'school')
            return true;
        }
        return false;
    }
    public function getGetSchoolAttribute(){
        //resturant hospital shopping school
        $places = $this->places;
        $buf = array();
        foreach($places as $place){
            if($place->main_type == 'school')
            array_push($buf , $place);
        }
        return $buf;
    }
}
