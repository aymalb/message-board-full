<?php
$pdo = new PDO('mysql:host=localhost;dbname=mb; charset=utf8', 'homestead', 'secret');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);