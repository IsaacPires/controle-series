<x-layout title="Episódios" :sessionMsg="$sessionMsg">
  <form method="post" action="{{route('Episodes.update', $seasons->id)}}">
  @csrf
   @method('PUT')
  <ul class="list-group">
    @foreach($seasons->episodes as $episodes)
      <li class="list-group-item d-flex justify-content-between align-items-center">
          {{$episodes->number}}
        <input
          {{$episodes->watched ? 'checked' : ''}}
          type="checkbox" 
          name="watched[]" 
          value='{{$episodes->id}}'>
      </li>
    @endforeach
  </ul>
  <a href="{{route('Seasons.index', $seasons->series_id)}}" class='m-2 btn btn-secondary'>Voltar</a>
  <button class=' btn btn-primary'>Salvar</button>
  </form>
</x-layout>
