<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ env('APP_NAME') }}</title>
  @vite('resources/css/app.css')
</head>

<body>
  <header>
    <nav>
      <a href="{{ route('home') }}" class="nav-link">Home</a>
      <div class="flex items-center gap-4">
        <a href="{{ route('login') }}" class="nav-link">Login</a>
        <a href="#" class="nav-link">Register</a>
      </div>
    </nav>
  </header>
  <main>
    {{ $slot }}
  </main>
</body>

</html>
