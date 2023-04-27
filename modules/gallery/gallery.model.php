<?php

// Clase que interactúa con la tabla 'gallery'
class Gallery
{
    protected $dbconn;

    public function __construct($conn)
    {
        $this->dbconn = $conn;
    }

    // Obtiene todas las imágenes ordenadas por fecha descendente (últimas subidas primero)
    public function getAll()
    {
        $query = "SELECT * FROM " . DATABASE_TABLES_PREFIX . "gallery ORDER BY date DESC";

        $stm = $this->dbconn->prepare($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtiene una imagen por su Id
    public function getById($id_imagen)
    {
        $stm = $this->dbconn->prepare("SELECT * FROM " . DATABASE_TABLES_PREFIX . "gallery WHERE id = :id");
        $stm->bindValue(":id", $id_imagen);
        $stm->execute();
        return $stm->fetch();
    }

    // Obtiene el número total de imágenes
    public function getCount()
    {
        $stm = $this->dbconn->query("SELECT COUNT(*) AS total FROM " . DATABASE_TABLES_PREFIX . "gallery");
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        $total = (int) $row['total'];
        return $total;
    }

    // Guardar imagen: guarda la ruta de la imagen en el servidor y el id de usuario que subió la imagen
    public function upload($id_user, $url_picture)
    {
        $stm = $this->dbconn->prepare("INSERT INTO " . DATABASE_TABLES_PREFIX . "gallery (id_user, url_picture) VALUES (:id_user, :url_picture)");
        $stm->bindValue(":id_user", $id_user);
        $stm->bindValue(":url_picture", $url_picture);
        $stm->execute();
    }

    // Elimina una imagen
    public function deleteById($id_imagen)
    {
        $stm = $this->dbconn->prepare("DELETE FROM " . DATABASE_TABLES_PREFIX . "gallery WHERE id=:id");
        $stm->bindValue(":id", $id_imagen);
        $stm->execute();
    }

    // Obtiene las imágenes por página
    public function getImages($page, $perPage)
    {
        // Cálculo del límite y offset
        $limit = $perPage;
        $offset = ($page - 1) * $perPage;

        // Consulta para obtener los datos de la página actual
        $sql = "SELECT id, url_picture, id_user FROM " . DATABASE_TABLES_PREFIX . "gallery ORDER BY date DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        // Convertir los resultados en un array asociativo
        $rows = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = $row;
        }

        // Devolver las imágenes de la página especificada
        return $rows;
    }

}