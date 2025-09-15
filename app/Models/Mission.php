<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Une mission organisée par une association.

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'title',
        'description',
        'address_id',
        'capacity',
        'is_published',
        'quantity_available',
        'unit',
        'type',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function participations()
    {
        return $this->hasMany(Participation::class, 'mission_id');
    }
}
