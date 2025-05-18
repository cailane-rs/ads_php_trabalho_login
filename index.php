<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(228, 228, 228);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            color: rgb(44, 117, 48);
            margin-bottom: 30px;
        }

        .form-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 320px;
            text-align: left;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #2e7d32;
        }

        .input-form {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input-form:focus {
            border-color: #66bb6a;
            outline: none;
        }

        .submit-button {
            width: 100%;
            padding: 12px;
            background-color: #4caf50;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-button:hover {
            background-color: #388e3c;
        }

        .login {
            display: block;
            margin-top: 20px;
            text-align: center;
        }

        .login a {
            background-color: #e8f5e9;
            color: #2e7d32;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s;
            display: inline-block;
        }

        .login a:hover {
            background-color: #c8e6c9;
        }
    </style>
</head>

<body>

    <h1>Prova 1 / Web 2</h1>

    <div class="form-container">
        <form action="cadastro.php" method="POST" onsubmit="return validaLogin()">
            <div class="form-group">
                <label for="nome">Nome completo</label>
                <input type="text" id="nome" name="nome" required class="input-form">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required class="input-form">
            </div>

            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="idSenha" name="senha" required class="input-form">
            </div>

            <input type="submit" name="cadastrar" value="Cadastrar" class="submit-button">
        </form>

        <div class="login">
            <a href="login.php">Possui conta? Logar-se</a>
        </div>
    </div>

    <script>
        function validaLogin() {
            var senha = document.getElementById("idSenha");

            if (senha.value.length < 8) {
                window.alert("A senha deve ter pelo menos 8 caracteres.");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>
