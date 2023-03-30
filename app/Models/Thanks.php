<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thanks extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'support_user_id',
        'message',
        'image_path',
        'video_path',
        'sent_at',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supportUser()
    {
        return $this->belongsTo(User::class, 'support_user_id');
    }
}
