<?php
require '../../includes/config/database.php';

$conexion_db = conectarDB();

function validarFormulario(): array
{
    $errores = [];
    $parametrosObligatorios = ["Titulo", 'precio', "descripcion", 'habitaciones', 'wc', 'estacionamiento'];
    foreach ($_POST as $key => $value) {
        if (in_array($key, $parametrosObligatorios) && $value === "") {
            $errores[] = "Campo obligatorio vacio: " . $key;
        } elseif ($key === 'descripcion' && strlen($value) < 50) {
            $errores[] = "La descripcion debe tener una extension de minimo 50 caracteres";
        }
    }

    $noVendedorExistente = !isset($_POST['vendedorExistente']) || $_POST['vendedorExistente'] === "";
    $noVendedorNuevo = !isset($_POST['vendedorNuevo']);
    if ($noVendedorExistente && $noVendedorNuevo) {
        $errores[] = "Campo obligatorio vacio: vendedor";
    } else {
        if ($_POST['nombreNuevo'] === "") {
            $errores[] = "Campo Obligatorio vacío: Nombre de Vendedor";
        }
        if ($_POST['apellidoNuevo'] === "") {
            $errores[] = "Campo Obligatorio vacío: Apellido de Vendedor";
        }
        if ($_POST['telefonoNuevo'] === "") {
            $errores[] = "Campo Obligatorio vacío: Telefono de Vendedor";
        }
    }
    return $errores;
}

function crearPropiedad(mysqli $conexionDB): void
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = obtenerTitulo();
        $precio = obtenerPrecio();
        $descripcion = obtenerDescripcion();
        $habitaciones = obtenerCantidadDeHabitaciones();
        $wc = obtenerCantidadDeWC();
        $estacionamiento = obtenerCantidadDeEstacionamientos();
        $idVendedor = obtenerVendedor($conexionDB);
        $insertar_propiedad_enunciado = "INSERT INTO propiedades (Titulo, precio, descripcion, habitaciones, wc, estacionamientos, vendedores_id)";
        $insertar_propiedad_enunciado = $insertar_propiedad_enunciado . " VALUES  ('$titulo', $precio, '$descripcion', $habitaciones, $wc, $estacionamiento, $idVendedor);";
        $query = mysqli_query($conexionDB, $insertar_propiedad_enunciado);
        if ($query) {
            echo "Insertado Correctamente";
        }
    }
    mysqli_close($conexionDB);
}

function obtenerTitulo(): string
{
    return $_POST['Titulo'];
}
function obtenerPrecio(): int
{
    return $_POST['precio'];
}
function obtenerDescripcion(): int
{
    return $_POST['descripcion'];
}

function obtenerCantidadDeHabitaciones(): int
{
    return $_POST['habitaciones'];
}
function obtenerCantidadDeWC(): int
{
    return $_POST['wc'];
}

function obtenerCantidadDeEstacionamientos(): int
{
    return $_POST['estacionamiento'];
}

function obtenerVendedor($conexionDB): int
{
    if ($_POST['nombreNuevo'] !== null) {
        $vendedor = obtenerVendedorNuevo($conexionDB);
    } else {
        $vendedor = $_POST['vendedorExistente'];
    }
    return $vendedor;
}

function obtenerVendedorNuevo($conexionDB): int
{
    try {
        $id_vendedor_nuevo = insertarVendedor($conexionDB);
        return $id_vendedor_nuevo;
    } catch (mysqli_sql_exception $sql_exception) {
        echo "Error al crear nuevo vendedor";
        exit;
    }
}

function insertarVendedor($conexionDB): int
{
    try {
        $nombreVendedor = $_POST['nombreNuevo'];
        $apellidoVendedor = $_POST['apellidoNuevo'];
        $telefonoVendedor = $_POST['telefonoNuevo'];
        $consulta_insertar_vendedor = "INSERT INTO vendedores (Nombre, Apellido, numTelefono)
         VALUES ('$nombreVendedor', '$apellidoVendedor', $telefonoVendedor);";
        $consulta = mysqli_query($conexionDB, $consulta_insertar_vendedor);
        if (!$consulta) {
            throw new mysqli_sql_exception();
        }
        return mysqli_insert_id($conexionDB);
    } catch (mysqli_sql_exception $sql_exception) {
        echo $consulta_insertar_vendedor;
        echo $sql_exception;
    }
}

require '../../includes/funciones.php';
añadirPlantilla('header');
?>


<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="../index.php" class="boton boton-verde">volver</a>

    <?php
    $errores = validarFormulario();
    if (!empty($errores)) {
        foreach ($errores as $error) { ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
    <?php
        }
    } else {
        crearPropiedad($conexionDB);
    }
    ?>
    <form class="formulario" method="POST">
        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" name="Titulo" placeholder="Titulo Propiedad">

            <label for="precio">precio</label>
            <input type="number" id="precio" name="precio" placeholder="Precio">

            <label for="imagen">precio</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripcion</label>
            <input type="textarea" id="descripcion" name="descripcion" placeholder="Descripcion de la propiedad">
        </fieldset>
        <fieldset>
            <legend>Informacion propiedad</legend>
            <label for="habitaciones">Numero de habitaciones</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Num. habitaciones" min='1'>

            <label for="wc">Numero de baños</label>
            <input type="number" id="wc" name="wc" placeholder="Num. baños" min='1'>

            <label for="estacionamiento">Numero de estacionamientos</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Casillas de estacionamiento" min='1'>
        </fieldset>

        <fieldset>
            <legend>Informacion vendedor</legend>

            <label for="existentes">Seleccionar Vendedor:</label>
            <select id="existentes" name="vendedorExistente">
                <option disabled selected value="">-- Seleccione un vendedor --</option>
                <option value="1">Carlos</option>
            </select>

            <label for="nuevo">
                Registrar vendedor nuevo:
                <input type="checkbox" name="vendedorNuevo" id="nuevo" onclick="registrarNuevo(this.checked)">
            </label>
            <label for="nombre">Nombre</label>
            <input disabled name="nombreNuevo" class="datosVendedor" type="text" id="nombre" placeholder="Nombre vendedor">

            <label for="apellido">Apellido</label>
            <input disabled name='apellidoNuevo' class="datosVendedor" type="text" id="apellido" placeholder="Apellido paterno">

            <label for="telefono">Numero Telefonico</label>
            <input disabled name="telefonoNuevo" class="datosVendedor" type="tel" id="telefono" placeholder="Telefono del vendedor">
        </fieldset>

        <input type="submit" value="Crear propiedad" class="boton boton-verde">

    </form>
</main>
<?php añadirPlantilla('footer'); ?>