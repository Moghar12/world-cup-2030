<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class referee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'nationality',
        'birthdate',
        'experience',
        'confederation_id',
    ];
   
    public function match()
    {
        return $this->hasMany(matchs::class);
    }
    public function confederation()
    {
        return $this->belongsTo(confederation::class);
    }
}
