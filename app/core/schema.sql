-- Drop existing tables if needed (use with caution in production)
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `api_cache`, `banners`, `categories`, `comments`, `competitions`, `contacts`, `events`, `fixtures`, `media`, `news`, `news_tags`, `player_stats`, `players`, `settings`, `subscribers`, `tags`, `teams`, `users`;
SET FOREIGN_KEY_CHECKS = 1;

-- Users Table (Admins, Editors, Contributors)
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin', 'editor', 'contributor') NOT NULL DEFAULT 'contributor',
  `full_name` VARCHAR(100) NOT NULL,
  `avatar` VARCHAR(255) DEFAULT NULL,
  `bio` TEXT,
  `status` ENUM('active', 'suspended') NOT NULL DEFAULT 'active',
  `last_login` DATETIME DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Categories Table
CREATE TABLE `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL UNIQUE,
  `slug` VARCHAR(60) NOT NULL UNIQUE,
  `description` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tags Table
CREATE TABLE `tags` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL UNIQUE,
  `slug` VARCHAR(60) NOT NULL UNIQUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- News Table
CREATE TABLE `news` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(300) NOT NULL UNIQUE,
  `content` LONGTEXT NOT NULL,
  `excerpt` TEXT NOT NULL,
  `featured_image` VARCHAR(255) NOT NULL,
  `category_id` INT NOT NULL,
  `author_id` INT NOT NULL,
  `status` ENUM('draft', 'published', 'scheduled', 'archived') NOT NULL DEFAULT 'draft',
  `published_at` DATETIME DEFAULT NULL,
  `views` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`author_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- News-Tags Relationship Table
CREATE TABLE `news_tags` (
  `news_id` INT NOT NULL,
  `tag_id` INT NOT NULL,
  PRIMARY KEY (`news_id`, `tag_id`),
  FOREIGN KEY (`news_id`) REFERENCES `news`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`tag_id`) REFERENCES `tags`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Banners Table
CREATE TABLE `banners` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `image` VARCHAR(255) NOT NULL,
  `link` VARCHAR(255) DEFAULT NULL,
  `status` ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Competitions Table
CREATE TABLE `competitions` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL UNIQUE,
  `logo` VARCHAR(255) DEFAULT NULL,
  `api_id` INT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Teams Table
CREATE TABLE `teams` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL UNIQUE,
  `short_name` VARCHAR(20) NOT NULL,
  `logo` VARCHAR(255) DEFAULT NULL,
  `api_id` INT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Fixtures Table
CREATE TABLE `fixtures` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `competition_id` INT NOT NULL,
  `home_team_id` INT NOT NULL,
  `away_team_id` INT NOT NULL,
  `date` DATETIME NOT NULL,
  `venue` VARCHAR(100) DEFAULT NULL,
  `home_score` INT DEFAULT NULL,
  `away_score` INT DEFAULT NULL,
  `status` ENUM('scheduled', 'in_play', 'finished', 'postponed', 'canceled') NOT NULL DEFAULT 'scheduled',
  `api_id` INT DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`competition_id`) REFERENCES `competitions`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`home_team_id`) REFERENCES `teams`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`away_team_id`) REFERENCES `teams`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Players Table
CREATE TABLE `players` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `position` ENUM('GK', 'DEF', 'MID', 'FW') NOT NULL,
  `jersey_number` TINYINT UNSIGNED NOT NULL,
  `nationality` VARCHAR(50) NOT NULL,
  `date_of_birth` DATE NOT NULL,
  `height` SMALLINT UNSIGNED DEFAULT NULL COMMENT 'Height in cm',
  `weight` SMALLINT UNSIGNED DEFAULT NULL COMMENT 'Weight in kg',
  `bio` TEXT,
  `image` VARCHAR(255) DEFAULT NULL,
  `joined_date` DATE NOT NULL,
  `status` ENUM('active', 'injured', 'suspended', 'loaned', 'retired') NOT NULL DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Player Stats Table
