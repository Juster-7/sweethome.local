<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasProfilePhoto;
use Orchid\Platform\Models\User as Authenticatable;

class User extends Authenticatable
{
	use HasFactory, Notifiable, HasApiTokens, HasProfilePhoto;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'name',
        'email',
        'password',
		'permissions',
		'photo',
		'role_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
        //'password'    => 'hashed', // $user = User::create([ // ... 'password' => 'password', // Instead of Hash::make('password') ]);

    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',
        'email',
        'permissions',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
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
	
	public function profilePhotoUrl() {
		return $this->getProfilePhotoUrl($this->photo);	
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
}
