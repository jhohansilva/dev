<?php

if (isset($_POST['email']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['HTTP_ORIGIN'] == 'https://titansoluciones.com') {
    $email_to = "contacto@titansoluciones.com";
    $email_subject = "Contacto web de: ";

    if (!isset($_POST['nombre']) ||
        !isset($_POST['email']) ||
        !isset($_POST['ciudad']) ||
        !isset($_POST['mensaje'])) {
        echo ('-1|Debes completar todos los campos');
    }

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $ciudad = $_POST['ciudad'];
    $mensaje = $_POST['mensaje'];

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'Ingresa un e-mail válido';
        echo '-1|' . $error_message;
    } else if (!preg_match($string_exp, $nombre)) {
        $error_message .= 'Ingresa un nombre válido';
        echo '-1|' . $error_message;
    } else if (!preg_match($string_exp, $ciudad)) {
        $error_message .= 'Ingresa una ciudad válida';
        echo '-1|' . $error_message;
    } else if (strlen($mensaje) < 2) {
        $error_message .= 'Ingresa un mensaje válido';
        echo '-1|' . $error_message;
    } else {
        $email_message = "Detalles del mensaje enviado.\n\n";

        function clean_string($string)
        {
            $bad = array("content-type", "bcc:", "to:", "cc:", "href");
            return str_replace($bad, "", $string);
        }

        $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
        // $email = filter_var($email, FILTER_SANITIZE_STRING);
        $ciudad = filter_var($ciudad, FILTER_SANITIZE_STRING);
        $mensaje = filter_var($mensaje, FILTER_SANITIZE_STRING);

        $email_message .= "Nombre: " . clean_string($nombre) . "\n";
        $email_message .= "Email: " . clean_string($email) . "\n";
        $email_message .= "Ciudad: " . clean_string($ciudad) . "\n";
        $email_message .= "Mensaje: " . clean_string($mensaje) . "\n";

        // create email headers
        $headers = 'From: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        if (@mail($email_to, $email_subject . clean_string($nombre), $email_message, $headers)) {
            echo '0|Mensaje enviado correctamente';
        } else {
            echo '-1|Ha ocurrido un error enviando el mensaje';
        }
    }
} else {
    echo '-1|Acceso denegado';
}
