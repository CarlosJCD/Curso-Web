<?php

require "../../includes/app.php";

validarAcceso();

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;
use App\Vendedor;

$vendedores = Vendedor::all();


$errores = validarFormulario();
if (empty($errores)) {
    $conexionDB = conectarDB();
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
                    $errores[] = " añada el " . $key . " de la propiedad";
                    break;
                case "descripcion":
                    $errores[] = " añada la " . $key . " de la propiedad";
                    break;
                case "habitaciones":
                    $errores[] = " añada el numero de habitaciones de la propiedad";
                    break;
                case "wc":
                    $errores[] = " añada el numero de baños de la propiedad";
                    break;
                case "estacionamiento":
                    $errores[] = " añada el numero de cajones de estacionamiento de la propiedad";
                    break;
                case "vendedor":
                    $errores[] = " escoja un vendedor existente o registre uno nuevo";
                    break;
                case "nombreNuevo":
                    $errores[] = " Ingrese el nombre del vendedor a registrar";
                    break;
                case "apellidoNuevo":
                    $errores[] = " Ingrese el apellido paterno del vendedor a registrar";
                    break;
                case "telefonoNuevo":
                    $errores[] = " Ingrese el telefono celular del vendedor a registrar";
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

        $propiedad = cargarPropiedad($conexionDB);

        $propiedad->registrar();
    }
}

function cargarPropiedad($conexionDB): Propiedad
{
    $propiedad = new Propiedad();

    $imagenesDir = "../../imagenesPropiedades/";
    if (!is_dir($imagenesDir)) {
        mkdir($imagenesDir);
    }

    $image = Image::make($_FILES['imagen']["tmp_name"])->fit(800, 600);
    $propiedad->imagen = md5(uniqid(rand(), true)) . ".jpg";
    $image->save($imagenesDir . $propiedad->imagen);

    $propiedad->titulo = mysqli_real_escape_string($conexionDB, obtenerParametro("titulo"));
    $propiedad->precio = mysqli_real_escape_string($conexionDB, obtenerParametro("precio"));
    $propiedad->descripcion = mysqli_real_escape_string($conexionDB, obtenerParametro("descripcion"));
    $propiedad->habitaciones = mysqli_real_escape_string($conexionDB, obtenerParametro("habitaciones"));
    $propiedad->wc = mysqli_real_escape_string($conexionDB, obtenerParametro("wc"));
    $propiedad->estacionamiento = mysqli_real_escape_string($conexionDB, obtenerParametro("estacionamiento"));
    $propiedad->fechaCreacion = date('Y/m/d');
    $propiedad->idVendedor = obtenerVendedor($conexionDB);

    return $propiedad;
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
        return insertarVendedor($conexionDB);
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

añadirPlantilla('header');

?>


<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/admin" class="boton boton-verde">volver</a>
    <?php
    if (isset($_POST['submit']) && empty($errores)) { ?>
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
        <?php include "../../includes/templates/formulario_propiedades.php" ?>

        <input type="submit" name="submit" class="boton boton-verde">
    </form>
</main>
<?php añadirPlantilla('footer'); ?>