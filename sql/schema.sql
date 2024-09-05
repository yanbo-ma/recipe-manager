-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS recipe_manager;

-- Grant usage and all privileges on the database to the root user
GRANT USAGE ON *.* TO 'root'@'localhost';
GRANT ALL PRIVILEGES ON recipe_manager.* TO 'root'@'localhost';
FLUSH PRIVILEGES;

-- Use the newly created database
USE recipe_manager;

USE recipe_manager;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS recipes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    total_time INT NOT NULL,
    cuisine VARCHAR(50) NOT NULL,
    dietary_preference VARCHAR(50),
    ingredients TEXT NOT NULL,
    steps TEXT NOT NULL,
    image VARCHAR(255),
    created_by INT,
    FOREIGN KEY (created_by) REFERENCES users(id)
);
