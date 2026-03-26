<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Scopes\UserScope;

class Warehouse extends Model
{
    use SoftDeletes, \App\Traits\LogsActivity;

    protected $fillable = ['user_id', 'name', 'location'];

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
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
