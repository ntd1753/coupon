<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'membership_level_id',
        'membership_expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'membership_level_id',
        'membership_expires_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function CouponHistory(){
        return $this->hasMany(CouponHistory::class);
    }
    function products(){
        return $this->hasMany(Product::class,'vendor_id','id');
    }
    public function membershipLevel()
    {
        return $this->belongsTo(LoyaltyMembership::class, 'membership_level_id');
    }
    public function loyalty()
    {
        return $this->hasOne(Loyalty::class);
    }

    public function loyaltyTransactions()
    {
        return $this->hasMany(LoyaltyTransaction::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    protected static function booted()
    {
        static::created(function ($user) {
            $folderName = 'user_' . $user->id . '_' . Str::slug($user->name);
            Storage::disk('public')->makeDirectory("upload/{$folderName}");
        });
    }
}
