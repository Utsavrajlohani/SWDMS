<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesTarget extends Model
{
    protected $fillable = ['user_id', 'month', 'target_amount', 'achieved_amount'];
}
