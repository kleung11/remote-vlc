CREATE TABLE `favorites` (
  `id` int NOT NULL AUTO_INCREMENT,
  `song_id` int NOT NULL DEFAULT '0',
  `status` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `song_id_UNIQUE` (`song_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `songs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `singer` varchar(100) NOT NULL,
  `song_name` varchar(100) NOT NULL,
  `song_location` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `song_name_fulltext` (`song_name`),
  FULLTEXT KEY `singer_fulltext` (`singer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `hit_songs` (
  `song_id` int NOT NULL DEFAULT '0',
  `played` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`song_id`),
  KEY `idx_played` (`played`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
