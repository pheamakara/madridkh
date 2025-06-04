<?php
require_once __DIR__ . '/../config/paths.php';
require_once CORE_PATH . '/Database.php';

class NewsModel {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }
    
    public function getNews($limit, $offset, $categorySlug = null, $tag = null) {
        $query = "SELECT n.id, n.title, n.slug, n.excerpt, n.featured_image, n.created_at, 
                         u.full_name AS author, c.name AS category_name
                  FROM news n
                  JOIN users u ON n.author_id = u.id
                  JOIN categories c ON n.category_id = c.id
                  WHERE n.status = 'published'";
        
        $params = [];
        
        // Add category filter if provided
        if ($categorySlug) {
            $query .= " AND c.slug = :category_slug";
            $params[':category_slug'] = $categorySlug;
        }
        
        // Add tag filter if provided
        if ($tag) {
            $query .= " AND n.id IN (
                        SELECT nt.news_id FROM news_tags nt
                        JOIN tags t ON nt.tag_id = t.id
                        WHERE t.slug = :tag
                    )";
            $params[':tag'] = $tag;
        }
        
        $query .= " ORDER BY n.created_at DESC
                   LIMIT :limit OFFSET :offset";
        
        $stmt = $this->db->prepare($query);
        
        // Bind parameters
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getNewsById($id) {
        $query = "SELECT n.*, u.full_name AS author, u.avatar AS author_avatar, 
                         c.name AS category_name, c.slug AS category_slug
                  FROM news n
                  JOIN users u ON n.author_id = u.id
                  JOIN categories c ON n.category_id = c.id
                  WHERE n.id = :id AND n.status = 'published'
                  LIMIT 1";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $news = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($news) {
            // Get tags for the news
            $news['tags'] = $this->getTagsForNews($id);
        }
        
        return $news;
    }
    
    public function getRelatedNews($excludeId, $categoryId, $limit = 3) {
        $query = "SELECT id, title, slug, featured_image, created_at
                  FROM news
                  WHERE category_id = :category_id 
                    AND id != :exclude_id
                    AND status = 'published'
                  ORDER BY created_at DESC
                  LIMIT :limit";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindParam(':exclude_id', $excludeId, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTrendingTags($limit = 10) {
        // This could be based on most used tags or manually curated
        // Here we'll get the most used tags in the last 30 days
        $query = "SELECT t.id, t.name, t.slug, COUNT(nt.news_id) AS news_count
                  FROM tags t
                  JOIN news_tags nt ON t.id = nt.tag_id
                  JOIN news n ON nt.news_id = n.id
                  WHERE n.created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
                  GROUP BY t.id
                  ORDER BY news_count DESC
                  LIMIT :limit";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getTotalPages($perPage, $categorySlug = null, $tag = null) {
        $query = "SELECT COUNT(*) AS total 
                  FROM news n
                  JOIN categories c ON n.category_id = c.id
                  WHERE n.status = 'published'";
        
        $params = [];
        
        if ($categorySlug) {
            $query .= " AND c.slug = :category_slug";
            $params[':category_slug'] = $categorySlug;
        }
        
        if ($tag) {
            $query .= " AND n.id IN (
                        SELECT nt.news_id FROM news_tags nt
                        JOIN tags t ON nt.tag_id = t.id
                        WHERE t.slug = :tag
                    )";
            $params[':tag'] = $tag;
        }
        
        $stmt = $this->db->prepare($query);
        
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return ceil($result['total'] / $perPage);
    }
    
    private function getTagsForNews($newsId) {
        $query = "SELECT t.name, t.slug 
                  FROM tags t
                  JOIN news_tags nt ON t.id = nt.tag_id
                  WHERE nt.news_id = :news_id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':news_id', $newsId, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function incrementViewCount($newsId) {
        $query = "UPDATE news SET views = views + 1 WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $newsId, PDO::PARAM_INT);
        $stmt->execute();
    }
}