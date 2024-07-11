<?php

namespace App\Models;

use Carbon\Carbon;
use Str;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    public $table = 'audit_logs';

    protected $fillable = [
        'description',
        'subject_id',
        'subject_type',
        'user_id',
        'properties',
        'host',
    ];

    protected $casts = [
        'properties' => 'collection',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getActivityAttribute()
    {
        return sprintf('%s: <span class="text-secondary"><b>%s</b></span> %s#%s by %s', Carbon::parse($this->created_at)->format(config('panel.datetime_long_format')), Str::ucfirst($this->description), $this->subject_type, $this->subject_id, $this->user->name ?? 'System User');

        // {{ $auditLog->created_at . ' ,' }} <b>{{$auditLog->description . ' '}}</b> {{$auditLog->subject_type . ' With ID: ' . $auditLog->subject_id}} {{' By: ' . ( isset($auditLog->user) ? $auditLog->user->name : 'Deleted User') }}
    }
}
