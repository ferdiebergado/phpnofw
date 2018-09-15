CREATE DATABASE IF NOT EXISTS php_ferdie;
USE php_ferdie;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` boolean default true,
  `last_login` timestamp,
  `created_at` timestamp default current_timestamp,
  `updated_at` timestamp default current_timestamp ON UPDATE current_timestamp,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`email`)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci AUTO_INCREMENT=1;
DELETE FROM `users` WHERE `email` = 'ferdiebergado@gmail.com';
INSERT INTO `users` VALUES(null, 'ferdie bergado', 'ferdiebergado@gmail.com', '$2y$10$ihAZM76a94DSwptJkYmmsef0exvmvNcyuWtLWvf1b5YC9JViN/RBy', default, null, default, default);
