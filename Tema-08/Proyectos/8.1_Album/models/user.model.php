<?php
/*
    Modelo:  user.model.php
    Descripción: Modelo para gestionar los datos del controlador user
*/


class userModel extends Model
{

    /*
        Método: get()
        Descripción: obtiene todos los usuarios con sus roles asignados
        Devuelve:
            - Array de objetos con datos del usuario y su rol
    */
    public function get()
    {
        try {
            $sql = "SELECT u.id, u.name, u.email, r.name as role_name, r.id as role_id
                    FROM users u
                    LEFT JOIN roles_users ru ON u.id = ru.user_id
                    LEFT JOIN roles r ON ru.role_id = r.id
                    ORDER BY u.id";

            $fp = $this->db->connect();
            $stmt = $fp->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    /*
        Método: read($id)
        Descripción: obtiene los detalles de un usuario
        Parámetros: 
            - $id: id del usuario
        Devuelve:
            - Objeto de la clase user
            - False si no existe
    */
    public function read($id)
    {
        try {
            $sql = "SELECT u.id, u.name, u.email, r.id as role_id
                    FROM users u
                    LEFT JOIN roles_users ru ON u.id = ru.user_id
                    LEFT JOIN roles r ON ru.role_id = r.id
                    WHERE u.id = :id LIMIT 1";

            $fp = $this->db->connect();
            $stmt = $fp->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    /*
        Método: read_show($id)
        Descripción: obtiene los detalles completos de un usuario para mostrar
        Parámetros: 
            - $id: id del usuario
        Devuelve:
            - Objeto con todos los datos del usuario y su rol
    */
    public function read_show($id)
    {
        try {
            $sql = "SELECT u.id, u.name, u.email, r.name as role_name, r.description as role_description
                    FROM users u
                    LEFT JOIN roles_users ru ON u.id = ru.user_id
                    LEFT JOIN roles r ON ru.role_id = r.id
                    WHERE u.id = :id LIMIT 1";

            $fp = $this->db->connect();
            $stmt = $fp->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    /*
        Método: create($user, $role_id)
        Descripción: Crea un nuevo usuario y le asigna un rol
        Parámetros:
            - $user: objeto de la clase class_user
            - $role_id: id del rol a asignar
    */
    public function create($user, $role_id)
    {
        try {
            $password_enc = password_hash($user->password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (name, email, password) 
                    VALUES (:name, :email, :password)";

            $fp = $this->db->connect();
            $fp->beginTransaction();

            $stmt = $fp->prepare($sql);
            $stmt->bindParam(':name', $user->name, PDO::PARAM_STR, 50);
            $stmt->bindParam(':email', $user->email, PDO::PARAM_STR, 50);
            $stmt->bindParam(':password', $password_enc, PDO::PARAM_STR, 60);
            $stmt->execute();

            $ultimo_id = $fp->lastInsertId();

            // Asignar rol al usuario
            $sql = "INSERT INTO roles_users (user_id, role_id) 
                    VALUES (:user_id, :role_id)";

            $stmt = $fp->prepare($sql);
            $stmt->bindParam(':user_id', $ultimo_id, PDO::PARAM_INT);
            $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);
            $stmt->execute();

            $fp->commit();

            return $ultimo_id;
        } catch (PDOException $e) {
            $fp->rollBack();
            $this->handleError($e);
        }
    }

    /*
        Método: update($user, $id, $role_id)
        Descripción: Actualiza los datos de un usuario y su rol
        Parámetros:
            - $user: objeto de la clase class_user con datos actualizados
            - $id: id del usuario a actualizar
            - $role_id: nuevo rol del usuario
    */
    public function update($user, $id, $role_id)
    {
        try {
            $fp = $this->db->connect();
            $fp->beginTransaction();

            // Actualizar datos del usuario
            $sql = "UPDATE users SET name = :name, email = :email";

            // Agregar password solo si se proporciona
            if (!empty($user->password)) {
                $password_enc = password_hash($user->password, PASSWORD_DEFAULT);
                $sql .= ", password = :password";
            }

            $sql .= " WHERE id = :id LIMIT 1";

            $stmt = $fp->prepare($sql);
            $stmt->bindParam(':name', $user->name, PDO::PARAM_STR, 50);
            $stmt->bindParam(':email', $user->email, PDO::PARAM_STR, 50);

            if (!empty($user->password)) {
                $stmt->bindParam(':password', $password_enc, PDO::PARAM_STR, 60);
            }

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Actualizar rol del usuario
            $current_role_id = $this->get_user_role($id);
            if ($current_role_id != $role_id) {
                $sql = "UPDATE roles_users SET role_id = :role_id WHERE user_id = :user_id";
                $stmt = $fp->prepare($sql);
                $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);
                $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
                $stmt->execute();
            }

            $fp->commit();
        } catch (PDOException $e) {
            $fp->rollBack();
            $this->handleError($e);
        }
    }

    /*
        Método: delete($id)
        Descripción: Elimina un usuario de la base de datos
        Parámetros:
            - $id: id del usuario a eliminar
    */
    public function delete($id)
    {
        try {
            $fp = $this->db->connect();
            $fp->beginTransaction();

            // Eliminar relaciones de roles (ON DELETE CASCADE debería hacer esto automáticamente)
            $sql = "DELETE FROM roles_users WHERE user_id = :user_id";
            $stmt = $fp->prepare($sql);
            $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Eliminar usuario
            $sql = "DELETE FROM users WHERE id = :id LIMIT 1";
            $stmt = $fp->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $fp->commit();
        } catch (PDOException $e) {
            $fp->rollBack();
            $this->handleError($e);
        }
    }

    /*
        Método: search($term)
        Descripción: Busca usuarios que coincidan con el término de búsqueda
        Parámetros:
            - $term: término de búsqueda
        Devuelve:
            - Array de objetos con usuarios encontrados y sus roles
    */
    public function search($term)
    {
        try {
            $sql = "SELECT u.id, u.name, u.email, r.name as role_name, r.id as role_id
                    FROM users u
                    LEFT JOIN roles_users ru ON u.id = ru.user_id
                    LEFT JOIN roles r ON ru.role_id = r.id
                    WHERE CONCAT(u.name, ' ', u.email, ' ', r.name) LIKE :term
                    ORDER BY u.id";

            $fp = $this->db->connect();
            $stmt = $fp->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_OBJ);

            $search_term = '%' . $term . '%';
            $stmt->bindParam(':term', $search_term, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    /*
        Método: order($criterio)
        Descripción: Ordena usuarios según un criterio
        Parámetros:
            - $criterio: criterio de ordenación
        Devuelve:
            - Array de objetos con usuarios ordenados y sus roles
    */
    public function order(int $criterio)
    {
        try {

            $sql = "SELECT u.id, u.name, u.email, r.name as role_name, r.id as role_id
                    FROM users u
                    LEFT JOIN roles_users ru ON u.id = ru.user_id
                    LEFT JOIN roles r ON ru.role_id = r.id
                    ORDER BY :criterio";

            $fp = $this->db->connect();
            $stmt = $fp->prepare($sql);
            $stmt->bindParam(':criterio', $criterio, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    /*
        Método: get_roles()
        Descripción: obtiene todos los roles disponibles
        Devuelve:
            - Array de objetos con roles disponibles
    */
    public function get_roles()
    {
        try {
            $sql = "SELECT id, name, description FROM roles ORDER BY id";

            $fp = $this->db->connect();
            $stmt = $fp->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    /*
        Método: validate_unique_email($email)
        Descripción: valida si el email ya existe en la tabla users
        Parámetros: 
            - $email: email a validar
        Devuelve:
            - True si email existe
            - False si no existe
    */
    public function validate_unique_email($email)
    {
        try {
            $sql = "SELECT email FROM users WHERE email = :email";

            $fp = $this->db->connect();
            $stmt = $fp->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR, 50);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    /*
        Método: validate_unique_name($name)
        Descripción: valida si el nombre ya existe en la tabla users
        Parámetros: 
            - $name: nombre a validar
        Devuelve:
            - True si nombre existe
            - False si no existe
    */
    public function validate_unique_name($name)
    {
        try {
            $sql = "SELECT name FROM users WHERE name = :name";

            $fp = $this->db->connect();
            $stmt = $fp->prepare($sql);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR, 50);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    /*
        Método: validate_role_exists($role_id)
        Descripción: valida si el rol existe en la tabla roles
        Parámetros: 
            - $role_id: id del rol a validar
        Devuelve:
            - True si rol existe
            - False si no existe
    */
    public function validate_role_exists($role_id)
    {
        try {
            $sql = "SELECT id FROM roles WHERE id = :role_id";

            $fp = $this->db->connect();
            $stmt = $fp->prepare($sql);
            $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    /*
        Método: validate_id_user_exists($id)
        Descripción: valida si el id de usuario existe en la tabla users
        Parámetros: 
            - $id: id del usuario a validar
        Devuelve:
            - True si usuario existe
            - False si no existe
    */
    public function validate_id_user_exists($id)
    {
        try {
            $sql = "SELECT id FROM users WHERE id = :id";

            $fp = $this->db->connect();
            $stmt = $fp->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    /*
        Método: get_user_role($user_id)
        Descripción: obtiene el rol asignado a un usuario
        Parámetros: 
            - $user_id: id del usuario
        Devuelve:
            - id del rol del usuario
    */
    public function get_user_role($user_id)
    {
        try {
            $sql = "SELECT role_id FROM roles_users WHERE user_id = :user_id LIMIT 1";

            $fp = $this->db->connect();
            $stmt = $fp->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetch();
            return $result ? $result->role_id : null;
        } catch (PDOException $e) {
            $this->handleError($e);
        }
    }

    public function handleError(PDOException $e)
    {
        // Incluir y cargar el controlador de errores
        $errorControllerFile = CONTROLLER_PATH . ERROR_CONTROLLER . '.php';

        if (file_exists($errorControllerFile)) {
            require_once $errorControllerFile;
            $mensaje = $e->getMessage() . " en la línea " . $e->getLine() . " del archivo " . $e->getFile();
            $controller = new Errores('DE BASE DE DATOS', 'Mensaje de Error: ', $mensaje);
        } else {
            // Fallback en caso de que el controlador de errores no exista
            echo "Error crítico: " . $e->getMessage();
            exit();
        }
    }
}
