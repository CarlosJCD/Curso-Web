<?php
require '../../includes/config/database.php';

$conexionDB = conectarDB();
$errores = validarFormulario();

if (empty($errores)) {
    crearPropiedad($conexionDB);
}


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
    } elseif (!$noVendedorNuevo && $_POST['vendedorNuevo'] === 'on') {
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

function crearPropiedad($conexionDB): void
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = mysqli_real_escape_string($conexionDB, obtenerTitulo());
        $precio = mysqli_real_escape_string($conexionDB, obtenerPrecio());
        $descripcion = mysqli_real_escape_string($conexionDB, obtenerDescripcion());
        $habitaciones = mysqli_real_escape_string($conexionDB, obtenerCantidadDeHabitaciones());
        $wc = mysqli_real_escape_string($conexionDB, obtenerCantidadDeWC());
        $estacionamiento = mysqli_real_escape_string($conexionDB, obtenerCantidadDeEstacionamientos());
        $fechaCreacion = date('Y/m/d');
        $idVendedor = mysqli_real_escape_string($conexionDB, obtenerVendedor($conexionDB));
        $insertar_propiedad_enunciado = "INSERT INTO propiedades (Titulo, precio, descripcion, habitaciones, wc, estacionamientos, creado, vendedores_id)";
        $insertar_propiedad_enunciado = $insertar_propiedad_enunciado . " VALUES  ('$titulo', $precio, '$descripcion', $habitaciones, $wc, $estacionamiento, '$fechaCreacion', $idVendedor);";
        $query = mysqli_query($conexionDB, $insertar_propiedad_enunciado);
        if ($query) {
            header('Location: /admin');
        }
    }
}

function obtenerTitulo(): string
{
    if (isset($_POST['Titulo'])) {
        return $_POST['Titulo'];
    }
    return "";
}

function obtenerPrecio()
{
    if (isset($_POST['precio'])) {
        return $_POST['precio'];
    }
    return "";
}

function obtenerDescripcion()
{
    if (isset($_POST['descripcion'])) {
        return $_POST['descripcion'];
    }
    return "";
}

function obtenerCantidadDeHabitaciones()
{
    if (isset($_POST['habitaciones'])) {
        return $_POST['habitaciones'];
    }
    return "";
}

function obtenerCantidadDeWC()
{
    if (isset($_POST['wc'])) {
        return $_POST['wc'];
    }
    return "";
}

function obtenerCantidadDeEstacionamientos()
{
    if (isset($_POST['estacionamiento'])) {
        return $_POST['estacionamiento'];
    }
    return "";
}

function obtenerVendedor($conexionDB)
{
    if (isset($_POST['nombreNuevo'])) {
        $vendedor = obtenerVendedorNuevo($conexionDB);
    } elseif (isset($_POST['vendedorExistente'])) {
        $vendedor = $_POST['vendedorExistente'];
    } else {
        $vendedor = '';
    }
    return $vendedor;
}

function obtenerVendedorNuevo($conexionDB)
{
    try {
        $idVendedorNuevo = insertarVendedor($conexionDB);
        return $idVendedorNuevo;
    } catch (mysqli_sql_exception $sql_exception) {
        echo "Error al crear nuevo vendedor";
        exit;
    }
}

function insertarVendedor($conexionDB)
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

function obtenerNombreVendedorNuevo()
{
    if (isset($_POST['nombreNuevo'])) {
        return $_POST['nombreNuevo'];
    }
    return "";
}

function obtenerApellidoVendedorNuevo()
{
    if (isset($_POST['apellidoNuevo'])) {
        return $_POST['apellidoNuevo'];
    }
    return "";
}

function obtenerTelefonoNuevo()
{
    if (isset($_POST['telefonoNuevo'])) {
        return $_POST['telefonoNuevo'];
    }
    return "";
}

function seleccionarTodosLosVendedores($conexionDB)
{
    $enunciadoConsulta = "SELECT * FROM vendedores";
    $consulta = mysqli_query($conexionDB, query: $enunciadoConsulta);
    if ($consulta) {
        return $consulta;
    } else {
        echo "Error consulta";
    }
}


require '../../includes/funciones.php';
añadirPlantilla('header');
?>


<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/admin" class="boton boton-verde">volver</a>

    <?php
    if (!empty($errores)) {
        foreach ($errores as $error) { ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
    <?php
        }
    }
    ?>
    <form class="formulario" method="POST">
        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" name="Titulo" placeholder="Titulo Propiedad" value="<?php echo obtenerTitulo() ?>">

            <label for="precio">precio</label>
            <input type="number" id="precio" name="precio" placeholder="Precio" value="<?php echo obtenerPrecio() ?>">

            <label for="imagen">precio</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripcion</label>
            <input type="textarea" id="descripcion" name="descripcion" placeholder="Descripcion de la propiedad" value="<?php echo obtenerDescripcion() ?>">
        </fieldset>
        <fieldset>
            <legend>Informacion propiedad</legend>
            <label for="habitaciones">Numero de habitaciones</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Num. habitaciones" min='1' value="<?php echo obtenerCantidadDeHabitaciones() ?>">

            <label for="wc">Numero de baños</label>
            <input type="number" id="wc" name="wc" placeholder="Num. baños" min='1' value="<?php echo obtenerCantidadDeWC() ?>">

            <label for="estacionamiento">Numero de estacionamientos</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Casillas de estacionamiento" min='1' value="<?php echo obtenerCantidadDeEstacionamientos() ?>">
        </fieldset>

        <fieldset>
            <legend>Informacion vendedor</legend>

            <label for="existentes">Seleccionar Vendedor:</label>
            <select id="existentes" name="vendedorExistente">
                <option disabled selected value="">-- Seleccione un vendedor --</option>
                <?php
                $query = seleccionarTodosLosVendedores($conexionDB);
                while ($vendedor = mysqli_fetch_assoc($query)) { ?>
                    <option <?php
                            if (isset($_POST['vendedorExistente'])) {
                                echo $_POST['vendedorExistente'] === $vendedor['id'] ? 'selected' : '';
                            }
                            ?> value="<?php echo $vendedor['id']; ?>">
                        <?php echo $vendedor['Nombre'] . " " . $vendedor['Apellido']; ?>
                    </option>
                <?php
                }
                ?>
            </select>
            <label for="nuevo">
                Registrar vendedor nuevo:
                <input type="checkbox" name="vendedorNuevo" id="nuevo" onclick="registrarNuevo(this.checked)">
            </label>
            <label for="nombre">Nombre</label>
            <input disabled name="nombreNuevo" class="datosVendedor" type="text" id="nombre" placeholder="Nombre vendedor" value="<?php echo obtenerNombreVendedorNuevo() ?>">

            <label for="apellido">Apellido</label>
            <input disabled name='apellidoNuevo' class="datosVendedor" type="text" id="apellido" placeholder="Apellido paterno" value="<?php echo obtenerApellidoVendedorNuevo() ?>">

            <label for="telefono">Numero Telefonico</label>
            <input disabled name="telefonoNuevo" class="datosVendedor" type="tel" id="telefono" placeholder="Telefono del vendedor" value="<?php echo obtenerTelefonoNuevo() ?>">
        </fieldset>

        <input type="submit" name="submit" value="Crear propiedad" class="boton boton-verde">

    </form>
</main>
<?php añadirPlantilla('footer'); ?>