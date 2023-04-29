<?php

// Gallery class
class Gallery
{
    protected $dbconn;

    public function __construct($conn)
    {
        $this->dbconn = $conn;
    }

    // Get all images order by descending date (last uploaded first)
    public function getAll()
    {
        $query = "SELECT * FROM " . DATABASE_TABLES_PREFIX . "gallery ORDER BY date DESC";

        $stm = $this->dbconn->prepare($query);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get an image by ID
    public function getById($id_imagen)
    {
        $stm = $this->dbconn->prepare("SELECT * FROM " . DATABASE_TABLES_PREFIX . "gallery WHERE id = :id");
        $stm->bindValue(":id", $id_imagen);
        $stm->execute();
        return $stm->fetch();
    }

    // Get total number of images
    public function getCount()
    {
        $stm = $this->dbconn->query("SELECT COUNT(*) AS total FROM " . DATABASE_TABLES_PREFIX . "gallery");
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        $total = (int) $row['total'];
        return $total;
    }

    // Save image: save url of the picture and user ID
    public function upload($id_user, $url_picture)
    {
        $stm = $this->dbconn->prepare("INSERT INTO " . DATABASE_TABLES_PREFIX . "gallery (id_user, url_picture) VALUES (:id_user, :url_picture)");
        $stm->bindValue(":id_user", $id_user);
        $stm->bindValue(":url_picture", $url_picture);
        $stm->execute();
    }

    // Delete an image
    public function deleteById($id_imagen)
    {
        $stm = $this->dbconn->prepare("DELETE FROM " . DATABASE_TABLES_PREFIX . "gallery WHERE id=:id");
        $stm->bindValue(":id", $id_imagen);
        $stm->execute();
    }

    // Get images by page
    public function getImages($page, $perPage)
    {
        // Calculate limit and offset
        $limit = $perPage;
        $offset = ($page - 1) * $perPage;

        // Get images
        $sql = "SELECT id, url_picture, id_user FROM " . DATABASE_TABLES_PREFIX . "gallery ORDER BY date DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $rows = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = $row;
        }

        // Return images
        return $rows;
    }

}