<?php

use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SeasonsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('series');
}); 


//podemos agrupar todos os conteudos que serão de uma mesma controle para não precisa repetilos diversas vezes
//caso não houvesse este agrupamento seria necessário passar desta maneira
//EX:Route::get('/series', [SeriesController::class, 'index']);


/* Route::controller(SeriesController::class)->group(function(){
    //Rota nomeada
    Route::get('/series', 'index')name->('series.index');
    Route::get('/criar', 'criar')->name('series.create');
    Route::post('/series/salvar', 'store')->name('series.store');
});
 */

//está linha faz todos os processo para mim, ex:
/* Verb	  URI	                 Action 	Route Name
GET	      /series	             index	    series.index
GET	      /series/create	     create	    series.create (c)
POST	  /series	             store	    series.store (save)
GET	      /series/{photo}	     show	    series.show
GET	      /series/{photo}/edit   edit	    series.edit
PUT/PATCH /series/{photo}	     update	    series.update (atualiza)
DELETE	  /series/{photo}	     destroy	series.destroy */


//podemos definir apenas os metodos que desejamos com o only ou criar excessoes com o except
//passando dentro do form method('delete') nos permite utilizar aqui no only o metodo
//->only(['index', 'create', 'store', 'destroy', 'edit', 'update']);
 Route::resource('/series', SeriesController::class)->except('show');

 Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('Seasons.index');

//pode ser feito da maneira manual, para usar o delete é necessário passar um metodo dentro do form
//sinalizando que que será do tipo delete, se não terá de ser uma requisição post
/*  Route::delete('/series/destroy/{id}', [SeriesController::class, 'destroy'])->name('series.destroy'); */


/* Alternativa correta! Ao ter um link que remova algo, faça logout ou algo do tipo, 
robôs que seguem links podem acabar causando um certo estrago em nossa aplicação. 
Ações destrutivas devem sempre ser feitas em requisições POST através de formulários. */


 //importante lembrar que depois do cliente salvar um cadastro é sempre necessário
 //leva-lo para outra tela, é um padrão chamado post rederect get, assim evitando
 //que ao executar o f5 por exemplo, ele reenvie todo formulário de novo  




