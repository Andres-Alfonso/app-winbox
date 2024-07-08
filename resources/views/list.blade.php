<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .container {
            text-align: left;
            padding: 20px;
            background: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            max-width: 600px;
            width: 100%;
        }
        .message {
            color: green;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    @if(session('success'))
        <div class="message">{{ session('success') }}</div>
        <script>
            // Redirige a la página deseada después de 3 segundos
            setTimeout(function() {
                window.location.href = "http://localhost/success/survey";
            }, 500);
        </script>
    @endif
    <form method="post" action="{{ route('entries.saveAnswer') }}" class="container" id="formQuestion">
        @csrf
        @include('survey::standard', ['survey' => $survey])
    </form>

    <div id="question"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<script>

        fetch('/random-question')
            .then(response => response.json())
            .then(data => {
                document.getElementById('question').innerText = data.title; // Assuming your survey has a 'title' field
            });
        
            Echo.channel('questions')
                .listen('NewQuestion', (e) => {
                    console.log('Nueva pregunta recibida:', e.question);
                    // Actualiza la interfaz de usuario con la nueva pregunta
                });
            
</script>