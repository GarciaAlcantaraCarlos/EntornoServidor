<!DOCTYPE html>
<html>
<head>
    <title>@yield('titulo')</title>
</head>
<body>
    <header>
        <h1>Mi Sitio Web</h1>
        @if($usuario)
            <p>Bienvenido, administrador.</p>
        @else
            <p>Hola, usuario.</p>
        @endif
    </header>
    <main>
        @yield('contenido')
    </main>
    <footer>
      <x-boton tipo="success">Guardar</x-boton>
      <x-boton tipo="danger">Eliminar</x-boton>
      <p>© 2024 Mi Sitio Web</p>
    </footer>
</body>
</html>