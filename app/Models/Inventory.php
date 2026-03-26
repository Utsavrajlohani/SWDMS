<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\UserScope;

class Inventory extends Model
{
    protected $table = 'inventory';
    use \App\Traits\LogsActivity;

    protected $fillable = ['user_id', 'product_id', 'warehouse_id', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
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
