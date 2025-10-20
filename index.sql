CREATE DATABASE IF NOT EXISTS bronxscience;
USE bronxscience;

-- USERS TABLE
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  profile_pic VARCHAR(255) DEFAULT 'images/default.jpeg',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Default admin user
INSERT INTO users (username, email, password)
VALUES ('admin1', 'admin@bxscience.edu', '123456');

-- ARTICLES TABLE
CREATE TABLE IF NOT EXISTS articles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  author VARCHAR(255),
  content TEXT,
  image VARCHAR(255),
  slot INT UNIQUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Check users
SELECT * FROM users;
