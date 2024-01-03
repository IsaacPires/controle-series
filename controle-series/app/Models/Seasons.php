<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seasons extends Model
{
    use HasFactory;

    protected $fillable = ['number'];
    public $timestamps = false;

    public function series()
    {
        return $this->belongsTo(Series::class, 'series_id');
    }

    public function episodes()
    {
        return $this->hasMany(Episodes::class, 'season_id');
    }
    
}
