CREATE TABLE `users` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `status` varchar(20) NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `email` varchar(123) NOT NULL,
  `phone` varchar(114) NOT NULL,
  `currency` varchar(116) NOT NULL,
  `balance` varchar(112),
  `country` char(115) DEFAULT NULL,
  `date` datetime NOT NULL,
  `doc_name` varchar(115),
  `doc` varchar(122),
  `postal` int(11),
  `upload` varchar(122)
) ENGINE = InnoDB;
