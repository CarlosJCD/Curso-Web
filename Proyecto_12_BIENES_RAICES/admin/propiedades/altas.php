<?php
require '../../includes/config/database.php';

$conexion_DB = conectarDB();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['Titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['wc'];
    $estacionamiento = $_POST['estacionamiento'];
    if ($_POST['nombreNuevo'] !== null) {
        try {
            $vendedor = insertarVendedor($conexion_DB);
        } catch (mysqli_sql_exception $sql_exception) {
            echo "Error al crear nuevo vendedor";
            exit;
        }
        $vendedor = insertarVendedor($conexion_DB);
    } else {
        $vendedor = $_POST['vendedorExistente'];
    }
    $insertar_propiedad_enunciado = "INSERT INTO propiedades (Titulo, precio, descripcion, habitaciones, wc, estacionamientos, vendedores_id)";
    $insertar_propiedad_enunciado = $insertar_propiedad_enunciado . " VALUES  ('$titulo', $precio, '$descripcion', $habitaciones, $wc, $estacionamiento, $vendedor);";
    $insertar_propiedad_query = mysqli_query($conexion_DB, $insertar_propiedad_enunciado);
    if ($insertar_propiedad_enunciado) {
        echo "Insertado Correctamente";
    }
}

function insertarVendedor($conexion_DB)
{
    try {
        $nombreVendedor = $_POST['nombreNuevo'];
        $apellidoVendedor = $_POST['apellidoNuevo'];
        $telefonoVendedor = $_POST['telefonoNuevo'];
        $consulta_insertar_vendedor = "INSERT INTO vendedores (Nombre, Apellido, numTelefono) VALUES ('$nombreVendedor', '$apellidoVendedor', $telefonoVendedor);";
        $consulta = mysqli_query($conexion_DB, $consulta_insertar_vendedor);
        if (!$consulta)
            throw new mysqli_sql_exception();
        return mysqli_insert_id($conexion_DB);
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
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Num. casillas de estacionamiento" min='1'>
        </fieldset>

        <fieldset>
            <legend>Informacion vendedor</legend>

            <label for="existentes">Seleccionar Vendedor:</label>
            <select id="existentes" name="vendedorExistente"></select>

            <label for="nuevo">
                Registrar vendedor nuevo:<input type="checkbox" id="nuevo" onclick="registrarNuevo(this.checked)">
            </label>
            <label for="nombre">Nombre</label>
            <input disabled name="nombreNuevo" class="datosVendedor" type="text" id="nombre" placeholder="Nombre vendedor">

            <label for="apellido">Apellido</label>
            <input disabled name='apellidoNuevo' class="datosVendedor" type="text" id="apellido" placeholder="Apellido paterno">

            <label for="telefono">Numero Telefonico</label>
            <input disabled name="telefonoNuevo" class="datosVendedor" type="tel" id="telefono" placeholder="Numo de telefono del vendedor">

        </fieldset>

        <input type="submit" value="Crear propiedad" class="boton boton-verde">

    </form>
</main>
<?php añadirPlantilla('footer'); ?>