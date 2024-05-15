<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Events\UserAddressCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    public $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prefixname',
        'firstname',
        'middlename',
        'lastname',
        'suffixname',
        'username',
        'type',
        'email',
        'password',
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
    // public static function boot()
    // {
    //     parent::boot();
    //     static::created(function ($user) {
    //         event(new UserAddressCreated($user, request()->input('addresses', [])));
    //     });
    // }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    public function images()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
