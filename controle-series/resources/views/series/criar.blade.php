<x-layout title='Criar'>
  <form action="{{route('series.store')}}" method='post'>
    @csrf

      <div class="row mb-3">
        <div class='mb-3 col-md-8'>
          <label class='form-label' for='name'>Nome:</label>
          <input class='form-control'
              autofocus
              type='text'
              name='name'
              id='name'
              value="{{old('name')}}">
          </input>
        </div>
        <div class='mb-3 col-md-2'>
          <label class='form-label' for='seasons'>Temporadas:</label>
          <input class='form-control'
              type='text'
              name='seasons'
              id='seasons'
              value="{{old('seasons')}}">
          </input>
        </div>
        <div class='mb-3 col-md-2'>
          <label class='form-label' for='Episodes'>Episódios:</label>
          <input class='form-control'
              type='text'
              name='Episodes'
              id='Episodes'
              value="{{old('Episodes')}}">
          </input>
        </div>
      </div>
      <a href='/series' class='btn btn-secondary'>Voltar</a>
      <button type='submit' class='btn btn-primary'>Adicionar</button>
  </form>
</x-layout>
