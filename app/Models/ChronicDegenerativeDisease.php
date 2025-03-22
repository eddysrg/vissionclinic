<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChronicDegenerativeDisease extends Model
{
    use HasFactory;

    protected $fillable = [
        'disease',
        'applies',
        'observations',
        'pathological_history_id'
    ];

    protected $casts = [
        'applies' => 'boolean',
    ];

    public function pathologicalHistory() {
        return $this->belongsTo(PathologicalHistory::class);
    }
}
