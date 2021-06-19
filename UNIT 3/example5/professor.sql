/**
 * 1.Crear una tabla PROFESSOR en la base de datos EXAMPLE3 con sus atributos
 *
 * creation of the Professor table with its attributes
 */
USE example3;

CREATE TABLE professor
(
    id INTEGER NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50),
    city VARCHAR(50) NOT NULL,
    years_experience INTEGER NOT NULL,
    salary DECIMAL(10,2) NOT NULL,
    PRIMARY KEY(id)
)
ENGINE InnoDB;