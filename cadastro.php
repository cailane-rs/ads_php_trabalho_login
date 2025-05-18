<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de cadastro</title>
</head>
<body>

    <?php
        $servername = "localhost";
        $username = "root";
        $password  = "cabecadedragao";
        $dbname = "banco";

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        try {
            $conn = new mysqli($servername, $username, $password, $dbname);
            $options = [
                'cost' => 11,
            ];
            //É aqui que vou verificar se já tem email cadastrado.
            
            $stmt = $conn->prepare("select id from usuarios where email=?");
            if (!$stmt) {
    die("Erro ao preparar statement: " . $conn->error);
}
            //Aqui estou passaddo os parametros
            $stmt->bind_param("s", $email);
            $stmt->execute();
            //Esse store_result meio que guarda os resultados da consulta da query.
            $stmt->store_result();
            //Caso tenha algum email vai retornar a linha e vai cair nesse if...
            if ($stmt->num_rows > 0) {
                //Morre a aplicação.
                die("Email já cadastrado.");
            }
            $stmt->close();

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT, $options);
            $stmt = $conn->prepare("insert into usuarios (nome, email, senha) values (?,?,?)");
            $stmt->bind_param("sss", $nome, $email, $senhaHash);
            if (!$stmt) {
    die("Erro ao preparar statement: " . $conn->error);
}
    
            $stmt->execute();
            $stmt->close();
            //Direciona para a página de login
            header("Location: login.php");
            exit;
        } catch (Exception $e) {
            die("Erro " . $e);
        }
    ?>
</body>
</html>