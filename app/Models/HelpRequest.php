<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpRequest extends Model
{
    protected $fillable = [
        'title',
        'description',
        'help_category_id',
        'address_id',
        'user_id',
        'status',
        'scheduled_at',
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
}
