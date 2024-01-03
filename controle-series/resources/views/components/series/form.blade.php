  <form action="{{$action}}" method='post'>
  @csrf
  @isset($update)
    @method('PUT')
  @endisset
    <div class='mb-3'>
      <label class='form-label' for='name'>Nome:</label>
      <input class='form-control'
      type='text'
      name='name'
      id='name'
      @isset($nome)
        value="{{$nome}}"
      @endisset
      >
      </input>
    </div>
    <a href='/series' class='btn btn-secondary'>Voltar</a>
    <button type='submit' class='btn btn-primary'>Adicionar</button>
  </form>