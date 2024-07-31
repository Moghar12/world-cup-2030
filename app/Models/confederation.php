<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class confederation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'acronym',
        'region',
        'teams',
    ];

    public function referees()
    {
        return $this->hasMany(referee::class);
    }
    public function teams()
    {
        return $this->hasMany(team::class);
    }
}
