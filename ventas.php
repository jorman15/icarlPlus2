<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "icarl";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Consulta para obtener los registros de ventas
$sql = "SELECT * FROM ventas";
$result = $conn->query($sql);

// Array para almacenar los registros de ventas
$ventas = [];

// Verificar si se encontraron registros
if ($result->num_rows > 0) {
    // Recorrer cada fila de resultados y agregarla al array de ventas
    while ($row = $result->fetch_assoc()) {
        $ventas[] = $row;
    }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registro de Ventas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }

        #eliminar {
            margin-bottom: 10px;
        }
        #pdf {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Ventas</h1>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-<?php echo ($_SESSION['mensaje'] == 'Registro de venta exitoso') ? 'success' : 'danger'; ?>">
                <?php echo $_SESSION['mensaje']; ?>
            </div>
            <?php unset($_SESSION['mensaje']); ?>
        <?php endif; ?>

        <form action="./crud/eliminar_ventas.php" method="POST">
            <div class="table-responsive" style="max-height: 300px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Cliente</th>
                            <th>Tipo de Servicio</th>
                            <th>Mecánico</th>
                            <th>Vehículo</th>
                            <th>Repuesto</th>
                            <th>Fecha</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ventas as $venta): ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="ventas[]" value="<?php echo $venta['id']; ?>">
                                </td>
                                <td>
                                    <?php echo $venta['cliente']; ?>
                                </td>
                                <td>
                                    <?php echo $venta['tipo_servicio']; ?>
                                </td>
                                <td>
                                    <?php echo $venta['mecanico']; ?>
                                </td>
                                <td>
                                    <?php echo $venta['vehiculo']; ?>
                                </td>
                                <td>
                                    <?php echo $venta['repuesto']; ?>
                                </td>
                                <td>
                                    <?php echo $venta['fecha']; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Botón para eliminar las ventas seleccionadas -->
            <button id="eliminar" type="submit" class="btn btn-danger">Anular seleccionadas</button>
        </form>

        <!-- Enlace para abrir el formulario de registro de ventas en una ventana aparte -->
        <a href="form/formulario_registro_venta.php" target="" class="btn btn-primary">Registrar Venta</a>

        <section>
            <!-- Enlace para volver a la página principal de ventas -->
            <a href="index.php" class="btn btn-secondary mt-3" target="">Volver al menú principal</a>
        </section>

        <section>
            <!-- Botón para generar el PDF -->
            <a id="pdf" href="generar_reporte_ventas.php" target="" class="btn btn-primary">Generar reporte</a>
        </section>
    </div>
</body>

</html>