<?php
session_start();

// Conectar ao banco de dados
$host = 'localhost';
$db_user = 'root';  // Insira o usuário do seu banco de dados
$db_password = '';  // Insira a senha do seu banco de dados
$db_name = 'sistema_login';

$conn = new mysqli($host, $db_user, $db_password, $db_name);

// Verificar se a conexão deu certo
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepara uma declaração SQL para evitar SQL Injection
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Verifica se o usuário existe
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Verifica a senha
        if (password_verify($password, $hashed_password)) {
            // Inicia a sessão do usuário
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;

            // Redireciona para o dashboard
            header("location: dashboard.php");
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }

    $stmt->close();
}

$conn->close();
?>
