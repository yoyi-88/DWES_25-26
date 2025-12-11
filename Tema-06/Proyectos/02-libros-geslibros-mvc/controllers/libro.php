<?php

    class Libro Extends Controller {

        // Crea una instancia del controlador libro
        // Llama al constructor de la clase padre Controller
        // Crea una vista para el controlador libro
        // Carga el modelo si existe libro.model.php
        function __construct() {

            parent ::__construct(); 
            
        }

        /*
            Método:  render
            Descripción: Renderiza la vista del libro

            views/libro/index.php
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
            Descripción: Muestra el formulario para crear un nuevo libro

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
            Descripción: Recibe los datos del formulario para crear un nuevo libro
            url asociada: libro/create
       */
       public function create() {

        // Obtengo los datos del formulario
        $titulo = $_POST['titulo']?? '';
        $autor_id = $_POST['autor_id']?? '';
        $editorial_id = $_POST['editorial_id']?? '';
        $generos = $_POST['generos']?? '';
        $stock = $_POST['stock']?? '';
        $precio_venta = $_POST['precio_venta']?? '';
        $fecha_nac = $_POST['fecha_nac']?? '';
        $curso_id = $_POST['curso_id']?? '';

        // Validar los datos, se omite en este ejemplo

        // Crear un objeto de la clase libro
        $libro = new class_libro(
            null, 
            $titulo, 
            $autor_id, 
            $editorial_id,
            $stock,
            $precio_venta,  
            $generos,  
            $fecha_nac, 
            $curso_id
        );

        // Llamar al modelo para insertar el nuevo libro
        $this->model->create($libro);

        // Redirigir a la lista de libros
        header('Location: ' . URL . 'libro');


    }   
    
    /*
        Método: edit()
        Descripción: permite cargar los datos necesarios para editar los detalles
        de un libro.

        Parámetros:
            - id: libro a editar
    */
    public function edit($params) {

        // Obtener el id del libro que voy a editar
        // libro/edit/4 -> voy a editar el libro con id=4
        // $param es un array en la posición 0 está el id
        $id = (int) $params[0];
        
        // Obtener el objeto de la class_libro con los detalles de este libro
        $this->view->libro = $this->model->read($id);

        // Creo la propiedad id en la vista
        $this->view->id = $id;

        // Creo el titulo para la  vista
        $this->view->title = "Formulario Editar libro";

        // Cargamos los autores
        $this->view->autores = $this->model->get_autores();

        // Cargamos los editoriales
        $this->view->editoriales = $this->model->get_editoriales();

        // Cargamos los generos
        $this->view->generos = $this->model->get_generos();

        // Cargamos los temas
        $this->view->temas_libros = $this->model->get_temas_libro($id);

        $this->view->title = "Formulario editar Libro";

        // Cargo la vista
        $this->view->render('libro/edit/index');


    }

    /*
        Método: update()
        Descripción: Recibe los datos del formulario para actualizar un libro
        url asociada: libro/update/id

        Parámetros:
            - id (GET): libro a actualizar
            - datos del formulario (POST)
    */
    public function update($params) {

        // Obtener el id del libro que voy a actualizar
        $id = (int) $params[0];

        // Obtengo los datos del formulario
        $titulo = $_POST['titulo']?? '';
        $autor_id = $_POST['autor_id']?? '';
        $editorial_id = $_POST['editorial_id']?? '';
        $generos = $_POST['generos']?? '';
        $stock = $_POST['stock']?? '';
        $precio_venta = $_POST['precio_venta']?? '';

        // Validar los datos, se omite en este ejemplo

        // Crear un objeto de la clase libro
        $libro = new class_libro(
            $id, 
            $titulo, 
            $autor_id, 
            $editorial_id,
            null,
            $stock,
            $precio_venta,  
            $generos
        );

        $libro->generos = $generos;

        // Llamar al modelo para actualizar el libro
        $this->model->update($libro, $id);

        // Redirigir a la lista de libros
        header('Location: ' . URL . 'libro');     
    
    
    }

    /*
        Método: show()
        Descripción: Muestra los detalles de un libro
        Los detalles del libro se mostran en un formulario de solo lectura
        Parámetros:
            - id: libro a mostrar
    */
    public function show($params) {

        // Obtener el id del libro que voy a mostrar
        // libro/show/4 -> voy a mostrar el libro con id=4
        // $param es un array en la posición 0 está el id
        $id = (int) $params[0];
        
        // Obtener el objeto de la class_libro con los detalles de este libro
        $this->view->libro = $this->model->read_show($id);

        // Creo la propiedad id en la vista
        $this->view->id = $id;

        // Creo el titulo para la  vista
        $this->view->title = "Detalles del libro";

        // Cargo la vista
        $this->view->render('libro/show/index');
    }

    /*
        Método: delete()
        Descripción: Elimina un libro de la base de datos
        Parámetros:
            - id: libro a eliminar
    */
    public function delete($params) {

        // Obtener el id del libro que voy a eliminar
        // libro/delete/4 -> voy a eliminar el libro con id=4
        // $param es un array en la posición 0 está el id
        $id = (int) $params[0];
        
        // Llamar al modelo para eliminar el libro
        $this->model->delete($id);

        // Redirigir a la lista de libros
        header('Location: ' . URL . 'libro');
    }

    /*
        Método: search()
        Descripción: Busca a partir de una expresión en todos los detalles de los libros
        url asociada: libro/search
    */
    public function search() {

        // Obtengo el término de búsqueda del formulario
        $term = $_GET['term'] ?? '';

        // Creo la propiedad  title para la vista
        $this->view->notify = "Resultados de la búsqueda";

        // Llamar al modelo para buscar los libros
        $this->view->libros = $this->model->search($term);

        // Llama a la vista para renderizar la página
        $this->view->render('libro/main/index');
    }

    /*
        Método: order()
        Descripción: Ordena la lista de libros por un criterio
        url asociada: libro/order/criterio

        Parámetros:
            - criterio: campo por el que se ordena la lista
                1: id
                2: titulo
                3: editorial_id
                4: precio_venta
                5: generos
                6: edad
                7: curso
    */
    public function order($params) {

        // Obtener el criterio de ordenación
        $criterio = (int) $params[0];

        // Mapeo de criterios a columnas de la base de datos
        $columnas = [
            1 => 'libros.id',
            2 => 'libro',
            3 => 'libros.editorial_id',
            4 => 'libros.precio_venta',
            5 => 'libros.generos',
            6 => 'edad',
            7 => 'curso'
        ];

        // Creo la propiedad  title para la vista
        $this->view->title = "libros ordenados por " . ($columnas[$criterio] ?? 'Id');  

        // Creo la propiedad  notify para la vista
        $this->view->notify = "libros ordenados por " . ($columnas[$criterio] ?? 'Id');

        // Llamar al modelo para ordenar los libros
        $this->view->libros = $this->model->order($criterio);

        // Llama a la vista para renderizar la página
        $this->view->render('libro/main/index');
    }
    
}

?>