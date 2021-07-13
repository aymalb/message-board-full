<section id="posts">

<?php



try {

    if (isset($_POST['posttext'])) {
        $pdo = new PDO('mysql:host=localhost;dbname=mb; charset=utf8', 'homestead', 'secret');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'INSERT INTO `posts` SET
                `posttext` = :posttext,
                `postdate` = NOW(),
                `username` = :username';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':posttext', $_POST['posttext']);
        $stmt->bindValue(':username', $_COOKIE['username']);
        $stmt->execute();

        header('location:index.php');
    }

    $pdo = new PDO('mysql:host=localhost;dbname=mb; charset=utf8', 'homestead', 'secret');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM `posts`';

    $posts = $pdo->query($sql)->fetchAll();

    foreach($posts as $post) {
        echo '<article class="post"><div class="post-text">' . $post['posttext'] . '</div>' .
        '<div class="post-date">Posted on ' . $post['postdate'] . ' by ' . $post['username'] . '</div>' . '</article>';
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

<form action="" method="post">

<input type="hidden" name="logout" value="true">

<input type="submit" value="Log out" class="form-el">

</form>