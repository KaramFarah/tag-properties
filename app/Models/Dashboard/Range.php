<?php

namespace App\Models\Dashboard;

use App\Models\Dashboard\Project;
use App\Models\Dashboard\BaseModel;

class Range extends BaseModel
{
    public const RANGE_TYPE_STUDIO = 5;
    public const RANGE_TYPE_1BR = 1;
    public const RANGE_TYPE_2BR = 2;
    public const RANGE_TYPE_3BR = 3;
    public const RANGE_TYPE_4BR = 4;

    static public function getRangeTypes()
    {
        return [
            self::RANGE_TYPE_STUDIO => __('Studio'),
            self::RANGE_TYPE_1BR => __('1 Bed Room'),
            self::RANGE_TYPE_2BR => __('2 Bed Rooms'),
            self::RANGE_TYPE_3BR => __('3 Bed Rooms'),
            self::RANGE_TYPE_4BR => __('5 Bed Room'),
        ];
    }

    public function getRangeTypeTextAttribute()
    {
        return ($this->unit_type ? $this->getRangeTypes()[$this->unit_type] : '');
    }

    public function projects(){
        return $this->belongsToMany(Project::class);
    }
}
