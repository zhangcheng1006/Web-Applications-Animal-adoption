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
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `login` varchar(40) NOT NULL,
  `mdp` varchar(40) NOT NULL,
  `email` varchar(128) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'individu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`login`, `mdp`, `email`, `type`) VALUES
('aik9508', '8cb2237d0679ca88db6464eac60da96345513964', 'ke.wang.x15@polytechnique.edu', 'individu'),
('cheng.zhang', '79d2094ed655e8a47493091e63fe29301be17608', 'cheng.zhang@polytechnique.edu', 'individu'),
('dominique', '9cc140dd813383e134e7e365b203780da9376438', 'dominique.renard@polytechnique.edu', 'individu'),
('junfeng.wang', '79d2094ed655e8a47493091e63fe29301be17608', 'wangjunfeng@gmail.com', 'individu'),
('maisondespetits', '3e1de30d83a00b6b0a55cac54dc72706539dc598', 'maisondespetits@gmail.com', 'association'),
('olivier', '663194f2b9123a38cd9e2e2811f8d2fd387b765e', 'olivier.serre@polytechnique.edu', 'association'),
('petassociation', '3757d46ef75231ea3de55cbc85417fb864281ddb', 'petassociation@gmail.com', 'association'),
('pethouse', '75c9b0dc424256e070c5e7901e43b21ab2b7c568', 'pethouse@gmail.com', 'association'),
('ruihua.ruan', 'dac6e0ef530e2f5ba877c32f0793db64756cb9cf', 'ruanruihua@gmail.com', 'individu'),
('svenhsia', 'b622e1d8fa3d9dce4619503b3f6cd18126c371e0', 'shiwen.xia@polytechnique.edu', 'individu'),
('zhilun.zhang', 'bf1b9dca1a1e2592e1ae7fbf9326d6261afe680c', 'zhilun.zhang@gmail.com', 'individu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`login`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
