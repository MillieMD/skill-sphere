<?php

    require "db.php";

    $sql = $db->prepare("INSERT 
                        INTO userEnrolled (user_id, course_id, date_enrolled)
                        VALUES(? ? CURDATE());");
    $sql->bind_param("ii", $_POST["user_id"], $_POST["course_id"]);
    $sql->execute();

    header("Location: ../pages/course.php?course=".$_POST["course_id"]);

?>