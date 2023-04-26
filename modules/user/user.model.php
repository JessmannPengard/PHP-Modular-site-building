<?php

// DB Table -> DATABASE_TABLES_PREFIX + 'users'
class User
{
    protected $dbconn;

    // Constructor
    public function __construct($conn)
    {
        $this->dbconn = $conn;
    }

    // Login method
    public function login($email, $password)
    {
        // Password encryption
        $pw = md5($password);

        // Prepare
        $stm = $this->dbconn->prepare("SELECT * FROM " . DATABASE_TABLES_PREFIX . "users WHERE 
                email=:email AND password=:password");

        $stm->bindValue(":email", $email);
        $stm->bindValue(":password", $pw);

        // Execute
        $stm->execute();

        // Return result
        return $stm->fetch();
    }

    // Register method
    public function register($email, $password)
    {
        $result = array();

        // Check that email is not yet registered
        if ($this->existEmail($email)) {
            // If registered:
            $result["result"] = false;
            return $result;
        }

        // Encrypt password
        $pw = md5($password);

        // Prepare
        $stm = $this->dbconn->prepare("INSERT INTO " . DATABASE_TABLES_PREFIX . "users (email, password)
                VALUES (:email, :password)");

        $stm->bindValue(":email", $email);
        $stm->bindValue(":password", $pw);

        // Execute
        $stm->execute();

        // Success
        $result["result"] = true;
        return $result;
    }

    // User password modify
    public function setPassword($email, $password)
    {
        // Check for registered email
        if (!$this->existEmail($email)) {
            $result["result"] = false;
            return $result;
        }

        // Encrypt password
        $pw = md5($password);

        // Prepare
        $stm = $this->dbconn->prepare("UPDATE " . DATABASE_TABLES_PREFIX . "users SET password=:password WHERE email=:email");

        $stm->bindValue(":password", $pw);
        $stm->bindValue(":email", $email);

        // Execute
        $stm->execute();

        // Success
        $result["result"] = true;
        return $result;
    }

    // Store recovery password token
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

        // Success
        $result["result"] = true;
        return $result;
    }

    // Check valid recovery token
    public function checkToken($email, $token)
    {
        // Prepare
        $stm = $this->dbconn->prepare("SELECT id FROM " . DATABASE_TABLES_PREFIX . "users_recovery_tokens WHERE email = :email AND token = :token AND date_expire > now()");

        $stm->bindValue(":email", $email);
        $stm->bindValue(":token", $token);

        // Execute
        $stm->execute();

        // Return result
        return $stm->fetch();
    }

    // Delete recovery tokens from user
    public function deleteToken($email)
    {
        // Prepare
        $stm = $this->dbconn->prepare("DELETE FROM " . DATABASE_TABLES_PREFIX . "users_recovery_tokens WHERE email = :email");

        $stm->bindValue(":email", $email);

        // Execute
        $stm->execute();
    }


    // Check for registered email
    public function existEmail($email)
    {
        // Prepare
        $stm = $this->dbconn->prepare("SELECT id FROM " . DATABASE_TABLES_PREFIX . "users WHERE email = :email");
        $stm->bindValue(":email", $email);

        // Execute
        $stm->execute();

        // Return result
        return $stm->fetch();
    }

    // Get email from id
    public function getEmail($id_user)
    {
        // Init variable
        $email = "";

        // Prepare
        $stm = $this->dbconn->prepare("SELECT email FROM " . DATABASE_TABLES_PREFIX . "users WHERE id = :id");

        $stm->bindValue(":id", $id_user);
        $stm->bindColumn("email", $email);

        // Execute
        $stm->execute();

        // Get result
        $stm->fetch();

        // Return email
        return $email;
    }

    // Get id from email
    public function getId($email)
    {
        // Init variable
        $id = 0;

        // Prepare
        $stm = $this->dbconn->prepare("SELECT id FROM " . DATABASE_TABLES_PREFIX . "users WHERE email = :email");

        $stm->bindValue(":email", $email);
        $stm->bindColumn("id", $id);

        // Execute
        $stm->execute();

        // Get result
        $stm->fetch();

        // Return id
        return $id;
    }

    // Get language from user
    public function getLanguage($id_user)
    {
        // Init variable
        $language = "";

        // Prepare
        $stm = $this->dbconn->prepare("SELECT language FROM " . DATABASE_TABLES_PREFIX . "users_settings WHERE id_user = :id_user");

        $stm->bindValue(":id_user", $id_user);
        $stm->bindColumn("language", $language);

        // Execute
        $stm->execute();

        // Get result
        $stm->fetch();

        // Return language
        return $language;
    }

    // Get profile picture from user
    public function getProfilePicture($id_user)
    {
        // Init variable
        $url = "";

        // Prepare
        $stm = $this->dbconn->prepare("SELECT profile_picture FROM " . DATABASE_TABLES_PREFIX . "users WHERE id = :id_user");

        $stm->bindValue(":id_user", $id_user);
        $stm->bindColumn("profile_picture", $url);

        // Execute
        $stm->execute();

        // Get result
        $stm->fetch();

        // Return profile picture url
        return $url;
    }
}
