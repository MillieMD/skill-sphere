<script type="text/javascript" src="../js/cookieControl.js"></script>
<?php

    include "db.php";

    $userName = $_POST['userName'];
    $passWord = $_POST['passWord'];

    //first we make sure the user exists
    //then we compare the inputted password with the stored password
    //if everythings good, we set a cookie as "logged in", and redirect to the profile page

    $existCheck = mysqli_query($db, "SELECT * FROM users WHERE username = '".$userName."'");
    if($existCheck != null){
        $user = mysqli_fetch_row($existCheck);
        if($user[1] == $passWord){
            //set logged in as true and redirect to profile page


            setcookie("Username", $userName, 0, "/");
            setcookie("Email", $user[2], 0, "/");
            setcookie("Joindate", $user[5], 0, "/");
            setcookie("id", $user[6], 0, "/");
            
        }else{
            //failed to log in due to wrong password
            echo "Please check your details and re-enter";
        }
    }else{
        //failed to log in due to not existing
        echo "Please check your details and re-enter";
    }
?>
