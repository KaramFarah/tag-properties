<?php

namespace App\Models\Dashboard;


// use Spatie\Image\Manipulations;
use DateTime;
use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Blog extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = ['photos'];

    public function __construct(array $attributes = [])
    {
        $this->setRawAttributes([
            'user_id'      => Auth::user()->id ?? '',
            'publish_date' => date('Y-m-d'),
        ], true);
        
        parent::__construct($attributes);
    }


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'publish_date'
    ];

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected static function boot() {
        static::saving(function ($model) {
            $max_id = Blog::max('id');
            $model->slug = Str::of($model->title . '-' . ($model->id ??  $max_id + 1))->slug('-');
        });

        parent::boot();
    }

    public function getCreatorAttribute()
    {
        if ($this->user_id){
            return User::where('id' , $this->user_id)->first();
        }
        else{
            return parent::creator;
        }
    }
    
    public function registerMediaConversions(Media $media = null):void
    {
        $this->addMediaConversion('full')
             ->crop(Manipulations::CROP_TOP_RIGHT, 820, 550);
        $this->addMediaConversion('preview')
             ->fit(Manipulations::FIT_FILL, 100, 100);
        $this->addMediaConversion('thumb')
             ->crop(Manipulations::CROP_TOP_RIGHT, 415, 279);
            //  ->crop(Manipulations::CROP_TOP_RIGHT, 820, 550);
    }

    public function getThumbImageAttribute(){
        $image = $this->getMedia('blog-photos')->first();
        if($image){
            return $image->getUrl('thumb');
        }
    }

    public function getPreviewImageAttribute(){
        $image = $this->getMedia('blog-photos')->first();
        if($image){
            return $image->getUrl('preview');
        }
    }
    
    public function getFullImageAttribute(){
        $image = $this->getMedia('blog-photos')->first();
        if($image){
            return $image->getUrl('full');
        }
    }
}