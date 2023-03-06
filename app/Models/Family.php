<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_of_children',
        'relationship',
        'dual_income',
        
    ];
    
    public function users()
{
    return $this->belongsToMany(User::class);
}

}
