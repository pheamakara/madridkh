<?php
class HomeController {
    private $newsModel;
    private $fixtureModel;
    
    public function __construct() {
        require_once 'app/models/NewsModel.php';
        require_once 'app/models/FixtureModel.php';
        $this->newsModel = new NewsModel();
        $this->fixtureModel = new FixtureModel();
    }
    
    public function index() {
        $data = [
            'banners' => $this->newsModel->getBanners(),
            'latestNews' => $this->newsModel->getLatestNews(9),
            'upcomingFixtures' => $this->fixtureModel->getUpcomingFixtures(3),
            'leagueTable' => $this->fixtureModel->getLeagueTable(5)
        ];
        
        require_once 'app/views/layouts/main.php';
        require_once 'app/views/home/index.php';
    }
}