<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class goal extends Model
{
    use HasFactory;
    protected $fillable = [
        'time',
        'type',
        'player_id',
        'result_id',
    ];
   
    public function player(){

        return $this->belongsTo(player::class);
    }
    public function result(){
        
        return $this->belongsTo(result::class);
    }
}
