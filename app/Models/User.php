<?php

namespace App\Models;

use Hash;
use Carbon\Carbon;
use \DateTimeInterface;
use App\Traits\Auditable;
use App\Models\Dashboard\Unit;
use App\Models\Dashboard\Agent;
use App\Models\Dashboard\BaseModel;

use App\Models\Dashboard\Call;
use App\Models\Dashboard\Contact;
use App\Models\Dashboard\Tag;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use HasFactory;
    use Auditable;

    public $table = 'users';

    // public static $searchable = [
    //     'name',
    //     'email',
    // ];

    protected $hidden = [
        'remember_token',
        'password',
    ];

    protected $dates = [
        'birthdate',
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $guarded = ['roles'];

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function getBirthdateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBirthdateAttribute($value)
    {
        $this->attributes['birthdate'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    // public function setEmailVerifiedAtAttribute($value)
    // {
    //     $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    // }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('panel.datetime_format'));
    }

    public function calls()
    {
        return $this->hasMany(Call::class, 'agent_id');
    }
    
    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'contact_user')->where('is_lead', 'no');
    }
    public function favorites()
    {
        return $this->belongsToMany(Unit::class);
    }

    public function units(): BelongsToMany{
        return $this->belongsToMany(Unit::class, 'agent_unit');
    }

    public function getIsAgentAttribute(){
        return $this->roles()->where('title', 'Agent')->exists();
    }

    public function getCreatedByAttribute()
    {
        return AuditLog::where('description', 'create')->where('subject_id', $this->id)->where('subject_type', get_class($this))->first()->user ?? null;
    }

    public function getAllowEditAttribute()
    {
        return (isset($this->createdBy) && auth()->user()->id === $this->createdBy->id) || auth()->user()->isAdmin;
    }

    public function getAllowDeleteAttribute()
    {
        return $this->allowEdit;
    }

    public function getAuditlogsAttribute()
    {
        return AuditLog::where('subject_id', $this->id)->where('subject_type', get_class($this))->latest()->get();
    }

    public function leads()
    {
        return $this->belongsToMany(Contact::class, 'contact_user')->where('is_lead', 'yes');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'user_tag');
    }

    public function getCreatedPropertiesAttribute(){
        $logs = AuditLog::where('user_id' , $this->id)
        ->where('subject_type' , get_class(New \App\Models\Dashboard\Unit))
        ->where('description' , 'create')->latest()->pluck('subject_id');
        $properties = [];
        foreach($logs as $log){
            if($unit = Unit::find($log))
            array_push($properties , $unit);
        }
        return $properties;
    }
}