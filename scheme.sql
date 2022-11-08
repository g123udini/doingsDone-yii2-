CREATE DATABASE doings_done
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE doings_done;

CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    email VARCHAR(128) NOT NULL,
    password VARCHAR(128) NOT NULL,
    login VARCHAR(128) NOT NULL,
    UNIQUE INDEX UI_email (email)
);

CREATE TABLE task (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(320) NOT NULL,
    project_id INT NOT NULL,
    user_id INT NOT NULL,
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deadline TIMESTAMP,
    status BOOL DEFAULT false,
    FOREIGN KEY (user_id) REFERENCES user (id)
);

CREATE TABLE project (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(320) NOT NULL,
    task_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (task_id) REFERENCES task (id),
    FOREIGN KEY (user_id) REFERENCES user (id)
);

CREATE TABLE file (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(320) NOT NULL,
    task_id INT NOT NULL,
    FOREIGN KEY (task_id) REFERENCES task (id)
)