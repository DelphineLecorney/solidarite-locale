<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Un bénévole participe à une mission.

class Participation extends Model
{
    use HasFactory;

    protected $fillable = [
        'mission_id',
        'volunteer_id',
        'status',
        'hours_logged'
    ];

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    public function volunteer()
    {
        return $this->belongsTo(User::class, 'volunteer_id');
    }
}
