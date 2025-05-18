<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>

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
            margin-bottom: 90px;
        }

        h3 {
            color: rgb(3, 85, 7);
            margin-bottom: 20px;
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

        .input-form:focus {
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
    </style>

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

        <input type="submit" value="submit" class="submit-button"><br><br>
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

        $sql = "SELECT id, email, senha FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $email_db, $senha_db);

        if ($stmt->num_rows > 0) {
            while ($stmt->fetch()) {
                if (password_verify($senha, $senha_db)) {
                    $_SESSION['usuario_id'] = $id;
                    $_SESSION['usuario_email'] = $email_db;
                    header("Location: dashboard.php");
                    exit();
                } else {
                    echo "<p style='color:red;'>Senha incorreta.</p>";
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