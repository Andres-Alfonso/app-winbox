<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Pregunta</title>
    <style>
        .option-inputs {
            margin-top: 10px;
        }
        .option-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .option-container input {
            flex: 1;
        }
        .remove-button {
            margin-left: 10px;
            background-color: #e3342f;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form action="{{ route('entries.saveSurvey') }}" method="post" id="surveyForm">
        @csrf
        <div class="form-row">
            <div class="col-md-12 mb-3">
                <label for="content">Nombre de encuesta: </label>
                <input type="text" class="form-control" name="content" id="content" required>
            </div>
            <div class="col-md-12 mb-3">
                <label for="question">Pregunta: </label>
                <input type="text" class="form-control" name="question" id="question" required>
            </div>
            <div class="col-md-12 mb-3">
                <label for="typeQuestion">Tipo: </label>
                <select name="typeQuestion" id="typeQuestion" required onchange="showAddOptionButton()">
                    <option value="text">Texto</option>
                    <option value="number">Numérico</option>
                    <option value="radio">Una opción</option>
                </select>
            </div>
            <div class="col-md-12 mb-3" id="addOptionButtonContainer" style="display: none;">
                <button type="button" class="btn btn-primary" onclick="addOption()">Añadir opción</button>
            </div>
            <div class="option-inputs col-md-12 mb-3" id="optionInputs" style="display: none;">
                <!-- Aquí se agregarán dinámicamente los inputs para las opciones -->
            </div>
            <input type="hidden" name="options" id="options">
            <div class="text-right">
                <input type="submit" class="btn btn-success" value="Guardar">
            </div>
        </div>
    </form>

    <script>
        function showAddOptionButton() {
            var typeQuestion = document.getElementById('typeQuestion').value;
            var addOptionButtonContainer = document.getElementById('addOptionButtonContainer');
            var optionInputs = document.getElementById('optionInputs');
            if (typeQuestion === 'radio') {
                addOptionButtonContainer.style.display = 'block';
                optionInputs.style.display = 'block';
            }else if(typeQuestion === 'multiselect'){
                addOptionButtonContainer.style.display = 'block';
                optionInputs.style.display = 'block';
            }else {
                addOptionButtonContainer.style.display = 'none';
                optionInputs.style.display = 'none';
                optionInputs.innerHTML = ''; // Limpiar los inputs anteriores si los hubiera
            }
        }

        function addOption() {
            var optionInputs = document.getElementById('optionInputs');
            var inputCount = optionInputs.getElementsByTagName('input').length;

            // Crear el contenedor del input y el botón de eliminación
            var optionContainer = document.createElement('div');
            optionContainer.className = 'option-container';

            // Crear el input
            var input = document.createElement('input');
            input.type = 'text';
            input.name = 'option';
            input.placeholder = 'Opción ' + (inputCount + 1);
            input.className = 'form-control';

            // Crear el botón de eliminación
            var removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'remove-button';
            removeButton.textContent = 'Eliminar';
            removeButton.onclick = function() {
                optionContainer.remove();
            };

            // Añadir el input y el botón al contenedor
            optionContainer.appendChild(input);
            optionContainer.appendChild(removeButton);

            // Añadir el contenedor de la opción al div principal
            optionInputs.appendChild(optionContainer);
        }

        document.getElementById('surveyForm').addEventListener('submit', function(e) {
            var optionInputs = document.getElementById('optionInputs');
            var inputs = optionInputs.getElementsByTagName('input');
            var options = [];

            for (var i = 0; i < inputs.length; i++) {
                options.push(inputs[i].value);
            }

            document.getElementById('options').value = JSON.stringify(options);
        });
    </script>
</body>
</html>
