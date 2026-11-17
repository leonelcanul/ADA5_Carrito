<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? "");

    if ($nombre !== "") {
        $_SESSION["usuario"] = $nombre;
        $_SESSION["carrito"] = [];
        header("Location: carrito.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | Mi carrito</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <main class="contenedor login">
        <h1>Mi carrito de compras</h1>
        <p>Escribe tu nombre para comenzar.</p>
        <form method="POST" action="index.php">
            <label for="nombre">Nombre del usuario</label>
            <input type="text" id="nombre" name="nombre" maxlength="80" required>
            <button type="submit">Ingresar</button>
        </form>
    </main>
</body>
</html>
