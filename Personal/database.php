<?php
class Database {
    public $host = 'localhost';
    public $user = 'root';
    public $pass = '';
    public $dbname = 'personal';
    public $mysqli;

    public function __construct() {
        $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        if ($this->mysqli->connect_error) {
            die('Bağlantı Hatası (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error);
        }
    }

    public function query($sql) {
        return $this->mysqli->query($sql);
    }

    public function prepare($query) {
        return $this->mysqli->prepare($query);
    }
    
    public function __destruct() {
        $this->mysqli->close();
    }
}
?>


