-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 27-Mar-2022 às 23:55
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `devfinance`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `icon_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `icon_id` (`icon_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categories`
--

INSERT INTO `categories` (`id`, `title`, `icon_id`) VALUES
(1, 'Alimentação', 1),
(2, 'Carro', 1),
(3, 'Educação', 1),
(4, 'Lazer', 1),
(5, 'Moradia', 1),
(6, 'Pagamentos', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `finance`
--

DROP TABLE IF EXISTS `finance`;
CREATE TABLE IF NOT EXISTS `finance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT NULL,
  `description` text,
  `price` varchar(20) NOT NULL,
  `date` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `finance`
--

INSERT INTO `finance` (`id`, `type`, `description`, `price`, `date`, `category_id`, `user_id`) VALUES
(3, 'income', 'FeijÃ£o', '7.95', '2022-03-26', 1, 12),
(10, 'income', 'teste', '120', '2022-03-15', 2, 12),
(4, 'income', 'Arigato', '395', '2022-03-26', 1, 12),
(14, 'expense', 'TransferÃªncia da Genial', '1999.66', '2022-03-29', 2, 12),
(6, 'expense', 'teste', '10', '2022-03-29', 2, 12),
(7, 'income', 'Venda de uma mesa', '200', '2022-03-31', 1, 12),
(13, 'income', 'TransferÃªncia da Genial', '1000', '2022-03-31', 2, 12),
(15, 'income', 'SalÃ¡rio recebido', '287', '2022-03-27', 2, 12),
(16, 'income', 'SalÃ¡rio recebido', '66', '2022-03-27', 2, 12),
(17, 'expense', 'TransferÃªncia da Genial', '67', '2022-03-27', 2, 12),
(18, 'income', 'TransferÃªncia da Genial', '0.70', '2022-03-28', 2, 12),
(19, 'income', 'teste', '15.60', '2022-03-29', 2, 12),
(20, 'income', 'Venda de uma biciclea', '150', '2022-03-27', 6, 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `group_icons`
--

DROP TABLE IF EXISTS `group_icons`;
CREATE TABLE IF NOT EXISTS `group_icons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_group` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `group_icons`
--

INSERT INTO `group_icons` (`id`, `title_group`) VALUES
(1, 'Família e pessoas\r\n');

-- --------------------------------------------------------

--
-- Estrutura da tabela `icons`
--

DROP TABLE IF EXISTS `icons`;
CREATE TABLE IF NOT EXISTS `icons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `icons`
--

INSERT INTO `icons` (`id`, `title`, `group_id`) VALUES
(1, '<i class=\"fas fa-user\"></i>', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `token` varchar(200) DEFAULT NULL,
  `bio` text,
  `registration_date` varchar(20) DEFAULT NULL,
  `adm` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `password`, `image`, `token`, `bio`, `registration_date`, `adm`) VALUES
(12, 'Samuel', 'Caitano Silva', 'smlcaitano@gmail.com', '$2y$10$0katU.R3tVXcowL9euQJn.sVhSC6olxPS4vuvALHNjCH8NjdbWEVy', 'foto.png', 'f12f5f4c9a117d6c088153c26a4b940916490aecbd8129c7d4cba586ef992542891908dd93d5a962eb92ac0e82aa687bcae4', NULL, '2022-03-26', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
