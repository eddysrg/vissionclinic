<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettlementType extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }
}
