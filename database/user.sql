CREATE DATABASE IF NOT EXISTS php_ferdie CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE php;
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL default current_timestamp,
  `updated_at` timestamp NOT NULL default current_timestamp,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`email`)
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1;
INSERT INTO `users` VALUES(null, 'ferdie bergado', 'ferdiebergado@gmail.com', '$2y$10$ihAZM76a94DSwptJkYmmsef0exvmvNcyuWtLWvf1b5YC9JViN/RBy', null, null);
