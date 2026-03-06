CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `illustration` varchar(256) DEFAULT NULL,
  `departure_date` date NOT NULL,
  `max_passengers` int(11) NOT NULL,
  `price` int(11) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) NOT NULL,
  `hashed_password` varchar(256) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_espece_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fk_reservation_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
  
  INSERT INTO `product` (`id`, `name`, `illustration`, `departure_date`, `max_passengers`, `price`) VALUES
(1, 'moon', 'Vous souhaitez découvrir notre magnifique Lune sous tous ses angles ? Alors montez à bord de notre prochain voyage !', '2026-03-18', 1, 19),
(2, 'titan', 'Vous souhaitez découvrir le plus grand satellite naturel de Saturne, Titan ? Alors venez vous embarquez dans un magnifique voyage de l\'autre coté du système solaire !', '2026-03-04', 6, 4),
(5, 'jupiter', 'Vous souhaitez être émerveillé devant la plus grande planète du système solaire ? Alors montez à bord et venez découvrir notre magnifique Jupiter au terme d\'un extraordinaire voyage !', '2026-03-06', 10, 109),
(6, 'Mars', 'Vous souhaitez vous aussi vous lancer à la conquête de Mars comme Elon Musk ? Alors montez à bord de ce trajet pour arriver avant lui sur Mars ! ', '2026-03-20', 139, 1249);

INSERT INTO `user` (`id`, `email`, `hashed_password`, `is_admin`) VALUES
(13, 'kevin.gbt2805@gmail.com', '7682fe272099ea26efe39c890b33675b', 1),
(26, 'kevin.gbt@gmail.com', 'cdaa6716746fb685734abde87f1b08ad', 0);

INSERT INTO `reservation` (`id`, `user_id`, `product_id`) VALUES
(20, 26, 1),
(21, 26, 2),
(22, 26, 5);