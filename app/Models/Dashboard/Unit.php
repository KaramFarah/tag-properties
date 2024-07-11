<?php

namespace App\Models\Dashboard;

use App\Helpers\DashboardHelper;
use Carbon\Carbon;
use App\Models\User;
use \DateTimeInterface;
use App\Models\AuditLog;
use Illuminate\Support\Str;
use App\Models\Dashboard\City;
use App\Models\Dashboard\Floor;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\DB;
use App\Models\Dashboard\NearbyPlace;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Unit extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    public const PROPERTY_TYPE_HOUSE = 1;
    public const PROPERTY_TYPE_OFFICE = 2;
    public const PROPERTY_TYPE_APPARTMENT = 3;
    public const PROPERTY_TYPE_CONDOS = 4;
    public const PROPERTY_TYPE_VILLA = 5;
    public const PROPERTY_TYPE_SMALLFAMILY = 6;
    public const PROPERTY_TYPE_SINGLEROOM = 7;
    public const PROPERTY_TYPE_HOTEL = 8;
    public const PROPERTY_TYPE_TWONHOUSE = 9;
    public const PROPERTY_TYPE_RETAIL = 10;
    public const PROPERTY_TYPE_PLOTS = 11;
    public const PROPERTY_TYPE_PENTHOUSES = 12;
    
    public const PROPERTY_STATUS_READY = 1;
    public const PROPERTY_STATUS_OFFPLAN = 2;

    public const PROPERTY_PURPOSE_FORSALE = 1;
    public const PROPERTY_PURPOSE_FORRENT = 2;

    public const PROPERTY_OWNERSHIP_FREEHOLD = 1;
    public const PROPERTY_OWNERSHIP_LEASEHOLD = 2;

    

    protected $guarded = ['forward']; // '_token',

    protected $attributes = [
        'availability' => 1,
        'published' => 1,
        'area_sqft' => 0,
        'bedrooms' => 1,
        'bathrooms' => 1
    ];

    public function getPropertyTypesAttribute()
    {
        return [
            self::PROPERTY_TYPE_PENTHOUSES => __('Penthouses'),
            self::PROPERTY_TYPE_APPARTMENT => __('Apartments'),
            self::PROPERTY_TYPE_VILLA => __('Villa'),
            self::PROPERTY_TYPE_HOTEL => __('Hotel'),
            self::PROPERTY_TYPE_OFFICE => __('Office'),
            self::PROPERTY_TYPE_RETAIL => __('Retail'),
            self::PROPERTY_TYPE_PLOTS => __('Plots'),
            self::PROPERTY_TYPE_TWONHOUSE => __('Townhouse'),
        ];
    }

    public function getPropertyTypeIconsAttribute () 
    {
        return [
            self::PROPERTY_TYPE_PENTHOUSES => 'flaticon-sketch',
            self::PROPERTY_TYPE_APPARTMENT => 'flaticon-bed',
            self::PROPERTY_TYPE_VILLA => 'flaticon-sketch-1',
            self::PROPERTY_TYPE_HOTEL => 'flaticon-spa',
            self::PROPERTY_TYPE_OFFICE => 'flaticon-online-booking',
            self::PROPERTY_TYPE_RETAIL => 'flaticon-shop',
            self::PROPERTY_TYPE_PLOTS => 'flaticon-real-estate',
            self::PROPERTY_TYPE_TWONHOUSE => 'flaticon-home',
        ];
    }

    public function getPropertyTypeTextAttribute(){
        return isset($this->propertyTypes[$this->property_type]) ? $this->propertyTypes[$this->property_type] : '';
    }

    public function getPropertyTypeIconAttribute()
    {
        return (isset($this->propertyTypeIcons[$this->property_type]) ? $this->propertyTypeIcons[$this->property_type] : 'flaticon-real-estate');
    }

    public function getPropertyStatusesAttribute()
    {
        return [
            self::PROPERTY_STATUS_READY => __('Ready'),
            self::PROPERTY_STATUS_OFFPLAN => __('Off Plan'),
        ];
    }

    public function getPropertyStatusTextAttribute()
    {
        return $this->property_status ? $this->propertyStatuses[$this->property_status] : '';
    }

    public function getPropertyPurposesAttribute()
    {
        return [
            self::PROPERTY_PURPOSE_FORSALE => __('For Sale'),
            self::PROPERTY_PURPOSE_FORRENT => __('For Rent'),
        ];
    }

    public function getPropertyPurposeTextAttribute()
    {
        return $this->property_purpose ? $this->propertyPurposes[$this->property_purpose] : '';
    }

    public function getPropertyOwnershipsAttribute()
    {
        return [
            self::PROPERTY_OWNERSHIP_FREEHOLD => __('Freehold'),
            self::PROPERTY_OWNERSHIP_LEASEHOLD => __('Leasehold'),
        ];
    }

    public function getPropertyOwnershipTextAttribute(){
        return $this->property_ownership ? $this->propertyOwnerships[$this->property_ownership] : '';
    }

    public function getFullLocationAttribute(){
        $location = '';
        
        if ($this->cities) {
            foreach($this->cities as $_city){
                $location .= ($location ? ', ' : '') . $_city->name;
            }
        }
        $location .= ($location ? ', ' : '') . $this->location; // Text field
        $location .= ($location ? ', ' : '') . $this->address;
        
        $country = DashboardHelper::countries()[$this->country] ?? '';
        $country ? ($location .= ($location ? ', ' : '') . $country) : '';

        if (!$location){
            $location = $this->project->fullLocation ?? '';
        }

        return Str::ucfirst($location);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function tags(): BelongsToMany{
        return $this->belongsToMany(Tag::class, 'unit_tag')->withPivot('tag_value')->orderBy('parent_id')->orderBy('name');
    }

    public function assignee(): BelongsToMany{
        return $this->belongsToMany(User::class, 'agent_unit');
    }

    public function getSelectedOption(Tag $tag)
    {
        $options = explode( ',' , $tag->value_options);
        // dd($tag);
        foreach($options as $key => $option){
            if(($this->tags()->wherePivot('tag_id' , $tag->id)->first()->pivot->tag_value ?? '') == $key){
                return $option;
            }
            else return 'No value Selected';
        }
    }

    public function installments(){
        return $this->belongsToMany(Installment::class, 'unit_installment');
    }
    public function floors(){
        return $this->belongsToMany(Floor::class);
    }
    public function places(){
        return $this->belongsToMany(NearbyPlace::class);
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function getAttachmentsAttribute()
    {
        return $this->getMedia('unit-attachment');
    }
    
    public function getFloorPlanPhotosAttribute()
    {
        return $this->getMedia('unit-floorplans');
    }

    public function getDeveloperNameAttribute(){
        if($this->project){
            return $this->project->developers->last()->name ?? '';
        }else{
            return 'No Developers Info';
        }
    }

    public function getGasAttribute(){
        $buf = $this->tags->pluck('name')->toArray();
        return $res = array_search('Gas', $buf, true);
    }

    public function getHasResturantAttribute(){
        $places = $this->places;
        foreach($places as $place){
            if($place->main_type == 'resturant')
            return true;
        }
        return false;
    }
    public function getGetResturantAttribute(){
        //resturant hospital shopping school
        $places = $this->places;
        $buf = array();
        foreach($places as $place){
            if($place->main_type == 'resturant')
            array_push($buf , $place);
        }
        return $buf;
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


    public function getIsFavouriteAttribute(){
        $buf = $this->users->pluck( 'id' , 'name')->toArray(); // all the users that like it

        $user = array_search(auth()->user()->id, $buf, true); // return the name of user how like it

        if(auth()->user()->name === $user)
            return true;

        return false;

    }

    public function getPostDateAttribute(){
        $createdAt = Carbon::parse($this->created_at);
        $buf = $createdAt->diffForHumans();
        return $buf;
    }



    // Assuming $model is your model instance or database record
    
    protected static function boot() {
        parent::boot();

        static::saving(function ($model) {
            $model->id ? $id = $model->id : $id = DB::table('units')->max('id') + 1;
            $model->slug = Str::of($model->name . ' ' . $id)->slug('-');
        });
    }

    public function getRecommendedCountAttribute(){
        return $this->users->count();
    }

    public function cities()
    {
        return $this->belongsToMany(City::class);
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
        $images = $this->getMedia('unit-photos')->all();
        if($images){
            return $images;
        }
    }
    public function getWebsiteImageAttribute(){
        $image = $this->getMedia('unit-photos')->last();
        if($image){
            return $image->getUrl('website');
        }
    }
    public function getQuickViewAttribute(){
        $image = $this->getMedia('unit-photos')->last();
        if($image){
            return $image->getUrl('quick-view');
        }
    }
    public function getOriginalImageAttribute(){
        $image = $this->getMedia('unit-photos')->last();
        if($image){
            return $image->getUrl();
        }
    }
    public function getFeaturedAttribute(){
        $image = $this->getMedia('unit-photos')->last();
        if($image){
            return $image->getUrl('featured');
        }
    }
    public function getPrintAttribute(){
        $image = $this->getMedia('unit-photos')->last();
        if($image){
            return $image->getUrl('print');
        }
    }
    public function getRecentAttribute(){
        $image = $this->getMedia('unit-photos')->last();
        if($image){
            return $image->getUrl('thumb');
        }
    }
}
