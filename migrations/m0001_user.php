<?php

use App\core\Application;

class m0001_user {

    public function up() {
        $db = Application::$app->db;
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )";
        $db->conn->exec($sql);

    }
    
    public function down() {
        $db = Application::$app->db;
        $sql = "DROP TABLE users";
        $db->conn->exec($sql);

    }

}
