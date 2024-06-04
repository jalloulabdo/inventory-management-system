-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 04 juin 2024 à 23:18
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `inventorymgtci`
--

-- --------------------------------------------------------

--
-- Structure de la table `attributes`
--

CREATE TABLE `attributes` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `active`) VALUES
(4, 'Color', 1),
(6, 'Size', 1);

-- --------------------------------------------------------

--
-- Structure de la table `attribute_value`
--

CREATE TABLE `attribute_value` (
  `id` int NOT NULL,
  `value` varchar(255) NOT NULL,
  `attribute_parent_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `attribute_value`
--

INSERT INTO `attribute_value` (`id`, `value`, `attribute_parent_id`) VALUES
(5, 'Blue', 2),
(6, 'White', 2),
(7, 'M', 3),
(8, 'L', 3),
(9, 'Green', 2),
(10, 'Black', 2),
(12, 'Grey', 2),
(13, 'S', 3),
(17, 'yellow', 4),
(20, 'Small', 6),
(21, 'Medium', 6),
(22, 'Large', 6),
(23, 'Black', 4),
(24, 'Maroon', 4),
(25, 'Red', 4),
(26, 'Blue', 4),
(27, 'Navy', 4),
(28, 'Pearl White', 4),
(29, 'Phantom Black', 4),
(30, 'Gray', 4),
(31, 'XL', 6),
(32, 'XXL', 6),
(33, 'XXXL', 6),
(34, 'Free Size', 6),
(35, 'None', 6),
(36, 'Pink', 4);

-- --------------------------------------------------------

--
-- Structure de la table `brands`
--

CREATE TABLE `brands` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `brands`
--

INSERT INTO `brands` (`id`, `name`, `active`) VALUES
(30, 'phone', 1),
(31, 'computer', 1),
(32, 'camera', 1),
(34, 'new', 1);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `active`) VALUES
(7, 'Electronic', 1),
(8, 'Clothings', 1),
(9, 'Chairs', 1),
(10, 'Headsets', 1),
(11, 'Controllers', 1),
(12, 'Shoes', 1),
(13, 'Others', 1),
(14, 'Office Supplies', 1);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(222) NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `firstname`, `lastname`, `address`, `phone`, `email`, `city`) VALUES
(1, 'jalloul', 'abderrahim 2', 'hay tikiouine', '0678787878', 'jalloul@gmail.com', 'agadir'),
(6, 'Dalton', 'Floyd', 'Praesentium quibusda', '+1 (824) 432-8674', 'wulowib@mailinator.com', 'Consequatur voluptat');

-- --------------------------------------------------------

--
-- Structure de la table `company`
--

CREATE TABLE `company` (
  `id` int NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `service_charge_value` varchar(255) NOT NULL,
  `vat_charge_value` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `company`
--

INSERT INTO `company` (`id`, `company_name`, `service_charge_value`, `vat_charge_value`, `address`, `phone`, `country`, `message`, `currency`) VALUES
(1, 'Inventory Management System', '13', '10', '1538 Wilkinson Court', '777777770', 'US', '<p>Built using PHP with CodeIgniter Framework!</p>', 'USD');

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

CREATE TABLE `groups` (
  `id` int NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `permission`) VALUES
(1, 'Administrator', 'a:41:{i:0;s:12:\"createClient\";i:1;s:12:\"updateClient\";i:2;s:10:\"viewClient\";i:3;s:12:\"deleteClient\";i:4;s:11:\"createUnity\";i:5;s:11:\"updateUnity\";i:6;s:9:\"viewUnity\";i:7;s:11:\"deleteUnity\";i:8;s:10:\"createUser\";i:9;s:10:\"updateUser\";i:10;s:8:\"viewUser\";i:11;s:10:\"deleteUser\";i:12;s:11:\"createGroup\";i:13;s:11:\"updateGroup\";i:14;s:9:\"viewGroup\";i:15;s:11:\"deleteGroup\";i:16;s:11:\"createBrand\";i:17;s:11:\"updateBrand\";i:18;s:9:\"viewBrand\";i:19;s:11:\"deleteBrand\";i:20;s:14:\"createCategory\";i:21;s:14:\"updateCategory\";i:22;s:12:\"viewCategory\";i:23;s:14:\"deleteCategory\";i:24;s:11:\"createStore\";i:25;s:11:\"updateStore\";i:26;s:9:\"viewStore\";i:27;s:11:\"deleteStore\";i:28;s:15:\"createAttribute\";i:29;s:15:\"updateAttribute\";i:30;s:13:\"viewAttribute\";i:31;s:15:\"deleteAttribute\";i:32;s:13:\"createProduct\";i:33;s:13:\"updateProduct\";i:34;s:11:\"viewProduct\";i:35;s:13:\"deleteProduct\";i:36;s:11:\"createOrder\";i:37;s:11:\"updateOrder\";i:38;s:9:\"viewOrder\";i:39;s:11:\"deleteOrder\";i:40;s:13:\"updateCompany\";}'),
(5, 'Testing', 'a:24:{i:0;s:10:\"updateUser\";i:1;s:8:\"viewUser\";i:2;s:11:\"createGroup\";i:3;s:11:\"updateGroup\";i:4;s:9:\"viewGroup\";i:5;s:11:\"createBrand\";i:6;s:11:\"updateBrand\";i:7;s:9:\"viewBrand\";i:8;s:14:\"createCategory\";i:9;s:14:\"updateCategory\";i:10;s:12:\"viewCategory\";i:11;s:11:\"createStore\";i:12;s:11:\"updateStore\";i:13;s:9:\"viewStore\";i:14;s:15:\"createAttribute\";i:15;s:15:\"updateAttribute\";i:16;s:13:\"viewAttribute\";i:17;s:13:\"createProduct\";i:18;s:13:\"updateProduct\";i:19;s:11:\"viewProduct\";i:20;s:11:\"createOrder\";i:21;s:11:\"updateOrder\";i:22;s:9:\"viewOrder\";i:23;s:13:\"updateCompany\";}'),
(6, 'Employee', 'a:12:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:11:\"createBrand\";i:4;s:11:\"updateBrand\";i:5;s:9:\"viewBrand\";i:6;s:13:\"createProduct\";i:7;s:13:\"updateProduct\";i:8;s:11:\"viewProduct\";i:9;s:11:\"createOrder\";i:10;s:11:\"updateOrder\";i:11;s:9:\"viewOrder\";}'),
(7, 'RH', 'a:28:{i:0;s:12:\"createClient\";i:1;s:12:\"updateClient\";i:2;s:10:\"viewClient\";i:3;s:12:\"deleteClient\";i:4;s:10:\"createUser\";i:5;s:10:\"updateUser\";i:6;s:8:\"viewUser\";i:7;s:10:\"deleteUser\";i:8;s:11:\"createGroup\";i:9;s:11:\"updateGroup\";i:10;s:9:\"viewGroup\";i:11;s:11:\"deleteGroup\";i:12;s:11:\"createBrand\";i:13;s:11:\"updateBrand\";i:14;s:9:\"viewBrand\";i:15;s:14:\"createCategory\";i:16;s:14:\"updateCategory\";i:17;s:12:\"viewCategory\";i:18;s:11:\"createStore\";i:19;s:11:\"updateStore\";i:20;s:9:\"viewStore\";i:21;s:15:\"createAttribute\";i:22;s:15:\"updateAttribute\";i:23;s:13:\"viewAttribute\";i:24;s:13:\"createProduct\";i:25;s:13:\"updateProduct\";i:26;s:11:\"viewProduct\";i:27;s:11:\"createOrder\";}');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `bill_no` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `customer_id` int NOT NULL,
  `gross_amount` varchar(255) NOT NULL,
  `service_charge_rate` varchar(255) NOT NULL,
  `service_charge` varchar(255) NOT NULL,
  `vat_charge_rate` varchar(255) NOT NULL,
  `vat_charge` varchar(255) NOT NULL,
  `net_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `paid_status` int NOT NULL,
  `type_payment` varchar(255) DEFAULT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `bill_no`, `date_time`, `customer_id`, `gross_amount`, `service_charge_rate`, `service_charge`, `vat_charge_rate`, `vat_charge`, `net_amount`, `discount`, `paid_status`, `type_payment`, `user_id`) VALUES
