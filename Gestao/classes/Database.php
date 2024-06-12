<?php
class Database {
    private $pdo;

    public function __construct($dbname) {
        $this->pdo = new PDO("sqlite:" . $dbname);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection() {
        return $this->pdo;
    }
}
?>
