<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"] ?? "";

    if (isset($_SESSION["carrito"][$id])) {
        unset($_SESSION["carrito"][$id]);
    }
}

header("Location: carrito.php");
exit();
