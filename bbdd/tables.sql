-- Base de datos: 'task_manager'

-- Creación de las tablas 
DROP TABLE IF EXISTS task_manager.tasks;
CREATE TABLE task_manager.tasks(
    id_task INT NOT NULL AUTO_INCREMENT,
    task_description VARCHAR(255) NOT NULL,
    PRIMARY KEY(id_task)
) ENGINE = INNODB;

INSERT INTO task_manager.tasks
VALUES(1, 'Generar un desplegable'),(2, 'Buscador'),(3, 'Navbar dinámica'), (4, 'Crear página de e-commerce'), (5, 'Menú lateral');

DROP TABLE IF EXISTS task_manager.categories;
CREATE TABLE task_manager.categories(
    id_category INT NOT NULL AUTO_INCREMENT,
    category_name VARCHAR(255) NOT NULL,
    PRIMARY KEY(id_category)
) ENGINE = INNODB;

INSERT INTO task_manager.categories
VALUES(1, 'PHP'),(2, 'Javascript'),(3, 'CSS');

DROP TABLE IF EXISTS task_manager.new_task;
CREATE TABLE task_manager.new_task(
    id_new_task INT NOT NULL,
    id_category INT NOT NULL,
    PRIMARY KEY(id_new_task, id_category),
    FOREIGN KEY (id_new_task) REFERENCES task_manager.tasks (id_task) ON DELETE CASCADE,
    FOREIGN KEY (id_category) REFERENCES task_manager.categories (id_category) ON DELETE CASCADE
) ENGINE = INNODB;  

INSERT INTO task_manager.new_task
VALUES (1, 2), (1, 3), (2, 2), (3, 2), (3, 3);

/*
#1452 - Cannot add or update a child row: a foreign key constraint fails (`task_manager`.`new_task`, CONSTRAINT `new_task_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`))
new_task_ibfk_2
*/

