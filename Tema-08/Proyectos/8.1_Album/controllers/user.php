<?php

class User extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    /*
        Método: render()
        Descripción: Muestra la tabla principal de usuarios con sus roles asignados
    */
    function render()
    {
        // iniciar o continuar sesión
        sec_session_start();

        // Capa Login
        $this->requireLogin();

        // Capa gestión rol de usuario
        $this->requirePrivilege($GLOBALS['user']['render']);

        // Crear un token CSRF para los formularios
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

        // Crear la propiedad title para la vista
        $this->view->title = "Tabla de Usuarios";

        // Obtener los datos del modelo con roles
        $this->view->users = $this->model->get();

        // Llama a la vista para renderizar la página
        $this->view->render('user/main/index');
    }

    /*
        Método: new()
        Descripción: Muestra el formulario para crear un nuevo usuario
    */
    function new()
    {
        // iniciar o continuar sesión
        sec_session_start();

        // Capa Login
        $this->requireLogin();

        // Capa gestión rol de usuario
        $this->requirePrivilege($GLOBALS['user']['new']);

        // Crear un token CSRF para el formulario
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        // Crear un objeto de la clase user vacío para el formulario
        $this->view->user = new class_user();

        // Comprobar validación previa
        if (isset($_SESSION['errors'])) {
            $this->view->errors = $_SESSION['errors'];
            unset($_SESSION['errors']);

            $this->view->user = $_SESSION['user'];
            unset($_SESSION['user']);

            $this->view->error = "Errores en el formulario";
        }

        // Crear la propiedad title para la vista
        $this->view->title = "Nuevo Usuario";

        // Obtener los roles disponibles
        $this->view->roles = $this->model->get_roles();

        // Llama a la vista para renderizar la página
        $this->view->render('user/new/index');
    }

    /*
        Método: create()
        Descripción: Recibe los datos del formulario para crear un nuevo usuario
    */
    public function create()
    {
        // inicio o continúo sesión
        sec_session_start();

        // Capa autenticación
        $this->requireLogin();

        // Capa gestión rol de usuario
        $this->requirePrivilege($GLOBALS['user']['new']);

        // Verificar el token CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            $this->handleError();
        }

        // Recoger los datos del formulario saneados
        $name = filter_var($_POST['name'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $password_confirm = filter_var($_POST['password_confirm'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $role_id = filter_var($_POST['role_id'] ??= '', FILTER_SANITIZE_NUMBER_INT);

        // Crear un objeto de la clase User
        $user = new class_user(
            null,
            $name,
            $email,
            $password,
            $role_id
        );

        // Validar los campos del formulario
        $errors = [];

        // Validación del nombre
        if (empty($name)) {
            $errors['name'] = "El campo nombre es obligatorio";
        } else if (strlen($name) < 5) {
            $errors['name'] = "El nombre debe tener al menos 5 caracteres";
        } else if (strlen($name) > 50) {
            $errors['name'] = "El nombre no puede superar 50 caracteres";
        } else if ($this->model->validate_unique_name($name)) {
            $errors['name'] = "El nombre ya ha sido registrado";
        }

        // Validación del email
        if (empty($email)) {
            $errors['email'] = "El campo email es obligatorio";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "El formato email no es correcto";
        } else if ($this->model->validate_unique_email($email)) {
            $errors['email'] = "El email ya ha sido registrado";
        }

        // Validación de la contraseña
        if (empty($password)) {
            $errors['password'] = "El campo contraseña es obligatorio";
        } else if (strlen($password) < 7) {
            $errors['password'] = "La contraseña debe tener al menos 7 caracteres";
        } else if (strcmp($password, $password_confirm) !== 0) {
            $errors['password'] = "Las contraseñas no coinciden";
        }

        // Validación del rol
        if (empty($role_id)) {
            $errors['role_id'] = "El campo rol es obligatorio";
        } else if (!filter_var($role_id, FILTER_VALIDATE_INT)) {
            $errors['role_id'] = "El formato del rol no es correcto";
        } else if (!$this->model->validate_role_exists($role_id)) {
            $errors['role_id'] = "El rol seleccionado no existe";
        }

        // Si hay errores vuelvo al formulario mostrando los errores
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['user'] = $user;
            header('Location: ' . URL . 'user/new');
            exit();
        }

        // Llamar al modelo para insertar el nuevo usuario
        $this->model->create($user, $role_id);

        // Generar un mensaje de éxito
        $_SESSION['notify'] = "Usuario creado correctamente";

        // Redirigir a la lista de usuarios
        header('Location: ' . URL . 'user');
        exit();
    }

    /*
        Método: edit()
        Descripción: Permite cargar los datos necesarios para editar un usuario
    */
    public function edit($params)
    {
        // inicio o continúo sesión
        sec_session_start();

        // Capa autenticación
        $this->requireLogin();

        // Capa gestión rol de usuario
        $this->requirePrivilege($GLOBALS['user']['edit']);

        // Obtener el id del usuario que voy a editar
        $id = (int) $params[0];

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        // Obtener el objeto con los detalles del usuario
        $this->view->user = $this->model->read($id);

        // Crear la propiedad id en la vista
        $this->view->id = $id;

        // Comprobar validación previa
        if (isset($_SESSION['errors'])) {
            $this->view->errors = $_SESSION['errors'];
            unset($_SESSION['errors']);

            $this->view->user = $_SESSION['user'];
            unset($_SESSION['user']);

            $this->view->error = "Errores en el formulario";
        }

        // Crear el título para la vista
        $this->view->title = "Editar Usuario ( ID: " . $id . ")";

        // Cargar los roles disponibles
        $this->view->roles = $this->model->get_roles();

        // Cargar la vista
        $this->view->render('user/edit/index');
    }

    /*
        Método: update()
        Descripción: Recibe los datos del formulario para actualizar un usuario
    */
    public function update($params)
    {
        // inicio o continúo sesión
        sec_session_start();

        // Capa autenticación
        $this->requireLogin();

        // Capa gestión rol de usuario
        $this->requirePrivilege($GLOBALS['user']['edit']);

        // Obtener el id del usuario que voy a actualizar
        $id = (int) $params[0];

        // Verificar el token CSRF
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            $this->handleError();
        }

        // Obtener los datos del formulario saneados
        $name = filter_var($_POST['name'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $role_id = filter_var($_POST['role_id'] ??= '', FILTER_SANITIZE_NUMBER_INT);

        // Obtener los detalles del usuario antes de la actualización
        $user = $this->model->read($id);

        // Array para almacenar errores de validación
        $errors = [];
        $cambios = false;

        // Validación del nombre
        if (strcmp($name, $user->name) != 0) {
            $cambios = true;
            if (empty($name)) {
                $errors['name'] = 'El campo nombre es obligatorio';
            } else if (strlen($name) < 5) {
                $errors['name'] = 'El nombre debe tener al menos 5 caracteres';
            } else if (strlen($name) > 50) {
                $errors['name'] = 'El nombre no puede superar 50 caracteres';
            } else if ($this->model->validate_unique_name($name)) {
                $errors['name'] = 'El nombre ya ha sido registrado';
            }
        }

        // Validación del email
        if (strcmp($email, $user->email) != 0) {
            $cambios = true;
            if (empty($email)) {
                $errors['email'] = 'El campo email es obligatorio';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'El formato del email no es correcto';
            } else if ($this->model->validate_unique_email($email)) {
                $errors['email'] = 'El email ya ha sido registrado';
            }
        }

        // Validación de la contraseña (solo si se proporciona)
        if (!empty($password)) {
            $cambios = true;
            if (strlen($password) < 7) {
                $errors['password'] = 'La contraseña debe tener al menos 7 caracteres';
            }
        }

        // Validación del rol
        if ($role_id != $this->model->get_user_role($id)) {
            $cambios = true;
            if (empty($role_id)) {
                $errors['role_id'] = 'El campo rol es obligatorio';
            } else if (!filter_var($role_id, FILTER_VALIDATE_INT)) {
                $errors['role_id'] = 'El formato del rol no es correcto';
            } else if (!$this->model->validate_role_exists($role_id)) {
                $errors['role_id'] = 'El rol no existe';
            }
        }

        // Si hay errores vuelvo al formulario mostrando los errores
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['user'] = (object) [
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'role_id' => $role_id
            ];
            header('Location: ' . URL . 'user/edit/' . $id);
            exit();
        }

        // Si no hay cambios redirijo a la lista de usuarios
        if (!$cambios) {
            $_SESSION['notify'] = "No se han realizado cambios en el usuario";
            header('Location: ' . URL . 'user');
            exit();
        }

        // Crear un objeto de la clase User con los datos actualizados
        $user_act = new class_user(
            $id,
            $name,
            $email,
            $password
        );

        // Llamar al modelo para actualizar el usuario
        $this->model->update($user_act, $id, $role_id);

        // Generar un mensaje de éxito
        $_SESSION['notify'] = "Usuario actualizado correctamente";

        // Redirigir a la lista de usuarios
        header('Location: ' . URL . 'user');
        exit();
    }

    /*
        Método: show()
        Descripción: Muestra los detalles de un usuario
    */
    public function show($params)
    {
        // Iniciar o continuar sesión
        sec_session_start();

        // Capa autenticación
        $this->requireLogin();

        // Capa gestión rol de usuario
        $this->requirePrivilege($GLOBALS['user']['show']);

        // Obtener el id del usuario que voy a mostrar
        $id = (int) htmlspecialchars($params[0]);

        // Validar id del usuario
        if (!$this->model->validate_id_user_exists($id)) {
            $_SESSION['error'] = "El usuario que intentas ver no existe";
            header('Location: ' . URL . 'user');
            exit();
        }

        // Obtener el objeto con los detalles del usuario
        $this->view->user = $this->model->read_show($id);

        // Crear la propiedad id en la vista
        $this->view->id = $id;

        // Crear el título para la vista
        $this->view->title = "Detalles del Usuario";

        // Cargar la vista
        $this->view->render('user/show/index');
    }

    /*
        Método: delete()
        Descripción: Elimina un usuario de la base de datos
    */
    public function delete($params)
    {
        // inicio o continúo sesión
        sec_session_start();

        // Capa autenticación
        $this->requireLogin();

        // Capa gestión rol de usuario
        $this->requirePrivilege($GLOBALS['user']['delete']);

        // Obtener token CSRF
        $csrf_token = $_POST['csrf_token'] ??= '';

        // Verificar el token CSRF
        if (!hash_equals($_SESSION['csrf_token'], $csrf_token)) {
            $this->handleError();
        }

        // Obtener el id del usuario que voy a eliminar
        $id = (int) $params[0];

        // Validar id del usuario
        if (!$this->model->validate_id_user_exists($id)) {
            $_SESSION['error'] = "El usuario que intentas eliminar no existe";
            header('Location: ' . URL . 'user');
            exit();
        }

        // Llamar al modelo para eliminar el usuario
        $this->model->delete($id);

        // Generar un mensaje de éxito
        $_SESSION['notify'] = "Usuario eliminado correctamente";

        // Redirigir a la lista de usuarios
        header('Location: ' . URL . 'user');
    }

    /*
        Método: search()
        Descripción: Busca usuarios a partir de una expresión
    */
    public function search()
    {
        // iniciar o continuar sesión
        sec_session_start();

        // Capa autenticación
        $this->requireLogin();

        // Capa gestión rol de usuario
        $this->requirePrivilege($GLOBALS['user']['search']);

        // Obtener la expresión de búsqueda desde el formulario
        $term = filter_var($_GET['term'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        // Crear la propiedad title para la vista
        $this->view->notify = "Resultados de la búsqueda: " . $term;

        // Llamar al modelo para buscar los usuarios
        $this->view->users = $this->model->search($term);

        // Llama a la vista para renderizar la página
        $this->view->render('user/main/index');
    }

    /*
        Método: order()
        Descripción: Ordena la lista de usuarios por un criterio
    */
    public function order($params)
    {
        // iniciar o continuar sesión
        sec_session_start();

        // Capa autenticación
        $this->requireLogin();

        // Capa gestión rol de usuario
        $this->requirePrivilege($GLOBALS['user']['order']);

        // Obtener el criterio de ordenación
        $criterio = (int) $params[0];

        // Mapeo de criterios a columnas de la base de datos
        $columnas = [
            1 => 'Id',
            2 => 'Name',
            3 => 'Email',
            4 => 'Role'
        ];

        // Crear la propiedad title para la vista
        $this->view->title = "Usuarios ordenados por " . ($columnas[$criterio] ?? 'Id');

        // Crear la propiedad notify para la vista
        $this->view->notify = "Usuarios ordenados por " . ($columnas[$criterio] ?? 'Id');

        // Llamar al modelo para ordenar los usuarios
        $this->view->users = $this->model->order($criterio);

        // Llama a la vista para renderizar la página
        $this->view->render('user/main/index');
    }

    /*
        Método: requirePrivilege
        Descripción: Verifica que el usuario tiene privilegios para acceder a la funcionalidad
    */
    private function requirePrivilege($allowedRoles)
    {
        if (!in_array($_SESSION['role_id'], $allowedRoles)) {
            $_SESSION['error'] = 'Acceso denegado. No tiene permisos suficientes';
            header('Location: ' . URL . 'user');
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

?>