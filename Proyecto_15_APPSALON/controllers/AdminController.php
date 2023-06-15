<?php

namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController
{
    public static function index(Router $router)
    {
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $arrayFecha = explode('-', $fecha);

        if (!checkdate($arrayFecha[1], $arrayFecha[2], $arrayFecha[0])) {
            header("Location: /admin");
        }


        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citasServicios ";
        $consulta .= " ON citasServicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasServicios.servicioId ";
        $consulta .= " WHERE fecha =  '$fecha' ";
        $citas = AdminCita::query($consulta);


        session_start();
        $router->render("admin/index", [
            "nombre" => $_SESSION['nombre'],
            "citas" => $citas,
            "fecha" => $fecha
        ]);
    }
}
