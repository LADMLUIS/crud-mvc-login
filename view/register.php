<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <main>
        <nav class="navbar">
            <div>
                <h2>Administrador</h2>
            </div>

            <div>
                <a href="user.php">Usuarios</a>
                <a href="register.php">Actas</a>
                <a href="login.php">Salir</a>
            </div>
        </nav>

        <div class="card-container">
        <div class="card">
            <div>
                <h2>Crear acta</h2>
            </div>

            <div style="display: flex; gap: 1rem;">

                <div>
                    <p>Fecha</p>
                    <input id="date" type="text">

                    <p>Inicio</p>
                    <input id="startHour" type="text">

                    <p>Fin</p>
                    <input id="finishHour" type="text">

                    <p>Asistencia</p>
                    <input id="assistants" type="text">
                </div>


                <div>
                    <p>Asunto</p>
                    <input id="matters" type="text">

                    <p>Desarrollo</p>
                    <textarea id="develop"></textarea>

                    <p>Compromiso</p>
                    <textarea id="commitments"></textarea>

                    <p>Responsable</p>
                    <input id="responsible" type="text">
                </div>
            </div>


            <div style="display: flex; justify-content: center; gap: 1rem; margin-top: 1rem;">
                <button onclick="post()">Crear</button>
            </div>
        </div>


        <div class="card" >
            <div>
                <h2>Buscar/Editar Actas</h2>
            </div>
            <p>Id de registro</p>
            <input id="idregister" type="text">

            <div style="display: flex; gap: 1rem;">

                <div>
                    <p>Fecha</p>
                    <input id="date2" type="text">

                    <p>Inicio</p>
                    <input id="startHour2" type="text">

                    <p>Fin</p>
                    <input id="finishHour2" type="text">

                    <p>Asistencia</p>
                    <input id="assistants2" type="text">
                </div>


                <div>
                    <p>Asunto</p>
                    <input id="matters2" type="text">

                    <p>Desarrollo</p>
                    <textarea id="develop2"></textarea>

                    <p>Compromiso</p>
                    <textarea id="commitments2"></textarea>

                    <p>Responsable</p>
                    <input id="responsible2" type="text">
                </div>
            </div>


            <div style="display: flex; justify-content: center; gap: 1rem; margin-top: 1rem;">

                <button onclick="get()">Buscar</button>
                <button onclick="put()">Editar</button>
                <button onclick="del()">Eliminar</button>
            </div>
        </div>

        </div>

        <button onclick="load()">Cargar Actas</button>

        <div id="load" style="display: flex; width: 100%; height: 100%; gap: 1rem;">

        </div>
    </main>


</body>

</html>

<style>
    .card-container{
        display: flex;
        gap: 2rem;
    }
    .card {
        display: flex;
        flex-flow: column nowrap;
        justify-content: center;
        align-items: center;
        gap: 0rem;
        background-color: #CA8787;
        padding: 1rem;
        border-radius: 1rem;
    }

    main {
        display: flex;
        flex-flow: column nowrap;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        background-color: #FFD0D0;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 5rem;

        width: 100%;
        background-color: #CA8787;
        color: #fafafa;
    }

    .navbar>div>a {
        color: white;
        font-size: 1.1rem;
        text-decoration: none;
        font-weight: 900;
        border-bottom: 1px solid white;
        margin-right: 1rem;
    }

    .navbar>div>h2 {
        margin-left: 1rem;
    }

    button {
        margin-top: 2rem;
        border: 0;
        border-radius: 1rem;
        padding: .5rem 1.5rem;
        background-color: #A87676;
        color: #fafafa;
        font-size: 1rem;
        font-weight: 600;
    }

    input,
    textarea {
        border: 0;
        border-radius: 1rem;
        padding: .5rem 1.5rem;
    }
</style>


