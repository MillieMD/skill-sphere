<script type="text/javascript" src="../js/cookieControl.js"></script>
<?php 
    //step-by-step:
    //1. connect to database
    //2. add user to the database with the data provided
    //3. send user a confirmation email
    //4. inform the user they must click the confirmation link

    //keep the login credentials the same, please dont steal my data lol
    $servername = "localhost"; 
    $username = "u2265397"; 
    $password = "JK22feb04jk";
    $dbname = "u2265397";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
    debug_to_console("Connection failed: " . $conn->connect_error);
    }    
    $userName = $_POST['userName'];
    $passWord = $_POST['passWord'];
    $email = $_POST['emailS'];
    $date = $_POST['date'];
    $num = 0;

    //run password hashing script here
    mysqli_query($conn, "INSERT INTO users VALUES ('".$userName."','".$passWord."','".$email."','".$num."','".$num."',STR_TO_DATE('".$date."','%d/%m/%Y'))");
    $existCheck = mysqli_query($conn, "SELECT * FROM users WHERE username = '".$userName."'");
    $user = mysqli_fetch_row($existCheck);
    echo "LOGGED_IN";
    setcookie("Username", $userName, 0, "/");
    setcookie("Email", $user[2], 0, "/");
    setcookie("Joindate", $user[5], 0, "/");
    $conn -> close();


    
    
?>
