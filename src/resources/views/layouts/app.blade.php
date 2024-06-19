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
  @if (!Request::is('contact/thanks'))
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        FashionablyLate
      </a>
      @if (Auth::check())
      <nav>
        <ul class="header-nav">
          <li class="header-nav__item">
            <form class="form" action="logout" method="post">
              @csrf
              <button class="header-nav__button">Logout</button>
            </form>
          </li>
        </ul>
      </nav>
      @elseif (Request::is('login'))
      <nav>
        <ul class="header-nav">
          <li class="header-nav__item">
            <a class="header-nav__link button" href="/register">register</a>
          </li>
        </ul>
      </nav>
      @elseif (Request::is('register'))
      <nav>
        <ul class="header-nav">
          <li class="header-nav__item">
            <a class="header-nav__link button" href="/login">login</a>
          </li>
        </ul>
      </nav>
      @endif
    </div>
  </header>
  @endif

  <main>
    @yield('content')
  </main>
</body>

</html>
