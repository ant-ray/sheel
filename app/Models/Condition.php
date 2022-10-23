<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Condition extends Model
{
    use HasFactory,SoftDeletes;
    /**
     * 可変項目
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'body',
        'condition',
        'tenant_id'
    ];
}
