<?php
namespace App;

use PDO;
use PDOException;

class Database {
    private $host = '127.0.0.1';
    private $dbName = 'expenses_tracker';
    private $username = 'root';
    private $password = 'mysqlronald';

    public function connect() {
        try {
            $pdo = new PDO("mysql:host={$this->host};dbname={$this->dbName}", $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            exit;
        }
    }
}