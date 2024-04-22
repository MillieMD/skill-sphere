<?php

    include "db.php";

    function retrieveReviews($course_id, $limit)
    {
        
        $sql = $db->prepare("SELECT users.username as username, reviews.rating, reviews.content FROM reviews JOIN users ON (reviews.user_id = users.user_id) WHERE course_id = ? LIMIT ?;");
        $sql->bind_param("ii", $course_id, $limit);
        $sql->execute();

        var_dump($sql->get_results());

        return $reviews;
    }

?>