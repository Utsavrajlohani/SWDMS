<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class UserScope implements Scope
{
    protected $column;

    /**
     * Create a new user scope instance.
     *
     * @param string $column
     */
    public function __construct($column = 'user_id')
    {
        $this->column = $column;
    }

    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            $builder->where($model->getTable() . '.' . $this->column, Auth::id());
        }
    }
}
