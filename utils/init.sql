DROP DATABASE IF EXISTS ITEC327_TermProject;
CREATE DATABASE ITEC327_TermProject;
USE ITEC327_TermProject;
CREATE TABLE ingredient_table (
    id INT NOT NULL PRIMARY KEY,
    ingredient_name VARCHAR(256)
);
CREATE TABLE recipe_table (
    id INT NOT NULL PRIMARY KEY,
    recipe_name VARCHAR(256) NOT NULL,
    rating INT NOT NULL,
    recipe_desc TEXT,
    timeToCook INT,
    timeToPrep INT,
    serving INT
);
CREATE TABLE steps_table(
    id INT NOT NULL PRIMARY KEY,
    recipe_id INT NOT NULL,
    stepTxt TEXT,
    FOREIGN KEY (recipe_id) REFERENCES recipe_table(id)
);
CREATE TABLE tags_table(
    id INT NOT NULL PRIMARY KEY,
    recipe_id INT NOT NULL,
    tag varchar(256),
    FOREIGN KEY (recipe_id) REFERENCES recipe_table(id)
);
CREATE TABLE picture_table (
    id INT NOT NULL PRIMARY KEY,
    recipe_id INT NOT NULL,
    file_url TEXT,
    FOREIGN KEY (recipe_id) REFERENCES recipe_table(id)
);
CREATE TABLE recipe_ingredients_list (
    id INT NOT NULL PRIMARY KEY,
    recipe_id INT NOT NULL,
    ingredient_id INT NOT NULL,
    ingredient_desc VARCHAR(256),
    amount DECIMAL(5, 2),
    FOREIGN KEY (recipe_id) REFERENCES recipe_table(id),
    FOREIGN KEY (ingredient_id) REFERENCES ingredient_table(id)
);
-- INSERT STATEMENTS
INSERT INTO ingredient_table (id, ingredient_name)
VALUES (1, "pound fresh prepared pizza dough"),
    (2, "ounces shredded mozzarella cheese"),
    (3, "cup of ricotta cheese"),
    (4, "large egg yolk"),
    (5, "teaspoon lemon zest"),
    (6, "finely grated garlic cloves"),
    (7, "teaspoon kosher salt"),
    (8, "teaspoon black pepper"),
    (9, "large egg"),
    (10, "teaspoon dried Italian seasoning");
INSERT INTO recipe_table (
        id,
        recipe_name,
        rating,
        recipe_desc,
        timeToCook,
        timeToPrep,
        serving
    )
VALUES (
        1,
        'White calzones with marinara sauce',
        3,
        "Supermarket brands of ricotta contain stabilizers, which can give the cheese a gummy texture when baked. Check the label and choose ricotta made with as few ingredients as possible.",
        20,
        30,
        4
    );
INSERT INTO tags_table (id, recipe_id, tag)
VALUES (1, 1, "Dinner"),
    (2, 1, "Casserole"),
    (3, 1, "Meat"),
    (4, 1, "Party");
INSERT INTO steps_table (id, recipe_id, stepTxt)
VALUES (1, 1, 'step1'),
    (2, 1, 'step2'),
    (3, 1, 'step3'),
    (4, 1, 'step4'),
    (5, 1, 'step5');
INSERT INTO recipe_ingredients_list (id, recipe_id, ingredient_id, amount)
VALUES (1, 1, 1, 1),
    (2, 1, 2, 6),
    (3, 1, 3, 0.75),
    (4, 1, 4, 1),
    (5, 1, 5, 0.5),
    (6, 1, 6, 2),
    (7, 1, 7, 0.5),
    (8, 1, 8, 0.75),
    (9, 1, 9, 1),
    (10, 1, 10, 1);
INSERT INTO picture_table(id, recipe_id, file_url)
VALUES (1, 1, "./images/sample.jpeg"),
    (2, 1, "./images/sample.jpeg"),
    (3, 1, "./images/sample.jpeg");