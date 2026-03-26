<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\UserScope;

class DailyClosing extends Model
{
    use \App\Traits\LogsActivity;

    protected $fillable = ['user_id', 'date', 'opening_balance', 'closing_balance', 'sales_total', 'expense_total'];

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
