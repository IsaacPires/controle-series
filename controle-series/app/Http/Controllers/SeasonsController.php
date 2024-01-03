<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Series;
use App\Models\Episodes;
use App\Models\seasons;

class SeasonsController extends Controller
{
    public function index(Series $series)
    {
        //eager loading, já estou trazendo os epsodios das temporadas no carregamento
        $seasons = $series->seasons()->with('episodes')->get();

        return view('Seasons.index')->with(['seasons' => $seasons])->with(['series' => $series]);
    }
     
}
