CREATE TABLE student
(
    id INTEGER NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50),
    city VARCHAR(50) NOT NULL,
    semester INTEGER NOT NULL,
    PRIMARY KEY(id)
)
ENGINE InnoDB;