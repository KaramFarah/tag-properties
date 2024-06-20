<?php

namespace App\Models\Dashboard;

use App\Models\Dashboard\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Career extends BaseModel
{
    use HasFactory;

    public function careerCvs()
    {
        return $this->hasMany(CareerCv::class)->latest();
    }
}
