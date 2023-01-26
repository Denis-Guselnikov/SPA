CREATE TABLE users
(
    id            INT(11) PRIMARY KEY AUTO_INCREMENT,
    username      VARCHAR(255),
    password_hash VARCHAR(255)
);

INSERT INTO users (username, password_hash)
VALUES ('denis', '$wejulsdujilejwq93249jwfj90231wj');

CREATE TABLE operation
(
    id        INT(11) PRIMARY KEY AUTO_INCREMENT,
    user_id   INT(11),
    status set('income','expense'),
    amount    FLOAT(10, 2),
    description  TEXT
);

INSERT INTO operation (user_id, status, amount, description)
VALUES ('1', 'income', 400, 'Test1 Income'),
       ('1', 'income', 400.20, 'Test2 Income'),
       ('1', 'expense', 300, 'Test3 Expenses'),
       ('1', 'expense', 150.50, 'Test4 Expenses');
