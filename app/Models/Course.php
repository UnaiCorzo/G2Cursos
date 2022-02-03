<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'location',
        'description',
        'price',
        'image',
        'teacher_id',
    ];

    public function teacher()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }
}
