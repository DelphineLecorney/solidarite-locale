<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Une candidature faite par un bénévole sur une demande d’aide.

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'help_request_id',
        'volunteer_id',
        'message',
        'status'
    ];

    public function helpRequest()
    {
        return $this->belongsTo(HelpRequest::class);
    }

    public function volunteer()
    {
        return $this->belongsTo(User::class, 'volunteer_id');
    }
}
