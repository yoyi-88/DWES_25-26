<?php

    class Alumno Extends Controller {

        // Crea una instancia del controlador Alumno
        // Llama al constructor de la clase padre Controller
        // Crea una vista para el controlador Alumno
        // Carga el modelo si existe alumno.model.php
        function __construct() {

            parent ::__construct(); 
            
        }

        /*
            Método:  render
            Descripción: Renderiza la vista del alumno

            views/alumno/index.php
        */

        function render() {

            
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
        function new() {

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

        public function create() {
            
            // Inicio o contiúo sesión
            session_start();

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

            // Validación de la nacionalidad 
            // Regla validación: no obligatorio

            // Llamar al modelo para insertar el nuevo alumno
            $this->model->create($alumno);

            // Redirigir a la lista de alumnos después de crear el nuevo alumno
            header('Location: ' . URL . 'alumno');
        }

        /*
            Método: edit
            Descripción: permite cargar los datos necesarios para editar los detalles de un alumno
            Parámetros: 
                -$id: alumno a editar
        */
        public function edit($param = []) {
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

        public function update($param = []) {
            // Obtener el id del alumno que voy a actualizar
            $id = $param[0];

            // Obtengo los datos del formulario
            $nombre = $_POST['nombre'] ?? '';
            $apellidos = $_POST['apellidos'] ?? '';
            $email = $_POST['email'] ?? '';
            $dni = $_POST['dni'] ?? '';
            $telefono = $_POST['telefono'] ?? '';
            $nacionalidad = $_POST['nacionalidad'] ?? '';
            $fecha_nac = $_POST['fecha_nac'] ?? '';
            $curso_id = $_POST['curso_id'] ?? '';

            // Validar los datos, se omite en este ejemplo

            // Crear un objeto de la clase Alumno
            $alumno = new class_alumno(
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

            // Llamar al modelo para actualizar el alumno
            $this->model->update($id, $alumno);

            // Redirigir a la lista de alumnos después de actualizar el alumno
            header('Location: ' . URL . 'alumno');
        }

        /*
            Método: delete
            Descripción: Elimina un alumno de la base de datos
            Parámetros:
                - $id: id del alumno a eliminar
        */

        public function delete($param = []) {
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
        public function show($param = []) {
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

?>