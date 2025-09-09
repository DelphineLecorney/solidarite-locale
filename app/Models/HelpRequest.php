<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Une demande d’aide faite par un utilisateur.

class HelpRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'address_id',
        'title',
        'description',
        'status',
        'starts_at',
        'ends_at'
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

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
