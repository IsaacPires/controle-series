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

    public function numberIfWatchedEps():int
    {
        //a função retorna todos episodios da temporada instanciada
        //realiza um filtro através de uma função anonima
        //passando todos os episodios assistidos
        //após isso ele realiza uma contagem e a retorna
        return $this->episodes
            ->filter(fn($episode) => $episode->watched)
            ->count();
    }
    
}
