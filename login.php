<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <link rel="stylesheet" href="login.css">

    <script>
        function validaLogin() {
            var email = document.login.email.value;
            var senha = document.login.senha.value;
            var emailRegex = /^[^\s@]+@[^\s@]+$/;


            if (email === "" || senha === "") {
                window.alert("Preencha todos os campos!");
                return false;
            }
            if (!emailRegex.test(email)) {
                window.alert("Email inválido. Digite: (ex: nome@...)");
                return false;
            }

            if (senha.length < 8) {
                window.alert("A senha deve ter pelo menos 8 caracteres.");
                return false;
            }

            return true;
        }
    </script>

</head>

<body>
    <h1>Prova 1 / Web 2</h1>
    <h3>Faça seu login</h3>

    <form name="login" action="" method="POST" target="" onsubmit="return validaLogin()" class="form-container"><br>

        <div class="form-group">
            <label for="email">Email</label>
            <input
                type="text" id="email" name="email" required class="input-form" />
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required class="input-form" />
        </div>

        <input type="submit" value="Entrar" class="submit-button"><br><br>
    </form>


    <?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "admin";
    $dbname = "banco";


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        $sql = "SELECT id, nome, email, senha FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $nome, $email_db, $senha_db);

        if ($stmt->num_rows > 0) {
            while ($stmt->fetch()) {
                if (password_verify($senha, $senha_db)) {
                    $_SESSION['usuario_id'] = $id;
                    $_SESSION['usuario_nome'] = $nome;
                    $_SESSION['usuario_email'] = $email_db;
                    header("Location: dashboard.html");
                    exit();
                } else {
                    echo "<p id='msg-erro' style='color:red;'>Senha incorreta.</p>
                    <script>
                    setTimeout(function() {
                    var msg = document.getElementById('msg-erro');
                    if (msg) { msg.remove(); }
                    }, 5000);
                    </script>";
                }
            }
        } else {
            echo "<p style='color:red;'>Usuário não encontrado.</p>";
        }

        $stmt->close();
        $conn->close();
    }


    ?>


</body>

</html>