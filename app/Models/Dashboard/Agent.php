<?php

namespace App\Models\Dashboard;

use App\Models\Call;
use App\Models\Role;
use App\Models\User;
use App\Models\Dashboard\Unit;
use App\Models\Dashboard\Contact;

class Agent extends BaseModel
{
    protected $guarded = ['roles'];
    
    public function calls()
    {
        return $this->hasMany(Call::class);
    }

    public function leads()
    {
        return $this->hasMany(Contact::class)->where('is_lead', 1);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
