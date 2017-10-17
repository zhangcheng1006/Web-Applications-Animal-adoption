-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 16, 2017 at 09:07 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Myproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `informations`
--

CREATE TABLE `informations` (
  `number` int(11) NOT NULL,
  `login` varchar(64) NOT NULL,
  `titre` varchar(512) NOT NULL,
  `type` varchar(32) NOT NULL,
  `genre` varchar(16) NOT NULL,
  `age` int(11) NOT NULL,
  `race` varchar(32) NOT NULL,
  `taille` varchar(16) NOT NULL,
  `adresse` varchar(256) NOT NULL,
  `date` date NOT NULL,
  `photo` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `informations`
--

INSERT INTO `informations` (`number`, `login`, `titre`, `type`, `genre`, `age`, `race`, `taille`, `adresse`, `date`, `photo`) VALUES
(2, 'junfeng.wang', 'On a un chat très beau et doux, mais on ne peut plus s''occuper de lui...', 'chat', 'Male', 4, 'Je ne sais pas', 'moyen', 'Villeneuve-sur-lot', '2016-09-18', 'images/upload/2.jpg'),
(4, 'petassociation', 'Un chien sage qui serait euthanasié dans deux jours s''il n''y a personne qui l''adoptait...', 'Chien', 'Male', 7, 'Samoyède', 'moyen', 'Paris', '2016-11-13', 'images/upload/4.jpg'),
(6, 'ruihua.ruan', 'J''ai une tortue mignonne!', 'Tortue', 'Male', 8, 'Je ne sais pas', 'petit', 'Paris', '2016-12-18', 'images/upload/6.jpg'),
(8, 'petassociation', 'Un chat qui est jeté par son ancien propriétaire, on cherche un nouveau propriétaire pour elle.', 'Chat', 'Female', 10, 'Fold', 'petit', 'Ile de France', '2017-01-06', 'images/upload/8.jpg'),
(13, 'cheng.zhang', 'Un lapin blanc et gris très mignon~~~Il est vraiment beau!', 'lapin', 'Male', 5, 'non', 'petit', 'Nice', '2017-01-16', 'images/upload/12.jpg'),
(14, 'cheng.zhang', 'Un husky assez sage et malin, je suis triste mais je ne peux plus m''occuper de lui.', 'chien', 'Female', 4, 'huskies', 'grand', 'paris', '2017-02-16', 'images/upload/14.jpg'),
(15, 'maisondespetits', 'Nous avon accueilli un petit chat il y a deux jours et on lui cherche un propriétaire.', 'chat', 'Male', 2, 'perse', 'petit', 'Bordeaux', '2017-02-26', 'images/upload/15.jpg'),
(16, 'maisondespetits', 'Deux lapins beiges et gris qui sont amoureux et on ne veut pas leur séparer.', 'lapin', 'Male', 4, 'non', 'petit', 'Bordeaux', '2017-03-18', 'images/upload/16.jpg'),
(17, 'junfeng.wang', 'Je ne peux plus m''occuper de mon chéri...Il est très sage et doux!', 'chien', 'Female', 7, 'berger allemand', 'grand', 'agen', '2017-03-25', 'images/upload/17.jpg'),
(19, 'dominique', 'J''ai un chien qui est né il y a trois mois. Il est très beau et malin.', 'chien', 'Male', 1, 'Labrador', 'petit', 'paris', '2017-03-30', 'images/upload/19.jpg'),
(20, 'pethouse', 'Notre association accueil un grand membre pendant 3 mois. Ce malheureux n''a toujours pas trouvé un propriétaire.', 'chien', 'Male', 6, 'Golden Retriever', 'grand', 'Nice', '2017-04-06', 'images/upload/20.jpg'),
(21, 'petassociation', 'Nous l''avons trouvé dans le froid et on la nourrit pendant 2 mois. On espère qu''elle a de la chance de trouver un propriétaire.', 'chat', 'Female', 5, 'perse', 'moyen', 'toulouse', '2017-04-10', 'images/upload/21.jpg'),
(22, 'petassociation', 'Comme qu''il est beau!!! Qui est ravi de l''adopter? Nous serons reconnaissants.', 'chat', 'Male', 5, 'Norwegian Forest', 'moyen', 'paris', '2017-04-11', 'images/upload/22.jpg'),
(23, 'petassociation', 'Nous avons une chatte très jolie. On souhaite que quelqu''un puisse l''adopter', 'chat', 'Female', 3, 'Scottish Fold', 'petit', 'Toulouse', '2017-04-12', 'images/upload/23.jpg'),
(24, 'petassociation', 'Un grand chat qui cherche un monsieur pour l''adopter', 'chat', 'Male', 8, 'Persian', 'moyen', 'bordeaux', '2017-04-14', 'images/upload/24.jpg'),
(26, 'junfeng.wang', 'Un chien très doux et assez sage, je le trouve dans la rue mais je ne peux pas l''adopter.', 'chien', 'Female', 4, 'mixed', 'moyen', 'paris', '2017-04-14', 'images/upload/25.jpg'),
(27, 'junfeng.wang', 'Comment vous pouvez la jeter dans la rue?! Elle est si mignonne!!!', 'chat', 'Female', 6, 'British Shorthair', 'moyen', 'nice', '2017-04-15', 'images/upload/27.jpg'),
(28, 'zhilun.zhang', 'Ma petite chatte, je cherche un nouveau propriétaire pour toi...', 'chat', 'Female', 3, 'perse', 'petit', 'Agen', '2017-04-16', 'images/upload/28.jpg'),
(29, 'petassociation', 'Notre fier ami qui doit être adopté dans une semaine. J''espère que quelqu''un puisse le sauver!', 'chien', 'Male', 9, 'alaska', 'grand', 'toulouse', '2017-04-16', 'images/upload/29.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `informations`
--
ALTER TABLE `informations`
  ADD PRIMARY KEY (`number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `informations`
--
ALTER TABLE `informations`
  MODIFY `number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
