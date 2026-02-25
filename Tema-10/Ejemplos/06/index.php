<?php
/*
    ejemplo: 10.6
    descripcion: uso lase PHPMailer para enviar correo electronico con formato HTML
    - Adjuntar un archivo
    - Adjuntar una imagen en el cuerpo del mensaje
*/

require 'config/smtp_gmail.php';

    // Incluir la clase PHPMailer

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once 'PHPMailer/src/Exception.php';
    require_once 'PHPMailer/src/PHPMailer.php';
    require_once 'PHPMailer/src/SMTP.php';

    // Crear una instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Establece juego de caracteres a UTF-8
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'quoted-printable';

        // Configuración del servidor SMTP google
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USER;
        $mail->Password = SMTP_PASS;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = SMTP_PORT;

        // usar fake SMTP papercut para pruebas
        $mail->isSMTP();

        // Cabecera del mensaje
        $destinatario = 'yoelito888@gmail.com';
        $remitente = 'ygomben2510@g.educaand.es';
        $asunto = 'Correo de prueba on PHPMailer';

        // Cuerpo del mensaje
        $cuerpo = '<h1>Hola, este es un correo de prueba con PHPMailer</h1>';
        $cuerpo .= '<p>Enviado desde PHP en la clase 2DAW del curso 2025-2026 del módulo DWES</p>';
        $cuerpo .= '<p>Gracias por usar PHPMailer</p>';
        $cuerpo .= '<p><img src="cid:arxanxa" alt="los colega en el retiro" width="300"></p>';

        // Configurar el correo 
        // remitente
        $mail->setFrom($remitente, 'Remitente');

        // destinatario
        $mail->addAddress($destinatario, 'Destinatario');

        // asunto
        $mail->Subject = $asunto;

        // cuerpo del mensaje
        $mail->Body = $cuerpo;

        // Codigo html
        $mail->isHTML(true);

        // adjuntar un archivo
        $mail->addAttachment('files/pdf.pdf', 'guiaUso.pdf');

        // adjuntar una imagen
        $mail->addEmbeddedImage('images/arxanxa.jpeg', 'arxanxa');

        // Enviar el correo
        $mail->send();
        echo 'Correo enviado correctamente';

    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }

    

?>
