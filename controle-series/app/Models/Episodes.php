<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episodes extends Model
{
    use HasFactory;
    //para não ter timestamps automaticos no banco
    public $timestamps = false;
    protected $fillable = ['number', 'watched'];
    /* podemos ter um código ainda mais seguro e, como dizemos em inglês, type safe.
    Para isso podemos informar que precisamos de um cast, ou seja, uma mudança de tipos,
    onde o campo watched precisa ser representado como um booleano. */
    protected $casts = ['watched' => 'boolean'];

    public function seasons()
    {
        return $this->belongsTo(Seasons::class, 'season_id');
    }

}
