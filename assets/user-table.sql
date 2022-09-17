CREATE TABLE `Users` (
  `id` int(11) unsigned AUTO_INCREMENT PRIMARY KEY  NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone_number` varchar(11) NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
