<?php

// Clase para gestionar los usuarios en la tabla "usuarios"
class User
{
    protected $dbconn;

    // Constructor
    public function __construct($conn)
    {
        $this->dbconn = $conn;
    }

    // Comprueba que la combinación usuario/contraseña sea correcta
    public function login($email, $password)
    {
        // Encriptar contraseña
        $pw = md5($password);

        // Prepare
        $stm = $this->dbconn->prepare("SELECT * FROM " . DATABASE_TABLES_PREFIX . "users WHERE 
                email=:email AND password=:password");

        $stm->bindValue(":email", $email);
        $stm->bindValue(":password", $pw);

        // Execute
        $stm->execute();

        // Devolver resultado
        return $stm->fetch();
    }

    // Registrar nuevo usuario
    public function register($email, $password)
    {
        $result = array();

        // Comprueba que el usuario no exista ya en la base de datos
        if ($this->existEmail($email)) {
            // Si ya existe:
            $result["result"] = false;
            return $result;
        }

        // Encriptar password
        $pw = md5($password);

        // Prepare
        $stm = $this->dbconn->prepare("INSERT INTO " . DATABASE_TABLES_PREFIX . "users (email, password)
                VALUES (:email, :password)");

        $stm->bindValue(":email", $email);
        $stm->bindValue(":password", $pw);

        // Execute
        $stm->execute();

        // Registrado con éxito
        $result["result"] = true;
        return $result;
    }

    // Modificar password de usuario
    public function setPassword($email, $password)
    {
        // Comprueba que el usuario exista
        if (!$this->existEmail($email)) {
            $result["result"] = false;
            return $result;
        }

        // Encriptar password
        $pw = md5($password);

        // Prepare
        $stm = $this->dbconn->prepare("UPDATE " . DATABASE_TABLES_PREFIX . "users SET password=:password WHERE email=:email");

        $stm->bindValue(":password", $pw);
        $stm->bindValue(":email", $email);

        // Execute
        $stm->execute();

        // Registrado con éxito
        $result["result"] = true;
        return $result;
    }

    // Guardar token de recuperación de contraseña
    public function setToken($email, $token, $date_expire)
    {
        // Prepare
        $stm = $this->dbconn->prepare("INSERT INTO " . DATABASE_TABLES_PREFIX . "users_recovery_tokens (email, token, date_expire)
                VALUES (:email, :token, :date_expire)");

        $stm->bindValue(":email", $email);
        $stm->bindValue(":token", $token);
        $stm->bindValue(":date_expire", $date_expire);

        // Execute
        $stm->execute();

        // Registrado con éxito
        $result["result"] = true;
        return $result;
    }

    // Comprobar la validez del token de recuperación de contraseña
    public function checkToken($email, $token)
    {
        // Prepare
        $stm = $this->dbconn->prepare("SELECT id FROM " . DATABASE_TABLES_PREFIX . "users_recovery_tokens WHERE email = :email AND token = :token AND date_expire > now()");

        $stm->bindValue(":email", $email);
        $stm->bindValue(":token", $token);

        // Execute
        $stm->execute();

        // Devolvemos el resultado
        return $stm->fetch();
    }

    // Borrar tokens de recuperación de contraseña
    public function deleteToken($email)
    {
        // Prepare
        $stm = $this->dbconn->prepare("DELETE FROM " . DATABASE_TABLES_PREFIX . "users_recovery_tokens WHERE email = :email");

        $stm->bindValue(":email", $email);

        // Execute
        $stm->execute();
    }


    // Comprueba si un usuario ya existe en la base de datos
    public function existEmail($email)
    {
        // Prepare
        $stm = $this->dbconn->prepare("SELECT id FROM " . DATABASE_TABLES_PREFIX . "users WHERE email = :email");
        $stm->bindValue(":email", $email);

        // Execute
        $stm->execute();

        // Devolvemos el resultado
        return $stm->fetch();
    }

    // Obtiene el email de usuario a partir de su id
    public function getEmail($id_user)
    {
        // Inicializamos la variable a devolver
        $email = "";

        // Prepare
        $stm = $this->dbconn->prepare("SELECT email FROM " . DATABASE_TABLES_PREFIX . "users WHERE id = :id");

        $stm->bindValue(":id", $id_user);
        $stm->bindColumn("email", $email);

        // Execute
        $stm->execute();

        // Obtenemos el resultado
        $stm->fetch();

        // Devolvemos el email de usuario
        return $email;
    }

    // Obtiene el id de un usuario a partir de su email
    public function getId($email)
    {
        // Inicializamos la variable a devolver
        $id = 0;

        // Prepare
        $stm = $this->dbconn->prepare("SELECT id FROM " . DATABASE_TABLES_PREFIX . "users WHERE email = :email");

        $stm->bindValue(":email", $email);
        $stm->bindColumn("id", $id);

        // Execute
        $stm->execute();

        // Obtenemos el resultado
        $stm->fetch();

        // Devolvemos el id
        return $id;
    }

    // Obtiene el idioma almacenado en los settings de un usuario
    public function getLanguage($id_user)
    {
        // Inicializamos la variable a devolver
        $language = "";

        // Prepare
        $stm = $this->dbconn->prepare("SELECT language FROM " . DATABASE_TABLES_PREFIX . "users_settings WHERE id_user = :id_user");

        $stm->bindValue(":id_user", $id_user);
        $stm->bindColumn("language", $language);

        // Execute
        $stm->execute();

        // Obtenemos el resultado
        $stm->fetch();

        // Devolvemos el email de usuario
        return $language;
    }
}