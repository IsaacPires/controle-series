<?php

namespace App\Http\Controllers;

use App\Models\Episodes;
use Illuminate\Http\Request;
use App\Models\Seasons;

class EpisodesController extends Controller
{
    public function index(Seasons $seasons){
        return view('episodes.index')
            ->with(['seasons'   => $seasons,
                    'sessionMsg'=> session('sessionMsg')
            ]);
    }   

    public function update(Request $request, Seasons $seasons) {
        $watchedEp =$request->watched ?? [];

        $seasons->episodes()->whereIn('id', $watchedEp)->update(['watched' => true]);
        $seasons->episodes()->whereNotIn('id', $watchedEp)->update(['watched' => false]);

        return redirect()->route('Episodes.index', $seasons->id)->with('sessionMsg', 'Episódios salvos com sucesso.'); 
    }
    
    
}
