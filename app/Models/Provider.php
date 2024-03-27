<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    public $table = "user_provider";
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'provider',
        'provider_id',
        'user_id',
        'avater',
    ];
}
