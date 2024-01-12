<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\DB;
use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use App\Repositories\SeriesRepository;
use App\Repositories\EloquentSeriesRepository;
use App\Http\Middleware\Authenticator;



class SeriesController extends Controller
{

  private $seriesRepository;

   public function __construct(SeriesRepository $seriesRepository)
  {
    $this->seriesRepository = $seriesRepository;

    $this->middleware(Authenticator::class)->except('index');
  } 

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

      $series = $this->seriesRepository->add($request);

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