(1, 'BILPR-5D1C', '1716410397', 1, '1000.00', '13', '130.00', '10', '100.00', '1230.00', '', 1, 'CHQ', 1),
(2, 'BILPR-9A4D', '1712469471', 6, '18318.00', '13', '2381.34', '10', '1831.80', '22531.14', '', 1, 'espece', 1),
(3, 'BILPR-B045', '1716496996', 6, '16830.00', '13', '2187.90', '10', '1683.00', '20700.90', '', 1, NULL, 1),
(4, 'BILPR-4890', '1716925739', 1, '25595.00', '13', '3327.35', '10', '2559.50', '31481.85', '', 1, '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `orders_item`
--

CREATE TABLE `orders_item` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `orders_item`
--

INSERT INTO `orders_item` (`id`, `order_id`, `product_id`, `qty`, `rate`, `amount`) VALUES
(9, 1, 27, '15', '765', '765.00'),
(10, 1, 26, '9', '235', '235.00'),
(11, 2, 24, '10', '223', '223.00'),
(12, 2, 26, '77', '235', '18095.00'),
(13, 3, 27, '22', '765', '16830.00'),
(15, 4, 27, '32', '765', '24480.00'),
(16, 4, 24, '5', '223', '1115.00');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `serial` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `new_qty` int DEFAULT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `attribute_value_id` text,
  `brand_id` text NOT NULL,
  `category_id` text NOT NULL,
  `store_id` int NOT NULL,
  `unity_id` int DEFAULT NULL,
  `availability` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `serial`, `name`, `sku`, `price`, `qty`, `new_qty`, `image`, `description`, `attribute_value_id`, `brand_id`, `category_id`, `store_id`, `unity_id`, `availability`) VALUES
