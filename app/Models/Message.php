<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'type_projet',
        'localisation',
        'budget',
        'message',
        'is_read',
    ];
}
