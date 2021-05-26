-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 26, 2021 at 10:28 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--
-- Database: `ITEC327_TermProject`
--
-- --------------------------------------------------------
--
-- Table structure for table `ingredient_table`
--
CREATE TABLE `ingredient_table` (
    `id` int(11) NOT NULL,
    `ingredient_name` varchar(256) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data for table `ingredient_table`
--
INSERT INTO `ingredient_table` (`id`, `ingredient_name`)
VALUES (1, 'pound fresh prepared pizza dough'),
    (2, 'ounces shredded mozzarella cheese'),
    (3, 'cup of ricotta cheese'),
    (4, 'large egg yolk'),
    (5, 'teaspoon lemon zest'),
    (6, 'finely grated garlic cloves'),
    (7, 'teaspoon kosher salt'),
    (8, 'teaspoon black pepper'),
    (9, 'large egg'),
    (10, 'teaspoon dried Italian seasoning');
-- --------------------------------------------------------
--
-- Table structure for table `picture_table`
--
CREATE TABLE `picture_table` (
    `id` int(11) NOT NULL,
    `recipe_id` int(11) NOT NULL,
    `file` text
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data for table `picture_table`
--
INSERT INTO `picture_table` (`id`, `recipe_id`, `file`)
VALUES (1, 1, './images/sample.jpeg'),
    (2, 1, './images/sample.jpeg'),
    (3, 1, './images/sample.jpeg');
-- --------------------------------------------------------
--
-- Table structure for table `recipe_ingredients_list`
--
CREATE TABLE `recipe_ingredients_list` (
    `id` int(11) NOT NULL,
    `recipe_id` int(11) NOT NULL,
    `ingredient_id` int(11) NOT NULL,
    `amount` decimal(5, 2) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data for table `recipe_ingredients_list`
--
INSERT INTO `recipe_ingredients_list` (`id`, `recipe_id`, `ingredient_id`, `amount`)
VALUES (1, 1, 1, '1.00'),
    (2, 1, 2, '6.00'),
    (3, 1, 3, '0.75'),
    (4, 1, 4, '1.00'),
    (5, 1, 5, '0.50'),
    (6, 1, 6, '2.00'),
    (7, 1, 7, '0.50'),
    (8, 1, 8, '0.75'),
    (9, 1, 9, '1.00'),
    (10, 1, 10, '1.00');
-- --------------------------------------------------------
--
-- Table structure for table `recipe_table`
--
CREATE TABLE `recipe_table` (
    `id` int(11) NOT NULL,
    `recipe_name` varchar(256) NOT NULL,
    `rating` int(11) NOT NULL,
    `description` text,
    `timeToCook` int(11) DEFAULT NULL,
    `timeToPrep` int(11) DEFAULT NULL,
    `serving` int(11) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data for table `recipe_table`
--
INSERT INTO `recipe_table` (
        `id`,
        `recipe_name`,
        `rating`,
        `description`,
        `timeToCook`,
        `timeToPrep`,
        `serving`
    )
VALUES (
        1,
        'White calzones with marinara sauce',
        3,
        'Supermarket brands of ricotta contain stabilizers, which can give the cheese a gummy texture when baked. Check the label and choose ricotta made with as few ingredients as possible.',
        20,
        30,
        4
    );
-- --------------------------------------------------------
--
-- Table structure for table `steps_table`
--
CREATE TABLE `steps_table` (
    `id` int(11) NOT NULL,
    `recipe_id` int(11) NOT NULL,
    `stepTxt` text
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data for table `steps_table`
--
INSERT INTO `steps_table` (`id`, `recipe_id`, `stepTxt`)
VALUES (1, 1, 'step1'),
    (2, 1, 'step2'),
    (3, 1, 'step3'),
    (4, 1, 'step4'),
    (5, 1, 'step5');
-- --------------------------------------------------------
--
-- Table structure for table `tags_table`
--
CREATE TABLE `tags_table` (
    `id` int(11) NOT NULL,
    `recipe_id` int(11) NOT NULL,
    `tag` varchar(256) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Dumping data for table `tags_table`
--
INSERT INTO `tags_table` (`id`, `recipe_id`, `tag`)
VALUES (1, 1, 'Dinner'),
    (2, 1, 'Casserole'),
    (3, 1, 'Meat'),
    (4, 1, 'Party');
--
-- Indexes for dumped tables
--
--
-- Indexes for table `ingredient_table`
--
ALTER TABLE `ingredient_table`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `picture_table`
--
ALTER TABLE `picture_table`
ADD PRIMARY KEY (`id`),
    ADD KEY `recipe_id` (`recipe_id`);
--
-- Indexes for table `recipe_ingredients_list`
--
ALTER TABLE `recipe_ingredients_list`
ADD PRIMARY KEY (`id`),
    ADD KEY `recipe_id` (`recipe_id`),
    ADD KEY `ingredient_id` (`ingredient_id`);
--
-- Indexes for table `recipe_table`
--
ALTER TABLE `recipe_table`
ADD PRIMARY KEY (`id`);
--
-- Indexes for table `steps_table`
--
ALTER TABLE `steps_table`
ADD PRIMARY KEY (`id`),
    ADD KEY `recipe_id` (`recipe_id`);
--
-- Indexes for table `tags_table`
--
ALTER TABLE `tags_table`
ADD PRIMARY KEY (`id`),
    ADD KEY `recipe_id` (`recipe_id`);
--
-- Constraints for dumped tables
--
--
-- Constraints for table `picture_table`
--
ALTER TABLE `picture_table`
ADD CONSTRAINT `picture_table_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe_table` (`id`);
--
-- Constraints for table `recipe_ingredients_list`
--
ALTER TABLE `recipe_ingredients_list`
ADD CONSTRAINT `recipe_ingredients_list_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe_table` (`id`),
    ADD CONSTRAINT `recipe_ingredients_list_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient_table` (`id`);
--
-- Constraints for table `steps_table`
--
ALTER TABLE `steps_table`
ADD CONSTRAINT `steps_table_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe_table` (`id`);
--
-- Constraints for table `tags_table`
--
ALTER TABLE `tags_table`
ADD CONSTRAINT `tags_table_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe_table` (`id`);