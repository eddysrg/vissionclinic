<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'postal_codes_id', 'settlement_types_id', 'municipalities_id', 'states_id'];

    public function postalCode()
    {
        return $this->belongsTo(PostalCode::class);
    }

    public function settlementType()
    {
        return $this->belongsTo(SettlementType::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
