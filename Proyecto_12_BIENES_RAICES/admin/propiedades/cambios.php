<?php
require '../../includes/config/database.php';

require "../../includes/funciones.php";

if (!estadoAutenticado()) {
    header('Location: /');
}

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /admin');
}
$conexionDB = conectarDB();

$_POST['submit'] ?? cargarPropiedad($id, $conexionDB);

$errores = validarFormulario();
if (empty($errores)) {
    actualizarPropiedad($conexionDB, $id);
}

function cargarPropiedad($id, $conexionDB)
{
    $query = "SELECT * FROM propiedades WHERE id = $id;";
    $resultado = mysqli_query($conexionDB, $query);
    $datosPropiedad = mysqli_fetch_assoc($resultado);
    $_POST['titulo'] = $datosPropiedad['Titulo'];
    $_POST['precio'] = $datosPropiedad['precio'];
    $_POST['descripcion'] = $datosPropiedad['descripcion'];
    $_POST['wc'] = $datosPropiedad['wc'];
    $_POST['habitaciones'] = $datosPropiedad['habitaciones'];
    $_POST['estacionamiento'] = $datosPropiedad['estacionamientos'];
    $_POST['vendedor'] = $datosPropiedad['vendedores_id'];
    $_POST['imagen'] = $datosPropiedad["imagen"];
}

function obtenerImagenAnterior($id, $conexionDB)
{
    $query = "SELECT * FROM propiedades WHERE id = $id;";
    $resultado = mysqli_query($conexionDB, $query);
    $datosPropiedad = mysqli_fetch_assoc($resultado);
    return $datosPropiedad['imagen'];
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

function actualizarPropiedad($conexionDB, $id): void
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $imagenesDir = "../../imagenesPropiedades/";
        if (isset($_FILES['imagen'])) {
            $rutaImagenAnterior = obtenerImagenAnterior($id, $conexionDB);
            unlink($imagenesDir . $rutaImagenAnterior);
        }

        $imagen = obtenerImagen();
        $rutaImagen = md5(uniqid(rand(), true)) . ".jpg";
        move_uploaded_file($imagen['tmp_name'], $imagenesDir . $rutaImagen);

        $titulo = mysqli_real_escape_string($conexionDB, obtenerParametro("titulo"));
        $precio = mysqli_real_escape_string($conexionDB, obtenerParametro("precio"));
        $descripcion = mysqli_real_escape_string($conexionDB, obtenerParametro("descripcion"));
        $habitaciones = mysqli_real_escape_string($conexionDB, obtenerParametro("habitaciones"));
        $wc = mysqli_real_escape_string($conexionDB, obtenerParametro("wc"));
        $estacionamiento = mysqli_real_escape_string($conexionDB, obtenerParametro("estacionamiento"));
        $fechaCreacion = date('Y/m/d');
        $idVendedor = obtenerVendedor($conexionDB);
        $actualizarPropiedad = "UPDATE propiedades SET Titulo = '$titulo', precio = $precio, imagen = '$rutaImagen', descripcion = '$descripcion', habitaciones = $habitaciones, wc = $wc, estacionamientos=$estacionamiento, creado = '$fechaCreacion', vendedores_id = '$idVendedor' WHERE id = $id;";
        mysqli_query($conexionDB, $actualizarPropiedad);
    }
}

function obtenerParametro($parametro)
{
    return $_POST[$parametro] ?? '';
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
        exit;
    }
}

function seleccionarTodosLosVendedores($conexionDB)
{
    $enunciadoConsulta = "SELECT * FROM vendedores";
    $consulta = mysqli_query($conexionDB, query: $enunciadoConsulta);
    if ($consulta) {
        return $consulta;
    } else {
        echo "Error consulta al seleccionar todos los vendedores";
        exit;
    }
}

function obtenerImagen()
{
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        return $_FILES['imagen'];
    }
    return "";
}

añadirPlantilla('header');
?>


<main class="contenedor seccion">
    <h1>Actualizar</h1>
    <a href="/admin" class="boton boton-verde">volver</a>
    <?php
    if (isset($_POST['submit']) && empty($errores)) { ?>
        <p class="alerta exito"> Anuncio actualizado correctamente</p>
        <?php }

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
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo obtenerParametro("titulo") ?>">

            <label for="precio">precio</label>
            <input type="number" id="precio" name="precio" placeholder="Precio" value="<?php echo obtenerParametro("precio") ?>">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

            <img src="../../imagenesPropiedades/<?php echo $_POST['imagen'] ?>" class="imagen-preview" alt="imagen propiedad">
            <label for="descripcion">Descripcion</label>
            <textarea id="descripcion" name="descripcion" placeholder="Descripcion de la propiedad"><?php echo obtenerParametro("descripcion") ?></textarea>
        </fieldset>
        <fieldset>
            <legend>Informacion propiedad</legend>
            <label for="habitaciones">Numero de habitaciones</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Num. habitaciones" min='1' value="<?php echo obtenerParametro("habitaciones") ?>">

            <label for="wc">Numero de baños</label>
            <input type="number" id="wc" name="wc" placeholder="Num. baños" min='1' value="<?php echo obtenerParametro("wc") ?>">

            <label for="estacionamiento">Numero de estacionamientos</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Casillas de estacionamiento" min='1' value="<?php echo obtenerParametro("estacionamiento") ?>">
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
                            if (isset($_POST['vendedor'])) {
                                echo $_POST['vendedor'] === $vendedor['id'] ? 'selected' : '';
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
            <input disabled name="nombreNuevo" class="datosVendedor" type="text" id="nombre" placeholder="Nombre vendedor" value="<?php echo obtenerParametro("nombreNuevo") ?>">

            <label for="apellido">Apellido</label>
            <input disabled name='apellidoNuevo' class="datosVendedor" type="text" id="apellido" placeholder="Apellido paterno" value="<?php echo obtenerParametro("apellidoNuevo") ?>">

            <label for="telefono">Numero Telefonico</label>
            <input disabled name="telefonoNuevo" class="datosVendedor" type="tel" id="telefono" placeholder="Telefono del vendedor" value="<?php echo obtenerParametro("telefonoNuevo") ?>">
        </fieldset>

        <input type="submit" value="Update" name="submit" class="boton boton-verde">

    </form>
</main>
<?php añadirPlantilla('footer');
mysqli_close($conexionDB);
?>