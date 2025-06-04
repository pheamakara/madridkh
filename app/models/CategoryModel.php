<?php
require_once ROOT_PATH . '/config/paths.php';
require_once CORE_PATH . '/Database.php';

class CategoryModel {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }
    
    public function getAllCategories() {
        $query = "SELECT id, name, slug FROM categories ORDER BY name ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getCategoryBySlug($slug) {
        $query = "SELECT id, name FROM categories WHERE slug = :slug LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':slug', $slug);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}