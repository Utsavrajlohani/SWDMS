<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Scopes\UserScope;

class Retailer extends Model
{
    use \App\Traits\LogsActivity, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'contact_person',
        'phone',
        'email',
        'referral_code',
        'referred_by',
        'reward_balance',
        'address',
        'area',
        'bnpl_active',
        'due_date_days',
        'penalty_rate',
        'credit_limit',
        'current_due',
    ];



    public function getTotalBilledAttribute()
    {
        return $this->orders()->sum('total_amount');
    }

    public function getTotalPaidAttribute()
    {
        return $this->payments()->sum('amount_paid');
    }

    public function getOutstandingBalanceAttribute()
    {
        return $this->total_billed - $this->total_paid;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function referrer()
    {
        return $this->belongsTo(Retailer::class, 'referred_by');
    }

    public function referrals()
    {
        return $this->hasMany(Retailer::class, 'referred_by');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);

        static::creating(function ($model) {
            $model->referral_code = 'RET-' . strtoupper(\Illuminate\Support\Str::random(6));
        });
    }
}
