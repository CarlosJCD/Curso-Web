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
    foreach ($_POST as $key => $value) {
        if ($value === '') {
            switch ($key) {
                case "titulo":
                case "precio":
                    $errores[] = "Porfavor, añada el " . $key . " de la propiedad";
                    break;
                case "descripcion":
                    $errores[] = "Porfavor, añada la " . $key . " de la propiedad";
                    break;
                case "habitaciones":
                    $errores[] = "Porfavor, añada el numero de habitaciones de la propiedad";
                    break;
                case "wc":
                    $errores[] = "Porfavor, añada el numero de baños de la propiedad";
                    break;
                case "estacionamiento":
                    $errores[] = "Porfavor, añada el numero de cajones de estacionamiento de la propiedad";
                    break;
                case "vendedor":
                    $errores[] = "Porfavor, escoja un vendedor existente o registre uno nuevo";
                    break;
                case "nombreNuevo":
                    $errores[] = "Porfavor, Ingrese el nombre del vendedor a registrar";
                    break;
                case "apellidoNuevo":
                    $errores[] = "Porfavor, Ingrese el apellido paterno del vendedor a registrar";
                    break;
                case "telefonoNuevo":
                    $errores[] = "Porfavor, Ingrese el telefono celular del vendedor a registrar";
                    break;
                default:
                    break;
            }
        } elseif ($key === 'descripcion' && strlen($value) < 50) {
            $errores[] = 'La descripcion debe tener al menos 50 caracteres de longitud';
        }
    }

    $errorImagen = validarImagen();
    if (!empty($_FILES) && $errorImagen != '') {
        $errores[] = $errorImagen;
    }

    return $errores;
}

function validarImagen()
{
    $tamanoMaximo = 100000000;
    $imagen = obtenerImagen();
    if ($imagen !== '' && ($imagen['size'] < $tamanoMaximo)) {
        return '';
    }
    if ($imagen === '') {
        return "Porfavor, añada la imagen de la propiedad";
    }
    if ($imagen['size'] > $tamanoMaximo) {
        return "La imagen excede el tamaño máximo (10 mb)";
    }
}

function crearPropiedad($conexionDB): void
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $imagenesDir = "../../imagenesPropiedades/";
        if (!is_dir($imagenesDir)) {
            mkdir($imagenesDir);
        }

        $imagen = obtenerImagen();
        $rutaImagen = md5(uniqid(rand(), true)) . ".jpg";
        move_uploaded_file($imagen['tmp_name'], $imagenesDir . $rutaImagen);

        $titulo = mysqli_real_escape_string($conexionDB, obtenerTitulo());
        $precio = mysqli_real_escape_string($conexionDB, obtenerPrecio());
        $descripcion = mysqli_real_escape_string($conexionDB, obtenerDescripcion());
        $habitaciones = mysqli_real_escape_string($conexionDB, obtenerCantidadDeHabitaciones());
        $wc = mysqli_real_escape_string($conexionDB, obtenerCantidadDeWC());
        $estacionamiento = mysqli_real_escape_string($conexionDB, obtenerCantidadDeEstacionamientos());
        $fechaCreacion = date('Y/m/d');
        $idVendedor = obtenerVendedor($conexionDB);
        $insertarPropiedad = "INSERT INTO propiedades (Titulo, precio, imagen, descripcion, habitaciones, wc, estacionamientos, creado, vendedores_id) VALUES  ('$titulo' , $precio, '$rutaImagen','$descripcion', $habitaciones, $wc, $estacionamiento, '$fechaCreacion', $idVendedor);";
        $query = mysqli_query($conexionDB, $insertarPropiedad);
    }
}

function obtenerTitulo(): string
{
    if (isset($_POST['titulo'])) {
        return $_POST['titulo'];
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
    } elseif (isset($_POST['vendedor'])) {
        $vendedor = $_POST['vendedor'];
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

function obtenerImagen()
{
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        return $_FILES['imagen'];
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
    if (isset($_POST['submit'])) { ?>
        <p class="alerta exito"> Anuncio creado correctamente</p>
    <?php unset($_POST);
    }
    ?>
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
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo obtenerTitulo() ?>">

            <label for="precio">precio</label>
            <input type="number" id="precio" name="precio" placeholder="Precio" value="<?php echo obtenerPrecio() ?>">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripcion</label>
            <textarea id="descripcion" name="descripcion" placeholder="Descripcion de la propiedad"><?php echo obtenerDescripcion() ?></textarea>
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
            <select id="existentes" name="vendedor">
                <option selected value="">-- Seleccione un vendedor --</option>
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

        <input type="submit" name="submit" class="boton boton-verde">

    </form>
</main>
<?php añadirPlantilla('footer'); ?>