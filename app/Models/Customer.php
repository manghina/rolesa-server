<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'anagrafica';

    protected $hidden = [ 

    ];
    protected $fillable = [
        'id',
        'name',
        'surname',
        'email',
        'phone',
        'category',
        'last_visit',
        'note',
        'message',
        'next',
        'codice_fiscale',
        'indirizzo',
        'civico',
        'comune',
        'CAP',
        'provincia',
        'data_nascita',
        'comune_nascita',
        'urgente',
        'dateStart',
        'monitoring',
        'urgency',
        'score',
        'dateBirth',
        'cycle',
        'archived',
        'pending',

    ];
    
    public $timestamps = false;
}
