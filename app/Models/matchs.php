<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class matchs extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'date',
        'isTicket',
        'ticketsNumber',
        'price',
        'field_id',
        'referee_id',
    ];
   
    public function referee()
    {
        return $this->belongsTo(referee::class);
    }
    public function squadlist()
    {
        return $this->hasMany(squadlist::class);
    }
    public function result()
    {
        return $this->hasOne(result::class);
    }

    public function field()
    {
        return $this->belongsTo(field::class);
    }

    public function teams()
    {
        return $this->belongsToMany(team::class);
    }
    public function ticket()
    {
        return $this->hasMany(ticket::class);
    }

}
