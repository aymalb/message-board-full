<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-login.css">
    <title>Message Board</title>
</head>
<body>
<header>
<h1><a href="index.php">Message board</a></h1>
</header>

<main>

<?php

include __DIR__ . '/../includes/functions.php';

try {

    if (isset($_POST['logout'])) {
        setcookie('username');
        setcookie('password');
        header('location:index.php');
    }


    if (isset($_POST['reg-log'])) {
        switch($_POST['reg-log']) {
            case 'reg':
                if (isset($_POST['user']['name']) && $_POST['user']['password'] != '' && count(findUser($_POST['user']['name'])) < 1) {
                    register($_POST['user']['name'], $_POST['user']['password']);
                    echo 'Registration successful!';
                    unset($_POST);
                } else {
                    echo 'Could not register: input missing or username unavailable or invalid';
                    unset($_POST);
                }
                break;
            
            case 'log':
                if (isset($_POST['user']['name']) && isset($_POST['user']['password']) &&
                count(findUser($_POST['user']['name'])) == 1 && login($_POST['user']['name'], $_POST['user']['password'])) {
                    setcookie('username', $_POST['user']['name'], time() + 3600 * 24 * 365);
                    setcookie('password', findUser($_POST['user']['name'])[0]['password'], time() + 3600 * 24 * 365);
                    header('location:index.php');
                } else {
                    echo 'Could not log in';
                }
                break;
        }
    }

    if (isset($_COOKIE['username']) && isset($_COOKIE['password']) && login($_COOKIE['username'], $_COOKIE['password'])) {
        include __DIR__ . '/../includes/main.html.php';
    } else {
        include __DIR__ . '/../includes/login.html.php';
    }


} catch (PDOException $e) {
    echo 'An error has occured: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}

?>
</main>


</body>
</html>