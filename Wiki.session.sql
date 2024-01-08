CREATE DATABASE wiki;
Use wiki;


create table Users(
user_id INT  PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('auteur', 'admin') NOT NULL

);


CREATE TABLE categories (
    category_name VARCHAR(50) PRIMARY KEY
);

CREATE TABLE tags (
    tag VARCHAR(50) PRIMARY KEY
);


CREATE TABLE wikis (
    wiki_id INT  PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    category_name VARCHAR(225),
    title VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    archived BOOLEAN DEFAULT 1,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (category_name) REFERENCES categories(category_name)
);


CREATE TABLE wiki_tags (
    wiki_id INT,
    tag varchar(50),
    PRIMARY KEY (wiki_id, tag),
    FOREIGN KEY (wiki_id) REFERENCES wikis(wiki_id),
    FOREIGN KEY (tag) REFERENCES tags(tag)
);
