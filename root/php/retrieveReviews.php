<?php

    require_once "db.php";

    $NUM_REVIEWS = 3;
    $course_id = 0;

    $sql = $db->prepare("SELECT users.username as username, reviews.rating as rating, reviews.content as content FROM reviews JOIN users ON (reviews.user_id = users.user_id) WHERE course_id = ? LIMIT ?;");
    $sql->bind_param("ii", $course_id, $NUM_REVIEWS);
    $sql->execute();

    $reviews = $sql->get_result();

    if($result === FALSE)
    {
        header("Location: ../pages/error.html");
        exit;
    }




?>