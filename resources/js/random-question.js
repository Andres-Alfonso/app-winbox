// Función para obtener una pregunta aleatoria
function getRandomQuestion() {
    axios.get('/api/random-question')
        .then(response => {
            console.log('Pregunta aleatoria obtenida:', response.data);
        })
        .catch(error => {
            console.error('Error al obtener la pregunta:', error);
        });
}

// Escuchar el evento WebSocket
Echo.channel('questions')
    .listen('RandomQuestionRequested', (e) => {
        console.log('Nueva pregunta recibida por WebSocket:', e.question);
    });

// Exponer la función al objeto window para poder llamarla desde la consola
window.getRandomQuestion = getRandomQuestion;

// Opcional: Obtener una pregunta automáticamente al cargar la página
 getRandomQuestion();