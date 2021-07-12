<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Message Board</title>
</head>
<body>

<h1><a href="index.php">Message board</a></h1>

<section id="posts">

<?php



try {

    if (isset($_POST['posttext'])) {
        $pdo = new PDO('mysql:host=localhost;dbname=mb; charset=utf8', 'homestead', 'secret');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'INSERT INTO `posts` SET
                `posttext` = :posttext,
                `postdate` = NOW()';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':posttext', $_POST['posttext']);
        $stmt->execute();

        header('location:index.php');
    }

    $pdo = new PDO('mysql:host=localhost;dbname=mb; charset=utf8', 'homestead', 'secret');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM `posts`';

    $posts = $pdo->query($sql)->fetchAll();

    foreach($posts as $post) {
        echo '<article class="post"><div class="post-text">' . $post['posttext'] . '</div>' .
        '<div class="post-date">Posted on ' . $post['postdate'] . '</div>' . '</article>';
    }

} catch (PDOException $e) {
    echo 'An error has occured: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
}

?>

</section>

<form action="" method="post">

<label for="posttext" class="form-el">Enter your post here:</label>
<textarea name="posttext" id="posttext" class="form-el" cols="40" rows="5"></textarea>

<input type="submit" value="Submit" class="form-el">

</form>

</body>
</html>