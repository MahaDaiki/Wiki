DROP DATABASE wiki;
CREATE DATABASE wiki;
Use wiki;


create table Users(
user_id INT  PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE ,
    password VARCHAR(255) NOT NULL,
    role ENUM('auteur', 'admin') NOT NULL
    

);


CREATE TABLE categories (
    cat_id PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(50) UNIQUE,
    cat_date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tags (
    tag_id int Primary key AUTO_INCREMENT,
    tag VARCHAR(50) UNIQUE 
);


CREATE TABLE wikis (
    wiki_id INT  PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    category_id INT,
    title VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    archived BOOLEAN DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
);


CREATE TABLE wiki_tags (
    wiki_id INT,
    tag_id INT,
    PRIMARY KEY (wiki_id, tag_id),
    FOREIGN KEY (wiki_id) REFERENCES wikis(wiki_id),
    FOREIGN KEY (tag_id) REFERENCES tags(tag_id)
);
