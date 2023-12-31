<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'mobile',
        'email',
        'password',
        'role',
        'profile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function likes(){
        return $this->belongsToMany(Post::class , 'likes');
    }

    public function getRoleInPersian(){
        if ($this->role === 'user') return 'کاربر معمولی' ;
        if ($this->role === 'author') return 'نویسنده' ;
        if ($this->role === 'admin') return 'مدیر' ;
    }

    public function getCreatedAtInJalali(){
        return Verta($this->created_at)->format('y/m/d');
    }

    public function getProfileImage(){

        return asset('images/users/' . $this->profile);
    }

}
