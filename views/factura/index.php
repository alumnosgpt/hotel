<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Facturas</title>
    <!-- Agrega aquí tus enlaces a Bootstrap u otros estilos -->
</head>
<body>

    <h1 class="text-center">BUSCAR FACTURAS</h1>

    <div class="row justify-content-center mb-3"> 
        <form class="col-lg-6 border rounded bg-light p-2" id="formularioFactura"> 
            <div class="row mb-2"> 
                <div class="col">
                    <label for="cliente">Seleccionar Cliente:</label>
                    <select name="cliente" id="cliente" class="form-control">
                        <?php foreach ($clientes as $cliente) : ?>
                            <option value="<?= $cliente['usu_id'] ?>"><?= $cliente['usu_nombre'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row mb-2"> 
                <div class="col">
                    <label for="tipo_habitacion">Seleccionar Tipo de Habitación:</label>
                    <select name="tipo_habitacion" id="tipo_habitacion" class="form-control">
                        <?php foreach ($tiposHabitacion as $tipoHabitacion) : ?>
                            <option value="<?= $tipoHabitacion['habitacion_id'] ?>"><?= $tipoHabitacion['habitacion_tipo'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row mb-2"> 
                <div class="col">
                    <button type="button" id="btnBuscar" class="btn btn-primary w-100">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    <div class="row justify-content-center">
        <!-- Agrega aquí tu script JavaScript para la funcionalidad de búsqueda -->
        <script src="build/js/facturas/index.js"></script>
    </div>

    <!-- Aquí puedes mostrar las facturas encontradas según la búsqueda -->
    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Total</th>
                    <!-- Otros encabezados según sea necesario -->
                </tr>
            </thead>
            <tbody id="resultadosFacturas">
                <!-- Aquí se agregarán dinámicamente las filas de facturas -->
            </tbody>
        </table>
    </div>

</body>
</html>
