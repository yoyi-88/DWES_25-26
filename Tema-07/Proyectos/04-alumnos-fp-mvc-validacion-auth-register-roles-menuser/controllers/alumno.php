<?php

class Alumno extends Controller
{

    // Crea una instancia del controlador Alumno
    // Llama al constructor de la clase padre Controller
    // Crea una vista para el controlador Alumno
    // Carga el modelo si existe alumno.model.php
    function __construct()
    {

        parent::__construct();
    }

    /*
            Método:  render
            Descripción: Renderiza la vista del alumno

            views/alumno/index.php
        */

    function render()
    {

        // iniciar o continuar sesión
        sec_session_start();

        // Capa Login
        $this->requireLogin();

        // Capa gestión rol de usuario
        // Solo los usuarios con privilegios pueden acceder a esta funcionalidad
        $this->requirePrivilege($GLOBALS['alumno']['render']);

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
        $this->view->title = "Tabla Alumnos de FP";

        // Obtengo los datos del modelo
        $this->view->alumnos = $this->model->get();

        // Llama a la vista para renderizar la página
        $this->view->render('alumno/main/index');
    }

    /*
            Método:new
            Descripción: Muestra el formulario para crear un nuevo alumno

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
        $this->requirePrivilege($GLOBALS['alumno']['new']);

        // Creo un token CSRF para el formulario
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        // Crear un objeto de la clase alumno vacío para el formulario
        $this->view->alumno = new class_alumno();

        // Comprobar no validación previa
        if (isset($_SESSION['errors'])) {
            // Creo la propiedad errors en la vista
            $this->view->errors = $_SESSION['errors'];
            unset($_SESSION['errors']);

            // Creo la propiedad alumno en la vista con los datos del formulario
            $this->view->alumno = $_SESSION['alumno'];
            unset($_SESSION['alumno']);

            // Creo la propiead error para la vista
            $this->view->error = "Errores en el formulario ";
        }

        // Creo la propiedad  title para la vista
        $this->view->title = "Nuevo Alumno";

        // Obtengo los datos del modelo de cursos
        $this->view->cursos = $this->model->get_cursos();

        // Llama a la vista para renderizar la página
        $this->view->render('alumno/new/index');
    }

    /*
            Método: create
            Descripción: Recibe los datos del formulario para crear un nuevo alumno
            url asociada: alumno/create
       */
    public function create()
    {

        // inicio o continúo sesión
        sec_session_start();

        // Capa autenticación
        $this->requireLogin();

        // Capa gestión rol de usuario
        // Solo los usuarios con privilegios pueden acceder a esta funcionalidad
        $this->requirePrivilege($GLOBALS['alumno']['new']);

        // Verificar el token CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            $this->handleError();
        }

