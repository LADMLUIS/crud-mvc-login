<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
</head>

<body>
    <div class="main">
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

        <div class="container">
            <div class="card-container">
                <div>
                    <div class="card">
                        <div>
                            <h2>Crear/Eliminar</h2>
                        </div>

                        <div>
                            <p for="username">Nombre de usuario</p>
                            <input type="text" id="username">
                        </div>

                        <div>
                            <p for="password">Contrasenia</p>
                            <input type="text" id="password">
                        </div>

                        <div class="buttons">
                            <button onclick="post()">Crear</button>
                            <button onclick="del()">Eliminar</button>
                        </div>

                    </div>
                </div>

                <div>
                    <div class="card">
                        <h2>Buscar/Editar</h2>

                        <div>
                            <p for="username">Usuario a buscar/editar</p>
                            <input type="text" id="username2">
                        </div>

                        <div>
                            <p for="username">Nuevo Nombre de usuario</p>
                            <input type="text" id="username3">
                        </div>

                        <div>
                            <p for="password">Nueva Contrasenia</p>
                            <input type="text" id="password2">
                        </div>

                        <div class="buttons">
                            <button onclick="get()">Cargar</button>
                            <button onclick="put()">Editar</button>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <button onclick="load()">Cargar Usuarios</button>

        <div id="load"
            style="display: flex; justify-content: center; gap: 0rem; width: calc(100%); height: calc(100%); background-color: #FFD0D0; padding: 1rem;">

        </div>

        <div>
        </div>
    </div>


</body>

</html>

<style>
    body {
        display: flex;
        justify-content: center;

    }

    .main {
        display: flex;
        flex-flow: column nowrap;
        align-items: center;
        gap: 1rem;

        width: 80%;
        height: 100vh;
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

    .container {
        border-radius: 1rem;
        width: 100%;
        height: 100%;
        background-color: blue;
        display: flex;
        justify-content: center;
        gap: 5rem;
        background-color: #CA8787;

    }

    .card-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 2rem;
        margin: 1rem;
    }

    .card {
        display: flex;
        flex-flow: column;
        width: 80%;
        background-color: #E1ACAC;
        border-radius: 1rem;
        padding: 2rem;

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

    input {
        border: 0;
        border-radius: 1rem;
        padding: .5rem 1.5rem;
    }

    .password-container {
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        width: calc(80%);
    }
</style>

<script type="text/javascript">
    const username = document.getElementById("username")
    const password = document.getElementById("password")

    const load = async () => {
        const response = await fetch(`http://localhost:8000?table=account&id=x&action=0`)

        const answer = await response.json()

        const loadDiv = document.getElementById("load")

        answer.answer.forEach(element => {
            console.log(element)
            loadDiv.innerHTML += `
        <div style="display: flex; width: 30%; height: 100%; background-color: #CA8787; color: #fafafa; flex-flow: column; justify-content:center; align-items:center; border-radius: 1rem; margin: 1rem;">
        <h2>Usuario</h2>
            
            
                <p>Usuario: ${element.username} </p>
                <div class="password-container">
                Contrasenia: ${element.password_2} 
                </div>
        </div>
        `;
        });

    }

    const del = async () => {
        const requestOptions = {
            method: 'DELETE', // Método de la solicitud
        };
        fetch(`http://localhost:8000?table=account&id=${username.value}`, requestOptions)
            .then(response => response.json()) // Convertir la respuesta a JSON
            .then(data => alert("Exito")) // Manejar los datos de respuesta
            .catch(error => alert('Error:', error)); // Manejar errores
    }

    const post = async () => {
        // Objeto JSON que quieres enviar
        const data = {
            username: username.value,
            password_2: password.value
        };

        // Configurar la solicitud
        const requestOptions = {
            method: 'POST', // Método de la solicitud
            headers: {
                'Content-Type': 'application/json' // Tipo de contenido del cuerpo de la solicitud
            },
            body: JSON.stringify(data) // Convertir el objeto JSON a una cadena JSON
        };

        // Realizar la solicitud utilizando fetch
        fetch('http://localhost:8000?table=account', requestOptions)
            .then(response => response.json()) // Convertir la respuesta a JSON
            .then(data => alert("Exito")) // Manejar los datos de respuesta
            .catch(error => alert('Error:', error)); // Manejar errores
    }

    const username2 = document.getElementById("username2")
    const username3 = document.getElementById("username3")
    const password2 = document.getElementById("password2")


    const get = async () => {
        fetch(`http://localhost:8000?table=account&id=${username2.value}`)
            .then(response => response.json()) // Convertir la respuesta a JSON
            .then(data => {
                console.log(data.answer[0])
                username3.value = data.answer[0].username;
                password2.value = data.answer[0].password_2;
            }) // Manejar los datos de respuesta
            .catch(error => alert('Error:', error)); // Manejar errores
    }

    const put = async () => {
        // Objeto JSON que quieres enviar
        const data = {
            username: username3.value,
            password_2: password2.value
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
        fetch(`http://localhost:8000?table=account&id=${username2.value}`, requestOptions)
            .then(response => response.json()) // Convertir la respuesta a JSON
            .then(data => alert("Exito")) // Manejar los datos de respuesta
            .catch(error => alert('Error:', error)); // Manejar errores
    }
</script>