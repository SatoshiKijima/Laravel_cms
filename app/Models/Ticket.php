<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Prefecture;
use App\Models\GiftCard;
use App\Models\Product;
use App\Models\UserTicket;
use App\Models\User;


class Ticket extends Model
{
    
    protected $with = ['product'];
    
    public function product()
    {
        
        return $this->belongsTo(Product::class);
    }

    public function area()
    {
        return $this->belongsTo(Prefecture::class);
    }

    public function giftcard()
    {
        return $this->belongsTo(GiftCard::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class, 'area_id');
    }
    
    public function userTickets()
    {
        return $this->hasMany('App\Models\UserTicket');
    }
}
