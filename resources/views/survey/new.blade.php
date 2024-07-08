@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Crear Pregunta</h2>
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
                    <select class="form-control" name="typeQuestion" id="typeQuestion" required onchange="showAddOptionButton()">
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
                <input type="hidden" name="correctOption" id="correctOption">
                <div class="text-right">
                    <input type="submit" class="btn btn-success" value="Guardar">
                </div>
            </div>
        </form>
    </div>

    <script>
        function showAddOptionButton() {
            var typeQuestion = document.getElementById('typeQuestion').value;
            var addOptionButtonContainer = document.getElementById('addOptionButtonContainer');
            var optionInputs = document.getElementById('optionInputs');
            if (typeQuestion === 'radio' || typeQuestion === 'multiselect') {
                addOptionButtonContainer.style.display = 'block';
                optionInputs.style.display = 'block';
            } else {
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

            // Crear el checkbox para la opción correcta
            var correctOption = document.createElement('input');
            correctOption.type = 'radio';
            correctOption.name = 'correctOptionRadio';
            correctOption.className = 'correct-option';
            correctOption.value = inputCount;
            correctOption.title = 'Opción correcta';

            // Añadir el input y el botón al contenedor
            optionContainer.appendChild(input);
            optionContainer.appendChild(correctOption);
            optionContainer.appendChild(removeButton);

            // Añadir el contenedor de la opción al div principal
            optionInputs.appendChild(optionContainer);
        }

        document.getElementById('surveyForm').addEventListener('submit', function(e) {
            var optionInputs = document.getElementById('optionInputs');
            var inputs = optionInputs.getElementsByTagName('input');
            var options = [];
            var correctOption;

            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].type === 'text') {
                    options.push(inputs[i].value);
                }
                if (inputs[i].type === 'radio' && inputs[i].checked) {
                    correctOption = inputs[i].previousElementSibling.value;
                }
            }

            document.getElementById('options').value = JSON.stringify(options);
            document.getElementById('correctOption').value = correctOption !== undefined ? correctOption : '';
        });
    </script>
@endsection