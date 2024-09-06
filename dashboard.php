<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bem-vindo ao Dashboard, <?php echo $_SESSION['username']; ?>!</h1>
    <!-- Lista de vídeos -->
    <a href="video.php?id=1">Aula 1</a><br>
    <a href="video.php?id=2">Aula 2</a><br>
    <a href="video.php?id=3">Aula 3</a><br>
    <a href="logout.php">Sair</a>
</body>
</html>
