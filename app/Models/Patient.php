<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = ["surname", "name", "date", "city", "cf", "ts", "expiry", "address", "cap", "phone", "email", "consent"];

    public function user() {

        return $this->belongsTo(User::class);

    }

    public function signature()
    {
        return $this->belongsTo(Signature::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_patients');
    }
}
