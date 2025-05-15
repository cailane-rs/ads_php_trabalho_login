<?php 

$conn = new mysqli('localhost', 'root', 'admin', 'banco');
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$query = "SELECT id, nome, email, senha FROM usuarios";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<ol>";
    while($row = $result->fetch_assoc()) {
        echo "<li>Nome: " . $row["nome"] . " - Email: " . $row["email"] . "<br>";
    }
    echo "</ol>";
} else {
    echo "alert('Nenhum registro encontrado')";
}

$conn->close();

?>
