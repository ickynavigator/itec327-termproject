DROP TABLE IF EXISTS `recipes`;
CREATE TABLE `recipes` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(256) NOT NULL,
    `description` TEXT,
    `calories` INT,
    `difficulty` INT,
    `rating` INT,
    `timeToPrep` INT,
    `timeToCook` INT,
    `tag` JSON,
    `class` JSON,
    `image` JSON,
    `ingredient` JSON,
    `steps` JSON
);