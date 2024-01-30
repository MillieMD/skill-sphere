<html>
<head>
</head>
<body>
    <?php
    //this block creates the quizzes, each quiz has two tables one containing the questions and one containing the answers


    //keep the login credentials the same, please dont steal my data lol
    //ask me for the password and ill tell you
    $servername = "localhost"; 
    $username = "u2265397"; 
    $password = "";
    $dbname = "u2265397";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    echo "<br>";
    }
    echo "Test quiz creator!";
    echo "this program will create a quiz, and add it to the database as a new table";

    $currentIDs = mysqli_query($conn, "SELECT * FROM dabaseDat");
    $currentIDs = mysqli_fetch_row($currentIDs);

    //creates the quiz table
    //the quiz table stores questions in the quiz, more specifically the ID of each question and the Text of the question
    mysqli_query($conn, "CREATE TABLE quiz".($currentIDs[0] + 1)." ( 
        question_id INT PRIMARY KEY, 
        question_text VARCHAR(255) NOT NULL 
        );");



    //creates the answers table
    //the answers table stores: Answer ID, The Question that its related to's ID, The text of the answer, Its correctness. 
    mysqli_query($conn, "CREATE TABLE answers".($currentIDs[0] + 1)." ( 
        answer_id INT PRIMARY KEY, 
        question_id INT, 
        answer_text VARCHAR(255) NOT NULL, 
        is_correct BOOLEAN, 
        FOREIGN KEY (question_id) REFERENCES quiz".($currentIDs[0] + 1)."(question_id) 
    );");

    //within the table "dabaseDat" there is the row "currentQuizID", this iterates up with each added quiz so that whenever a new quiz is added, its ID will be unique.
    mysqli_query($conn, "UPDATE dabaseDat SET currentQuizID = ".($currentIDs[0] + 1));

    //adding questions and answers will most likely be done through javascript
    //adding questions will be very easy so thats last priority 

    ?>
</body>    
</html>