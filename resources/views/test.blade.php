<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Document</title>
</head>
<body>
  <div id="app">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-4">
          <message-list></message-list>
        </div>
      </div>
    </div>
  </div>
  
  <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>