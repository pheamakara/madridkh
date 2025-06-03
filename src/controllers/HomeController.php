<?php
class HomeController {
    public function index() {
        $latestNews = [
            [
                'title' => 'Real Madrid Wins La Liga',
                'image' => '/public/images/news1.jpg',
                'snippet' => 'Ancelotti’s team claims the league with 3 matches to spare.',
                'link' => '#'
            ],
            [
                'title' => 'Bellingham’s Stunning Season',
                'image' => '/public/images/news2.jpg',
                'snippet' => 'Bellingham breaks records in his debut year.',
                'link' => '#'
            ]
        ];

        $fixtures = [
            [
                'opponent' => 'Barcelona',
                'date' => '2025-06-10',
                'time' => '21:00',
                'venue' => 'Santiago Bernabéu'
            ]
        ];

        require_once __DIR__ . '/../views/layout.php';
    }
}