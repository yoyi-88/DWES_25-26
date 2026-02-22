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
        $descripcion = filter_var($_POST['descripcion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $carpeta = filter_var($_POST['carpeta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        // Crear un objeto de la clase album
        $album = new class_album(
            null,
            $titulo,
            $descripcion,
            $autor,
            $fecha,
            null,
            null,
            $etiquetas,
            null,
            null,
             $carpeta,
            null,
            null
        );

        // Validamos los campos del formulario

        // Creo un array asociativo para almacenar los posibles errores del formulario
        // $error['titulo'] =  'titulo es obligatorio'

        $errors = [];

        // Validamos el título
        // Regla validación: título obligatorio y menor que 100
        if (empty($titulo)) {
            $errors['titulo'] = "El campo título es obligatorio";
        } else if (strlen($titulo) >= 100) {
            $errors['titulo'] = "El campo título no puede tener más de 100 caracteres";
        }

        // Validamos la descripción
        // Regla validación: descripción obligatorio 
        if (empty($descripcion)) {
            $errors['descripcion'] = "El campo descripción es obligatorio";
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
        // Reglas de validación: no obligatorio pero no mas de 100 caracteres
        if (!empty($etiquetas) && strlen($etiquetas) >= 100) {
            $errors['etiquetas'] = "El campo etiquetas no puede tener más de 100 caracteres";
        }


        // Validación Carpeta
        // Reglas de validación: obligatorio, sin espacios
        if (empty($carpeta)) {
            $errors['carpeta'] = "El campo carpeta es obligatorio";
        } else if (preg_match('/\s/', $carpeta)) {
            $errors['carpeta'] = "El nombre de la carpeta no puede contener espacios";
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

        // Crear la carpeta en el servidor
        $ruta_images = 'images/'; 
        $ruta_carpeta = $ruta_images . $carpeta;

        if (!file_exists($ruta_carpeta)) {
            if (!mkdir($ruta_carpeta, 0777, true)) {
                $errors['carpeta'] = "Error del sistema: No se pudo crear la carpeta en el servidor.";
                // Si hay error al crear la carpeta física, volvemos al formulario
                $_SESSION['errors'] = $errors;
                $_SESSION['album'] = $album;
                header('Location: ' . URL . 'album/new');
                exit();
            }
        } else {
             $errors['carpeta'] = "Ya existe una carpeta con ese nombre en el servidor.";
             $_SESSION['errors'] = $errors;
             $_SESSION['album'] = $album;
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

        $titulo = filter_var($_POST['titulo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $descripcion = filter_var($_POST['descripcion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $autor = filter_var($_POST['autor'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha = filter_var($_POST['fecha'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $etiquetas = filter_var($_POST['etiquetas'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        // Validar los datos, se omite en este ejemplo

        // Crear un objeto de la clase album con los datos actualizados
        $album_act = new class_album(
            $id,
            $titulo,
            $descripcion,
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

        // Obtengo los detalles del album antes de la actualización
        $album = $this->model->read($id);

        // Valido sólo los campos que han cambiado

        // array asociativo para almacenar los errores de validación
        $errors = [];

        // Control cambios
        $cambios = false;

        // Validación del titulo
        // Reglas: obligatorio
        if (strcmp($titulo, $album->titulo) != 0) {
            $cambios = true;
            if (empty($titulo)) {
                $errors['titulo'] = 'El campo titulo es obligatorio';
            }
        }

        // Validación de los descripcion
        // Reglas: obligatorio
        if (strcmp($descripcion, $album->descripcion) != 0) {
            $cambios = true;
            if (empty($descripcion)) {
                $errors['descripcion'] = 'El campo descripcion es obligatorios';
            }
        }

        // Validación del autor
        // Reglas: obligatorio
        if (strcmp($autor, $album->autor) != 0) {
            $cambios = true;
            if (empty($autor)) {
                $errors['autor'] = 'El campo autor es obligatorio';
            }
        }


        // Validación del fecha
        // Reglas: obligatorio, formato fecha
        if (strcmp($fecha, $album->fecha) != 0) {
            $cambios = true;
            if (empty($fecha)) {
                $errors['fecha'] = 'El campo fecha es obligatorio';
            } else {
                $fecha_obj = DateTime::createFromFormat('Y-m-d', $fecha);
                if (!$fecha_obj) {
                    $errors['fecha'] = "El formato de la fecha no es correcto";
                }
            }
        }

        // Validación de las etiquetas
        // Reglas: obligatorio
        if (strcmp($etiquetas, $album->etiquetas) != 0) {
            $cambios = true;
            if (empty($etiquetas)) {
                $errors['etiquetas'] = 'El campo etiquetas es obligatorio';
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
        $this->model->update($album_act);

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

        // INCREMENTAR VISITAS 
        // Sumamos 1 visita en la base de datos
        $this->model->increment_visitas($id);
        // Actualizamos el objeto actual en memoria para que la vista ya muestre +1 visita
        $this->view->album->num_visitas = ($this->view->album->num_visitas ?? 0) + 1;

        // LEER IMÁGENES DE LA CARPETA 
        $ruta_carpeta = 'images/' . $this->view->album->carpeta;
        $imagenes = [];
        
        // Comprobamos si la carpeta existe y leemos su contenido
        if (is_dir($ruta_carpeta)) {
            // array_diff quita los directorios ocultos '.' y '..' que siempre devuelve scandir
            $imagenes = array_diff(scandir($ruta_carpeta), array('.', '..'));
        }
        
        // Pasamos el array de imágenes a la vista
        $this->view->imagenes = $imagenes;

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

        // 1. Obtener los detalles del álbum para saber el nombre de la carpeta
        $album = $this->model->read($id);
        
        // 2. Comprobar si tiene una carpeta asignada y montar la ruta
        if (!empty($album->carpeta)) {
            $ruta_carpeta = 'images/' . $album->carpeta;

            // 3. Comprobar si el directorio físico existe
            if (is_dir($ruta_carpeta)) {
                // Leer todos los archivos de la carpeta ignorando . y ..
                $archivos = array_diff(scandir($ruta_carpeta), array('.', '..'));
                
                // 4. Recorrer y eliminar cada imagen (archivo)
                foreach ($archivos as $archivo) {
                    $ruta_archivo = $ruta_carpeta . '/' . $archivo;
                    if (is_file($ruta_archivo)) {
                        unlink($ruta_archivo); // Borra el archivo físico
                    }
                }
                
                // 5. Eliminar la carpeta (ahora que está vacía)
                rmdir($ruta_carpeta);
            }
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
        $this->view->albumes = $this->model->search($term);

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
                2: titulo
                3: autor
                4: nacionalidad
                5: fecha
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
            1 => 'id',
            2 => 'titulo',
            3 => 'autor',
            4 => 'fecha',
            5 => 'etiquetas',
            6 => 'num_fotos',
            7 => 'num_visitas'
        ];

        // Creo la propiedad  title para la vista
        $this->view->title = "albums ordenados por " . ($columnas[$criterio] ?? 'Id');

        // Creo la propiedad  notify para la vista
        $this->view->notify = "albums ordenados por " . ($columnas[$criterio] ?? 'Id');

        // Llamar al modelo para ordenar los albums
        $this->view->albumes = $this->model->order($criterio);

        // Llama a la vista para renderizar la página
        $this->view->render('album/main/index');
    }

    /*
        Método: addImages()
        Descripción: Muestra el formulario para añadir imágenes a un album
        Parámetros:
            - id: album al que se van a añadir las imágenes
    */
    /*
        Método: addImages()
        Descripción: Muestra el formulario para añadir imágenes a un álbum
    */
    public function addImages($params)
    {
        sec_session_start();

        $this->requireLogin();

        $this->requirePrivilege($GLOBALS['album']['addImages']);

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $id = (int) $params[0];

        // Obtenemos los datos del álbum (necesitamos saber su título y carpeta)
        $this->view->album = $this->model->read($id);
        $this->view->id = $id;
        $this->view->title = "Añadir imágenes a: " . $this->view->album->titulo;

        

        $this->view->render('album/addImages/index');
    }

    /*
        Método: uploadImages()
        Descripción: Procesa la subida múltiple de imágenes validando tamaño y formato
    */
    public function uploadImages($params)
    {
        sec_session_start();

        $this->requireLogin();

        $this->requirePrivilege($GLOBALS['album']['addImages']);

        $id = (int) $params[0];

        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            $this->handleError();
        }

        $album = $this->model->read($id);
        $ruta_carpeta = 'images/' . $album->carpeta;
        
        $errores = [];
        $max_size = 5 * 1024 * 1024; // 5MB
        $formatos_permitidos = ['image/jpeg', 'image/png', 'image/gif'];

        // Comprobar si se han enviado archivos
        if (!empty($_FILES['imagenes']['name'][0])) {
            $num_archivos = count($_FILES['imagenes']['name']);

            // FASE 1: Validación de TODOS los archivos (El enunciado exige cancelar todo si uno falla)
            for ($i = 0; $i < $num_archivos; $i++) {
                if ($_FILES['imagenes']['error'][$i] === UPLOAD_ERR_OK) {
                    $size = $_FILES['imagenes']['size'][$i];
                    $type = $_FILES['imagenes']['type'][$i];
                    $name = $_FILES['imagenes']['name'][$i];

                    if ($size > $max_size) {
                        $errores[] = "La imagen '$name' supera el tamaño máximo de 5MB.";
                    }
                    if (!in_array($type, $formatos_permitidos)) {
                        $errores[] = "El formato de '$name' no está permitido (solo JPG, PNG, GIF).";
                    }
                } else {
                    $errores[] = "Error al subir la imagen: " . $_FILES['imagenes']['name'][$i];
                }
            }

            // FASE 2: Si hay errores, cancelamos la subida y volvemos al formulario
            if (!empty($errores)) {
                $_SESSION['error'] = implode("<br>", $errores);
                header('Location: ' . URL . 'album/addImages/' . $id);
                exit();
            }

            // FASE 3: Si no hay errores, movemos todos los archivos a la carpeta del álbum
            for ($i = 0; $i < $num_archivos; $i++) {
                $tmp_name = $_FILES['imagenes']['tmp_name'][$i];
                $name = basename($_FILES['imagenes']['name'][$i]);
                $destino = $ruta_carpeta . '/' . $name;
                
                move_uploaded_file($tmp_name, $destino);
            }

            // ACTUALIZAR NÚMERO DE FOTOS 
            // Contamos los archivos reales que hay en la carpeta ignorando '.' y '..'
            $fotos_actuales = count(array_diff(scandir($ruta_carpeta), array('.', '..')));
            // Llamamos al modelo para que guarde ese número en la BBDD
            $this->model->update_num_fotos($id, $fotos_actuales);

            $_SESSION['notify'] = "Se han subido $num_archivos imágenes correctamente.";
            header('Location: ' . URL . 'album/show/' . $id); // Redirigimos a ver el álbum
            exit();

        } else {
            $_SESSION['error'] = "No se ha seleccionado ninguna imagen.";
            header('Location: ' . URL . 'album/addImages/' . $id);
            exit();
        }
    }  

   /*
        Método: deleteImage()
        Descripción: Elimina una imagen específica de un álbum
    */
    public function deleteImage($params) {
        sec_session_start();
        $this->requireLogin();
        $this->requirePrivilege($GLOBALS['album']['edit']);

        // El ID sigue llegando por la URL normal (router)
        $id_album = (int) $params[0];
        
        // El nombre lo recogemos por GET
        $nombre_imagen = urldecode($_GET['name'] ?? '');

        // Validamos que nos haya llegado un nombre
        if (empty($nombre_imagen)) {
            $_SESSION['error'] = "No se ha especificado ninguna imagen para borrar.";
            header('Location: ' . URL . 'album/show/' . $id_album);
            exit();
        }

        $album = $this->model->read($id_album);
        $ruta_archivo = 'images/' . $album->carpeta . '/' . $nombre_imagen;

        // Comprobamos si el archivo existe de verdad
        if (file_exists($ruta_archivo) && is_file($ruta_archivo)) {
            unlink($ruta_archivo); // Borramos el archivo físico

            // Actualizamos el contador de fotos en la BBDD
            $fotos_actuales = count(array_diff(scandir('images/' . $album->carpeta), array('.', '..')));
            $this->model->update_num_fotos($id_album, $fotos_actuales);

            $_SESSION['notify'] = "Imagen eliminada correctamente.";
        } else {
            $_SESSION['error'] = "La imagen no existe en el servidor.";
        }

        // Redirigimos de vuelta a la vista del álbum
        header('Location: ' . URL . 'album/show/' . $id_album);
        exit();
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
