<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Une association ou commune.

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'registration_number',
        'address_id',
        'owner_id'
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function missions()
    {
        return $this->hasMany(Mission::class);
    }
}
