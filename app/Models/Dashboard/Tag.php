<?php

namespace App\Models\Dashboard;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Dashboard\Unit;
use App\Models\Dashboard\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends BaseModel
{
    public const VALUE_TYPE_BOOLEAN = '';
    public const VALUE_TYPE_TEXT = 'text';
    public const VALUE_TYPE_DROPDOWN = 'dropdown';

    static public function valueTypes()
    {
        return [
            self::VALUE_TYPE_BOOLEAN => __('Yes/No'),
            self::VALUE_TYPE_TEXT => __('Text'),
            self::VALUE_TYPE_DROPDOWN => __('Dropdown')
        ];
    }

    public function getValueTypeTextAttribute()
    {
        return self::valueTypes()[$this->value_type];
    }

    public function getOptionsAsArrayAttribute()
    {
        return explode( ',' , $this->value_options);
    }

    public function parent()
    {
        return $this->belongsTo(Tag::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Tag::class, 'foreign_key', 'local_key');
    }

    protected static function boot() {
        parent::boot();
        static::saving(function ($model) {
            $model->id ? $id = $model->id : $id = DB::table('tags')->max('id') + 1;
            $model->slug = Str::of($id . ' ' . $model->name)->slug('-');
        });
    }
    
    public function contacts(){
        return $this->belongsToMany(Contact::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function units(){
        return $this->belongsToMany(Unit::class, 'unit_tag')->withPivot('tag_value');
    }
}