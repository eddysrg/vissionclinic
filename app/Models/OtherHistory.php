<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_of_history',
        'date',
        'type_of_examination',
        'observations',
        'pathological_history_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
