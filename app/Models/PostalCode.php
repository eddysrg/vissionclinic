<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    use HasFactory;

    protected $fillable = ['postal_code'];

    public function settlements()
    {
        return $this->hasMany(Settlement::class, 'postal_codes_id');
    }
}
