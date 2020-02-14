<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="{!! URL::asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') !!}">
  <link rel="stylesheet" href="{!! URL::asset('/css/default.css') !!}">
  <title>{!! $title !!}</title>
</head>
<body>
  <div class="container">

    <h1>API Http Busca CEP</h1>

    <p>Exemplo de funcionamento da API.</p>
    <p>Caso não esteja funcionando como esperado, certifique-se que seguiu todos os passos conforme descrito no repositório (readme.md).</p>
    <p><em>Obs.: ou talvez exista um erro mesmo ai basta reportar lá no Github ok? :)</em></p>

    @yield('content')
  </div>

  <footer class="footer">
    <div class="container">
      <p class="text-muted">Nunca deixe sua curiosidade morrer!</p>
    </div>
  </footer>

  <script type="text/javascript" src="{!! URL::asset('/bower_components/jquery/dist/jquery.min.js') !!}"></script>
  <script type="text/javascript" src="{!! URL::asset('/bower_components/bootstrap/dist/js/bootstrap.min.js') !!}"></script>

  @yield('javascript')
</body>
</html>
