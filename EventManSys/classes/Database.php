<?php
class Database {
    private $pdo;

    public function __construct() {
        $this->pdo = Config::getPDO();
    }

    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
?>

