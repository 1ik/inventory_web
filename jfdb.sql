-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2013 at 02:15 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jfdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE IF NOT EXISTS `expense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_type_id` int(11) NOT NULL,
  `showroom_id` int(11) NOT NULL,
  `amount` float NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `explanation` varchar(255) DEFAULT 'no explanation',
  PRIMARY KEY (`id`),
  KEY `fk_texpense_expense_type1` (`expense_type_id`),
  KEY `fk_texpense_showroom1` (`showroom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `expense_type`
--

CREATE TABLE IF NOT EXISTS `expense_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  `purchase_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `cost_price` decimal(10,0) DEFAULT '0',
  `sell_price` decimal(10,0) DEFAULT NULL,
  `designer_style` varchar(145) DEFAULT NULL,
  `showroom_id` int(11) NOT NULL,
  `color_code` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_items_purchase1` (`purchase_id`),
  KEY `fk_items_size1` (`size_id`),
  KEY `fk_item_supplier1` (`supplier_id`),
  KEY `fk_item_showroom1` (`showroom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `showroom_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_items_showroom1` (`showroom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

CREATE TABLE IF NOT EXISTS `item_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_group_id` int(11) NOT NULL,
  `name` varchar(145) NOT NULL,
  `added_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_product_type_sub_group1` (`sub_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `memo`
--

CREATE TABLE IF NOT EXISTS `memo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `added_on` datetime DEFAULT NULL,
  `showroom_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sell_showroom1` (`showroom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `memo_item`
--

CREATE TABLE IF NOT EXISTS `memo_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `memo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_memo_item1` (`item_id`),
  KEY `fk_memo_item_memo1` (`memo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `returned_item`
--

CREATE TABLE IF NOT EXISTS `returned_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `memo_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_returned_item_memo1_idx` (`memo_id`),
  KEY `fk_returned_item_item1_idx` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` float DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `showroom_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_salaries_showroom1` (`showroom_id`),
  KEY `fk_salary_staff1` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `showroom`
--

CREATE TABLE IF NOT EXISTS `showroom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE IF NOT EXISTS `size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `item_type_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `edited_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sizes_item_type1` (`item_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sold_item`
--

CREATE TABLE IF NOT EXISTS `sold_item` (
  `item_id` int(11) NOT NULL,
  KEY `fk_sold_item_item1` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(145) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `showroom_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_staffs_showroom1` (`showroom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `staff_salary`
--

CREATE TABLE IF NOT EXISTS `staff_salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` varchar(45) DEFAULT NULL,
  `showroom_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_staff_salary_showroom1` (`showroom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sub_group`
--

CREATE TABLE IF NOT EXISTS `sub_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_sub_group_group` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `cell_no` varchar(100) NOT NULL,
  `email` varchar(105) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE IF NOT EXISTS `transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_showroom_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `to_showroom_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_transfers_showroom1` (`from_showroom_id`),
  KEY `fk_transfer_showroom1` (`to_showroom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transferred_item`
--

CREATE TABLE IF NOT EXISTS `transferred_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transfer_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_transferred_item_transfer1` (`transfer_id`),
  KEY `fk_transferred_item_item1` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `fk_texpense_expense_type1` FOREIGN KEY (`expense_type_id`) REFERENCES `expense_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_texpense_showroom1` FOREIGN KEY (`showroom_id`) REFERENCES `showroom` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `fk_items_purchase1` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_items_size1` FOREIGN KEY (`size_id`) REFERENCES `size` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_supplier1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_showroom1` FOREIGN KEY (`showroom_id`) REFERENCES `showroom` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_items_showroom1` FOREIGN KEY (`showroom_id`) REFERENCES `showroom` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `item_type`
--
ALTER TABLE `item_type`
  ADD CONSTRAINT `fk_product_type_sub_group1` FOREIGN KEY (`sub_group_id`) REFERENCES `sub_group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `memo`
--
ALTER TABLE `memo`
  ADD CONSTRAINT `fk_sell_showroom1` FOREIGN KEY (`showroom_id`) REFERENCES `showroom` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `memo_item`
--
ALTER TABLE `memo_item`
  ADD CONSTRAINT `fk_memo_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_memo_item_memo1` FOREIGN KEY (`memo_id`) REFERENCES `memo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `returned_item`
--
ALTER TABLE `returned_item`
  ADD CONSTRAINT `fk_returned_item_memo1` FOREIGN KEY (`memo_id`) REFERENCES `memo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_returned_item_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `fk_salaries_showroom1` FOREIGN KEY (`showroom_id`) REFERENCES `showroom` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_salary_staff1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `size`
--
ALTER TABLE `size`
  ADD CONSTRAINT `fk_sizes_item_type1` FOREIGN KEY (`item_type_id`) REFERENCES `item_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sold_item`
--
ALTER TABLE `sold_item`
  ADD CONSTRAINT `fk_sold_item_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `fk_staffs_showroom1` FOREIGN KEY (`showroom_id`) REFERENCES `showroom` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `staff_salary`
--
ALTER TABLE `staff_salary`
  ADD CONSTRAINT `fk_staff_salary_showroom1` FOREIGN KEY (`showroom_id`) REFERENCES `showroom` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sub_group`
--
ALTER TABLE `sub_group`
  ADD CONSTRAINT `fk_sub_group_group` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transfer`
--
ALTER TABLE `transfer`
  ADD CONSTRAINT `fk_transfers_showroom1` FOREIGN KEY (`from_showroom_id`) REFERENCES `showroom` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transfer_showroom1` FOREIGN KEY (`to_showroom_id`) REFERENCES `showroom` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transferred_item`
--
ALTER TABLE `transferred_item`
  ADD CONSTRAINT `fk_transferred_item_transfer1` FOREIGN KEY (`transfer_id`) REFERENCES `transfer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transferred_item_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
