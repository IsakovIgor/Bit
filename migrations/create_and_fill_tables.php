<?php

require_once __DIR__ . '/../bootstrap/environment.php';

$db = $_ENV['database'];

try {
    $pdo = new \PDO(
        "{$db['type']}:host={$db['host']};port={$db['port']};dbname={$db['name']}",
        $db['login'],
        $db['password']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($db['type'] === 'pgsql') {
        $pdo->exec('CREATE TABLE IF NOT EXISTS users (
            id SERIAL PRIMARY KEY,
            email VARCHAR(255) UNIQUE,
            password VARCHAR(255)
        )');

        $pdo->exec('CREATE TABLE IF NOT EXISTS accounts (
            id SERIAL PRIMARY KEY,
            balance DOUBLE PRECISION,
            user_id INTEGER REFERENCES users (id)
        )');

        $pdo->exec('INSERT INTO users (id, email, password)
                            VALUES (1, \'test@test.ru\', \'' . \password_hash('test', PASSWORD_BCRYPT) . '\')');

        $pdo->exec('INSERT INTO accounts (id, balance, user_id) VALUES (1, 1000, 1)');
    }

    if ($db['type'] === 'mysql') {
        $pdo->exec('CREATE TABLE IF NOT EXISTS users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) UNIQUE,
            password VARCHAR(255)
        )');

        $pdo->exec('CREATE TABLE IF NOT EXISTS account (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            balance DOUBLE PRECISION,
            user_id INT(6) UNSIGNED,
            FOREIGN KEY (user_id) REFERENCES users(id)
        )');

        $pdo->exec('INSERT INTO users (id, email, password)
                            VALUES (1, \'test@test.ru\', \'' . \password_hash('test', PASSWORD_BCRYPT) . '\')');

        $pdo->exec('INSERT INTO accounts (id, balance, user_id) VALUES (1, 1000, 1)');
    }

} catch (\PDOException $e) {
    var_dump($e->getMessage());
}
