<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Une catégorie de besoin (courses, transport, etc.).

class HelpCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function helpRequests()
    {
        return $this->hasMany(HelpRequest::class, 'category_id');
    }
}
