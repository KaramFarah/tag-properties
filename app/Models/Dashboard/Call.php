<?php

namespace App\Models\Dashboard;
use App\Models\User;
use App\Models\Dashboard\Agent;
use App\Models\Dashboard\Comment;
use App\Models\Dashboard\Contact;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Call extends BaseModel
{
    protected $guarded = ['agent_name' , 'agent_email'];
    
    public function __construct(array $attributes = [])
    {
        //format used YYYY-MM-DDThh:mm:ssTZD
        // date = date('Y-m-d');datetime = date('Y-m-dÞ:i:s', strtotime(date));
        $this->setRawAttributes([
            'date' => date('Y-m-d\TH:i:s'),
            'agent_id' => auth()->user()->agent->id ?? ''
        ], true);
        parent::__construct($attributes);
    }

    // public function agent(): BelongsTo
    // {
    //     return $this->belongsTo(Agent::class);
    // }
    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function getTitleAttribute()
    {
        return sprintf('%s with %s on %s at %s', Str::ucfirst($this->type), $this->contact->name ?? '', date('Y-m-d', strtotime($this->date)), date('H:i', strtotime($this->date)));  
    }
}