(24, '243226562', 'iphone', '', '223', '7', NULL, 'assets/images/product_image/664bae31d903d.jpg', '', '[\"23\",\"21\"]', 'null', 'null', 5, 2, 1),
(26, '1237665', 'Pc Portable', '', '235', '36', NULL, 'assets/images/product_image/664e57aacca6f.jpg', '<p>\r\n\r\nOrdinateur tout-en-un que l\'on peut déplacer en raison de sa taille compacte et de la présence d\'une batterie qui lui permet de fonctionner un moment sans avoir besoin de source d\'alimentation.\r\n\r\n<br></p>', '[\"23\",\"25\",\"21\"]', '[\"31\"]', '[\"7\"]', 5, 2, 1),
(27, '97856744', 'Pc', '', '765', '131', NULL, '<p>You did not select a file to upload.</p>', '<p>\r\n\r\nOrdinateur tout-en-un que l\'on peut déplacer en raison de sa taille compacte et de la présence d\'une batterie qui lui permet de fonctionner un moment sans avoir besoin de source d\'alimentation.\r\n\r\n<br></p>', 'null', 'null', 'null', 5, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `stores`
--

CREATE TABLE `stores` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `stores`
--

INSERT INTO `stores` (`id`, `name`, `active`) VALUES
(5, 'Dynamix', 1),
(6, 'Taser', 1);

-- --------------------------------------------------------

--
-- Structure de la table `unities`
--

CREATE TABLE `unities` (
  `id` int NOT NULL,
  `name` varchar(110) NOT NULL,
  `active` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `unities`
--

INSERT INTO `unities` (`id`, `name`, `active`) VALUES
(2, 'PC', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `phone`, `gender`) VALUES
(1, 'admin', '$2y$10$7rLSvRVyTQORapkDOqmkhetjF6H9lJHngr4hJMSM2lHObJbW5EQh6', 'admin@gmail.com', 'Liam', 'Moore', '7777777777', 1),
(11, 'bryan', '$2y$10$VR/hRTtkIbt5Ws8fWshuduKC9bKD0Hed5UW.zFm6x2SWVJ7Ci8Fdy', 'bryan@mail.com', 'Bryan', 'Taylor', '7410002560', 1),
(16, 'tygeruceji', '$2y$10$Vi3G88xwuT1CgfGL0RGcbuqUzFEzPcQ9RPg54.j2VMQTcPeIgL5S.', 'rolit2@mailinator.com', 'Nero', 'Pate', '+1 (296) 292-3042', 1),
(17, 'gyzux', '$2y$10$SvGybXV5Ppit03ebaCTT8e6CpO.3Dn.az/cIEAkn0HLuZ1m5FsluS', 'byfuxytadi@mailinator.com', 'Davis', 'Santos', '+1 (198) 745-4355', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user_group`
--

CREATE TABLE `user_group` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `group_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user_group`
--

INSERT INTO `user_group` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(7, 6, 4),
(8, 7, 4),
(9, 8, 4),
(10, 9, 5),
(11, 10, 5),
(12, 11, 5),
(13, 13, 6),
(14, 14, 5),
(15, 15, 5),
(16, 16, 6),
(17, 17, 7);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders_item`
--
ALTER TABLE `orders_item`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `unities`
--
ALTER TABLE `unities`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `attribute_value`
--
ALTER TABLE `attribute_value`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `company`
--
ALTER TABLE `company`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `orders_item`
--
ALTER TABLE `orders_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `unities`
--
ALTER TABLE `unities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
