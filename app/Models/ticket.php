<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    protected $fillable = [
        'serial_code',
        'name',
        'QR_code',
        'door',
        'seat',
        'rank',
        'category',
        'price',
        'user_id',
        'match_id',

    ];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function match()
    {
        return $this->belongsTo(matchs::class);
    }
}
