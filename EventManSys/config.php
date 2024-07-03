<?php

class config {
    const DB_HOST = 'localhost';
    const DB_NAME = 'event_manager';
    const DB_USER = 'root';
    const DB_PASS = '';

    public static function getPDO() {
        try {
            $pdo = new PDO('mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME, self::DB_USER, self::DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Could not connect to the database: " . $e->getMessage());
        }
    }
}
?>