        // Recogemos los datos del formulario saneados
        // Prevenir ataques XSS
        $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $nacionalidad = filter_var($_POST['nacionalidad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha_nac = filter_var($_POST['fecha_nac'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $curso_id = filter_var($_POST['curso_id'] ??= '', FILTER_SANITIZE_NUMBER_INT);

        // Crear un objeto de la clase Alumno
        $alumno = new class_alumno(
            null,
            $nombre,
            $apellidos,
            $email,
            $telefono,
            $nacionalidad,
            $dni,
            $fecha_nac,
            $curso_id
        );

        // Validamos los campos del formulario

        // Creo un array asociativo para almacenar los posibles errores del formulario
        // $error['nombre'] =  'Nombre es obligatorio'

        $errors = [];

        // Validamos el nombre
        // Regla validación: obligatorio
        if (empty($nombre)) {
            $errors['nombre'] = "El campo nombre es obligatorio";
        }

        // Validación de los apellidos
        // Regla validación: obligatorio
        if (empty($apellidos)) {
            $errors['apellidos'] = "El campo apelllidos es obligatorio";
        }

        // Vallidación email
        // Reglas de validación: obligatorio, formato email y clave secundaria
        if (empty($email)) {
            $errors['email'] = "El campo email es obligatorio";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "El formato email no es correcto";
        } else if (!$this->model->validate_unique_email($email)) {
            $errors['email'] = "El email ya ha sido registrado";
        }

        // Validación del DNI
        // Reglas de validación: obligatorio, formato DNI y clave secundaria
        if (empty($dni)) {
            $errors['dni'] = "El campo DNI es obligatorio";
        } else if (!preg_match('/^[0-9]{8}[A-Za-z]$/', $dni)) {
            $errors['dni'] = "El formato del DNI no es correcto";
        } else if (!$this->model->validate_unique_dni($dni)) {
            $errors['dni'] = "El DNI ya ha sido registrado";
        }

        // Validación del teléfono
        // Regla validación teléfono: obligatorio, formato teléfono
        if (empty($telefono)) {
            $errors['telefono'] = "El teléfono es un campo obligatorio";
        } else if (!preg_match('/^\d{9}$/', $telefono)) {
            $errors['telefono'] = "El formato del teléfono no es correcto";
        }

        // Validación de la fecha de nacimiento
        // Reglas de validación: obligatorio, formato fecha
        if (empty($fecha_nac)) {
            $errors['fecha_nac'] = "El campo fecha de nacimiento es obligatorio";
        } else {
            $fecha = DateTime::createFromFormat('Y-m-d', $fecha_nac);
            if (!$fecha) {
                $errors['fecha_nac'] = 'El formato de la fecha de nacimiento no es correcto';
            }
        }

        // Validación de la nacionalidad
        // Regla validaci´n de la nacinalidad: opcional

        // Validación de curso_id
        // Regla validación curso_id: obligatorio, debe ser un entero, debe existir en la tabla cursos
        if (empty($curso_id)) {
            $errors['curso_id'] = "El campo curso es obligatorio";
        } else if (!filter_var($curso_id, FILTER_VALIDATE_INT)) {
            $errors['curso_id'] = "El formato del curso no es correcto";
        } else if (!$this->model->validate_curso_exists($curso_id)) {
            $errors['curso_id'] = "El curso seleccionado no existe";
        }

        // Fin Validación

        // Si hay errores vuelvo al formulario mostrando los errores
        if (!empty($errors)) {

            // Almaceno los errores en la sesión
            $_SESSION['errors'] = $errors;

            // Almaceno los datos del formulario en la sesión para rellenar el formulario
            $_SESSION['alumno'] = $alumno;

            // Redirijo al formulario
            header('Location: ' . URL . 'alumno/new');
            exit();
        }

        // Llamar al modelo para insertar el nuevo alumno
        $this->model->create($alumno);

        // Generar un mensaje de éxito
        $_SESSION['notify'] = "Alumno creado correctamente";

        // Redirigir a la lista de alumnos
        header('Location: ' . URL . 'alumno');
        exit();
    }

    /*
        Método: edit()
        Descripción: permite cargar los datos necesarios para editar los detalles
        de un alumno.

        Parámetros:
            - id: alumno a editar
    */
    public function edit($params)
    {

        // inicio o continúo sesión
        sec_session_start();

        // Capa autenticación
        $this->requireLogin();

        // Capa gestión rol de usuario
        // Solo los usuarios con privilegios pueden acceder a esta funcionalidad
        $this->requirePrivilege($GLOBALS['alumno']['edit']);

        // Obtener el id del alumno que voy a editar
        // alumno/edit/4 -> voy a editar el alumno con id=4
        // $param es un array en la posición 0 está el id
        $id = (int) $params[0];

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        // Obtener el objeto de la class_alumno con los detalles de este alumno
        $this->view->alumno = $this->model->read($id);

        // Creo la propiedad id en la vista
        $this->view->id = $id;

        // Comprobar no validación previa
        if (isset($_SESSION['errors'])) {
            // Creo la propiedad errors en la vista
            $this->view->errors = $_SESSION['errors'];
            unset($_SESSION['errors']);

            // Creo la propiedad alumno en la vista con los datos del formulario
            $this->view->alumno = $_SESSION['alumno'];
            unset($_SESSION['alumno']);

            // Creo la propiead error para la vista
            $this->view->error = "Errores en el formulario ";
        }

        // Creo el titulo para la  vista
        $this->view->title = "Formulario Editar Alumno";

        // Cargamos los cursos
        $this->view->cursos = $this->model->get_cursos();

        // Cargo la vista
        $this->view->render('alumno/edit/index');
    }

    /*
        Método: update()
        Descripción: Recibe los datos del formulario para actualizar un alumno
        url asociada: alumno/update/id

        Parámetros:
            - id (GET): alumno a actualizar
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
        $this->requirePrivilege($GLOBALS['alumno']['edit']);

        // Obtener el id del alumno que voy a actualizar
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

        // Crear un objeto de la clase Alumno con los datos actualizados
        $alumno_act = new class_alumno(
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

        // Obtengo los detalles del alumno antes de la actualización
        $alumno = $this->model->read($id);

        // Valido sólo los campos que han cambiado

        // array asociativo para almacenar los errores de validación
        $errors = [];

        // Control cambios
        $cambios = false;

        // Validación del nombre
        // Reglas: obligatorio
        if (strcmp($nombre, $alumno->nombre) != 0) {
            $cambios = true;
            if (empty($nombre)) {
                $errors['nombre'] = 'El campo nombre es obligatorio';
            }
        }

        // Validación de los apellidos
        // Reglas: obligatorio
        if (strcmp($apellidos, $alumno->apellidos) != 0) {
            $cambios = true;
            if (empty($apellidos)) {
                $errors['apellidos'] = 'El campo apellidos es obligatorios';
            }
        }

        // Validación de la fecha de nacimiento
        // Reglas: obligatorio, formato fecha
        if (strcmp($fecha_nac, $alumno->fecha_nac) != 0) {
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
        if (strcmp($dni, $alumno->dni) != 0) {
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
        if (strcmp($email, $alumno->email) != 0) {
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
        if (strcmp($telefono, $alumno->telefono) != 0) {
            $cambios = true;
            if (empty($telefono)) {
                $errors['telefono'] = 'El campo teléfono es obligatorio';
            } else if (!preg_match('/^\d{9}$/', $telefono)) {
                $errors['telefono'] = 'El formato del teléfono no es correcto';
            }
        }

        // Validación de la nacionalidad
        // Reglas: No obligatorio

        if (strcmp($nacionalidad, $alumno->nacionalidad) != 0) {
            $cambios = true;
        }

        // Validación curso_id
        // Reglas: obligatorio, entero, clave ajena
        if ($curso_id != $alumno->curso_id) {
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
            $_SESSION['alumno'] = $alumno_act;

            // Redirijo al formulario
            header('Location: ' . URL . 'alumno/edit/' . $id);
            exit();
        }

        // Si no hay cambios redirijo a la lista de alumnos
        if (!$cambios) {
            // Genero mensaje de notificación sin cambios
            $_SESSION['notify'] = "No se han realizado cambios en el alumno";

            // Redirigir a la lista de alumnos
            header('Location: ' . URL . 'alumno');
            exit();
        }


        // Llamar al modelo para actualizar el alumno
        $this->model->update($alumno_act, $id);

        // Generar un mensaje de éxito
        $_SESSION['notify'] = "Alumno actualizado correctamente";

        // Redirigir a la lista de alumnos
        header('Location: ' . URL . 'alumno');
        exit();
    }

    /*
        Método: show()
        Descripción: Muestra los detalles de un alumno
        Los detalles del alumno se mostran en un formulario de solo lectura
        Parámetros:
            - id: alumno a mostrar
    */
    public function show($params)
    {

        // Iniciar o continuar sesión
        sec_session_start();

        // Capa autenticación
        $this->requireLogin();

        // Capa gestión rol de usuario
        // Solo los usuarios con privilegios pueden acceder a esta funcionalidad
        $this->requirePrivilege($GLOBALS['alumno']['show']);

        // Obtener el id del alumno que voy a mostrar
        // alumno/show/4 -> voy a mostrar el alumno con id=4
        // $param es un array en la posición 0 está el id
        $id = (int) htmlspecialchars($params[0]);

        // No es necesario el token CSRF para mostrar datos        

        // Validar id del alumno que voy a mostrar
        if (!$this->model->validate_id_alumno_exists($id)) {
            // Generar un mensaje de error
            $_SESSION['error'] = "El alumno que intentas ver no existe";

            // Redirigir a la lista de alumnos si el id no es válido
            header('Location: ' . URL . 'alumno');
            exit();
        }


        // Obtener el objeto de la class_alumno con los detalles de este alumno
        $this->view->alumno = $this->model->read_show($id);

        // Creo la propiedad id en la vista
        $this->view->id = $id;

        // Creo el titulo para la  vista
        $this->view->title = "Detalles del Alumno";

        // Cargo la vista
        $this->view->render('alumno/show/index');
    }

    /*
        Método: delete()
        Descripción: Elimina un alumno de la base de datos
        Parámetros:
            - id: alumno a eliminar
    */
    public function delete($params)
    {

        // inicio o continúo sesión
        sec_session_start();

        // Capa autenticación
        $this->requireLogin();

        // Capa gestión rol de usuario
        // Solo los usuarios con privilegios pueden acceder a esta funcionalidad    
        $this->requirePrivilege($GLOBALS['alumno']['delete']);

        // Obtener token CSRF url
        $csrf_token = $_POST['csrf_token'] ??= '';

        // Verificar el token CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            $this->handleError();
        }

        // Obtener el id del alumno que voy a eliminar
        // alumno/delete/4 -> voy a eliminar el alumno con id=4
        // $param es un array en la posición 0 está el id
        $id = (int) $params[0];

        // Validar id del alumno que voy a eliminar
        if (!$this->model->validate_id_alumno_exists($id)) {
            // Generar un mensaje de error
            $_SESSION['error'] = "El alumno que intentas eliminar no existe";

            // Redirigir a la lista de alumnos si el id no es válido
            header('Location: ' . URL . 'alumno');
            exit();
        }

        // Llamar al modelo para eliminar el alumno
        $this->model->delete($id);

        // Generar un mensaje de éxito
        $_SESSION['notify'] = "Alumno eliminado correctamente";

        // Redirigir a la lista de alumnos
        header('Location: ' . URL . 'alumno');
    }

