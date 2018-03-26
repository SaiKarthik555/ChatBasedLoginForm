CREATE DATABASE `delta_form`;
USE `delta_form`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `password` varchar(40) NOT NULL, 
  `image` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`,`username`,`phone`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
