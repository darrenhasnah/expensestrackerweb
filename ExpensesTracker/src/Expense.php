<?php
namespace App;

use PDO;

class Expense {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

   
    public function addExpense($userId, $amount, $category, $description, $date) {
        $stmt = $this->db->prepare("INSERT INTO expenses (user_id, amount, category, description, date) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$userId, $amount, $category, $description, $date]);
    }
}
