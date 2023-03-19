CREATE TABLE directory (
                           id INT PRIMARY KEY,
                           parent_id INT,
                           name VARCHAR(255)
);

INSERT INTO directory (id, parent_id, name)
VALUES
    (1, NULL, 'Root'),
    (2, 1, 'Dir1'),
    (3, 1, 'Dir2'),
    (4, 2, 'Dir1.1'),
    (5, 2, 'Dir1.2'),
    (6, 4, 'Dir1.1.1'),
    (7, 4, 'Dir1.1.2'),
    (8, 5, 'Dir1.2.1'),
    (9, 3, 'Dir2.1'),
    (10, 3, 'Dir2.2');
