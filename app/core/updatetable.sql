-- Create Categories Table
CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL UNIQUE,
  `slug` VARCHAR(60) NOT NULL UNIQUE,
  `description` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert Sample Categories
INSERT INTO `categories` (`name`, `slug`) VALUES
('Match Reports', 'match-reports'),
('Transfers', 'transfers'),
('Opinion', 'opinion'),
('History', 'history'),
('Youth', 'youth'),
('Women’s Team', 'womens-team');

-- Create Tags Table
CREATE TABLE IF NOT EXISTS `tags` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(50) NOT NULL UNIQUE,
  `slug` VARCHAR(60) NOT NULL UNIQUE,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert Sample Tags
INSERT INTO `tags` (`name`, `slug`) VALUES
('Champions League', 'champions-league'),
('La Liga', 'la-liga'),
('Transfer News', 'transfer-news'),
('Injury Update', 'injury-update'),
('Player Interview', 'player-interview'),
('Tactical Analysis', 'tactical-analysis'),
('Youth Academy', 'youth-academy'),
('Women Football', 'women-football');

-- Create News-Tags Relationship Table
CREATE TABLE IF NOT EXISTS `news_tags` (
  `news_id` INT NOT NULL,
  `tag_id` INT NOT NULL,
  PRIMARY KEY (`news_id`, `tag_id`),
  FOREIGN KEY (`news_id`) REFERENCES `news`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`tag_id`) REFERENCES `tags`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add category_id to news table (if not already exists)
ALTER TABLE `news` ADD COLUMN `category_id` INT NOT NULL AFTER `featured_image`;
ALTER TABLE `news` ADD CONSTRAINT `fk_news_category` FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`);

-- Add views column to news table
ALTER TABLE `news` ADD COLUMN `views` INT DEFAULT 0 AFTER `published_at`;