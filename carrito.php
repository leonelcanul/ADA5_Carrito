<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

$carrito = $_SESSION["carrito"] ?? [];
$total = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi carrito</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<main class="contenedor">
    <header class="encabezado">
        <div>
            <h1>Mi carrito de compras</h1>
            <p>Bienvenido, <strong><?php echo htmlspecialchars($_SESSION["usuario"], ENT_QUOTES, "UTF-8"); ?></strong></p>
        </div>
        <a class="boton-secundario" href="cerrar_sesion.php">Cerrar sesión</a>
    </header>

    <section>
        <h2>Agregar producto</h2>
        <form class="form-producto" action="agregar.php" method="POST">
            <div>
                <label for="producto">Nombre del producto</label>
                <input type="text" id="producto" name="producto" maxlength="100" required>
            </div>
            <div>
                <label for="precio">Precio ($)</label>
                <input type="number" id="precio" name="precio" min="0.01" step="0.01" required>
            </div>
            <div>
                <label for="cantidad">Cantidad</label>
                <input type="number" id="cantidad" name="cantidad" min="1" step="1" value="1" required>
            </div>
            <button type="submit">Agregar al carrito</button>
        </form>
    </section>

    <section>
        <h2>Productos agregados</h2>
        <?php if (empty($carrito)): ?>
            <p class="vacio">Tu carrito está vacío. Agrega tu primer producto.</p>
        <?php else: ?>
            <div class="tabla-contenedor">
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($carrito as $id => $producto):
                    $subtotal = $producto["precio"] * $producto["cantidad"];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($producto["nombre"], ENT_QUOTES, "UTF-8"); ?></td>
                        <td>$<?php echo number_format($producto["precio"], 2); ?></td>
                        <td>
                            <form class="form-cantidad" action="modificar.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars((string)$id, ENT_QUOTES, "UTF-8"); ?>">
                                <input type="number" name="cantidad" min="1" step="1" value="<?php echo (int)$producto["cantidad"]; ?>" required>
                                <button type="submit">Actualizar</button>
                            </form>
                        </td>
                        <td>$<?php echo number_format($subtotal, 2); ?></td>
                        <td>
                            <form action="eliminar.php" method="POST" onsubmit="return confirm('¿Deseas eliminar este producto?');">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars((string)$id, ENT_QUOTES, "UTF-8"); ?>">
                                <button class="boton-eliminar" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            </div>
            <p class="total">Total: $<?php echo number_format($total, 2); ?></p>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
