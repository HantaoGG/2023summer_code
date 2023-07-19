use blog;
create table users(
    id INT(10) AUTO_INCREMENT PRIMARY KEY, 
    user VARCHAR(100),
    pwd VARCHAR(100), 
    name VARCHAR(20), 
    email VARCHAR(50));


create table articles( 
    id INT(10) AUTO_INCREMENT PRIMARY KEY, 
    title VARCHAR(50) NOT NULL, 
    author VARCHAR(50), 
    content VARCHAR(500));