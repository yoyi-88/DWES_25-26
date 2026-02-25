<?php

class Contact extends Controller
{

    // Crea una instancia del controlador contact
    // Llama al constructor de la clase padre Controller
    // Crea una vista para el controlador contact
    // Carga el modelo si existe contact.model.php
    function __construct()
    {

        parent::__construct();
    }

    /*
            Método:  render
            Descripción: Renderiza la vista del contact

            views/contact/index.php
        */

    function render()
    {

        // iniciar o continuar sesión para validar formulario de contacto
        sec_session_start();

        // Crear un token CSRF para los formularios
        // Por si el usuario abre dos pestañas simultáneas del mismo formulario
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        // Comprobar si hay mensajes en la sesión y pasarlos a la vista
        if (isset($_SESSION['notify'])) {
            $this->view->notify = $_SESSION['notify'];
            unset($_SESSION['notify']);
        }

        // Comprobar si hay mensajes de error en la sesión y pasarlos a la vista
        if (isset($_SESSION['error'])) {
            $this->view->notify = $_SESSION['error'];
            unset($_SESSION['error']);
        }

        // Inicializar los campo del formulario de contacto como objeto contacto
        $this->view->contact->name = null;
        $this->view->contact->email = null;
        $this->view->contact->message = null;
        $this->view->contact->subject = null;

        // compruebo si hay errores de una no validación anterior
        if (isset($_SESSION['errors'])) {
            // Muestro los errores
            $this->view->error = $_SESSION['errors'];
            // Retroalimento al formulario
            $this->view->contact = $_SESSION['contact'];

            // Elimino la variable de sesión
            unset($_SESSION['errors']);
            // elimino la variable de sesión del formulario
            unset($_SESSION['contact']);
        }
        

        // Obtengo los datos del  modelo para mostrar en la vista

        // Creo la propiedad  title para la vista
        $this->view->title = "Formulario de Contacto";


        // Llama a la vista para renderizar la página
        $this->view->render('contact/index');
    }

    /*
            Método: validate()
            Descripción: Valida el formulario de contacto y si es correcto envía un email al administrador con los datos del formulario
       */
    public function validate()
    {

        // inicio o continúo sesión
        sec_session_start();

        // Verificar el token CSRF
        $this->checkTokenCsrf($_POST['csrf_token'] ??= '');

        // Recogemos los datos del formulario saneados
        // Prevenir ataques XSS
        $name = filter_var($_POST['name'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $subject = filter_var($_POST['subject'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $message = filter_var($_POST['message'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
    
        // Crear un objeto de la clase contact
        $contact = new class_contact(
            $name,
            $email,
            $subject,
            $message
        );

        // Validamos los campos del formulario

        // Creo un array asociativo para almacenar los posibles errores del formulario
        // $error['nombre'] =  'Nombre es obligatorio'

        $errors = [];

        // Validamos el nombre
        // Regla validación: obligatorio
        if (empty($name)) {
            $errors['name'] = "El campo nombre es obligatorio";
        }

        // Validación de los email
        if (empty($email)) {
            $errors['email'] = "El campo email es obligatorio";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "El formato email no es correcto";
        }

        // Vallidación asunto
        // Reglas de validación: obligatorio
        if (empty($subject)) {
            $errors['subject'] = "El campo asunto es obligatorio";
        }

        // Validación del mensaje
        // Reglas de validación: obligatorio
        if (empty($message)) {
            $errors['message'] = "El campo mensaje es obligatorio";
        }

        // Fin Validación

        // Si hay errores vuelvo al formulario mostrando los errores
        if (!empty($errors)) {

            // Almaceno los errores en la sesión
            $_SESSION['errors'] = $errors;

            // Almaceno los datos del formulario en la sesión para rellenar el formulario
            $_SESSION['contact'] = $contact;

            // Redirijo al formulario
            header('Location: ' . URL . 'contact/new');
            exit();
        }

        // Enviar el correo al administrador con los datos del formulario
        $cuerpo_mensaje = "Nombre: " . $name . "\n";
        $cuerpo_mensaje .= "Email: " . $email . "\n";
        $cuerpo_mensaje .= "Asunto: " . $subject . "\n";
        $cuerpo_mensaje .= "Mensaje: " . $message . "\n";

        $this->sendEmail(EMAIL_ADMIN, "Nuevo mensaje de contacto", $cuerpo_mensaje);

        // Llamar al modelo para insertar el nuevo contact
        $this->model->create($contact);

        // Generar un mensaje de éxito
        $_SESSION['notify'] = "Mensaje enviado correctamente";

        // Redirigir a la lista de alumnos
        header('Location: ' . URL . 'index');
        exit();
    }

    /*
        Método: sendEmail
        Descripción: Envía un email al administrador con los datos del formulario de contacto
    */
    private function sendEmail($name, $email, $subject, $message)
    {
        // configuracion de la cuenta de correo
        


    /*
        Método: requirePrivilege
        Descripción: Verifica que el usuario tiene privilegios para acceder a la funcionalidad
    */
    private function requirePrivilege($allowedRoles)
    {
        if (!in_array($_SESSION['role_id'], $allowedRoles)) {
            $_SESSION['error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('Location: ' . URL . 'contact');
            exit();
        }
    }

    /*
        Método: requireLogin
        Descripción: Verifica que el usuario ha iniciado sesión
    */
    private function requireLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['notify'] = "Debes iniciar sesión para acceder al sistema";
            header('Location: ' . URL . 'auth/login');
            exit();
        }
    }

    /*
        Método checkTokenCsrf()
        Permite checkear si el token CSRF es válido
        @param
            - string $csrf_token: token CSRF
    */
    public function checkTokenCsrf($csrf_token)
    {

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
             $this->handleError();
        }
    }

    /*
        Método: handleError
        Descripción: Maneja los errores de la base de datos
    */

    private function handleError()
    {
        // Incluir y cargar el controlador de errores
        $errorControllerFile = CONTROLLER_PATH . ERROR_CONTROLLER . '.php';

        if (file_exists($errorControllerFile)) {
            sec_session_destroy();
            require_once $errorControllerFile;
            $mensaje = "Error de validación de seguridad del formulario. Intenta acceder de nuevo desde la página principal";
            $controller = new Errores('403', 'Mensaje de Error: ', $mensaje);
        } else {
            // Fallback en caso de que el controlador de errores no exista
            echo "Error crítico: " . "No se pudo cargar el controlador de errores.";
            exit();
        }
    }
}
