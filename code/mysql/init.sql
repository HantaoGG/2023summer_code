CREATE SCHEMA IF NOT EXISTS blog;
use blog;
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT(10) AUTO_INCREMENT PRIMARY KEY, 
    user VARCHAR(100) UNIQUE,
    pwd VARCHAR(100), 
    name VARCHAR(20), 
    email VARCHAR(50)
);
DROP TABLE IF EXISTS articles;
create table articles( 
    id INT(10) AUTO_INCREMENT PRIMARY KEY, 
    title VARCHAR(50) NOT NULL, 
    author VARCHAR(50), 
    content VARCHAR(500));

