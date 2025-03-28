<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['countries_id', 'name'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'countries_id');
    }

    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }
}
