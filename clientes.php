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

// Consulta para obtener los registros de clientes
$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);

// Array para almacenar los registros de clientes
$clientes = [];

// Verificar si se encontraron registros
if ($result->num_rows > 0) {
    // Recorrer cada fila de resultados y agregarla al array de clientes
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }
}

// Cerrar la conexión
$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registro de Cliente</title>
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
        <h1>Clientes</h1>

        <?php if (isset($_SESSION['mensaje'])): ?>
            <div
                class="alert alert-<?php echo ($_SESSION['mensaje'] == 'Registro de cliente exitoso') ? 'success' : 'danger'; ?>">
                <?php echo $_SESSION['mensaje']; ?>
            </div>
            <?php unset($_SESSION['mensaje']); ?>
        <?php endif; ?>

        <form action="./crud/eliminar_clientes.php" method="POST">
        <div class="table-responsive" style="max-height: 300px;">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="clientes[]" value="<?php echo $cliente['id']; ?>">
                            </td>
                            <td>
                                <?php echo $cliente['nombre']; ?>
                            </td>
                            <td>
                                <?php echo $cliente['apellido']; ?>
                            </td>
                            <td>
                                <?php echo $cliente['correo_electronico']; ?>
                            </td>
                            <td>
                                <?php echo $cliente['telefono']; ?>
                            </td>
                            <td>
                                <a href="./form/editar_cliente.php?id=<?php echo $cliente['id']; ?>"
                                    class="btn btn-primary">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div
        +>

            <!-- Botón para eliminar los clientes seleccionados -->
            <button id="eliminar" type="submit" class="btn btn-danger">Eliminar seleccionados</button>
        </form>

        <!-- Enlace para abrir el formulario de registro de clientes en una ventana aparte -->
        <a href="form/formulario_registro_cliente.php" target="" class="btn btn-primary">Registrar Cliente</a>



        <section>
            <!-- Enlace para volver a la página principal de clientes -->
            <a href="index.php" class="btn btn-secondary mt-3" target="">Volver al menu principal</a>
        </section>

        <section>
            <!-- Botón para generar el PDF -->
            <a id="pdf" href="generar_reporte_clientes.php" target="" class="btn btn-primary">Generar reporte</a>
        </section>
    </div>
</body>

</html>