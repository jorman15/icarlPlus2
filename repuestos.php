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

// Consulta para obtener los registros de repuestos
$sql = "SELECT * FROM repuestos";
$result = $conn->query($sql);

// Array para almacenar los registros de repuestos
$repuestos = [];

// Verificar si se encontraron registros
if ($result->num_rows > 0) {
    // Recorrer cada fila de resultados y agregarla al array de repuestos
    while ($row = $result->fetch_assoc()) {
        $repuestos[] = $row;
    }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registro de Repuesto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }

        #eliminar {
            margin-bottom: 10px;
        }
        #pdf{
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Repuestos</h1>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-<?php echo ($_SESSION['mensaje'] == 'Registro de repuesto exitoso') ? 'success' : 'danger'; ?>">
                <?php echo $_SESSION['mensaje']; ?>
            </div>
            <?php unset($_SESSION['mensaje']); ?>
        <?php endif; ?>

        <form action="./crud/eliminar_repuestos.php" method="POST">
            <div class="table-responsive" style="max-height: 300px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Imagen</th>
                            <th>Marca</th>
                            <th>Tipo</th>
                            <th>Clasificación</th>
                            <th>Código de Barras</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($repuestos as $repuesto): ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="repuestos[]" value="<?php echo $repuesto['id']; ?>">
                                </td>
                                <td>
                                    <!-- Aquí puedes mostrar la imagen del repuesto -->
                                    <img src="imagenes/<?php echo $repuesto['imagen'];?>" alt="Imagen del repuesto" width="100" height="90">
                                </td>
                                <td>
                                    <?php echo $repuesto['marca']; ?>
                                </td>
                                <td>
                                    <?php echo $repuesto['tipo']; ?>
                                </td>
                                <td>
                                    <?php echo $repuesto['clasificacion']; ?>
                                </td>
                                <td>
                                   <img src="codebar/<?php echo $repuesto['codigo_barras']; ?>" alt="codigo de barras" width = "100" height="40">  
                                </td>
                                <td>
                                    <a href="./form/editar_repuesto.php?id=<?php echo $repuesto['id']; ?>"
                                        class="btn btn-primary">Editar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Botón para eliminar los repuestos seleccionados -->
            <button id="eliminar" type="submit" class="btn btn-danger">Eliminar seleccionados</button>
        </form>

        <!-- Enlace para abrir el formulario de registro de repuestos en una ventana aparte -->
        <a href="form/formulario_registro_repuesto.php" target="" class="btn btn-primary">Registrar Repuesto</a>

        <section>
            <!-- Enlace para volver a la página principal de repuestos -->
            <a href="index.php" class="btn btn-secondary mt-3" target="">Volver al menú principal</a>
        </section>

        <section>
            <!-- Botón para generar el PDF -->
            <a id="pdf" href="generar_reporte_repuesto.php" target="" class="btn btn-primary">Generar reporte</a>
        </section>
    </div>
</body>

</html>