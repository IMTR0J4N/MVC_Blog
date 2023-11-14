<?php 
    abstract class Model {
        private $host = '127.0.0.1';
        private $db_name =  'blog';
        private $username = 'root';
        private $password = '';

        protected $_connexion;

        public $table;
        public $id;

        public function getConnection(): void {
            $this->_connexion = null;

            try {
                $this->_connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->_connexion->exec('set names utf8');
            } catch(PDOException $e) {
                echo "Erreur de connexion : " . $e->getMessage();
            }
        }

        public function getOne() {
            $sql = "SELECT * FROM :table WHERE id = :id";

            $query = $this->_connexion->prepare($sql);

            $query->execute(array('table' => $this->table, 'id' => $this->id));

            return $query->fetch();
        }

        public function getAll() {
            $sql = "SELECT * FROM ".$this->table;

            $query = $this->_connexion->query($sql);
            
            return $query;
        }
    }
?>