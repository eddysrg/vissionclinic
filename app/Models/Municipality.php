<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'states_id'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }
}
