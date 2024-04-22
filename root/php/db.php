<?php
    require_once "config.php";

    $db = new mysqli($host, $username, $password, $database);

    if($db->connect_error){
        die("ERROR:".$db->connect_error); 
    }

?>