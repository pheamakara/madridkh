<?php
class NewsModel {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }
    
    public function getBanners() {
        $query = "SELECT * FROM banners WHERE status = 'active' ORDER BY created_at DESC LIMIT 3";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getLatestNews($limit = 6) {
        $query = "SELECT id, title, image, excerpt, created_at 
                  FROM news 
                  WHERE status = 'published' 
                  ORDER BY created_at DESC 
                  LIMIT :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}