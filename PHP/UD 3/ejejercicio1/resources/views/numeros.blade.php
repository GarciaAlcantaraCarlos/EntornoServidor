@include('components/navbar')

@use('app\Http\Controllers\MiControlador')

<h1>Números del 1 al {{ $cantidad }}</h1>
<ul>
    @foreach ($lista as $numero)
        <li>{{ $numero }}</li>
    @endforeach
</ul>