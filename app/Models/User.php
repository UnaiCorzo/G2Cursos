<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surnames',
        'email',
        'password',
        'dni',
        'cv',
        'role_id',
        'company_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** Get the post that owns the comment. */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function course_teacher()
    {
        return $this->hasMany('App\Models\Course', 'teacher_id');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating', 'user_id');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Models\Course')
            ->withTimestamps();
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
}
