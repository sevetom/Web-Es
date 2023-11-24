<?php
class DatabaseHelper {
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function getRandomPosts($n) {
        $stmt = $this->db->prepare("SELECT idarticolo, titoloarticolo, imgarticolo
                FROM articolo
                ORDER BY RAND()
                LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategories() {
        $stmt = $this->db->prepare("SELECT * FROM categoria");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPosts($n=-1) {
        $query = "SELECT idarticolo, titoloarticolo, imgarticolo, anteprimaarticolo, dataarticolo, nome
                FROM articolo, autore
                WHERE autore=idautore
                ORDER BY dataarticolo DESC ";
        $stmt = $this->db->prepare($n > 0 ? $query .= "LIMIT ?" : $query);
        if ($n > 0) $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAuthors() {
        $query = "SELECT username, nome, GROUP_CONCAT(DISTINCT nomecategoria) as argomenti
            FROM categoria, articolo, autore, articolo_ha_categoria
            WHERE idarticolo=articolo
            AND";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>