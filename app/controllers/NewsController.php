<?php
require_once ROOT_PATH . '/config/paths.php';

class NewsController {
    private $newsModel;
    private $categoryModel;
    
    public function __construct() {
        require_once MODELS_PATH . '/NewsModel.php';
        require_once MODELS_PATH . '/CategoryModel.php';
        $this->newsModel = new NewsModel();
        $this->categoryModel = new CategoryModel();
    }
    
    public function index() {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $category = isset($_GET['category']) ? $_GET['category'] : null;
        $tag = isset($_GET['tag']) ? $_GET['tag'] : null;
        
        $perPage = 9; // Articles per page
        $offset = ($page - 1) * $perPage;
        
        // Get news data
        $data = [
            'news' => $this->newsModel->getNews($perPage, $offset, $category, $tag),
            'categories' => $this->categoryModel->getAllCategories(),
            'trendingTags' => $this->newsModel->getTrendingTags(10),
            'currentCategory' => $category,
            'currentTag' => $tag,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $this->newsModel->getTotalPages($perPage, $category, $tag),
                'base_url' => $this->getBaseUrl($category, $tag)
            ]
        ];
        
        // Render the view
        $this->renderView('news/index', $data);
    }
    
    public function show($id) {
        $newsId = (int)$id;
        $news = $this->newsModel->getNewsById($newsId);
        
        if (!$news) {
            header("HTTP/1.0 404 Not Found");
            include VIEWS_PATH . '/errors/404.php';
            exit;
        }
        
        // Increment view count
        $this->newsModel->incrementViewCount($newsId);
        
        $data = [
            'news' => $news,
            'relatedNews' => $this->newsModel->getRelatedNews($newsId, $news['category_id'], 3),
            'trendingTags' => $this->newsModel->getTrendingTags(10)
        ];
        
        $this->renderView('news/show', $data);
    }
    
    private function getBaseUrl($category = null, $tag = null) {
        $url = '/news?';
        if ($category) $url .= 'category=' . urlencode($category) . '&';
        if ($tag) $url .= 'tag=' . urlencode($tag) . '&';
        return rtrim($url, '&');
    }
    
    private function renderView($viewPath, $data = []) {
        extract($data);
        require_once VIEWS_PATH . "/layouts/main.php";
    }
}