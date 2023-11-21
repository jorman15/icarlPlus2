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

// Consulta para obtener todos los registros de repuestos
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

// Crear el objeto TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

// Establecer el título del documento
$pdf->SetTitle('Reporte de Repuestos');

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
            
            .part-image {
                max-width: 100px;
                max-height: 100px;
            }
        </style>';

$html .= '<h1>Reporte de Repuestos</h1>';

$html .= '<table>';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>Imagen</th>';
$html .= '<th>Marca</th>';
$html .= '<th>Tipo</th>';
$html .= '<th>Clasificación</th>';
$html .= '<th>Código de Barras</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

foreach ($repuestos as $repuesto) {
    $html .= '<tr>';
    $html .= '<td><img src="imagenes/' . $repuesto['imagen'] . '" class="part-image" alt="Imagen del repuesto"></td>';
    $html .= '<td>' . $repuesto['marca'] . '</td>';
    $html .= '<td>' . $repuesto['tipo'] . '</td>';
    $html .= '<td>' . $repuesto['clasificacion'] . '</td>';
    $html .= '<td><img src="codebar/' . $repuesto['codigo_barras'] . '" alt="Código de Barras del repuesto"></td>';
    $html .= '</tr>';
}

$html .= '</tbody>';
$html .= '</table>';

$pdf->writeHTML($html, true, false, true, false, '');

// Generar el PDF y enviarlo al navegador para su descarga
$pdf->Output('reporte_repuestos.pdf', 'D');