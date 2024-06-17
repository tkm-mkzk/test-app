<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap">
  @yield('css')
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        FashionablyLate
      </a>
      <nav>
        <ul class="header-nav">
          @if (Auth::check())
          <li class="header-nav__item">
            <form class="form" action="logout" method="post">
              @csrf
              <button class="header-nav__button">Logout</button>
            </form>
          </li>
          @else
          @if (Request::is('login'))
          <li class="header-nav__item">
            <a class="header-nav__link button" href="/register">register</a>
          </li>
          @elseif (Request::is('register'))
          <li class="header-nav__item">
            <a class="header-nav__link button" href="/login">login</a>
          </li>
          @endif
          @endif
        </ul>
      </nav>
    </div>
  </header>

  <main>
    @yield('content')
  </main>
</body>

</html>
