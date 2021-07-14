<?php

function findUser($username) {
    include __DIR__ . '/../includes/connection.php';

    $sql = 'SELECT * FROM `users` WHERE `name` = :username';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();

    return $stmt->fetchAll();
}

function register($username, $password) {
    include __DIR__ . '/../includes/connection.php';

    $sql = 'INSERT INTO `users` SET
            `name` = :username,
            `password` = :password';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));

    $stmt->execute();
}

function login($username, $password) {
    include __DIR__ . '/../includes/connection.php';

    $sql = 'SELECT * FROM `users` WHERE `name` = :username';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch();

    if (password_verify($password, $user['password']) || hash_equals($user['password'], $password) {
        return true;
    } else {
        return false;
    }
}