    /*
        Método: search()
        Descripción: Busca a partir de una expresión en todos los detalles de los alumnos
        url asociada: alumno/search
    */
    public function search()
    {

        // iniciar o continuar sesión
        sec_session_start();

        // Capa autenticación
        $this->requireLogin();

        // Capa gestión rol de usuario
        // Solo los usuarios con privilegios pueden acceder a esta funcionalidad
        $this->requirePrivilege($GLOBALS['alumno']['search']);

        // Obtener la expresión de búsqueda desde el formulario
        $term = filter_var($_GET['term'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        // No es necesario verificar el token CSRF para búsquedas GET

        // Creo la propiedad  title para la vista
        $this->view->notify = "Resultados de la búsqueda: " . $term;

        // Llamar al modelo para buscar los alumnos
        $this->view->alumnos = $this->model->search($term);

        // Llama a la vista para renderizar la página
        $this->view->render('alumno/main/index');
    }

    /*
        Método: order()
        Descripción: Ordena la lista de alumnos por un criterio
        url asociada: alumno/order/criterio

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
        $this->requirePrivilege($GLOBALS['alumno']['order']);

        // No es necesario verificar el token CSRF para ordenación GET

        // Obtener el criterio de ordenación
        $criterio = (int) $params[0];

        // Mapeo de criterios a columnas de la base de datos
        $columnas = [
            1 => 'alumnos.id',
            2 => 'alumno',
            3 => 'alumnos.email',
            4 => 'alumnos.nacionalidad',
            5 => 'alumnos.dni',
            6 => 'edad',
            7 => 'curso'
        ];

        // Creo la propiedad  title para la vista
        $this->view->title = "Alumnos ordenados por " . ($columnas[$criterio] ?? 'Id');

        // Creo la propiedad  notify para la vista
        $this->view->notify = "Alumnos ordenados por " . ($columnas[$criterio] ?? 'Id');

        // Llamar al modelo para ordenar los alumnos
        $this->view->alumnos = $this->model->order($criterio);

        // Llama a la vista para renderizar la página
        $this->view->render('alumno/main/index');
    }

    /*
        Método: requirePrivilege
        Descripción: Verifica que el usuario tiene privilegios para acceder a la funcionalidad
    */
    private function requirePrivilege($allowedRoles)
    {
        if (!in_array($_SESSION['role_id'], $allowedRoles)) {
            $_SESSION['error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('Location: ' . URL . 'alumno');
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
