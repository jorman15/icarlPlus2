<!DOCTYPE html>
<html>
<head>
    <title>Control de Inventario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">icarlPlus</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/clientes.php') ? 'active' : ''; ?>" href="clientes.php">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/vehiculos.php') ? 'active' : ''; ?>" href="vehiculos.php">Vehículos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/repuestos.php') ? 'active' : ''; ?>" href="repuestos.php">Repuestos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/mecanicos.php') ? 'active' : ''; ?>" href="mecanicos.php">Mecánicos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == '/ventas.php') ? 'active' : ''; ?>" href="ventas.php">Ventas</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Clientes</h5>
                        <?php
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

                            // Consulta para obtener la cantidad de registros de clientes
                            $sql = "SELECT COUNT(*) AS count FROM clientes";
                            $result = $conn->query($sql);

                            // Obtener el resultado
                            $row = $result->fetch_assoc();
                            $countClientes = $row['count'];

                            // Cerrar la conexión
                            $conn->close();

                            echo "<p class='card-text'>Cantidad de registros: $countClientes</p>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Vehículos</h5>
                        <?php
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

                            // Consulta para obtener la cantidad de registros de vehículos
                            $sql = "SELECT COUNT(*) AS count FROM vehiculos";
                            $result = $conn->query($sql);

                            // Obtener el resultado
                            $row = $result->fetch_assoc();
                            $countVehiculos = $row['count'];

                            // Cerrar la conexión
                            $conn->close();

                            echo "<p class='card-text'>Cantidad de registros: $countVehiculos</p>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Repuestos</h5>
                        <?php
                            $servername = "localhost";
                            $password = "";
                            $dbname = "icarl";

                            // Crear la conexión
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Verificar la conexión
                            if ($conn->connect_error) {
                                die("Error de conexión a la base de datos: " . $conn->connect_error);
                            }

                            // Consulta para obtener la cantidad de registros de repuestos
                            $sql = "SELECT COUNT(*) AS count FROM repuestos";
                            $result = $conn->query($sql);

                            // Obtener el resultado
                            $row = $result->fetch_assoc();
                            $countRepuestos = $row['count'];

                            // Cerrar la conexión
                            $conn->close();

                            echo "<p class='card-text'>Cantidad de registros: $countRepuestos</p>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mecánicos</h5>
                        <?php
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

                            // Consulta para obtener la cantidad de registros de mecánicos
                            $sql = "SELECT COUNT(*) AS count FROM mecanicos";
                            $result = $conn->query($sql);

                            // Obtener el resultado
                            $row = $result->fetch_assoc();
                            $countMecanicos = $row['count'];

                            // Cerrar la conexión
                            $conn->close();

                            echo "<p class='card-text'>Cantidad de registros: $countMecanicos</p>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3" id = "ventas">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ventas</h5>
                        <?php
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

                            // Consulta para obtener la cantidad de registros de mecánicos
                            $sql = "SELECT COUNT(*) AS count FROM ventas";
                            $result = $conn->query($sql);

                            // Obtener el resultado
                            $row = $result->fetch_assoc();
                            $countMecanicos = $row['count'];

                            // Cerrar la conexión
                            $conn->close();

                            echo "<p class='card-text'>Cantidad de registros: $countMecanicos</p>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #ventas{
            margin-top: 10px;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>