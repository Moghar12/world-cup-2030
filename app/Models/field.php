<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class field extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'details',
        'capacity',
        'location',
        'image',
    ];
   
    public function matchs()
    {
        return $this->hasMany(matchs::class);
    }
}
