<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script>
        function validaLogin() {
            var email = document.login.email.value;
            var senha = document.login.senha.value;

            if (senha === "") {
                window.alert("Preencha todos os campos!");
                return false;
            }

            if (senha.length =< 8) {
                window.alert("A senha deve ter pelo menos 8 caracteres.");
                return false;
            }

            return true;
        }
    </script>

</head>
<body>
    <h3>Faça seu login: </h3>

    <form name = "login" action="" method="POST" target="" onsubmit = "return validaLogin()"><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" placeholder="Insira seu email:" required><br>
        <br>
        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" placeholder="Insira sua senha:" required><br>
        <br>
        <input type="submit" value="submit"><br><br>
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