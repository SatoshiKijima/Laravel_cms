<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Ticket;


class SupportUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function family()
    {
       return $this->belongsToMany(User::class);
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    
    public function supportedTicketCount()
    {
        return $this->tickets()->count();
    }
    
    public function supportedTicketTotalPrice()
    {
        return $this->tickets()->sum('price');
    }
    
    public function supportedUsedTicketCount()
    {
        return $this->tickets()->where('use', 2)->count();
    }
}
