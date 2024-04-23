<?php

    require_once 'db.php';

    // If user has already reviewed, it updates their old review - prevents spam
    // This is only accessible by logged in users so we can assume $_COOKIE["id"] is set
    $sql = $db->prepare('REPLACE INTO reviews(user_id, course_id, rating, content) VALUES(?, ?, ?, ?);');
    $sql->bind_param('ssis', $_COOKIE['id'], $_POST['course_id'], $_POST['rate'], $_POST['comment']);
    $sql->execute();

    header('Location: ../pages/course.php');
    exit;
