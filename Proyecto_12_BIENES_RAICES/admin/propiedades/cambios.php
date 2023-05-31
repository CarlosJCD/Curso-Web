<?php

use App\Propiedad;

require "../../includes/app.php";

validarAcceso();

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /admin');
}
$conexionDB = conectarDB();

$_POST['submit'] ?? cargarPropiedad($id);


$errores = validarFormulario();
if (empty($errores)) {
    actualizarPropiedad($conexionDB, $id);
    cargarPropiedad($id, $conexionDB);
}

function cargarPropiedad($id)
{
    $propiedad = Propiedad::findById($id);

    $_POST['titulo'] = $propiedad->titulo;
    $_POST['precio'] = $propiedad->precio;
    $_POST['descripcion'] = $propiedad->descripcion;
    $_POST['wc'] = $propiedad->wc;
    $_POST['habitaciones'] = $propiedad->habitaciones;
    $_POST['estacionamiento'] = $propiedad->estacionamiento;
    $_POST['vendedor'] = $propiedad->idVendedor;
    $_POST['imagen'] = $propiedad->imagen;
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
        <?php include "../../includes/templates/formulario_propiedades.php" ?>

    </form>
</main>
<?php añadirPlantilla('footer');
mysqli_close($conexionDB);
?>