CREATE TABLE `player_stats` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `player_id` INT NOT NULL,
  `season` YEAR NOT NULL,
  `competition_id` INT NOT NULL,
  `appearances` SMALLINT UNSIGNED DEFAULT 0,
  `goals` SMALLINT UNSIGNED DEFAULT 0,
  `assists` SMALLINT UNSIGNED DEFAULT 0,
  `minutes_played` INT UNSIGNED DEFAULT 0,
  `yellow_cards` SMALLINT UNSIGNED DEFAULT 0,
  `red_cards` SMALLINT UNSIGNED DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`player_id`) REFERENCES `players`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`competition_id`) REFERENCES `competitions`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Contacts Table
CREATE TABLE `contacts` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `subject` VARCHAR(200) DEFAULT NULL,
  `message` TEXT NOT NULL,
  `ip_address` VARCHAR(45) NOT NULL,
  `status` ENUM('pending', 'read', 'replied', 'spam') NOT NULL DEFAULT 'pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Events Table
CREATE TABLE `events` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(200) NOT NULL,
  `description` TEXT NOT NULL,
  `location` VARCHAR(200) NOT NULL,
  `start_datetime` DATETIME NOT NULL,
  `end_datetime` DATETIME DEFAULT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  `status` ENUM('upcoming', 'ongoing', 'completed', 'canceled') NOT NULL DEFAULT 'upcoming',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Subscribers Table
CREATE TABLE `subscribers` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `status` ENUM('active', 'unsubscribed') NOT NULL DEFAULT 'active',
  `subscribed_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `unsubscribed_at` DATETIME DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Comments Table
CREATE TABLE `comments` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `news_id` INT NOT NULL,
  `user_id` INT DEFAULT NULL,
  `name` VARCHAR(100) DEFAULT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `content` TEXT NOT NULL,
  `parent_id` INT DEFAULT NULL,
  `status` ENUM('pending', 'approved', 'spam', 'deleted') NOT NULL DEFAULT 'pending',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (`news_id`) REFERENCES `news`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`parent_id`) REFERENCES `comments`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Media Library Table
CREATE TABLE `media` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `file_name` VARCHAR(255) NOT NULL,
  `file_path` VARCHAR(255) NOT NULL,
  `file_type` VARCHAR(50) NOT NULL,
  `file_size` INT NOT NULL,
  `alt_text` VARCHAR(255) DEFAULT NULL,
  `caption` VARCHAR(255) DEFAULT NULL,
  `uploaded_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Settings Table
CREATE TABLE `settings` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `key` VARCHAR(50) NOT NULL UNIQUE,
  `value` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- API Cache Table
CREATE TABLE `api_cache` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `endpoint` VARCHAR(255) NOT NULL,
  `data` JSON NOT NULL,
  `expires_at` DATETIME NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert Essential Data
INSERT INTO `categories` (`name`, `slug`) VALUES
('Match Reports', 'match-reports'),
('Transfers', 'transfers'),
('Opinion', 'opinion'),
('History', 'history'),
('Youth', 'youth'),
('Women’s Team', 'womens-team');

INSERT INTO `tags` (`name`, `slug`) VALUES
('Champions League', 'champions-league'),
('La Liga', 'la-liga'),
('Transfer News', 'transfer-news'),
('Injury Update', 'injury-update'),
('Player Interview', 'player-interview'),
('Tactical Analysis', 'tactical-analysis'),
('Youth Academy', 'youth-academy'),
('Women Football', 'women-football');

-- Create Admin User (password: Admin123! - change after creation)
INSERT INTO `users` (`username`, `email`, `password`, `role`, `full_name`) 
VALUES ('admin', 'admin@madridkh.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'Admin User');

-- Create Initial Banner
INSERT INTO `banners` (`title`, `description`, `image`, `status`) 
VALUES ('Welcome to Real Madrid Cambodia', 'Official fan club in Cambodia', 'banner1.jpg', 'active');

-- Create Real Madrid Team
INSERT INTO `teams` (`name`, `short_name`) VALUES ('Real Madrid', 'RMA');

-- Create La Liga Competition
INSERT INTO `competitions` (`name`) VALUES ('La Liga');

-- Add Indexes for Performance
CREATE INDEX idx_news_status ON `news` (`status`);
CREATE INDEX idx_news_published ON `news` (`published_at`);
CREATE INDEX idx_fixtures_date ON `fixtures` (`date`);
CREATE INDEX idx_players_position ON `players` (`position`);