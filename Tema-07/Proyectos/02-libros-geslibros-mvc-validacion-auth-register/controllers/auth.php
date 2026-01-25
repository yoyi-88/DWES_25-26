<?php

class Auth extends Controller
{

    // Crea una instancia del controlador auth
    // Llama al constructor de la clase padre Controller
    // Crea una vista para el controlador auth
    // Carga el modelo si existe auth.model.php
    function __construct()
    {

        parent::__construct();
    }

    /*
            Método:  login()
            Descripción: Muestra el formulario de login 
            URL asociada: auth/login
            Vista asociada: views/auth/login/index.php
            Modelo asociado: models/auth.model.php
           
        */

    function login()
    {

        // iniciar o continuar sesión
        sec_session_start();

        // Crear un token CSRF para los formularios
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        

        // Inicializo los campos del formulario
        $this->view->email = null;
        $this->view->pass = null;

        // Comprobar si existe alguna notificación o mensaje
        if (isset($_SESSION['notify'])) {
            $this->view->notify = $_SESSION['notify'];
            unset($_SESSION['notify']);
        }

        // Verificar si existe algún error
        if (isset($_SESSION['errors'])) {

            // detalles del error
            $this->view->errors = $_SESSION['errors'];
            unset($_SESSION['errors']);

            // Creo la propiedad error
            $this->view->error = "Error de autenticación, revise el formulario";

            // Retroalimento los detalles del formulario
            $this->view->email = $_SESSION['email'];
            $this->view->pass = $_SESSION['pass'];

            unset($_SESSION['email']);
            unset($_SESSION['pass']);
        }

        // Obtengo los datos del  modelo para mostrar en la vista

        // Creo la propiedad  title para la vista
        $this->view->title = "Autenticación de Usuarios";

        // Llama a la vista para renderizar la página
        $this->view->render('auth/login/index');
    }

    /*
            Método: validate()
            Descripción: Recibe los datos de autenticación para validarla: emial, pass
                - Validar usuario mediante email y pass
                - En caso de error de valiación. Restroalimenta el formulario y muestra errores
                - En caso de validación. Inicia sesión segura y redirecciona a la página de alumno

            url asociada: auth/validate_login

            POST:
                - email
                - pass
                - csrf_token
    */
    public function validate()
    {

        // inicio o continúo sesión
        sec_session_start();

        // Verificar el token CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            $this->handleError();
        }

        // Recogemos los datos del formulario saneados
        // Prevenir ataques XSS
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $pass = filter_var($_POST['pass'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        // Validación de los datos del formulario

        // Creo un array asociativo para almacenar los posibles errores del formulario
        $errors    = [];
        $validate  = true;

        // Vallidación email
        // Reglas de validación: obligatorio, formato email y existir en la tabla user
        if (empty($email)) {
            $errors['email'] = "El campo email es obligatorio";
            $validate = false;
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "El formato email no es correcto";
            $validate = false;
        }

       
        // Solo voy a validar el email y el password si el email es correcto
        if ($validate) {

            // Obtener los detalles del usuario a partir del email
            // Obtener un objeto de la clase user con las propiedades nombre, email, pass
            $user = $this->model->get_user_email($email);

            // Voy a validar en el mismo bloque el email y el password
            if (!$user) {
                $errors['email'] = 'Email  no ha sido registrado';

                // Verificación del password
                // Reglas de validación: obligatorio, longitud mínima sea 7 caracteres, coincidente con
                // password del usuario
            } else if (empty($pass)) {
                $errors['pass'] = "El password no ha sido introducido";
            } else if (strlen($pass) < 7) {
                $errors['pass'] = "Longitud mínima 7 caracteres";
            } else if (!password_verify($pass, $user->password)) {
                $errors['pass'] = "El password no es correcto";
            }
        }

        // Fin Validación

        // Si hay errores vuelvo al formulario de autenticación
        if (!empty($errors)) {

            // Almaceno los errores en la sesión
            $_SESSION['errors'] = $errors;
            
            // Almaceno email
            $_SESSION['email'] = $email;

            // Almaceno el password
            $_SESSION['pass'] = $pass;

            // Redirecciono al controlador auth/login
            header('Location: ' . URL . 'auth/login');
            exit();
        }

        // Autentiación correcta
        // - Almaceno los datos del usuario en la sesión
        // - Redirecciono al panel de control de alumnos


        // Almaceno los datos del usuario en la sesión
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_email'] = $user->email;

        // Obtengo los datos del rol del usuario
        $_SESSION['role_id'] = $this->model->get_id_role_user($user->id);
        $_SESSION['role_name'] = $this->model->get_name_role_user($_SESSION['role_id']);

         // Generar mensaje de inicio de sesión
        $_SESSION['notify'] = "Usuario ". $user->name. " ha iniciado sesión.";

        // redirección al panel de control
        header("location:". URL. "alumno");
        exit();
    }


    private function handleError()
    {
        // Incluir y cargar el controlador de errores
        $errorControllerFile = CONTROLLER_PATH . ERROR_CONTROLLER . '.php';

        if (file_exists($errorControllerFile)) {
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
