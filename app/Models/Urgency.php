<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urgency extends Model
{
    use HasFactory;
    protected $table = 'urgency';

    protected $hidden = [ 

    ];
    protected $fillable = [
        'id',
        'label'
    ];
    
    public $timestamps = false;
}
