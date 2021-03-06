-- 
-- Table structure for table `users`
-- 

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varbinary(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varbinary(255) NOT NULL,
  `avatar` text NOT NULL,
  `signup_date` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;