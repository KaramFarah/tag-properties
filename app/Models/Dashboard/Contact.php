<?php

namespace App\Models\Dashboard;

use App\Models\Role;
use App\Models\User;
use \DateTimeInterface;
// use Spatie\Image\Manipulations;
use App\Models\Dashboard\City;
use App\Models\Dashboard\Agent;
use App\Models\Dashboard\Comment;
use Spatie\MediaLibrary\HasMedia;
use App\Models\Dashboard\Campaign;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends BaseModel implements HasMedia
{

    use InteractsWithMedia;

    protected $attributes = [
        'priority' => 'medium'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'passport_expiry'
    ];
    // public function __construct(array $attributes = [])
    // {
    //     $this->setRawAttributes([
    //         'agent_id' => auth()->user()->agent->id ?? ''
    //     ], true);
    //     parent::__construct($attributes);
    // }

    // protected $fillable = [
    //     'name',
    //     'email',
    //     'birthdate',
    //     'title',
    //     'phone1',
    //     'phone2',
    //     'area',
    //     'street',
    //     'city',
    //     'designation',
    //     'company',
    //     'source',
    //     'interests',
    //     'gender',
    //     'created_at',
    //     'updated_at',
    //     'deleted_at',
    // ];

    protected $guarded = 
    [
        'tags' ,
        'agents' , 
        'content*'];

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function cities()
    {
        return $this->belongsToMany(City::class);
    }
    
    public function calls()
    {
        return $this->hasMany(Call::class);
    }
 
    public function agents()
    {
        return $this->belongsToMany(User::class);
    }
    // public function agent()
    // {
    //     return $this->belongsTo(Agent::class);
    // }
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
    public function parent()
    {
        return $this->belongsTo(Contact::class, 'parent_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }
}
