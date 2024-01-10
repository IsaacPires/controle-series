<x-layout title="Temporadas de '{!!$series->name!!}'">
  <ul class="list-group">
    @foreach($seasons as $season)
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <a href= {{route('Episodes.index', $season->id )}}>
          Temporada: {{$season->number}}
        </a>
        <span class='badge bg-secondary'>
          {{ $season->numberIfWatchedEps() ."/". $season->episodes->count() }}
        </span>
      </li>
    @endforeach
  </ul>

  <a href='/series' class='m-2 btn btn-secondary'>Voltar</a>

</x-layout>
