<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpRequest extends Model
{
    // @return HasMany<Application

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'address_id',
        'user_id',
        'status',
        'scheduled_at',
        'accepted_by_user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(HelpCategory::class, 'category_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function participations()
    {
        return $this->hasMany(Participation::class, 'volunteer_id');
    }
}
