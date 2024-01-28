//@component('mail::message')

# Série '{{ $serieName}}' criada com sucesso 

A série '{{ $serieName}}' foi criada com succeso com {{$qtdSeason}}.

Acesse aqui:

@component('mail::button', ['url' => route('Seasons.index', $id)])
Ver série
@endcomponent

@endcomponent