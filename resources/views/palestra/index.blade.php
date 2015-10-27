<!-- index.blade.php -->
<!doctype html>
<html>
<head>
    <title>Palestras</title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/g/fontawesome@4.4.0(css/font-awesome.min.css+css/font-awesome.css)">
    <!-- load angular -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.0-beta.1/angular.min.js"></script>
</head>
<body>

  <h1>Palestras</h1>
  
  @foreach ($palestras as $palestra)
    <p>This is palestra  <b>#{{ $palestra->palestra_id }}</b></p>
  @endforeach


</body>
</html>