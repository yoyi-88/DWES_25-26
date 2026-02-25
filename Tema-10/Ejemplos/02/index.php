<?php
/*
    ejemplo: 10.1
    descripcion: uso de la funcion mail()
    parámetros: 
        to: dirección de correo del destinatario
        subject: asunto del correo
        message: cuerpo del correo
        headers: cabeceras adicionales (opcional)
*/

// Definir la cabecera del mensaje (header)
$header = "Mime-Version: 1.0" . "\r\n";
$header .= "Content-Type: text/html; charset=utf-8" . "\r\n"; // Corregido charset y =
$header .= "From: Y. Gómez <ygomben2510@g.educaand.es>" . "\r\n";
$header .= "X-Mailer: PHP/" . phpversion();

// Definir destinatario
$to = "ygoben2510@g.educaand.es";

// Definir asunto
$subject = "Correo de prueba";

// Definir mensaje
$mensaje = "<h1>Hola, este es un correo e prueba</h1>
            <p>Enviado desde PHP en la clase 2DAW del curso 2025-2026 del módulo DWES</p>";

// Enviar el correo
if (mail($to, $subject, $mensaje, $header)) {
    echo "Correo enviado correctamente";
} else {
    echo "Error al enviar el correo";
}


?>
