<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class result extends Model
{
    use HasFactory;

    protected $fillable = [
        'team1_goals',
        'team2_goals',
        'team1_possession',
        'team2_possession',
        'fullTime',
        'winner_id',
        'match_id',	
    ];
    public function match()
    {
        return $this->belongsTo(matchs::class);
    }
    public function winner()
    {
        return $this->belongsTo(team::class);
    }

    public function goals()
    {
        return $this->hasMany(goal::class);
    }

    public function cards()
    {
        return $this->hasMany(card::class);
    }
}
