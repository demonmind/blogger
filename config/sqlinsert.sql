CREATE TABLE IF NOT EXISTS users (
  `userID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
	'superadmin' tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`userID`, `username`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS blogs (
  `blogID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`blogID`, `slug`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS posts (
	`postID` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`blog_id` int(10) COLLATE utf8_unicode_ci DEFAULT NULL,
	`user_id` int(10) COLLATE utf8_unicode_ci DEFAULT NULL,
	`title` varchar(5000) COLLATE utf8_unicode_ci DEFAULT NULL,
	`message` varchar(5000) COLLATE utf8_unicode_ci DEFAULT NULL,
	`date` datetime COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY (`postID`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS comments (
	`commentID` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`post_id` int(10) COLLATE utf8_unicode_ci DEFAULT NULL,
	`user_id` int(10) COLLATE utf8_unicode_ci DEFAULT NULL,
	`title` varchar(5000) COLLATE utf8_unicode_ci DEFAULT NULL,
	`message` varchar(5000) COLLATE utf8_unicode_ci DEFAULT NULL,
	`date` datetime COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY (`commentID`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;