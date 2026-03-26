<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Scopes\UserScope;

class Expense extends Model
{
    use SoftDeletes, \App\Traits\LogsActivity;

    protected $fillable = ['user_id', 'title', 'amount', 'category', 'date', 'description'];

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
