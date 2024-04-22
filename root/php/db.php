<?

    include "config.php";

    $db = new mysqli($host, $username, $password, $db);

    if($db->connect_error)
    {
        header("Location: ../pages/error.html");
    }

?>