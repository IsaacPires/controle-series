<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Episodes;
use App\Models\seasons;



class SeriesController extends Controller
{
    public function index(Request $request){
        //$request->get('ID') é a mesma coisa que $_GET['ID'];
        //$series = DB::SELECT('SELECT * from Series');

        $series = Series::orderBy('name', 'asc')->get();
        
        //pega o valor guardado na sessão 
        //$sessionMsg = $request->session()->get('Success');

        //existe um helper no laravel que permite realizar a busca de uma forma
        //ainda menos verbosa
         $sessionMsg = session('sessionMsg');

        //esquece a mensagem para que ela não persista aparecendo na sessão, isso deve ser usado
        //caso a variavel tenha sido salva na session através do metodo put, caso seja no metodo
        //flash ele contempla esse processo
        //$request->session()->forget('Success');

        return view('series.index')->with(['series' => $series])->with(['sessionMsg' => $sessionMsg]);
      }

    public function create(Request $request){
       return view('series.criar');
    }

    public function store( SeriesFormRequest $request){

      //DB::insert('INSERT INTO series (name) VALUES (?)', [$serieName])
      //$serie = new Series();
      //$serie->name = $request->input('name');

      //acessando o metodo estátio create podemos realizar um inserção em massa
      //request->all() trás todas as informações e as envia através de um array
      //é necessário descrever o que será salvo no banco na model no atributo
      //fillable

      //se eu quiser buscar campos especificos posso usar o $request->only('campo1', 'campo2'...);

      //se eu quiser buscar campos especificos com excessão usar o $request->except('campo1', 'campo2'...);
      $series = Series::create($request->all());

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

      $request->session()->flash('sessionMsg', "Série '{$series->name}' adicionada com sucesso!");

      return redirect()->route('series.index'); //apartir da versão 9 --> to_route('series.index'); 

    }

    //é possível passar que tipo de parametro eu quero pegar na requisição
    //podendo passar até mesmo uma model
    public function destroy(Series $series){

      //como carreguei uma instancia como parametro posso chamar diretamente a função delete
      $series->delete();

      //uma flash message é uma dado na sessão que persiste por apenas um request
      //$request->session()->flash('mensagem.session', "Série '{$series->name}' removida com sucesso!");

      //é possível enviar uma flash msg através do with da route, é uma forma menos verbosa de realziar o
      //processo de setar o valor
      return redirect()->route('series.index')->with('sessionMsg', "Série '{$series->name}' removida com sucesso!"); 
    }
 
    public function edit(Series $series){

      //acessar a propriedade '$series->season' faz com que eu acesse a coleção e já pega as temporadas
      //através do metodos eu tenho um querybuilder, que me da a oportunidade de filtrar antes de pegar a coleção
      return view('series.edit')->with(['series' => $series]);

    } 

    public function update(Series $series, SeriesFormRequest $request){
      
      //fill se comporta de forma muito semelhante ao create, porém ele não é estatico
      //e é necessário chamar o save.
      $series->fill($request->all());
      $series->save();
      return redirect()->route('series.index')->with('sessionMsg', "Série '{$series->name}' atualizada com sucesso!"); 

    }
}
