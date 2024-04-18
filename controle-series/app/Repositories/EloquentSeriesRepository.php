<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Episodes;
use App\Models\seasons;


class EloquentSeriesRepository implements SeriesRepository{
  
  public function add(Request $request): Series{
          //DB::insert('INSERT INTO series (name) VALUES (?)', [$serieName])
      //$serie = new Series();
      //$serie->name = $request->input('name');
      
      //acessando o metodo estátio create podemos realizar um inserção em massa
      //request->all() trás todas as informações e as envia através de um array
      //é necessário descrever o que será salvo no banco na model no atributo
      //fillable

      //se eu quiser buscar campos especificos posso usar o $request->only('campo1', 'campo2'...);

      //se eu quiser buscar campos especificos com excessão usar o $request->except('campo1', 'campo2'...);
      //através do use é possíve utilizar uma variavel que está fora do escopo


      //para não esquecer ---> ao utilizar o & na frente da variavel ( &$series) podemos usar ela por referencia 
      //$series = null;

      //DB::transaction para garantir que todo o código executado esteja dentro de uma única transação do banco de dados.
      return DB::transaction(function () use ($request){

        $series = Series::create(
          [
            'name' => $request->name,
            'coverPath' => $request->coverPath
          ]
        );

        $seasons = [];
  
        for ($i=1; $i <= $request->seasons ; $i++) { 
          $seasons[]  = [
            'series_id' => $series->id,
            'number'    => $i,
          ];
        }
  
        seasons::insert($seasons);
  
        $Episodes = [];
  
        foreach ($series->seasons as $season) {
          for ($i=1; $i <= $request->Episodes  ; $i++) { 
            $Episodes[] = [
              'season_id' => $season->id,
              'number'    => $i
            ];
          }
        }
  
        Episodes::insert($Episodes);

        return $series;
      },5);
     //Deadlocks ocorrem quando duas ou mais transações estão aguardando bloqueios que são detidos por outras transações,
     //levando a um impasse (deadlock).
     //é possível passar um parametro e nel dizer quantas tentativas queremos realizar, no exemplo acima 5
  }
}