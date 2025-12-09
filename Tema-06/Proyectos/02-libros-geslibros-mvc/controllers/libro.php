<?php

    class Libro Extends Controller {

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
            $this->view->title = "Tabla Libros de GesLibros";

            // Obtengo los datos del modelo
            $this->view->libros = $this->model->get();

            // Llama a la vista para renderizar la página
            $this->view->render('libro/main/index');
        }

        /*
            Método:new
            Descripción: Muestra el formulario para crear un nuevo alumno

            Carga de datos: lista de cursos para la lista dinámica del select
        */
        function new() {

            // Creo la propiedad  title para la vista
            $this->view->title = "Nuevo Libro";

            // Obtengo los datos del modelo de cursos
            $this->view->cursos = $this->model->get_cursos();

            // Llama a la vista para renderizar la página
            $this->view->render('libro/new/index');
        }

       /*
            Método: create
            Descripción: Recibe los datos del formulario para crear un nuevo alumno
            url asociada: alumno/create
       */
       public function create() {

        // Obtengo los datos del formulario
        $nombre = $_POST['nombre']?? '';
        $apellidos = $_POST['apellidos']?? '';
        $email = $_POST['email']?? '';
        $dni = $_POST['dni']?? '';
        $telefono = $_POST['telefono']?? '';
        $nacionalidad = $_POST['nacionalidad']?? '';
        $fecha_nac = $_POST['fecha_nac']?? '';
        $curso_id = $_POST['curso_id']?? '';

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

        // Llamar al modelo para insertar el nuevo alumno
        $this->model->create($alumno);

        // Redirigir a la lista de alumnos
        header('Location: ' . URL . 'alumno');


    }   
    
    /*
        Método: edit()
        Descripción: permite cargar los datos necesarios para editar los detalles
        de un alumno.

        Parámetros:
            - id: alumno a editar
    */
    public function edit($params) {

        // Obtener el id del alumno que voy a editar
        // alumno/edit/4 -> voy a editar el alumno con id=4
        // $param es un array en la posición 0 está el id
        $id = (int) $params[0];
        
        // Obtener el objeto de la class_alumno con los detalles de este alumno
        $this->view->alumno = $this->model->read($id);

        // Creo la propiedad id en la vista
        $this->view->id = $id;

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
    public function update($params) {

        // Obtener el id del alumno que voy a actualizar
        $id = (int) $params[0];

        // Obtengo los datos del formulario
        $nombre = $_POST['nombre']?? '';
        $apellidos = $_POST['apellidos']?? '';
        $email = $_POST['email']?? '';
        $dni = $_POST['dni']?? '';
        $telefono = $_POST['telefono']?? '';
        $nacionalidad = $_POST['nacionalidad']?? '';
        $fecha_nac = $_POST['fecha_nac']?? '';
        $curso_id = $_POST['curso_id']?? '';

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
        $this->model->update($alumno, $id);

        // Redirigir a la lista de alumnos
        header('Location: ' . URL . 'alumno');     
    
    
    }

    /*
        Método: show()
        Descripción: Muestra los detalles de un alumno
        Los detalles del alumno se mostran en un formulario de solo lectura
        Parámetros:
            - id: alumno a mostrar
    */
    public function show($params) {

        // Obtener el id del alumno que voy a mostrar
        // alumno/show/4 -> voy a mostrar el alumno con id=4
        // $param es un array en la posición 0 está el id
        $id = (int) $params[0];
        
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
    public function delete($params) {

        // Obtener el id del alumno que voy a eliminar
        // alumno/delete/4 -> voy a eliminar el alumno con id=4
        // $param es un array en la posición 0 está el id
        $id = (int) $params[0];
        
        // Llamar al modelo para eliminar el alumno
        $this->model->delete($id);

        // Redirigir a la lista de alumnos
        header('Location: ' . URL . 'alumno');
    }

    /*
        Método: search()
        Descripción: Busca a partir de una expresión en todos los detalles de los alumnos
        url asociada: alumno/search
    */
    public function search() {

        // Obtengo el término de búsqueda del formulario
        $term = $_GET['term'] ?? '';

        // Creo la propiedad  title para la vista
        $this->view->notify = "Resultados de la búsqueda";

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
    public function order($params) {

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
    
}

?>