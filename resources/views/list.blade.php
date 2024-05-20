<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @if(session('success'))
        <div class="">{{ session('success') }}</div>
        <script>
            // Espera 5000 milisegundos (5 segundos) y luego redirige a la página deseada
            setTimeout(function() {
                window.location.href = "http://localhost/";
            }, 5000); // tiempo en milisegundos
        </script>
    @endif
    <form method="post" action="{{route('entries.saveAnswer') }}" class="container" id="formQuestion" show>
    @csrf
        @include('survey::standard', ['survey' => $survey])
    </form>
</body>
</html>