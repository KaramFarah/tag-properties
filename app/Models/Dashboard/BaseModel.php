<?php

namespace App\Models\Dashboard;

use App\Models\User;
use \DateTimeInterface;
use App\Models\AuditLog;
use App\Traits\Auditable;
use App\Models\Dashboard\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BaseModel extends Model
{
    use HasFactory,SoftDeletes;
    use Auditable;
    protected $guarded = [];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('panel.datetime_format'));
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
    public function getCreatorAttribute(){
        $creator = AuditLog::where('description' , 'create')
        ->where('subject_type' , get_class($this))
        ->where('subject_id' , $this->id)->get();
        $id = $creator->first()->user_id ?? '';
        return User::withTrashed()->find($id) ?? 'This User is Deleted';
    }
}

?>