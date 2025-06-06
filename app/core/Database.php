<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'madridkh';
    private $username = 'madriduser';
    private $password = 'Mkr@9899';
    private $conn;
    
    public function connect() {
    $this->conn = null;
    
    try {
        $this->conn = new PDO(
            "mysql:host={$this->host};dbname={$this->db_name}", 
            $this->username, 
            $this->password
        );
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch(PDOException $e) {
        // Log to error log
        error_log("Database Connection Error: " . $e->getMessage());
        
        // Show user-friendly message
        header('HTTP/1.1 503 Service Unavailable');
        include VIEWS_PATH . '/errors/database.php';
        exit;
    }
    
    return $this->conn;
}
}