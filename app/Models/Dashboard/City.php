<?php

namespace App\Models\Dashboard;

use App\Models\Dashboard\Unit;
use App\Helpers\DashboardHelper;
use App\Models\Dashboard\Project;
use App\Models\Dashboard\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class City extends BaseModel
{
    use HasFactory;

    public function developers()
    {
        return $this->hasMany(Developer::class)->latest();
    }

    public function projects()
    {
        return $this->hasMany(Project::class)->latest();
    }
    public function units()
    {
        return $this->hasMany(Unit::class)->latest();
    }

    public function country()
    {
        return $this->country_code ? DashboardHelper::countries()[$this->country_code] : '';
    }

}
