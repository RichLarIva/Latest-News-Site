CREATE TABLE `users`(
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `fullname` varchar(120) NOT NULL,
    `user` varchar(25) NOT NULL UNIQUE,
    `pwd` varchar(255) NOT NULL,
    `bday` varchar(11) NOT NULL,
    `cats` varchar(250) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=latin1;