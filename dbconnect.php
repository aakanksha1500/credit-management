<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=credit','root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>


<!-- CREATE TABLE `user` (
	id int not null auto increment ;
  `name` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `credit` varchar(10) NOT NULL,
  primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`name`, `email`, `credit`) VALUES
('abhishek', 'abhi@gmail.com', '123345'),
('akshay', 'aks@gmail.com', '110345'),
('AMAR', 'amar@gmail.com', '988726'),
('Anirud', 'ani@gmail.com', '36000'),
('gauri', 'gb@gmail.com', '39500'),
('mayuri', 'mayu@gmail.com', '10000'),
('Shreyas', 'Shreyas@gmail.com', '34567'),
('sia', 'sia@gmail.com', '9718470'),
('tejal', 'tejalv@gmail.com', '1234'),
('vaibhav', 'vaibs@gmail.com', '200000');
-->

