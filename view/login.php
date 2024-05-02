<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

    <main>
        <div class="container">

            <div class="form-container">
                <div>
                    <h2 class="login-title">Inicio de sesion</h2>
                </div>
                <div>
                    <div class="input-group">
                        <p>Username</p>
                        <input class="login-input" id="username" type="text">
                    </div>
                    <div class="input-group">
                        <p>Password</p>
                        <input class="login-input" id="password" type="text">
                    </div>
                    
                </div>

                <div>
                        <button class="login-button" onclick="login()">Iniciar sesion</button>
                    </div>
            </div>

            <div class="img-container">
                <img class="login-img" src="pexels.jpg" >
            </div>
        </div>
    </main>

</body>

</html>

<style>
    body {
        background-color: #FFD0D0;
        overflow: hidden;
    }

    main {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        display: flex;
        flex-flow: row nowrap;
        justify-content: center;
        align-items: center;
        height: 80vh;
        width: 50%;
        border: .2rem solid #A87676;
        border-radius: 1rem;

    }

    .img-container {
        width: 50%;
        height: 100%;

    }
    .login-img{
        width: 100%;
        height: 100%;
        border-radius: 1rem;
    }

    .form-container {
        display: flex;
        flex-flow: column nowrap;
        gap: 2rem;
        width: 50%;
        height: 100%;
        color: #fafafa;
        justify-content: center;
        align-items: center;
        background-color: #E1ACAC;
    }
    .login-title{
        font-size: 2rem;
        font-weight: 900;
        text-transform: uppercase;
    }
    .login-input{
        border: 0;
        border-radius: 1rem;
        padding: .7rem;
    }
    .login-button{
        color: #fafafa;
        background-color: #A87676;
        border: 0;
        border-radius: 1rem;
        padding: .5rem 1.5rem;
        font-size: 1rem;
        font-weight: 600;
    }
</style>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bcryptjs/2.2.0/bcrypt.min.js"
    integrity="sha512-BJZhA/ftU3DVJvbBMWZwp7hXc49RJHq0xH81tTgLlG16/OkDq7VbNX6nUnx+QY4bBZkXtJoG0b0qihuia64X0w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    var bcrypt = dcodeIO.bcrypt;
    const d = document;
    const username = d.getElementById("username");
    const password = d.getElementById("password");

    async function login() {
        const data = await fetch(
            `http://localhost:8000?table=account&id=${username.value}`
        );
        const obj = await data.json();
        console.log(obj.answer[0]);

        // Comparar la cadena de texto con la contraseña encriptada usando bcryptjs
        bcrypt.compare(
            password.value,
            obj.answer[0].password_2,
            function (err, result) {
                if (err) {
                    // Ocurrió un error durante la comparación
                    console.error(err);
                    return;
                }

                if (result) {
                    // La contraseña ingresada coincide con la contraseña encriptada
                    alert("La contraseña es válida");
                    window.location.replace("user.php");
                } else {
                    // La contraseña ingresada no coincide con la contraseña encriptada
                    alert("La contraseña no es válida");
                }
            }
        );
    }

</script>