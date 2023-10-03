<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasFactory;
    protected $fillable = ["signature"];

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }
}
