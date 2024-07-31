<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class matchs_team extends Model
{
    use HasFactory;
    protected $fillable =[
        'squadlist_id',
    ];
    public function squadlist()
    {
        return $this->hasOne(squadlist::class);
    }

}
