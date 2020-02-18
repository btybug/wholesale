<?php

namespace App;

use Actuallymab\LaravelComment\CanComment;
use App\Models\Addresses;
use App\Models\Coupons;
use App\Models\Dashboard;
use App\Models\Favorites;
use App\Models\MailJob;
use App\Models\Notifications\CustomEmails;
use App\Models\Orders;
use App\Models\ReferralBonus;
use App\Models\Roles;
use App\Models\Stock;
use App\Models\StockVariation;
use App\Models\Ticket;
use App\Models\UserNotes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'username', 'email', 'password', 'phone', 'country', 'gender', 'status', 'referred_by', 'role_id',
        'verification_type', 'verification_image', 'customer_number', 'dob', 'company_name', 'company_number', 'wholesaler_status'
    ];

    protected $appends = [
        'age'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAgeAttribute()
    {
        $dateOfBirth = $this->dob;
        if ($dateOfBirth == '0000-00-00') {
            return null;
        }

        $years = \Carbon\Carbon::parse($dateOfBirth)->age;
        return $years;
    }

    public function role()
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }

    public function addresses()
    {
        return $this->hasMany(Addresses::class, 'user_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Orders::class, 'user_id')->with('items')->with('history');
    }

    public function favorites()
    {
        return $this->belongsToMany(Stock::class, 'favorites', 'user_id', 'stock_id');
    }

    public function authorAttributes()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'url' => 'URL',    // optional
            'avatar' => '/public/images/' . $this->gender . '.png', // optional
        ];
    }

    public function sendEmailVerificationNotification()
    {

    }

    public function sendPasswordResetNotification($token)
    {

    }

    public function isAdministrator()
    {
        return ($this->role->type == 'backend') ? true : false;
    }

    public function isWholeseler()
    {
        return ($this->role->slug == 'wholesaler') ? true : false;
    }

    public function customEmails()
    {
        return $this->belongsToMany(CustomEmails::class, 'custom_email_user', 'user_id', 'custom_email_id')->withPivot(['is_read']);
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by', 'customer_number');
    }

    public function inviter()
    {
        return $this->belongsTo(User::class, 'referred_by', 'customer_number');
    }

    public function referral_bonuses()
    {
        return $this->belongsToMany(User::class, 'referral_bonus', 'user_id', 'bonus_bringing_user_id')->withPivot('status', 'type', 'id')->wherePivot('type', 'referral');
    }

    public function mail_job()
    {
        return $this->hasMany(MailJob::class, 'to', 'email');
    }

    public function referralBonus()
    {
        return $this->hasMany(ReferralBonus::class, 'user_id');
    }

    public function bonus_bringers()
    {
        return $this->belongsToMany(User::class, 'referral_bonus', 'user_id', 'bonus_bringing_user_id')->withPivot('status', 'type');
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupons::class, 'referal_coupons', 'user_id', 'coupon_id');
    }

    public function widgets()
    {
        return $this->hasMany(Dashboard::class, 'user_id');
    }

    public function notes()
    {
        return $this->hasMany(UserNotes::class, 'user_id');
    }
}
