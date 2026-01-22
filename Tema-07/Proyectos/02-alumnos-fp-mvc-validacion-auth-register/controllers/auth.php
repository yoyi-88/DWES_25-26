<?php

    class Auth Extends Controller {

        // Crea una instancia del controlador auth
        // Llama al constructor de la clase padre Controller
        // Crea una vista para el controlador auth
        // Carga el modelo si existe auth.model.php
        function __construct() {

            parent ::__construct(); 
            
        }

        /*
            Método:  login()
            Descripción: Muestra el formulario de login
            URL asociada: auth/login
            vista asociada: views/auth/login/index.php
            Modelo asociado: models/auth.model.php

            views/auth/index.php
        */

        function login() {

            // iniciar o continuar sesión
            session_start();

            // Crear un token CSRF para los formularios
            if (empty($_SESSION['csrf_token'])) {
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            }

            // Inicializo los campos del formulario
            $this->view->email = null;
            $this->view->password = null;

            // Comprobar si existe alguna notificación o mensaje
            if (isset($_SESSION['notify'])) {
                $this->view->notify = $_SESSION['notify'];
                unset($_SESSION['notify']);
            }

            // Verifico si existe algún error
            if (isset($_SESSION['errors'])) {
                $this->view->errors = $_SESSION['errors'];
                unset($_SESSION['errors']);

                // Creo la propiedad error
                $this->view->error = "Error de autenticación, revise el formulario";

                // // Retroalimento los detalles del formulario
                $this->view->email = $_SESSION['email'];
                $this->view->password = $_SESSION['pass'];


                unset($_SESSION['email']);
                unset($_SESSION['pass']);
            }
            
                
            // Obtengo los datos del  modelo para mostrar en la vista
            
            // Creo la propiedad  title para la vista
            $this->view->title = "Autentificación de Usuarios";

            // Llama a la vista para renderizar la página
            $this->view->render('auth/login/index');
        }

       

       /*
            Método: validate_login
            Descripción: Recibe los datos del autenticación para validarla: email, pass
                - Validar usuario mediante email y pass 
                - En caso de error de validación. Retroalimenta el formulario y muestra errores
                - En caso de validación. Inicia sesión segura y redirecciona a la página de alumno
            
            url asociada: auth/validate/login

            POST:
                - email
                - pass
                - csrf_token
       */
       public function validate_login() {

        // inicio o continúo sesión
        session_start();

        // Verificar el token CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            $this->handleError();
        }

        // Recogemos los datos del formulario saneados
        // Prevenir ataques XSS
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $pass = filter_var($_POST['pass'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        // Validamos los campos del formulario

        // Creo un array asociativo para almacenar los posibles errores del formulario
        
        $error = [];

        // Vallidación email
        // Reglas de validación: obligatorio, formato email y clave secundaria
        if (empty($email)){
            $error['email'] = "El campo email es obligatorio";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = "El formato email no es correcto";
        } 

        // Obtener los detalles del usuario a partir del email
        // Obtener un objeto de la clase user con las propiedades email, pass
        $user = $this->model->get_user_email($email);
        
        // Verifico usuario
        if (!$user) {
            $error['email'] = 'Email no ha sido registrado';
        }

        // Validación del password
        // Reglas de validación: obligatorio, longitud mínima sea 7 caracteres, coincidente con password del usuario
        if (empty($pass)){
            $error['pass'] = "El password no ha sido introducido";
        } else if (strlen($pass) < 7) {
            $error['pass'] = "Longitud mínima 7 caracteres";
        } else if (!password_verify($pass, $user->password)) {
            $error['pass'] = "El password no es correcto";
        }

        // Fin Validación

        // Si hay errores vuelvo al formulario mostrando los errores
        if (!empty($error)) {

            // Almaceno los errores en la sesión
            $_SESSION['errors'] = $error;

            // Almaceno email
            $_SESSION['email'] = $email;

            // Almaceno el password
            $_SESSION['pass'] = $pass;

            // Redirecciono al controlador auth/Login
            header('Location: ' . URL . 'auth/login');
            exit();
        }

        // Llamar al modelo para insertar el nuevo auth
        $this->model->create($auth);

        // Generar un mensaje de éxito
        $_SESSION['notify'] = "auth creado correctamente";

        // Redirigir a la lista de auths
        header('Location: ' . URL . 'auth');
        exit();

    }   
    
    /*
        Método: edit()
        Descripción: permite cargar los datos necesarios para editar los detalles
        de un auth.

        Parámetros:
            - id: auth a editar
    */
    public function edit($params) {

        // inicio o continúo sesión
        session_start();

        // Obtener el id del auth que voy a editar
        // auth/edit/4 -> voy a editar el auth con id=4
        // $param es un array en la posición 0 está el id
        $id = (int) $params[0];

        // Obtener el token CSRF para el formulario
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }


        
        // Obtener el objeto de la class_auth con los detalles de este auth
        $this->view->auth = $this->model->read($id);

        // Creo la propiedad id en la vista
        $this->view->id = $id;

        // Comprobar no validación previa
        if (isset($_SESSION['errors'])) {
            // Creo la propiedad errors en la vista
            $this->view->errors = $_SESSION['errors'];
            unset($_SESSION['errors']);

            // Creo la propiedad auth en la vista con los datos del formulario
            $this->view->auth = $_SESSION['auth'];
            unset($_SESSION['auth']);

            // Creo la propiead error para la vista
            $this->view->error = "Errores en el formulario ";
        }

        // Creo el titulo para la  vista
        $this->view->title = "Formulario Editar auth";

        // Cargamos los cursos
        $this->view->cursos = $this->model->get_cursos();

        // Cargo la vista
        $this->view->render('auth/edit/index');


    }

    /*
        Método: update()
        Descripción: Recibe los datos del formulario para actualizar un auth
        url asociada: auth/update/id

        Parámetros:
            - id (GET): auth a actualizar
            - datos del formulario (POST)
    */
    public function update($params) {

        // inicio o continúo sesión
        session_start();

        // Obtener el id del auth que voy a actualizar
        $id = (int) htmlspecialchars($params[0]);;

        // Verificar el token CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            $this->handleError();
        }


        // Obtengo los datos del formulario saneados
        // Prevenir ataques XSS

        $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $nacionalidad = filter_var($_POST['nacionalidad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha_nac = filter_var($_POST['fecha_nac'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $curso_id = filter_var($_POST['curso_id'] ??= '', FILTER_SANITIZE_NUMBER_INT);


        // Validar los datos, se omite en este ejemplo

        // Crear un objeto de la clase auth con los datos actualizados
        $auth_act = new class_auth(
            $id, 
            $nombre, 
            $apellidos, 
            $email,
            $telefono,
            $nacionalidad,  
            $dni,  
            $fecha_nac, 
            $curso_id
        );

        // Obtengo los detalles del auth antes de la actualización
        $auth = $this->model->read($id);

        // Valido sólo los campos que han cambiado

        // array asociativo para almacenar los errores de validación
        $errors = [];

        // Control cambios
        $cambios = false;

        // Validación del nombre
        // Reglas: obligatorio
        if (strcmp($nombre, $auth->nombre) != 0) {
            $cambios = true;
            if (empty($nombre)) {
                $errors['nombre'] = 'El campo nombre es obligatorio';
            }
        }

        // Validación de los apellidos
        // Reglas: obligatorio
        if (strcmp($apellidos, $auth->apellidos) != 0) {
            $cambios = true;
            if (empty($apellidos)) {
                $errors['apellidos'] = 'El campo apellidos es obligatorios';
            }
        }

        // Validación de la fecha de nacimiento
        // Reglas: obligatorio, formato fecha
        if (strcmp($fecha_nac, $auth->fecha_nac) != 0) {
            $cambios = true;
            if (empty($fecha_nac)) {
                $errors['fecha_nac'] = 'El  campo fecha de nacimiento es obligatorio';
            } else {
                $fecha = DateTime::createFromFormat('Y-m-d', $fecha_nac);
                if (!$fecha) {
                    $errors['fecha_nac'] = 'El formato de la fecha de nacimiento no es correcto';
                }
            }
        }


        // Validación del DNI
        // Reglas: obligatorio, formato DNI y clave secundaria
        if (strcmp($dni, $auth->dni) != 0) {
            $cambios = true;
            // Expresión regular para validar el DNI
            // 8 números seguidos de una letra
            $options = [
                'options' => [
                    'regexp' => '/^(\d{8})([A-Za-z])$/'
                ]
            ];

            if (empty($dni)) {
                $errors['dni'] = 'El campo DNI es obligatorio';
            } else if (!filter_var($dni, FILTER_VALIDATE_REGEXP, $options)) {
                $errors['dni'] = 'Formato DNI no es correcto';
            } else if (!$this->model->validate_unique_dni($dni)) {
                $errors['dni'] = 'El DNI ya ha sido registrado';
            }
        }  

        // Validación del email
        // Reglas: obligatorio, formato email y clave secundaria
        if (strcmp($email, $auth->email) != 0) {
            $cambios = true;
            if (empty($email)) {
                $errors['email'] = 'El campo email es obligatorio';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'El formato del email no es correcto';
            } else if (!$this->model->validate_unique_email($email)) {
                $errors['email'] = 'El email ya ha sido registrado';
            }
        }

        // Validación del teléfono
        // Reglas: obligatorio, formato teléfono
        if (strcmp($telefono, $auth->telefono) != 0) {
            $cambios = true;
            if (empty($telefono)) {
                $errors['telefono'] = 'El campo teléfono es obligatorio';
            } else if (!preg_match('/^\d{9}$/', $telefono)) {
                $errors['telefono'] = 'El formato del teléfono no es correcto';
            }
        }

        // Validación de la nacionalidad
        // Reglas: No obligatorio

        // Validación curso_id
        // Reglas: obligatorio, entero, clave ajena
        if ($curso_id != $auth->curso_id) {
            $cambios = true;
            if (empty($curso_id)) {
                $errors['curso_id'] = 'El curso es obligatorio';
            } else if (!filter_var($curso_id, FILTER_VALIDATE_INT)) {
                $errors['curso_id'] = 'El formato del curso no es correcto';
            } else if (!$this->model->validate_curso_exists($curso_id)) {
                $errors['curso_id'] = 'El curso no existe';
            }
        }

        // Fin validación

        // Si hay errores vuelvo al formulario mostrando los errores
        if (!empty($errors)) {

            // Almaceno los errores en la sesión
            $_SESSION['errors'] = $errors;

            // Almaceno los datos del formulario en la sesión para rellenar el formulario
            $_SESSION['auth'] = $auth_act;

            // Redirijo al formulario
            header('Location: ' . URL . 'auth/edit/' . $id);
            exit();
        }

        // Si no hay cambios redirijo a la lista de auths
        if (!$cambios) {
            // Genero mensaje de notificación sin cambios
            $_SESSION['notify'] = "No se han realizado cambios en el auth";

            // Redirigir a la lista de auths
            header('Location: ' . URL . 'auth');
            exit();
        }


        // Llamar al modelo para actualizar el auth
        $this->model->update($auth_act, $id);

        // Generar un mensaje de éxito
        $_SESSION['notify'] = "auth actualizado correctamente";

        // Redirigir a la lista de auths
        header('Location: ' . URL . 'auth');
        exit();     
    
    
    }

    /*
        Método: show()
        Descripción: Muestra los detalles de un auth
        Los detalles del auth se mostran en un formulario de solo lectura
        Parámetros:
            - id: auth a mostrar
    */
    public function show($params) {

        // inicio o continúo sesión
        session_start(); 

        // Obtener el id del auth que voy a mostrar
        // auth/show/4 -> voy a mostrar el auth con id=4
        // $param es un array en la posición 0 está el id
        $id = (int) htmlspecialchars($params[0]);

        // Obtener el token CSRF desde la vista principal main/index.php
        // auth/show/4/token_csrf
        $csrf_token = $params[1];

        // Validación CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            $this->handleError();
        }

        // Validar id del auth que voy a mostrar
        if (!$this->model->validate_id_auth_exists($id)) {
            // Generar un mensaje de error
            $_SESSION['error'] = "El auth que intentas ver no existe";
            // Redirigir a la lista de auths si el id no es válido
            header('Location: ' . URL . 'auth');
            exit();
        }
        
        // Obtener el objeto de la class_auth con los detalles de este auth
        $this->view->auth = $this->model->read_show($id);

        // Creo la propiedad id en la vista
        $this->view->id = $id;

        // Creo el titulo para la  vista
        $this->view->title = "Detalles del auth";

        // Cargo la vista
        $this->view->render('auth/show/index');
    }

    /*
        Método: delete()
        Descripción: Elimina un auth de la base de datos
        Parámetros:
            - id: auth a eliminar
    */
    public function delete($params) {
        // inicio o continúo sesión
        session_start();

        // obtengo el token CSRF url
        $csrf_token = $params[1];

        // verificar el token CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            $this->handleError();
        }

        // Obtener el id del auth que voy a eliminar
        // auth/delete/4 -> voy a eliminar el auth con id=4
        // $param es un array en la posición 0 está el id
        $id = (int) $params[0];

        // validar id del auth que voy a eliminar
        if (!$this->model->validate_id_auth_exists($id)) {
            // Generar un mensaje de error
            $_SESSION['error'] = "El auth que intentas eliminar no existe";
            // Redirigir a la lista de auths si el id no es válido
            header('Location: ' . URL . 'auth');
            exit();
        }
        
        // Llamar al modelo para eliminar el auth
        $this->model->delete($id);

        // Generar un mensaje de éxito
        $_SESSION['notify'] = "auth eliminado correctamente";

        // Redirigir a la lista de auths
        header('Location: ' . URL . 'auth');
    }

    /*
        Método: search()
        Descripción: Busca a partir de una expresión en todos los detalles de los auths
        url asociada: auth/search
    */
    public function search() {

        // inicio o continúo sesión
        session_start();

        // obtengo  la expresión de búsqueda desde el formulario
        $term = filter_var($_GET['term'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        // obtener el token CSRF desde el formulario
        $csrf_token = $_GET['csrf_token'] ??= '';


        // verificar el token CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            $this->handleError();
        }

        // Creo la propiedad  title para la vista
        $this->view->notify = "Resultados de la búsqueda: " . $term;

        // Llamar al modelo para buscar los auths
        $this->view->auths = $this->model->search($term);

        // Llama a la vista para renderizar la página
        $this->view->render('auth/main/index');
    }

    /*
        Método: order()
        Descripción: Ordena la lista de auths por un criterio
        url asociada: auth/order/criterio

        Parámetros:
            - criterio: campo por el que se ordena la lista
                1: id
                2: nombre
                3: email
                4: nacionalidad
                5: dni
                6: edad
                7: curso
    */
    public function order($params) {
        
        // inicio o continúo sesión
        session_start();
        // obtengo  el token CSRF desde la url
        $csrf_token = $params[1];
        // verificar el token CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            $this->handleError();
        }
        
        // Obtener el criterio de ordenación
        $criterio = (int) $params[0];

        // Mapeo de criterios a columnas de la base de datos
        $columnas = [
            1 => 'auths.id',
            2 => 'auth',
            3 => 'auths.email',
            4 => 'auths.nacionalidad',
            5 => 'auths.dni',
            6 => 'edad',
            7 => 'curso'
        ];

        // Creo la propiedad  title para la vista
        $this->view->title = "auths ordenados por " . ($columnas[$criterio] ?? 'Id');  

        // Creo la propiedad  notify para la vista
        $this->view->notify = "auths ordenados por " . ($columnas[$criterio] ?? 'Id');

        // Llamar al modelo para ordenar los auths
        $this->view->auths = $this->model->order($criterio);

        // Llama a la vista para renderizar la página
        $this->view->render('auth/main/index');
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

?>