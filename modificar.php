<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"] ?? "";
    $cantidad = filter_var($_POST["cantidad"] ?? null, FILTER_VALIDATE_INT);

    if (isset($_SESSION["carrito"][$id]) && $cantidad !== false && $cantidad > 0) {
        $_SESSION["carrito"][$id]["cantidad"] = (int)$cantidad;
    }
}

header("Location: carrito.php");
exit();
