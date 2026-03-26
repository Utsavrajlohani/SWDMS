<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Scopes\UserScope;

class Order extends Model
{
    use HasFactory, \App\Traits\LogsActivity;

    protected $fillable = [
        'user_id',
        'retailer_id',
        'subtotal',
        'gst_amount',
        'total_amount',
        'discount_amount',
        'status',
        'payment_method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
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
