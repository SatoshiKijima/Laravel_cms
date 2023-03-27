<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;

class UserTicket extends Model
{
    public function ticket()
    {
      
        return $this->belongsTo(Ticket::class);
    }
}