<script type="text/javascript">

    const d = document;

    const date = d.getElementById("date");
    const startHour = d.getElementById("startHour");
    const finishHour = d.getElementById("finishHour");
    const assistants = d.getElementById("assistants");

    const matters = d.getElementById("matters");
    const develop = d.getElementById("develop");
    const commitments = d.getElementById("commitments");
    const responsible = d.getElementById("responsible");

    const load = async () => {
        const response = await fetch(`http://localhost:8000?table=register&id=x&action=0`)

        const answer = await response.json()

        const loadDiv = document.getElementById("load")

        answer.answer.forEach(element => {
            console.log(element)
            loadDiv.innerHTML += `
        <div style="display: flex; width: 30%; background-color: #CA8787; color: #fafafa; flex-flow: column nowrap; justify-content:center; align-items:center; border-radius: 1rem;">
            <div>
                <h2>Acta</h2>
            </div>
            <div>
                <p>IdRegistro: ${element.idregister} </p>
                <p>Fecha: ${element.date} </p>
                <p>Inicio: ${element.startHour} </p>
                <p>Fin: ${element.finishHour}</p>
                <p>Asistencia: ${element.assistants} </p>
                <p>Asunto: ${element.matters} </p>
                <p>Desarrollo: ${element.develop} </p>
                <p>Compromiso: ${element.commitments} </p>
                <p>Responsable: ${element.responsible} </p>
            </div>

            </div>
        `;
        });

    }

    const post = async () => {
        // Objeto JSON que quieres enviar
        const data = {
            date: date.value,
            startHour: startHour.value,
            finishHour: finishHour.value,
            assistants: assistants.value,

            matters: matters.value,
            develop: develop.value,
            commitments: commitments.value,
            responsible: responsible.value
        };

        // Configurar la solicitud
        const requestOptions = {
            method: 'POST', // Método de la solicitud
            headers: {
                'Content-Type': 'application/json' // Tipo de contenido del cuerpo de la solicitud
            },
            body: JSON.stringify(data) // Convertir el objeto JSON a una cadena JSON
        };

        console.log(data);

        // Realizar la solicitud utilizando fetch
        fetch('http://localhost:8000?table=register', requestOptions)
            .then(response => response.json()) // Convertir la respuesta a JSON
            .then(data => alert('Exito!')) // Manejar los datos de respuesta
            .catch(error => alert('Error:', error)); // Manejar errores
    }

    const idregister = d.getElementById("idregister");

    const date2 = d.getElementById("date2");
    const startHour2 = d.getElementById("startHour2");
    const finishHour2 = d.getElementById("finishHour2");
    const assistants2 = d.getElementById("assistants2");

    const matters2 = d.getElementById("matters2");
    const develop2 = d.getElementById("develop2");
    const commitments2 = d.getElementById("commitments2");
    const responsible2 = d.getElementById("responsible2");

    const del = async () => {
        const requestOptions = {
            method: 'DELETE', // Método de la solicitud
        };

        fetch(`http://localhost:8000?table=register&id=${idregister.value}`, requestOptions)
            .then(response => response.json()) // Convertir la respuesta a JSON
            .then(data => alert("Exito")) // Manejar los datos de respuesta
            .catch(error => alert('Error:', error)); // Manejar errores
    }

    const get = async () => {
        fetch(`http://localhost:8000?table=register&id=${idregister.value}`)
            .then(response => response.json()) // Convertir la respuesta a JSON
            .then(data => {
                console.log(data.answer[0])
                date2.value = data.answer[0].date;
                startHour2.value = data.answer[0].startHour;
                finishHour2.value = data.answer[0].finishHour;
                assistants2.value = data.answer[0].assistants;

                matters2.value = data.answer[0].matters;
                develop2.value = data.answer[0].develop;
                commitments2.value = data.answer[0].commitments;
                responsible2.value = data.answer[0].responsible;
            }) // Manejar los datos de respuesta
            .catch(error => alert('Error:', error)); // Manejar errores
    }

    const put = async () => {
        // Objeto JSON que quieres enviar
        const data = {
            date: date2.value,
            startHour: startHour2.value,
            finishHour: finishHour2.value,
            assistants: assistants2.value,

            matters: matters2.value,
            develop: develop2.value,
            commitments: commitments2.value,
            responsible: responsible2.value
        };

        // Configurar la solicitud
        const requestOptions = {
            method: 'PUT', // Método de la solicitud
            headers: {
                'Content-Type': 'application/json' // Tipo de contenido del cuerpo de la solicitud
            },
            body: JSON.stringify(data) // Convertir el objeto JSON a una cadena JSON
        };

        // Realizar la solicitud utilizando fetch
        fetch(`http://localhost:8000?table=register&id=${idregister.value}`, requestOptions)
            .then(response => response.json()) // Convertir la respuesta a JSON
            .then(data => alert("Exito")) // Manejar los datos de respuesta
            .catch(error => alert('Error:', error)); // Manejar errores
    }

</script>