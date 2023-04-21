<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prefecture;
use App\Models\GiftCard;
use App\Models\Product;
use App\Models\UserTicket;
use App\Models\User;
use App\Models\SupportUser;
use App\Models\Ticket;


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
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supportUser()
    {
        return $this->belongsTo(SupportUser::class, 'support_user_id');
    }
    
    
}
