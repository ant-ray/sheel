<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Institution extends Model
{
    use HasFactory,SoftDeletes;
    /**
     * 可変項目
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'tel',
        'email',
    ];

}
