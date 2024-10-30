<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasProfilePhoto;

class User extends Authenticatable //implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens, HasProfilePhoto;
	
    protected $fillable = [
        'name',
        'email',
        'password',
		'photo',
		'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
	public function role() {
		return $this->belongsTo(Role::class);
	}
	
	public function comments() {
		return $this->hasMany(Comment::class);
	}

	public function posts() {
		return $this->hasMany(Post::class);
	}
	
	public function isAdmin() {			
		return $this->role_id === 1;	
	}
	
	public function sendPasswordResetNotification($token) {
        $notification = new ResetPassword($token);
        $notification->createUrlUsing(function ($user, $token) {
            return url(route('user.password.reset', [
                'token' => $token,
                'email' => $user->email
            ]));
        });
        $this->notify($notification);
    }
	
	public function profilePhotoUrl() {
		return $this->getProfilePhotoUrl($this->photo);	
	}
}
