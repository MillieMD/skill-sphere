
<html>


<body>
<?php 

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
    //step-by-step:
    //1. connect to database
    //2. add user to the database with the data provided
    //3. send user a confirmation email
    //4. inform the user they must click the confirmation link

    //keep the login credentials the same, please dont steal my data lol

    //step 1
    
    $servername = "localhost"; 
    $username = "u2265397"; 
    $password = "JK22feb04jk";
    $dbname = "u2265397";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
    debug_to_console("Connection failed: " . $conn->connect_error);
    }

    //step 2
    debug_to_console("we in");

    $userName = "test";//$_GET['userName'];
    $passWord = "test";//$_GET['passWord'];
    $email = "test";//$_GET['email'];
    $date = "2222-22-22";//$_GET['date'];

    //run password hashing script here

     mysqli_query($conn, "INSERT INTO users VALUES (".$userName.",".$passWord.",".$email.",".0.",".0.",".$date.")");


    
    
?>
<body>
</html>
        
