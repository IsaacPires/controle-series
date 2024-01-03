<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episodes extends Model
{
    use HasFactory;
    //para não ter timestamps automaticos no banco
    public $timestamps = false;
    protected $fillable = ['number'];

    public function seasons()
    {
        return $this->belongsTo(Seasons::class, 'season_id');
    }

}
