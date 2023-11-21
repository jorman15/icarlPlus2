<?php
session_start();

require('vendor/autoload.php');

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

// Consulta para obtener todos los registros de vehículos
$sql = "SELECT * FROM vehiculos";
$result = $conn->query($sql);

// Array para almacenar los registros de vehículos
$vehiculos = [];

// Verificar si se encontraron registros
if ($result->num_rows > 0) {
    // Recorrer cada fila de resultados y agregarla al array de vehículos
    while ($row = $result->fetch_assoc()) {
        $vehiculos[] = $row;
    }
}

// Cerrar la conexión
$conn->close();

// Crear el objeto TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

// Establecer el título del documento
$pdf->SetTitle('Reporte de Vehículos');

// Agregar una página
$pdf->AddPage();

// Establecer el contenido del PDF
$html = '<style>
            h1 {
                text-align: center;
                color: #333;
                font-size: 24px;
                margin-bottom: 20px;
            }
            
            table {
                width: 100%;
                border-collapse: collapse;
            }
            
            th, td {
                border: 1px solid #ccc;
                padding: 8px;
                text-align: left;
            }
            
            thead {
                background-color: #f2f2f2;
            }
            
            .vehicle-image {
                max-width: 100px;
                max-height: 100px;
            }
        </style>';

$html .= '<h1>Reporte de Vehículos</h1>';

$html .= '<table>';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>Imagen</th>';
$html .= '<th>Marca</th>';
$html .= '<th>Modelo</th>';
$html .= '<th>Año</th>';
$html .= '<th>Clasificación</th>';
$html .= '<th>Código de Barras</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

foreach ($vehiculos as $vehiculo) {
    $html .= '<tr>';
    $html .= '<td><img src="imagenes/' . $vehiculo['imagen'] . '" class="vehicle-image" alt="Imagen del vehículo"></td>';
    $html .= '<td>' . $vehiculo['marca'] . '</td>';
    $html .= '<td>' . $vehiculo['modelo'] . '</td>';
    $html .= '<td>' . $vehiculo['anio'] . '</td>';
    $html .= '<td>' . $vehiculo['clasificacion'] . '</td>';
    $html .= '<td><img src="codebar/' . $vehiculo['codigo_barras'] . '" alt="Código de Barras del vehículo" ></td>';
    $html .= '</tr>';
}

$html .= '</tbody>';
$html .= '</table>';

$pdf->writeHTML($html, true, false, true, false, '');

// Generar el PDF y enviarlo al navegador para su descarga
$pdf->Output('reporte_vehiculos.pdf', 'D');