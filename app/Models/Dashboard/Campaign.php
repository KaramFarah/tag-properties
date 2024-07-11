<?php

namespace App\Models\Dashboard;
use App\Models\Dashboard\Contact;

class Campaign extends BaseModel
{
    
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function getTitleAttribute()
    {
        return sprintf('%s (%s -> %s)', $this->name, $this->start_date, $this->end_date);
    }
}
