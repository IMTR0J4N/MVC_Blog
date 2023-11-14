<?php
    class Article extends Model {
        public function __construct() {
            $this->table = "articles";

            $this->getConnection();
        }

        public function findById(string $id) {
            $sql = "SELECT * FROM :table WHERE id = :id";
            $query = $this->_connexion->prepare($sql);
            $query->execute(array('table' => $this->table, 'id' => $id));

            return $query->fetch(PDO::FETCH_ASSOC);
        }

        public function findByAuthorId(string $id) {
            $sql = "SELECT * FROM :table WHERE author_id = :id";

            $query = $this->_connexion->prepare($sql);
            $query->execute(array('table' => $this->table, 'id' => $id));

            return $query->fetch(PDO::FETCH_ASSOC);
        }
    }
?>