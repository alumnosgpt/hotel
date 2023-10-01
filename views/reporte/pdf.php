<style>
    h1{
        color: red
    }
</style>
<h1>Hola mundo desde la vista</h1>
<img src="<?= asset('images/hotel.jpg') ?>" alt="">
<p><?= $grado .  " " . $userData?></p>
<ul>
    <?php foreach ($data as $d) : ?>
        <li><?= $d ?></li>
    <?php endforeach  ?>
</ul>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php
// Configuración de conexión a Informix
$host = 'tu_host';
$database = 'tu_base_de_datos';
$user = 'tu_usuario';
$password = 'tu_contraseña';
$informix_conn_string = "informix:host=$host;database=$database;user=$user;password=$password";

try {
    $conn = new PDO($informix_conn_string);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

// Simula datos del cliente
$nombreCliente = "John Doe";
$nitCliente = "123456789";

// Consulta SQL para obtener detalles de la factura
$factura_id = 1; // Supongamos que conocemos el ID de la factura
$query_detalles = "SELECT h.habitacion_tipo, f.factura_cantidad_dias, h.habitacion_tarifa
                   FROM factura f
                   INNER JOIN reservas r ON f.factura_reserva_id = r.reserva_id
                   INNER JOIN habitaciones h ON r.reserva_habitacion_id = h.habitacion_id
                   WHERE f.factura_id = :factura_id";

$stmt_detalles = $conn->prepare($query_detalles);
$stmt_detalles->bindParam(':factura_id', $factura_id, PDO::PARAM_INT);
$stmt_detalles->execute();
$detalles = $stmt_detalles->fetchAll(PDO::FETCH_ASSOC);
?>

    <h1>Factura</h1>

    <div>
        <h2>Información del Cliente</h2>
        <p>Nombre del Cliente: <?php echo $nombreCliente; ?></p>
        <p>NIT: <?php echo $nitCliente; ?></p>
    </div>

    <div>
        <h2>Detalle de la Factura</h2>
        <table>
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;

                foreach ($detalles as $detalle) {
                    $totalProducto = $detalle['habitacion_tarifa'] * $detalle['factura_cantidad_dias'];
                    $total += $totalProducto;

                    echo "<tr>
                            <td>{$detalle['habitacion_tipo']}</td>
                            <td>{$detalle['factura_cantidad_dias']}</td>
                            <td>Q{$detalle['habitacion_tarifa']}</td>
                            <td>Q{$totalProducto}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div>
        <h2>Total: Q<?php echo $total; ?></h2>
    </div>

</body>
</html>
