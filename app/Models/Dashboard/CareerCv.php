<?php

namespace App\Models\Dashboard;

use App\Models\Dashboard\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CareerCv extends BaseModel implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'cvs';

    protected $guarded = ['cv'];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCvAttribute()
    {
        return $this->getMedia('cv');
    }
}
