# Laravel init

## Starting a project: 
- Composer must be installed before starting a project.
- 7zip must be isntalled before decompressing a laravel/laravel project

`composer create-project --prefer-dist laravel/laravel $name`. (we use the prefer-dist flag to only download a working copy of the laravel repo and not the entire source)

## Importing a project:
- `composer install` (Similar to npm install)
- You must create a copy of .env before executing the key generation.
- `php artisan key:generate`
- You must connect the database in the .env file before executing the migrations
- `php artisan migrate`
- `php artisan config:publish cors` (fix for cors issues)

# File structure
`/` - Laravel must be installed on the webserver root
- `app/`
  - `Http/`
    - `Controllers/` - (C in MVC) contains actual app code
    - `Middleware/` - Checks and validations that sit between the router and its calls to the controller
  - `Models/` - (M in MVC) contains classes mapped to the database
  - `Providers/` - Has information on components, middleware has to be manually registered inside this folder
- `bootstrap/`
- `config/`
- `database/` 
  - `factories/`
  - `migrations/` - Instructions to mount and rollback database tables
  - `seeders/`
  - `.gitignore`
- `public/` - static resources like images
- `resources/` - css, js & views, the frontend folder
  - `views/` - (V in MVC) blade's directory containing components, templates and pages
    - `components/` - blade components, auto imported
    - `templates`
- `routes/` - web and api routing
- `storage/`
- `test/`
- `vendor/` - (excluded by .gitignore) contains the composer install stuff
- `.env`- Contains environment variables, this is where `php artisan key:generate` sets our key and where we will need to configure the database connection through the `DB_CONNECTION` and following lines.
- `.env.example` - Since the .env file should not be pushed, this file is a copy of with without sensitive data, used to help developers set up their environment

# Views
- Location: `/resources/views/`
- File extension: `{file}.blade.php`

This is what the user sees and it was allows him to interact with the real program code. They are written in **blade** which is similar to React's JSX in the sense that it cobines two languages, but more similar o .svelte files in the sense that it allows you to include php directives within an html file.

## File variants
### Pages
When you create blade files, these can be served as pages through the use of the router. They can be combined with other views and they can use blade directives.

Blade directives allow us to include conditionals and loops, among other instructions, within the code by using `@if()`, `@else`, `@endif`, `@for()`, `@endfor`, `@foreach()` and `@endforeach`. Their logic extends PHP's logic.

Any variable can be included in the html by wrapping it in double curly brackets ``{{ $var }}``.

### Layouts
When a page layout is going to be repeatedly used we can convert it into a layout. We can include the static layout content as html and then include 'slots'by the use of the `@yield` directive

```html
<!DOCTYPE html>
<html>
<head>
    <title>@yield('titulo')</title>
</head>
<body>
  <nav> ... </nav>
  <main>
    @yield('contenido')
  </main>
  <footer> ... </footer>
</body>
</html>
```

After creating the layout, you may use it in any other blade page by using the `@extends` and `@content` directives.

You may use the `@content` directive in two different ways. Either include the content as a second parameter of type string, or close the diretive after the section title, include the contents in plain html and later use the `@endsection` directive.

```php
@extends('mainlayout')

@section('titulo', 'Página de Inicio')

@section('contenido')
    <h1>Bienvenido a mi página de inicio</h1>
    <p>Esta es la primera página de mi aplicación Laravel.</p>
@endsection
```

### Components
We can create reusable and customizable components by creating files in the `/resources/views/components` folder, and then using them in any vire prefixed by `x-`.

> resources/views/components/boton.blade.php

This file uses variables that will be passed to the component and includes a $slot variable, which will render the innerHTML that gets passed into the component by the parent view.
```html
<button class="btn btn-{{ $tipo ?? 'primary' }}">
    {{ $slot }}
</button>
```

Later, any file in the views folder can use the previously created component by calling an autowired `x-component` and passing the props as element attributes and the slot content as the innerHTML.
```html
<x-boton tipo="success">Guardar</x-boton>
<x-boton tipo="danger">Eliminar</x-boton>
```

### Includes
You may include any view into another by the use of the `@include` directive and pointing into any blade.php page.

```php
@include('components/navbar')
```

# Routing
Location: `/routes/`

By default found in `web.php` and extended into `api.php` through the use of the `php artisan install:api` command, Laravel allows us to route users through our views. 

We can look at the router as a trafic conductor, it redirect the flow of code into the corresponding controllers and views.

`/routes/web.php` serves html views to the user
```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MiControlador;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/edad/{edad?}', function ($edad = 0) {
    return view('edad', ['edad' => $edad]);
});
```

