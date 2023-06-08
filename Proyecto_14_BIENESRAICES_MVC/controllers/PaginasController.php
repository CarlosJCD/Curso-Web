<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\EntradaBlog;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {
        $router->display('paginas/index', [
            'inicio' => true,
            'propiedades' => Propiedad::get(3)
        ]);
    }
    public static function nosotros(Router $router)
    {
        $router->display('paginas/nosotros');
    }
    public static function propiedades(Router $router)
    {
        $router->display('paginas/propiedades', [
            'propiedades' => Propiedad::all()
        ]);
    }
    public static function propiedad(Router $router)
    {
        $id = validarORedireccionar("/");
        $router->display('paginas/propiedad', [
            'propiedad' => Propiedad::findById($id)
        ]);
    }
    public static function blog(Router $router)
    {
        $entradasBlog = EntradaBlog::all();
        $router->display('paginas/blog', [
            "entradasBlog" => $entradasBlog
        ]);
    }
    public static function entrada(Router $router)
    {
        $id = validarORedireccionar("/blog");
        $entradaBlog = EntradaBlog::findById($id);
        $router->display('paginas/entrada', [
            'entradaBlog' => $entradaBlog
        ]);
    }
    public static function contacto(Router $router)
    {
        $mensaje = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $contacto = $_POST['contacto'];

            $contenido = self::construirEmail($contacto);
            $phpmailer = new PHPMailer();
            $phpmailer->isSMTP();
            $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 2525;
            $phpmailer->Username = '9435c17cfb7bb2';
            $phpmailer->Password = '19fb4dc3f33530';
            $phpmailer->SMTPSecure = 'tls';
            $phpmailer->setFrom('admin@bienesraices.com');
            $phpmailer->addAddress('admin@bienesraices.com', "BienesRaices.com");
            $phpmailer->Subject = "Tienes un nuevo mensaje";

            $phpmailer->isHTML(true);
            $phpmailer->CharSet = "UTF-8";

            $phpmailer->Body = $contenido;
            $phpmailer->AltBody = "Texto alternativo del cuerpo del mail";

            if ($phpmailer->send()) {
                $mensaje = "Mensaje enviado correctamente";
            } else {
                $mensaje = "El mensaje no se pudo enviar, porfavor intentelo de nuevo.";
            }
        }

        $router->display('paginas/contacto', [
            "mensaje" => $mensaje
        ]);
    }

    private static function construirEmail($contacto)
    {
        $contenido = '<html>';
        $contenido .= "<p><strong>Has Recibido un email:</strong></p>";
        $contenido .= "<p>Nombre: " . $contacto['nombre'] . "</p>";
        $contenido .= "<p>Mensaje: " . $contacto['mensaje'] . "</p>";
        $contenido .= "<p>Vende o Compra: " . $contacto['tipo'] . "</p>";
        $contenido .= "<p>Presupuesto o Precio: $" . $contacto['presupuesto'] . "</p>";

        switch ($contacto['contacto']) {
            case "telefono":
                $contenido .= "<p>Eligió ser Contactado por Teléfono</p>";
                $contenido .= "<p>Su teléfono es: " .  $contacto['telefono'] . " </p>";
                $contenido .= "<p>En la Fecha y hora: " . $contacto['fecha'] . " - " . $contacto['hora']  . " Horas</p>";
                break;
            case "email":
                $contenido .= "<p>Eligio ser Contactado por Email:</p>";
                $contenido .= "<p>Su Email  es: " .  $contacto['email'] . " </p>";
                break;
            default:
                break;
        }
        $contenido .= '</html>';

        return $contenido;
    }
}
