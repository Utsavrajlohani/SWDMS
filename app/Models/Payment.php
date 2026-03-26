<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Scopes\UserScope;

class Payment extends Model
{
    use HasFactory, \App\Traits\LogsActivity;

    protected $fillable = [
        'user_id',
        'retailer_id',
        'amount_paid',
        'payment_mode',
        'reference_number',
        'payment_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);

        static::creating(function ($model) {
            if (auth()->check()) {
                $model->user_id = auth()->id();
            }
        });
    }
}
