<?php
class FixtureModel {
    private $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }
    
    public function getUpcomingFixtures($limit = 3) {
        // In a real implementation, this would fetch from API
        // Here we'll simulate with local data
        return [
            [
                'id' => 1,
                'home_team' => 'Real Madrid',
                'away_team' => 'Barcelona',
                'date' => '2023-06-15 20:00:00',
                'venue' => 'Santiago Bernabeu',
                'competition' => 'La Liga'
            ],
            [
                'id' => 2,
                'home_team' => 'Real Madrid',
                'away_team' => 'Atletico Madrid',
                'date' => '2023-06-22 19:30:00',
                'venue' => 'Wanda Metropolitano',
                'competition' => 'Copa del Rey'
            ],
            [
                'id' => 3,
                'home_team' => 'Real Madrid',
                'away_team' => 'Manchester City',
                'date' => '2023-06-30 21:00:00',
                'venue' => 'Etihad Stadium',
                'competition' => 'Champions League'
            ]
        ];
    }
    
    public function getLeagueTable($limit = 5) {
        // In a real implementation, this would fetch from API
        // Here we'll simulate with local data
        return [
            ['position' => 1, 'team' => 'Real Madrid', 'played' => 38, 'won' => 26, 'drawn' => 8, 'lost' => 4, 'points' => 86],
            ['position' => 2, 'team' => 'Barcelona', 'played' => 38, 'won' => 25, 'drawn' => 7, 'lost' => 6, 'points' => 82],
            ['position' => 3, 'team' => 'Atletico Madrid', 'played' => 38, 'won' => 21, 'drawn' => 8, 'lost' => 9, 'points' => 71],
            ['position' => 4, 'team' => 'Sevilla', 'played' => 38, 'won' => 18, 'drawn' => 12, 'lost' => 8, 'points' => 66],
            ['position' => 5, 'team' => 'Real Sociedad', 'played' => 38, 'won' => 17, 'drawn' => 11, 'lost' => 10, 'points' => 62]
        ];
    }
}