CREATE DATABASE instagramClone;
use instagramClone;

CREATE TABLE users (
    id int auto_increment not null, 
    name varchar(100),
    surname varchar(100),
    nickname varchar(100),
    email   varchar(255),
    password varchar(255),
    image_path varchar(255),
    created_at datetime,
    updated_at datetime,
    remember_token varchar(255),
    PRIMARY KEY (id)
);

INSERT INTO users VALUES (null, 'Juan', 'Lopez', 'Lopez', 'lopez@gmail.com', '1234', 'picture.jpg', CURTIME(), CURTIME(), null );
INSERT INTO users VALUES (null, 'Manolo', 'Zamiro', 'ZamiroMasNa', 'zamiro@gmail.com', '1234', 'picture.jpg', CURTIME(), CURTIME(), null );
INSERT INTO users VALUES (null, 'Natsu', 'Dragneel', 'Salamander', 'salamander@gmail.com', '1234', 'picture.jpg', CURTIME(), CURTIME(), null );

CREATE TABLE images (
    id int auto_increment not null,
    user_id int not null,
    image_path varchar(255),
    description text,
    created_at datetime,
    updated_at datetime,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO images VALUES (null, 1, 'picture.jpg', 'test', CURTIME(), CURTIME());
INSERT INTO images VALUES (null, 2, 'lopez.jpg', 'test2', CURTIME(), CURTIME());
INSERT INTO images VALUES (null, 3, 'manolo.jpg', 'test3', CURTIME(), CURTIME());
INSERT INTO images VALUES (null, 4, 'sunder.jpg', 'test4', CURTIME(), CURTIME());

CREATE TABLE comments (
    id int auto_increment not null,
    user_id int not null,
    image_id int not null,
    content text,
    created_at datetime,
    updated_at datetime,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (image_id) REFERENCES images(id)
);

INSERT INTO comments  VALUES(null, 1, 2, 'Wow that is a good picture', CURTIME(), CURTIME());
INSERT INTO comments  VALUES(null, 2, 4, 'Wow that is a good picture 2', CURTIME(), CURTIME());
INSERT INTO comments  VALUES(null, 3, 1, 'Wow that is a good picture 3', CURTIME(), CURTIME());
INSERT INTO comments  VALUES(null, 4, 3, 'Wow that is a good picture 4', CURTIME(), CURTIME());

CREATE TABLE likes (
    id int auto_increment not null,
    user_id int not null,
    image_id int not null,
    created_at datetime,
    updated_at datetime, 
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (image_id) REFERENCES images(id)
);

INSERT INTO likes VALUES(null, 1, 2, CURTIME(), CURTIME());
INSERT INTO likes VALUES(null, 2, 3, CURTIME(), CURTIME());
INSERT INTO likes VALUES(null, 3, 2, CURTIME(), CURTIME());
