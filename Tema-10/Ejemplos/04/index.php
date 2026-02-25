<?php
/*
    ejemplo: 10.3
    descripcion: uso lase PHPMailer para enviar correo electronico con formato HTML
        - Adjuntar un archivo al correo
*/

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
        // $mail->isSMTP();
        // $mail->Host = 'smtp.gmail.com';
        // $mail->SMTPAuth = true;
        // $mail->Username = '

        // usar fake SMTP papercut para pruebas
        $mail->isSMTP();

        // Cabecera del mensaje
        $destinatario = 'ygomben2510@g.educaand.es';
        $remitente = 'yoelito888@gmail.com';
        $asunto = 'Correo de prueba on PHPMailer';

        // Cuerpo del mensaje
        $cuerpo = '<h1>Hola, este es un correo de prueba con PHPMailer</h1>';
        $cuerpo .= '<p>Enviado desde PHP en la clase 2DAW del curso 2025-2026 del módulo DWES</p>';
        $cuerpo .= '<p>Gracias por usar PHPMailer</p>';

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
        $mail->addAttachment('files/pdf.pdf', 'guiauso.pdf');

        // Enviar el correo
        $mail->send();
        echo 'Correo enviado correctamente';

    } catch (Exception $e) {
        echo "Error al enviar el correo: {$mail->ErrorInfo}";
    }

    

?>
