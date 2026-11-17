<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["producto"] ?? "");
    $precio = filter_var($_POST["precio"] ?? null, FILTER_VALIDATE_FLOAT);
    $cantidad = filter_var($_POST["cantidad"] ?? null, FILTER_VALIDATE_INT);

    if ($nombre !== "" && mb_strlen($nombre) <= 100 && $precio !== false && $precio > 0 && $cantidad !== false && $cantidad > 0) {
        $id = uniqid("prod_", true);
        $_SESSION["carrito"][$id] = [
            "nombre" => $nombre,
            "precio" => (float)$precio,
            "cantidad" => (int)$cantidad
        ];
    }
}

header("Location: carrito.php");
exit();
