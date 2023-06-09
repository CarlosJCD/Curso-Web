<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public $email;
    public $nombre;
    public $token;
    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        $mail = $this->obtenerPHPMailerConfigurado();
        $this->construirEmailConfirmarCuenta($mail);
        $mail->send();
    }

    private function obtenerPHPMailerConfigurado()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'b1ce5be9e2e4d6';
        $mail->Password = '21a170ea5a025c';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress("cuentas@appsalon.com", "AppSalon.com");
        return $mail;
    }

    private function construirEmailConfirmarCuenta(PHPMailer $mail)
    {
        $mail->Subject = "Confirma tu cuenta";

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $mail->Body = "<html>";
        $mail->Body .= "<p> <strong>Hola $this->nombre </strong>";
        $mail->Body .= ". Has creado tu cuenta en appsalon, solo debes confirmar a traves del siguiente enlace:";
        $mail->Body .= "</p>";
        $mail->Body .= "<p>presiona aquí:";
        $mail->Body .= "<a href='http://localhost:3000/confirmarCuenta?token=" . $this->token . "'> Confirmar Cuenta";
        $mail->Body .= "</a></p>";
        $mail->Body .= "</html>";
    }

    public function enviarInstruccionesCambiarContraseña()
    {
        $mail = $this->obtenerPHPMailerConfigurado();
        $this->construirEmailCambiarContraseña($mail);
        $mail->send();
    }

    private function construirEmailCambiarContraseña(PHPMailer $mail)
    {
        $mail->Subject = "Reestablece tu contraseña";

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $mail->Body = "<html>";
        $mail->Body .= "<p> <strong>Hola $this->nombre </strong>";
        $mail->Body .= ". Has solicitado reestablecer la contraseña de tu cuenta de appsalon,";
        $mail->Body .= " para ello debes de dar cick al siguiente enlace:";
        $mail->Body .= "</p>";
        $mail->Body .= "<p>presiona aquí:";
        $mail->Body .= "<a href='http://localhost:3000/cambiarContraseña?token=" . $this->token . "'> Cambiar Contraseña";
        $mail->Body .= "</a></p>";
        $mail->Body .= "</html>";
    }
}
