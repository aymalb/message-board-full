<?php

function findUser($username) {
    $pdo = new PDO('mysql:host=localhost;dbname=mb; charset=utf8', 'homestead', 'secret');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM `users` WHERE `name` = :username';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();

    return $stmt->fetchAll();
}

function register($username, $password) {
    $pdo = new PDO('mysql:host=localhost;dbname=mb; charset=utf8', 'homestead', 'secret');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'INSERT INTO `users` SET
            `name` = :username,
            `password` = :password';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));

    $stmt->execute();
}

function login($username, $password) {
    $pdo = new PDO('mysql:host=localhost;dbname=mb; charset=utf8', 'homestead', 'secret');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM `users` WHERE `name` = :username';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch();

    if (password_verify($password, $user['password'])) {
        return true;
    } else {
        return false;
    }
}