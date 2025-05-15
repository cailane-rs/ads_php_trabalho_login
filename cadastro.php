<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
        $servername = "localhost";
        $username = "root";
        $password  = "admin";
        $dbname = "banco";

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        try {
            $conn = new mysqli($servername, $username, $password, $dbname);
            $options = [
                'cost' => 11,
            ];
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT, $options);
            $stmt = $conn->prepare("insert into usuarios (nome, email, senha) values (?,?,?)");
            $stmt->bind_param("sss", $nome, $email, $senhaHash);
    
            $stmt->execute();
            $stmt->close();
        } catch (Exception $e) {
            die("Erro " . $e);
        }
    ?>
</body>
</html>