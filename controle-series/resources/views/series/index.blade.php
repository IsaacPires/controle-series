<x-layout title='Séries' :sessionMsg="$sessionMsg">
 @auth <a class='btn btn-dark mb-4' href ='{{route('series.create')}}'>Adicionar Serie</a> @endauth
  <ul class="list-group">
    @foreach($series as $serie)
      <li class="list-group-item d-flex justify-content-between align-items-center">
        @auth <a href={{route('Seasons.index', $serie->id)}} > @endauth
        {{$serie->name}} 
        @auth </a>  @endauth
        <form action={{route('series.destroy', $serie->id)}} method='POST'>
          @csrf
          @method('DELETE')

          @auth
            <a class="btn btn-primary btn-sm" href ='{{route('series.edit', $serie->id)}}'>Editar</a>
            <button class="btn btn-danger btn-sm">x</button>
          @endauth
        </form>
      </li>
    @endforeach
  </ul>

</x-layout>