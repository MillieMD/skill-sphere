<script type="text/javascript" src="../js/cookieControl.js"></script>
<?php 
    //step-by-step:
    //1. connect to database
    //2. add user to the database with the data provided
    //3. send user a confirmation email
    //4. inform the user they must click the confirmation link

    //keep the login credentials the same, please dont steal my data lol
    
    require_once "db.php";
    
    $userName = $_POST['userName'];
    $passWord = $_POST['passWord'];
    $email = $_POST['emailS'];
    $date = $_POST['date'];
    $num = 0;

    $sql="SELECT * FROM users";
    $result = mysqli_query($db, $sql);
    $count = mysqli_num_rows($result);
    

    //run password hashing script here
    mysqli_query($db, "INSERT INTO users VALUES ('".$userName."','".$passWord."','".$email."','".$num."','".$num."',STR_TO_DATE('".$date."','%d/%m/%Y'), STR_TO_DATE('".$date."','%d/%m/%Y'), '".$count."')");
    $existCheck = mysqli_query($db, "SELECT * FROM users WHERE username = '".$userName."'");
    $user = mysqli_fetch_assoc($existCheck);

    echo "LOGGED_IN";
    setcookie("Username", $userName, 0, "/");


    setcookie("Email", $user["email"], 0, "/");
    setcookie("Joindate", $user["joinDate"], 0, "/");
    setcookie("id", $user["id"], 0, "/");


    $db -> close();
    
?>
