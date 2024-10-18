<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;
use Storage;

class User extends Authenticatable //implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
		'photo'
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
	
	public function comments() {
		return $this->hasMany(Comment::class);
	}

	public function posts() {
		return $this->hasMany(Post::class);
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
	
	public function getProfilePhotoUrl() {
		//if (!empty($this->photo)&&file_exists(Storage::disk('profile-photos')->path($this->photo))&&!empty($this->photo))
		if (!empty($this->photo)&&(Storage::disk('profile-photos')->exists($this->photo)))
			$photoUrl = Storage::disk('profile-photos')->url($this->photo);
		else 
			$photoUrl = '/images/profile-photo.png';
			
		return $photoUrl;	
	}
}
