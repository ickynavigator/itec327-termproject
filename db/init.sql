DROP DATABASE IF EXISTS ITEC327_TermProject;
CREATE DATABASE ITEC327_TermProject;
USE ITEC327_TermProject;
-- CREATE TABLE class (
--     id INT NOT NULL PRIMARY KEY,
--     class_name VARCHAR(256)
-- );
-- CREATE TABLE ingredients (
--     id INT NOT NULL PRIMARY KEY,
--     ingredient_name VARCHAR(256)
-- );
CREATE TABLE recipes (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(256) NOT NULL,
    rating INT NOT NULL,
    description TEXT,
    timeToCook INT,
    timeToPrep INT,
    serving INT,
    image_url TEXT,
    steps JSON,
    tags JSON,
    ingredients JSON,
    class VARCHAR(256)
);
-- CREATE TABLE steps(
--     id INT NOT NULL PRIMARY KEY,
--     id_recipe INT NOT NULL,
--     stepTxt TEXT,
--     FOREIGN KEY (id_recipe) REFERENCES recipe (id)
-- );
-- CREATE TABLE tags(
--     id INT NOT NULL PRIMARY KEY,
--     id_recipe INT NOT NULL,
--     tag varchar(256),
--     FOREIGN KEY (id_recipe) REFERENCES recipe (id)
-- );
-- CREATE TABLE picture (
--     id INT NOT NULL PRIMARY KEY,
--     id_recipe INT NOT NULL,
--     file_url TEXT,
--     FOREIGN KEY (id_recipe) REFERENCES recipe (id)
-- );
-- CREATE TABLE recipe_ingredients (
--     id INT NOT NULL PRIMARY KEY,
--     id_recipe INT NOT NULL,
--     id_ingredient INT NOT NULL,
--     ingredient_desc VARCHAR(256),
--     amount DECIMAL(5, 2),
--     FOREIGN KEY (id_recipe) REFERENCES recipe (id),
--     FOREIGN KEY (id_ingredient) REFERENCES ingredient (id)
-- );
-- CREATE TABLE recipe_class (
--     id INT NOT NULL PRIMARY KEY,
--     id_recipe INT NOT NULL,
--     id_class INT NOT NULL,
--     FOREIGN KEY (id_recipe) REFERENCES recipe (id),
--     FOREIGN KEY (id_class) REFERENCES class (id)
-- );
-- INSERT STATEMENTS
-- INSERT INTO ingredient (id, ingredient_name)
-- VALUES (1, "pizza dough"),
--     (2, "mozzarella cheese"),
--     (3, "ricotta cheese"),
--     (4, "egg yolk"),
--     (5, "lemon zest"),
--     (6, "garlic cloves"),
--     (7, "kosher salt"),
--     (8, "black pepper"),
--     (9, "egg"),
--     (10, "Italian seasoning");
-- INSERT INTO recipe (
--         id,
--         name,
--         rating,
--         description,
--         timeToCook,
--         timeToPrep,
--         serving
--     )
-- VALUES (
--         1,
--         'White calzones with marinara sauce',
--         3,
--         "Supermarket brands of ricotta contain stabilizers, which can give the cheese a gummy texture when baked. Check the label and choose ricotta made with as few ingredients as possible.",
--         20,
--         30,
--         4
--     );
-- INSERT INTO tags (id, id_recipe, tag)
-- VALUES (1, 1, "Dinner"),
--     (2, 1, "Casserole"),
--     (3, 1, "Meat"),
--     (4, 1, "Party");
-- INSERT INTO steps (id, id_recipe, stepTxt)
-- VALUES (1, 1, 'step1'),
--     (2, 1, 'step2'),
--     (3, 1, 'step3'),
--     (4, 1, 'step4'),
--     (5, 1, 'step5');
-- INSERT INTO recipe_ingredients (
--         id,
--         id_recipe,
--         id_ingredient,
--         ingredient_desc,
--         amount
--     )
-- VALUES (1, 1, 1, "pound fresh prepared", 1),
--     (2, 1, 2, "ounces shredded ", 6),
--     (3, 1, 3, "cup of", 0.75),
--     (4, 1, 4, "large", 1),
--     (5, 1, 5, "teaspoon", 0.5),
--     (6, 1, 6, "finely grated", 2),
--     (7, 1, 7, "teaspoon", 0.5),
--     (8, 1, 8, "teaspoon", 0.75),
--     (9, 1, 9, "large", 1),
--     (10, 1, 10, "teaspoon dried", 1);
-- INSERT INTO picture(id, id_recipe, file_url)
-- VALUES (1, 1, "./images/sample.jpeg"),
--     (2, 1, "./images/sample.jpeg"),
--     (3, 1, "./images/sample.jpeg");
-- -- make a class insert
-- Insert statements