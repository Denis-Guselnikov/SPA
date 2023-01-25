CREATE TABLE users
(
    id            INT(11) PRIMARY KEY AUTO_INCREMENT,
    username      VARCHAR(255),
    password_hash VARCHAR(255)
);

INSERT INTO users (username, password_hash)
VALUES ('test', '$wejulsdujilejwq93249jwfj90231wj');

CREATE TABLE operation
(
    id        INT(11) PRIMARY KEY AUTO_INCREMENT,
    user_id   INT(11),
    is_income BOOL,
    amount    FLOAT(10, 2),
    comments  TEXT
);

INSERT INTO operation (user_id, is_income, amount, comments)
VALUES ('1', true, 400, 'Test1 Income'),
       ('1', true, 400.20, 'Test2 Income'),
       ('1', false, 300, 'Test3 Expenses'),
       ('1', false, 150.50, 'Test4 Expenses');
