<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro usuário</title>
</head>
<body>

    <form action="cadastro.php" method="POST" onsubmit="return validaLogin()">
        <input type="text" name="nome" required>
        <input type="email" name="email" required>
        <input id="idSenha" type="password" name="senha" required>
        <input type="submit" name="cadastrar" required>
    </form>

    <a href="login">Logar-se</a>
    

    
    <script>
        function validaLogin() {
            var senha = document.getElementById("idSenha");

            if (senha.value.length =< 8) {
                window.alert("A senha deve ter pelo menos 8 caracteres.");
                return false;
            }

            return true;
        }
    </script>

</body>
</html>