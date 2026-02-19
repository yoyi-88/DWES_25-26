<?php

class Album extends Controller
{

    // Crea una instancia del controlador album
    // Llama al constructor de la clase padre Controller
    // Crea una vista para el controlador album
    // Carga el modelo si existe album.model.php
    function __construct()
    {

        parent::__construct();
    }

    /*
            Método:  render
            Descripción: Renderiza la vista del album

            views/album/index.php
        */

    function render()
    {

        // iniciar o continuar sesión
        sec_session_start();

        // Capa Login
        $this->requireLogin();

        // Capa gestión rol de usuario
        // Solo los usuarios con privilegios pueden acceder a esta funcionalidad
        $this->requirePrivilege($GLOBALS['album']['render']);

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

        // Obtengo los datos del  modelo para mostrar en la vista

        // Creo la propiedad  title para la vista
        $this->view->title = "Colección de Álbumes";

        // Obtengo los datos del modelo
        $this->view->albumes = $this->model->get();

        // Llama a la vista para renderizar la página
        $this->view->render('album/main/index');
    }

    /*
            Método:new
            Descripción: Muestra el formulario para crear un nuevo album

            Carga de datos: lista de cursos para la lista dinámica del select
        */
    function new()
    {

        // iniciar o continuar sesión
        sec_session_start();

        // Capa Login
        $this->requireLogin();

        // Capa gestión rol de usuario
        // Solo los usuarios con privilegios pueden acceder a esta funcionalidad
        $this->requirePrivilege($GLOBALS['album']['new']);

        // Creo un token CSRF para el formulario
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        // Crear un objeto de la clase album vacío para el formulario
        $this->view->album = new class_album();

        // Comprobar no validación previa
        if (isset($_SESSION['errors'])) {
            // Creo la propiedad errors en la vista
            $this->view->errors = $_SESSION['errors'];
            unset($_SESSION['errors']);

            // Creo la propiedad album en la vista con los datos del formulario
            $this->view->album = $_SESSION['album'];
            unset($_SESSION['album']);

            // Creo la propiead error para la vista
            $this->view->error = "Errores en el formulario ";
        }

        // Creo la propiedad  title para la vista
        $this->view->title = "Nuevo Álbum";

        // Llama a la vista para renderizar la página
        $this->view->render('album/new/index');
    }

    /*
            Método: create
            Descripción: Recibe los datos del formulario para crear un nuevo album
            url asociada: album/create
       */
    public function create()
    {

        // inicio o continúo sesión
        sec_session_start();

        // Capa autenticación
        $this->requireLogin();

        // Capa gestión rol de usuario
        // Solo los usuarios con privilegios pueden acceder a esta funcionalidad
        $this->requirePrivilege($GLOBALS['album']['new']);

        // Verificar el token CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            $this->handleError();
        }

