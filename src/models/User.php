<?php
    class User extends Model {

        public function __construct() {
            $this->table = "users";

            $this->getConnection();
        }

        public function findById(string $id) {
            $sql = "SELECT * FROM :table WHERE id = :id";
            $query = $this->_connexion->prepare($sql);
            $query->execute(array('table' => $this->table, 'id' => $id));

            return $query->fetch(PDO::FETCH_ASSOC);
        }

        public function findByUsernameAndPassword(string $username, string $password) {
            $sql = "SELECT * FROM ".$this->table." WHERE username = ? AND password = ? ;";
            $query = $this->_connexion->prepare($sql);
            $query->bindParam(1, $username, PDO::PARAM_STR);
            $query->bindParam(2, $password, PDO::PARAM_STR);

            $res = $query->execute();

            return $res;
        }
    }
?>