`routes/api.php` serves json responses
```php
<?php

use App\Models\Usuario;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiControl;

Route::post('/usuario', function (Request $request) {
  ApiControl::validarEmail();
  $nuevoUsuario = Usuario::create([
    'nombre' => $request->input('nombre'),
    'email' => $request->input('email')
  ]);
  return $nuevoUsuario;
});

Route::get('/usuario', function () {
  return Usuario::all();
});

Route::get('/usuario/{id}', function ($id) {
  return Usuario::find($id);
});
```

Both of them can perform full RESTful routing.

# Middleware
Location: `/app/Http/Middleware/RoleMiddleware.php`

Between the routing and the controllers we may run a middleware, some code that intercepts the request and performs checks before allowing the router to call the controller. The controller must be created through the console.
```bash
php artisan make:middleware {middlewareName}
```

It is common to use a middleware to validate authentication, an example of it follows:
```php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware {
  public function handle(Request $request, Closure $next, string $role) {
    if (Auth::check() && Auth::user()->role === $role) {
      $salida = $next($request);
    }else{
      $salida = redirect('/');
    }
    return $salida;
  }
}
```

Before using the middleware we must registeer it in `/app/Providers/AppServiceProvider.php` because this is not automatically done on creation by the command
```php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
  public function register() { ... }
  public function boot() {
    $this->app['router']->aliasMiddleware('role', \App\Http\Middleware\RoleMiddleware::class);
  }
}
```

# Controllers
Location: `/app/Http/Controllers/`

Controllers contain our main business logic, the code that runs the operations in our software. They are written in standard php but can benefit from laravel's use directive.

Controllers must be created through the command line with `php artisan make:controller {controllerName}`

# Models
Location: `/app/Models/`

Models are what connect our OOP code to the relational database. We use `protected $fillable = [...]` to create an array of columns that Laravel will use to set up said columns in our database.

Models must be created through the command line with `php artisan make:modeñ {modelName} {-?mfs}`. This command has three optional flags standing for Migration, Factory and Seeder, which may be automatically created along with the model. Otherwise, they'll need need to be independently created later with commands such as `php artisan make:migration {migrationName}`.

A simple model follows, but Laravel creates a more complete example as it sets up the User class by default in `/app/Models/User.php`:
```php
class Usuario extends Model {
  protected $fillable = ['nombre', 'email'];
}
```

When we create relations in between tables we must use `hasOne`, `hasMany`, `belongsTo` and `belongsToMany` by providing functions within our model class.
```php
class Usuario extends Model {
  ...
  public function pwd() {
    return $this->hasOne(Pwd::class);
  }
  public function posts() {
    return $this->hasMany(Post::class);
  }
  public function roles() {
    return $this->belongsToMany(Roles::class);
  }
}
```

On the other side of the relations we will find the corresponding methods
```php
class Pwd extends Model {
  public function usuario() {
    return $this->belongsTo(Usuario::class);
  }
}

class Post extends Model {
  public function usuario() {
    return $this->belongsTo(Usuario::class);
  }
}

class Rol extends Model {
  public function usuario() {
    return $this->belongsToMany(Usuario::class);
  }
}
```

## Migrations
Location: `/database/migrations/`

Migrations help Laravel create or delete the tables and schemas needed for the app to properly work. A basic migration will look like this:

`/database/migrations/2024_12_03_073227_crear_tabla_usuarios.php`
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up() {
    Schema::create('usuarios', function (Blueprint $table) {
      $table->id();
      $table->string('nombre');
      $table->string('email')->unique();
      $table->timestamps();
    });
  }

  public function down() {
    Schema::dropIfExists('usuarios');
  }
};
```

When connecting tables through foreign keys and relations, the migration files must use `$table->foreign`. This equally applies to 1:1, 1:N, M:N relations,
```php
  $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
```


> You may execute migrations through the command line with `php artisan migrate` or undo them with `php artisan rollback`, you may include the name of the exact migration you wish to perform to only trigger that one instead of all others.

# Extending Laravel
## Laravel UI

Laravel has a prepared UI package with default views, to use it we first have to obtain it from the composer package, since it does not come bundled with the laravel/laravel package that we installed before.
```bash
composer require laravel/ui
```

After obtaining the UI, we must generate the views that we wish to utilize, since Laravel/UI doesn't automatically generate all of its views. We may generate the login and registration views through the activation of the authentification package. 

Notice how in this case we use php artisan and not composer, this is because we already have the package in our `/vendor/` folder and we are working within our repository rather than obtaining new packages.
```bash
php artisan ui bootstrap --auth
```

Since these views use node-served libraries, we must also install them with
```bash
npm install
npm run build
```