use e1kh0ddh49syn5j4;

CREATE TABLE users (
    userID INT PRIMARY KEY AUTO_INCREMENT,
    user_email VARCHAR(120) NOT NULL,
    user_name VARCHAR(120) NOT NULL UNIQUE,
    user_password VARCHAR(80) NOT NULL
);

CREATE TABLE recipes (
    recipeID INT PRIMARY KEY AUTO_INCREMENT,
    userID INT,
    FOREIGN KEY (userID) REFERENCES users(userID),
    title VARCHAR(140) NOT NULL,
    cook_time INT NOT NULL,
    serving_size INT NOT NULL,
    ingredients VARCHAR(600) NOT NULL,
    instructions VARCHAR(1000) NOT NULL,
    image_url VARCHAR(200) NOT NULL
);

CREATE TABLE favorites (
    userID INT,
    recipeID INT,
    PRIMARY KEY (userID, recipeID),
    FOREIGN KEY (userID) REFERENCES users(userID),
    FOREIGN KEY (recipeID) REFERENCES recipes(recipeID)
);

CREATE TABLE tags(
recipeIDtagged INT NOT NULL,
meal ENUM('breakfast', 'lunch', 'dinner', 'dessert') NOT NULL,
difficulty ENUM('easy', 'intermediate', 'hard') NOT NULL,
FOREIGN KEY (recipeIDtagged) REFERENCES recipes(recipeID)
);

-- Additional tables and features can be added as needed.



