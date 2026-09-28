<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'phone',
        'profile_pic',
        'is_admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    static function getAdminList()
    {
        return User::select('users.*')
            ->where('user_type', 1)
            ->where('is_delete', 0 )
            ->orderBy('id', 'desc')
            ->get();
    }

    public function getProfilePicUrl()
    {
        if (!empty($this->profile_pic) && file_exists(public_path('upload/profile/' . $this->profile_pic))) {
            return asset('upload/profile/' . $this->profile_pic);
        }
        return asset('assets/img/user1-128x128.jpg');
    }
}
