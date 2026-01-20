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
        session_start();

        // Comprobar si hay mensajes en la sesión y pasarlos a la vista
        if (isset($_SESSION['notify'])) {
            $this->view->notify = $_SESSION['notify'];
            unset($_SESSION['notify']);
        }

        // 

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
        session_start();

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

            // Creo la propiedad a alumno en la vista con los datos del formulario
            $this->view->alumno = $_SESSION['alumno'];
            unset($_SESSION['alumno']);

            // Creo la propiedad error para la vista
            $this->view->error = "Errores en el formulario";
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

        // Inicio o contiúo sesión
        session_start();

        // VERIFICAR TOKEN CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
            // El token no es válido, detener la ejecución
            die('Error: token CSRF inválido');
        }

        // Recogemos los datos del formulario saneados
        // Prevenir ataques XSS
        // Obtengo los datos del formulario
        $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $nacionalidad = filter_var($_POST['nacionalidad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha_nac = filter_var($_POST['fecha_nac'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $curso_id = filter_var($_POST['curso_id'] ??= '', FILTER_SANITIZE_NUMBER_INT);

        // Validar los datos, se omite en este ejemplo

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

        // Creo un array para almacenar los posibles errores del formulario
        // $error['nombre'] = 'Nombre es obligatorio'
        $error = [];

        // Validamos el nombre
        // Regla validación: obligatorio
        if (empty($nombre)) {
            $error['nobre'] = "El campo nombre es obligatorio";
        }

        // Validación de los apellidos 
        // Regla validación: obligatorio
        if (empty($apellidos)) {
            $error['apellidos'] = "El campo apellidos es obligatorio";
        }

        // Validación de DNI
        // Regla validación: obligatorio, formato DNI y clave secundaria
        if (empty($dni)) {
            $error['dni'] = 'El campo dni es obligatorio';
        } else if (!preg_match('/^[0-9]{8}[A-Z]$/', $dni)) {
            $error['dni'] = 'El formato del dni no es correcto';
        } else if (!$this->model->validate_unique_dni($dni)) {
            $error['dni'] = 'El dni ya ha sido registrado';
        }

        // Validación de email 
        // Regla validación: obligatorio, formato email y clave secundaria
        if (empty($email)) {
            $error['email'] = 'El campo email es obligatorio';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'El formato email no es correcto';
        } else if (!$this->model->validate_unique_email($email)) {
            $error['email'] = 'El email ya ha sido registrado';
        }

        // Validación de teléfono 
        // Regla validación: obligatorio, formato teléfono 
        if (empty($telefono)) {
            $error['telefono'] = 'El campo telefono es obligatorio';
        } else if (!preg_match('/^\d{9}$/', $telefono)) { // Usando expresión regular
            $error['telefono'] = 'El formato del telefono es obligatorio';
        }

        // Validación de la fecha de nacimiento 
        // Regla validación: obligatorio, formato fecha 
        if (empty($fecha_nac)) {
            $error['fecha_nac'] = "El campo fecha de nacimiento es obligatorio";
        } else {
            $fecha = DateTime::createFromFormat('Y-m-d', $fecha_nac);
            if (!$fecha) {
                $error['fecha_nac'] = 'El formato de la fecha de nacimento no es correcto';
            }
        }

        // Validación del curso_id
        // Regla validación: obligatorio, debe ser un entero, debe existir en la tabla cursos
        if (empty($curso_id)) {
            $error['curso_id'] = 'El campo curso es obligatorio';
        } else if (!filter_var($curso_id, FILTER_VALIDATE_INT)) {
            $error['curso_id'] = 'El campo curso debe ser un número entero';
        } else if (!$this->model->validate_curso_exists($curso_id)) {
            $error['curso_id'] = 'El curso seleccionado no existe';
        }

        // Fin de la validación
        // Si hay errores, redirijo al formulario mostrando los errores
        if (!empty($error)) {
            // Almaceno los errores en la sesión
            $_SESSION['errors'] = $error;

            // Almaceno los datos del formulario en la sesión para rellenar el formulario
            $_SESSION['alumno'] = $alumno;

            // Redirijo al formulario
            header('Location: ' . URL . 'alumno/new');
            exit();
        }

        // Llamar al modelo para insertar el nuevo alumno
        $this->model->create($alumno);

        // Generar un mensaje de éxito
        $_SESSION['notify'] = "El alumno ha sido creado correctamente.";

        // Redirigir a la lista de alumnos después de crear el nuevo alumno
        header('Location: ' . URL . 'alumno');
        exit();
    }

    /*
            Método: edit
            Descripción: permite cargar los datos necesarios para editar los detalles de un alumno
            Parámetros: 
                -$id: alumno a editar
        */
    public function edit($param = [])
    {
        // Obtener el id del alumno que voy a editar
        // alumno/edit/4 -> voy a editar el alumno con id=4
        // $param es un array en la posición 0 está el id
        $id = $param[0];

        // Obtener el objeto de la class_alumno con lo detalles de ese alumno
        $this->view->alumno = $this->model->read($id);

        // Creo la propiedad id en la vista
        $this->view->id = $id;

        // Crea el título para la vista
        $this->view->title = "Formulario Editar Alumno";

        // Cargamos los cursos
        $this->view->cursos = $this->model->get_cursos();

        // Cargo la vista
        $this->view->render('alumno/edit/index');
    }

    /*
            Método: update
            Descripción: Recibe los datos del formulario para actualizar un alumno
            url asociada: alumno/update/{id}
        */
    public function update($param = [])
    {
        session_start();
        // Obtener el id del alumno que voy a actualizar
        $id = $param[0];

        // validamos token CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
            // El token no es válido, detener la ejecución
            die('Error: token CSRF inválido');
        }

        // Recogemos los datos del formulario saneados
        // Prevenir ataques XSS
        // Obtengo los datos del formulario
        $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $nacionalidad = filter_var($_POST['nacionalidad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha_nac = filter_var($_POST['fecha_nac'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $curso_id = filter_var($_POST['curso_id'] ??= '', FILTER_SANITIZE_NUMBER_INT);

        // Crear un objeto de la clase Alumno con los datos del formulario
        $alumno_act = new class_alumno(
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

        // obtengo detalles de alumnoo 
        $alumno = $this->model->read($id);

        // array asociativo para almacenar errores
        $error = [];

        // control cambios
        $cambios = false;

        // validaciones
        
         // Validamos el nombre
        // Regla validación: obligatorio
        if (strcmp($nombre, $alumno->nombre) != 0) {
            if (empty($nombre)) {
                $error['nombre'] = 'El campo nombre es obligatorio';
            }
        }

        // Validación de los apellidos 
        // Regla validación: obligatorio
        if (strcmp($apellidos, $alumno->apellidos) != 0) {
            if (empty($apellidos)) {
                $error['apellidos'] = 'El campo apellidos es obligatorio';
            }
        }

        // Validación de DNI
        // Regla validación: obligatorio, formato DNI y clave secundaria
        if (strcmp($dni, $alumno->dni) != 0) {
            if (empty($dni)) {
                $error['dni'] = 'El campo dni es obligatorio';
            } else if (!preg_match('/^[0-9]{8}[A-Z]$/', $dni)) {
                $error['dni'] = 'El formato del dni no es correcto';
            } else if (!$this->model->validate_unique_dni_update($dni, $id)) {
                $error['dni'] = 'El dni ya ha sido registrado';
            }
        }
        

        // Validación de email 
        // Regla validación: obligatorio, formato email y clave secundaria
        if (strcmp($email, $alumno->email) != 0) {
            if (empty($email)) {
                $error['email'] = 'El campo email es obligatorio';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['email'] = 'El formato email no es correcto';
            } else if (!$this->model->validate_unique_email_update($email, $id)) {
                $error['email'] = 'El email ya ha sido registrado';
            }
        }
        

        // Validación de teléfono 
        // Regla validación: obligatorio, formato teléfono 
        if (strcmp($telefono, $alumno->telefono) != 0) {
            if (empty($telefono)) {
                $error['telefono'] = 'El campo telefono es obligatorio';
            } else if (!preg_match('/^\d{9}$/', $telefono)) { // Usando expresión regular
                $error['telefono'] = 'El formato del telefono es obligatorio';
            }
        }
        

        // Validación de la fecha de nacimiento 
        // Regla validación: obligatorio, formato fecha 
        if (strcmp($fecha_nac, $alumno->fecha_nac) != 0) {
            if (empty($fecha_nac)) {
                $error['fecha_nac'] = 'El campo fecha de nacimiento es obligatorio';
            } else {
                $fecha = DateTime::createFromFormat('Y-m-d', $fecha_nac);
                if (!$fecha) {
                    $error['fecha_nac'] = 'El formato de la fecha de nacimento no es correcto';
                }
            }
        }
        

        // Validación del curso_id
        // Regla validación: obligatorio, debe ser un entero, debe existir en la tabla cursos
        if (strcmp($curso_id, $alumno->curso_id) != 0) {
            if (empty($curso_id)) {
                $error['curso_id'] = 'El campo curso es obligatorio';
            } else if (!filter_var($curso_id, FILTER_VALIDATE_INT)) {
                $error['curso_id'] = 'El campo curso debe ser un número entero';
            } else if (!$this->model->validate_curso_exists($curso_id)) {
                $error['curso_id'] = 'El curso seleccionado no existe';
            }
        }
        

        //Si hay errores, redirijo al formulario mostrando los errores
        if (!empty($error)) {
            // Almaceno los errores en la sesión
            $_SESSION['errors'] = $error;

            // Almaceno los datos del formulario en la sesión para rellenar el formulario
            $_SESSION['alumno'] = $alumno_act;

            // Redirijo al formulario
            header('Location: ' . URL . 'alumno/edit/' . $id);
            exit();
        }

        // Verifico si hay cambios
        if(!$cambios){
            // Genero mensaje de notificación sin cambios
            $_SESSION['notify'] = "No se han realizado cambios en el alumno";
            // No hay cambios, redirijo a la lista de alumnos
            header('Location: ' . URL . 'alumno');
            exit();
        }
        // Llamar al modelo para actualizar el alumno
        $this->model->update($alumno_act, $id);

        // Redirigir a la lista de alumnos después de actualizar el alumno
        header('Location: ' . URL . 'alumno');

        
    }

    /*
            Método: delete
            Descripción: Elimina un alumno de la base de datos
            Parámetros:
                - $id: id del alumno a eliminar
        */

    public function delete($param = [])
    {
        // Obtener el id del alumno que voy a eliminar
        $id = $param[0];

        // Llamar al modelo para eliminar el alumno
        $this->model->delete($id);

        // Redirigir a la lista de alumnos después de eliminar el alumno
        header('Location: ' . URL . 'alumno');
    }

    /*
            Método: show
            Descripción: Muestra los detalles de un alumno
        */
    public function show($param = [])
    {
        // Obtener el id del alumno que voy a mostrar
        $id = $param[0];

        // Obtener el objeto de la class_alumno con lo detalles de ese alumno
        $this->view->alumno = $this->model->read($id);

        // Creo la propiedad id en la vista
        $this->view->id = $id;

        // Crea el título para la vista
        $this->view->title = "Detalles del Alumno";

        // Cargamos los cursos
        $this->view->cursos = $this->model->get_cursos();

        // Cargo la vista
        $this->view->render('alumno/show/index');
    }

    /*
            Método: orderBy
            Descripción: Ordena la lista de alumnos por un campo específico
        */
    // public function orderBy($param = []) {
    //     // Obtener el campo por el que se va a ordenar
    //     $campo = $param[0] ?? 'id';

    //     $campos_permitidos = [
    //         'id', 'alumno', 'email', 'nacionalidad', 'dni', 'edad', 'curso'
    //     ];

    //     // Validar
    //     if (!in_array($campo, $campos_permitidos)) {
    //         $campo = 'id';
    //     }

    //     // Obtengo los datos del modelo para mostrar en la vista
    //     $this->view->title = "Tabla Alumnos de FP";

    //     // Obtengo los datos del modelo ordenados por el campo especificado
    //     $this->view->alumnos = $this->model->orderBy($campo);

    //     // Llama a la vista para renderizar la página
    //     $this->view->render('alumno/main/index');
    // }
}
