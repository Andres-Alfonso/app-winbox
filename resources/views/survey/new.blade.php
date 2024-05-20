<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('entries.saveSurvey') }}" method="post">
        @csrf
        <div class="form-row">
            <div class="col-md-12 mb-3">
                <label for="">Pregunta</label>
                <input type="text" class="form-control" name="content" required>
            </div>
            
            <div class="text-right">
                <input type="submit" class="btn btn-success" value="Guardar">
            </div>
        </div>
    </form>
    
</body>
</html>