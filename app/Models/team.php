<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class team extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'nickname',
        'rank',
        'stage',
        'group',
        'image',
        'flag',
        'confederation_id',
        'match_id',
        'points',
    ];

   
    public function coach()
    {
        return $this->hasOne(coach::class);
    }
    public function squadlist()
    {
        return $this->hasMany(squadlist::class);
    }

    public function confederation()
    {
        return $this->belongsTo(confederation::class);
    }

    public function players()
    {
        return $this->hasMany(player::class);
    }
    public function match()
    {
        return $this->belongstomany(matchs::class);
    }
    
}
