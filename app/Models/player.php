<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'birthdate',
        'nationality',
        'position',
        'image',
        'team_id',
        'squadlist_id',
        
    ];
    public function cards()
    {
        return $this->hasMany(card::class);
    }
    public function goals()
    {
        return $this->hasMany(goal::class);
    }

    public function team()
    {
        return $this->belongsTo(team::class);
    }
    public function squadlist()
    {
        return $this->belongsTo(squadlist::class);
    }
}
