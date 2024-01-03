<x-layout title='Séries'>
  <a class='btn btn-dark mb-4' href ='{{route('series.create')}}'>Adicionar Serie</a>
  @isset($sessionMsg)
    <div class='alert alert-success'>
      {{$sessionMsg}}
    </div>
  @endisset
  <ul class="list-group">
    @foreach($series as $serie)
      <li class="list-group-item d-flex justify-content-between align-items-center">
       <a href={{route('Seasons.index', $serie->id)}} > {{$serie->name}} </a>
        <form action={{route('series.destroy', $serie->id)}} method='POST'>
          @csrf
          @method('DELETE')

          <a class="btn btn-primary btn-sm" href ='{{route('series.edit', $serie->id)}}'>Editar</a>
          <button class="btn btn-danger btn-sm">x</button>

        </form>
      </li>
    @endforeach
  </ul>

</x-layout>