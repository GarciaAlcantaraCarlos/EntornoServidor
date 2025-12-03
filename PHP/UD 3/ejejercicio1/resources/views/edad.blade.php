@include('components/navbar')

@if ($edad >= 18)
  <x-h1>Eres mayor de edad</x-h1>
@else
  <x-h1 color="red">Eres menor de edad</x-h1>
@endif