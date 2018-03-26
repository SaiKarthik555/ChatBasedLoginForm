

CREATE TABLE `messages` (
  `group_hash` int(255) NOT NULL,
  `from_id` int(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
