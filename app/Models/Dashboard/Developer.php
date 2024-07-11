<?php
namespace App\Models\Dashboard;
use \DateTimeInterface;
use Illuminate\Support\Str;
use Spatie\Image\Manipulations;
use App\Models\Dashboard\Project;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Developer extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = ['logo'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit(Manipulations::FIT_FILL, 400, 400);
    }

    public function getLogoAttribute()
    {
        $_images = $this->getMedia('logos');
        return isset($_images[0]) ? $_images[0]->getUrl() : '';
    }

    public function getLogoMediaAttribute()
    {
        $_images = $this->getMedia('logos');
        return isset($_images[0]) ? $_images[0] : '';
    }

    public function getLogoThumbAttribute()
    {
        $_images = $this->getMedia('logos');
        return isset($_images[0]) ? $_images[0]->getUrl('thumb') : '';
    }

    public function projects() : BelongsToMany
    {
        return $this->belongsToMany(Project::class , 'project_developer');
    }

    protected static function boot() {
        parent::boot();
        static::saving(function ($model) {
            $model->slug = Str::of($model->name . ' ' . $model->id)->slug('-');
        });
    }

    public function getUnitsAttribute()
    {
        $developer_units = [];
        foreach($this->projects as $project){
            foreach($project->units as $unit){
                array_push($developer_units , $unit);
            }
        }

        return $developer_units;
    }
}