        // Recogemos los datos del formulario saneados
        // Prevenir ataques XSS
        $titulo = filter_var($_POST['titulo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $autor = filter_var($_POST['autor'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha = filter_var($_POST['fecha'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $etiquetas = filter_var($_POST['etiquetas'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        // Crear un objeto de la clase album
        $album = new class_album(
            null,
            $titulo,
            null,
            $autor,
            $fecha,
            null,
            null,
            $etiquetas,
            null,
            null,
            null,
            null,
            null
        );

        // Validamos los campos del formulario

        // Creo un array asociativo para almacenar los posibles errores del formulario
        // $error['nombre'] =  'Nombre es obligatorio'

        $errors = [];

        // Validamos el título
        // Regla validación: título obligatorio y menor que 100
        if (empty($titulo)) {
            $errors['titulo'] = "El campo título es obligatorio";
        } else if (strlen($titulo) >= 100) {
            $errors['titulo'] = "El campo título no puede tener más de 100 caracteres";
        }

        // Validación del autor
        // Regla validación: obligatorio
        if (empty($autor)) {
            $errors['autor'] = "El campo autor es obligatorio";
        }

        // Vallidación fecha
        // Reglas de validación: obligatorio, formato fecha
        if (empty($fecha)) {
            $errors['fecha'] = "El campo fecha es obligatorio";
        } else {
            $fecha_obj = DateTime::createFromFormat('Y-m-d', $fecha);
            if (!$fecha_obj) {
                $errors['fecha'] = "El formato de la fecha no es correcto";
            }
        }
        
        // Validación Etiquetas
        // Reglas de validación: obligatorio
        if (empty($etiquetas)) {
            $errors['etiquetas'] = "El campo etiquetas es obligatorio";
        }

        // Fin Validación

        // Si hay errores vuelvo al formulario mostrando los errores
        if (!empty($errors)) {

            // Almaceno los errores en la sesión
            $_SESSION['errors'] = $errors;

            // Almaceno los datos del formulario en la sesión para rellenar el formulario
            $_SESSION['album'] = $album;

            // Redirijo al formulario
            header('Location: ' . URL . 'album/new');
            exit();
        }

        // Llamar al modelo para insertar el nuevo album
        $this->model->create($album);

        // Generar un mensaje de éxito
        $_SESSION['notify'] = "album creado correctamente";

        // Redirigir a la lista de albums
        header('Location: ' . URL . 'album');
        exit();
    }

    /*
        Método: edit()
        Descripción: permite cargar los datos necesarios para editar los detalles
        de un album.

        Parámetros:
            - id: album a editar
    */
    public function edit($params)
    {

        // inicio o continúo sesión
        sec_session_start();

        // Capa autenticación
        $this->requireLogin();

        // Capa gestión rol de usuario
        // Solo los usuarios con privilegios pueden acceder a esta funcionalidad
        $this->requirePrivilege($GLOBALS['album']['edit']);

        // Obtener el id del album que voy a editar
        // album/edit/4 -> voy a editar el album con id=4
        // $param es un array en la posición 0 está el id
        $id = (int) $params[0];

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        // Obtener el objeto de la class_album con los detalles de este album
        $this->view->album = $this->model->read($id);

        // Creo la propiedad id en la vista
        $this->view->id = $id;

        // Comprobar no validación previa
        if (isset($_SESSION['errors'])) {
            // Creo la propiedad errors en la vista
            $this->view->errors = $_SESSION['errors'];
            unset($_SESSION['errors']);

            // Creo la propiedad album en la vista con los datos del formulario
            $this->view->album = $_SESSION['album'];
            unset($_SESSION['album']);

            // Creo la propiead error para la vista
            $this->view->error = "Errores en el formulario ";
        }

        // Creo el titulo para la  vista
        $this->view->title = "Formulario Editar album";

        // Cargamos los cursos
        $this->view->cursos = $this->model->get_cursos();

        // Cargo la vista
        $this->view->render('album/edit/index');
    }

    /*
        Método: update()
        Descripción: Recibe los datos del formulario para actualizar un album
        url asociada: album/update/id

        Parámetros:
            - id (GET): album a actualizar
            - datos del formulario (POST)
    */
    public function update($params)
    {

        // inicio o continúo sesión
        sec_session_start();

        // Capa autenticación
        $this->requireLogin();

        // Capa gestión rol de usuario
        // Solo los usuarios con privilegios pueden acceder a esta funcionalidad
        $this->requirePrivilege($GLOBALS['album']['edit']);

        // Obtener el id del album que voy a actualizar
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
        $curso_id = (int) filter_var($_POST['curso_id'] ??= '', FILTER_SANITIZE_NUMBER_INT);

        // Validar los datos, se omite en este ejemplo

        // Crear un objeto de la clase album con los datos actualizados
        $album_act = new class_album(
            $id,
            $nombre,
            $apellidos,
            $email,
            $telefono,
            $nacionalidad,
            $dni,
            $fecha_nac,
            (int) $curso_id
        );

        // Obtengo los detalles del album antes de la actualización
        $album = $this->model->read($id);

        // Valido sólo los campos que han cambiado

        // array asociativo para almacenar los errores de validación
        $errors = [];

        // Control cambios
        $cambios = false;

        // Validación del nombre
        // Reglas: obligatorio
        if (strcmp($nombre, $album->nombre) != 0) {
            $cambios = true;
            if (empty($nombre)) {
                $errors['nombre'] = 'El campo nombre es obligatorio';
            }
        }

        // Validación de los apellidos
        // Reglas: obligatorio
        if (strcmp($apellidos, $album->apellidos) != 0) {
            $cambios = true;
            if (empty($apellidos)) {
                $errors['apellidos'] = 'El campo apellidos es obligatorios';
            }
        }

        // Validación de la fecha de nacimiento
        // Reglas: obligatorio, formato fecha
        if (strcmp($fecha_nac, $album->fecha_nac) != 0) {
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
        if (strcmp($dni, $album->dni) != 0) {
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
        if (strcmp($email, $album->email) != 0) {
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
        if (strcmp($telefono, $album->telefono) != 0) {
            $cambios = true;
            if (empty($telefono)) {
                $errors['telefono'] = 'El campo teléfono es obligatorio';
            } else if (!preg_match('/^\d{9}$/', $telefono)) {
                $errors['telefono'] = 'El formato del teléfono no es correcto';
            }
        }

        // Validación de la nacionalidad
        // Reglas: No obligatorio

        if (strcmp($nacionalidad, $album->nacionalidad) != 0) {
            $cambios = true;
        }

        // Validación curso_id
        // Reglas: obligatorio, entero, clave ajena
        if ($curso_id != $album->curso_id) {
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
            $_SESSION['album'] = $album_act;

            // Redirijo al formulario
            header('Location: ' . URL . 'album/edit/' . $id);
            exit();
        }

        // Si no hay cambios redirijo a la lista de albums
        if (!$cambios) {
            // Genero mensaje de notificación sin cambios
            $_SESSION['notify'] = "No se han realizado cambios en el album";

            // Redirigir a la lista de albums
            header('Location: ' . URL . 'album');
            exit();
        }


        // Llamar al modelo para actualizar el album
        $this->model->update($album_act, $id);

        // Generar un mensaje de éxito
        $_SESSION['notify'] = "album actualizado correctamente";

        // Redirigir a la lista de albums
        header('Location: ' . URL . 'album');
        exit();
    }

    /*
        Método: show()
        Descripción: Muestra los detalles de un album
        Los detalles del album se mostran en un formulario de solo lectura
        Parámetros:
            - id: album a mostrar
    */
    public function show($params)
    {

        // Iniciar o continuar sesión
        sec_session_start();

        // Capa autenticación
        $this->requireLogin();

        // Capa gestión rol de usuario
        // Solo los usuarios con privilegios pueden acceder a esta funcionalidad
        $this->requirePrivilege($GLOBALS['album']['show']);

        // Obtener el id del album que voy a mostrar
        // album/show/4 -> voy a mostrar el album con id=4
        // $param es un array en la posición 0 está el id
        $id = (int) htmlspecialchars($params[0]);

        // No es necesario el token CSRF para mostrar datos        

        // Validar id del album que voy a mostrar
        if (!$this->model->validate_id_album_exists($id)) {
            // Generar un mensaje de error
            $_SESSION['error'] = "El album que intentas ver no existe";

            // Redirigir a la lista de albums si el id no es válido
            header('Location: ' . URL . 'album');
            exit();
        }


        // Obtener el objeto de la class_album con los detalles de este album
        $this->view->album = $this->model->read_show($id);

        // Creo la propiedad id en la vista
        $this->view->id = $id;

        // Creo el titulo para la  vista
        $this->view->title = "Detalles del album";

        // Cargo la vista
        $this->view->render('album/show/index');
    }

    /*
        Método: delete()
        Descripción: Elimina un album de la base de datos
        Parámetros:
            - id: album a eliminar
    */
    public function delete($params)
    {

        // inicio o continúo sesión
        sec_session_start();

        // Capa autenticación
        $this->requireLogin();

        // Capa gestión rol de usuario
        // Solo los usuarios con privilegios pueden acceder a esta funcionalidad    
        $this->requirePrivilege($GLOBALS['album']['delete']);

        // Obtener token CSRF url
        $csrf_token = $_POST['csrf_token'] ??= '';

        // Verificar el token CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            $this->handleError();
        }

        // Obtener el id del album que voy a eliminar
        // album/delete/4 -> voy a eliminar el album con id=4
        // $param es un array en la posición 0 está el id
        $id = (int) $params[0];

        // Validar id del album que voy a eliminar
        if (!$this->model->validate_id_album_exists($id)) {
            // Generar un mensaje de error
            $_SESSION['error'] = "El album que intentas eliminar no existe";

            // Redirigir a la lista de albums si el id no es válido
            header('Location: ' . URL . 'album');
            exit();
        }

        // Llamar al modelo para eliminar el album
        $this->model->delete($id);

        // Generar un mensaje de éxito
        $_SESSION['notify'] = "album eliminado correctamente";

        // Redirigir a la lista de albums
        header('Location: ' . URL . 'album');
    }

    /*
        Método: search()
        Descripción: Busca a partir de una expresión en todos los detalles de los albums
        url asociada: album/search
    */
    public function search()
    {

        // iniciar o continuar sesión
        sec_session_start();

        // Capa autenticación
        $this->requireLogin();

        // Capa gestión rol de usuario
        // Solo los usuarios con privilegios pueden acceder a esta funcionalidad
        $this->requirePrivilege($GLOBALS['album']['search']);

        // Obtener la expresión de búsqueda desde el formulario
        $term = filter_var($_GET['term'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        // No es necesario verificar el token CSRF para búsquedas GET

        // Creo la propiedad  title para la vista
        $this->view->notify = "Resultados de la búsqueda: " . $term;

        // Llamar al modelo para buscar los albums
        $this->view->albums = $this->model->search($term);

        // Llama a la vista para renderizar la página
        $this->view->render('album/main/index');
    }

    /*
        Método: order()
        Descripción: Ordena la lista de albums por un criterio
        url asociada: album/order/criterio

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
    public function order($params)
    {

        // iniciar o continuar sesión
        sec_session_start();

        // Capa autenticación
        $this->requireLogin();

        // Capa gestión rol de usuario
        // Solo los usuarios con privilegios pueden acceder a esta funcionalidad
        $this->requirePrivilege($GLOBALS['album']['order']);

        // No es necesario verificar el token CSRF para ordenación GET

        // Obtener el criterio de ordenación
        $criterio = (int) $params[0];

        // Mapeo de criterios a columnas de la base de datos
        $columnas = [
            1 => 'albums.id',
            2 => 'album',
            3 => 'albums.email',
            4 => 'albums.nacionalidad',
            5 => 'albums.dni',
            6 => 'edad',
            7 => 'curso'
        ];

        // Creo la propiedad  title para la vista
        $this->view->title = "albums ordenados por " . ($columnas[$criterio] ?? 'Id');

        // Creo la propiedad  notify para la vista
        $this->view->notify = "albums ordenados por " . ($columnas[$criterio] ?? 'Id');

        // Llamar al modelo para ordenar los albums
        $this->view->albums = $this->model->order($criterio);

        // Llama a la vista para renderizar la página
        $this->view->render('album/main/index');
    }

    /*
        Método: requirePrivilege
        Descripción: Verifica que el usuario tiene privilegios para acceder a la funcionalidad
    */
    private function requirePrivilege($allowedRoles)
    {
        if (!in_array($_SESSION['role_id'], $allowedRoles)) {
            $_SESSION['error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('Location: ' . URL . 'album');
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
