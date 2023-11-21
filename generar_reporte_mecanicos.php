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

// Consulta para obtener todos los registros de mecánicos
$sql = "SELECT * FROM mecanicos";
$result = $conn->query($sql);

// Array para almacenar los registros de mecánicos
$mecanicos = [];

// Verificar si se encontraron registros
if ($result->num_rows > 0) {
    // Recorrer cada fila de resultados y agregarla al array de mecánicos
    while ($row = $result->fetch_assoc()) {
        $mecanicos[] = $row;
    }
}

// Cerrar la conexión
$conn->close();

// Crear el objeto TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

// Establecer el título del documento
$pdf->SetTitle('Reporte de Mecánicos');

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
        </style>';

$html .= '<h1>Reporte de Mecánicos</h1>';

$html .= '<table>';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>Nombre</th>';
$html .= '<th>Apellido</th>';
$html .= '<th>Teléfono</th>';
$html .= '<th>Correo Electrónico</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

foreach ($mecanicos as $mecanico) {
    $html .= '<tr>';
    $html .= '<td>' . $mecanico['nombre'] . '</td>';
    $html .= '<td>' . $mecanico['apellido'] . '</td>';
    $html .= '<td>' . $mecanico['telefono'] . '</td>';
    $html .= '<td>' . $mecanico['correo_electronico'] . '</td>';
    $html .= '</tr>';
}

$html .= '</tbody>';
$html .= '</table>';

$pdf->writeHTML($html, true, false, true, false, '');

// Generar el PDF y enviarlo al navegador para su descarga
$pdf->Output('reporte_mecanicos.pdf', 'D');