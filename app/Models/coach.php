<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coach extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'nationality',
        'image',
        'experience',
        'birthdate',
        'team_id',
    ];

  
    public function team()
    {
        return $this->belongsTo(team::class);
    }
}
