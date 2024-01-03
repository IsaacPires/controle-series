<x-layout title='Editar'>
  <form action="{{route('series.update', $series->id)}}" method='PUT'>
  @csrf

    <div class="row mb-3">
      <div class='mb-3 col-md-12'>
        <label class='form-label' for='name'>Nome:</label>
        <input class='form-control'
        type='text'
        name='name'
        id='name'
        @isset($series->name)
          value="{{$series->name}}"
        @endisset
        >
        </input>
      </div>
    </div>

    <a href='/series' class='btn btn-secondary'>Voltar</a>
    <button type='submit' class='btn btn-primary'>Adicionar</button>
  </form>
</x-layout>