<?php
 $servername = "localhost"; 
 $username = "u2265397"; 
 $password = "JK22feb04jk";
 $dbname = "u2265397";
 $conn = new mysqli($servername, $username, $password, $dbname);
 if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 echo "<br>";
 }

/*  Creates a quiz, quiz_id auto increments 
    so only quiz name needs to be provided as a paramater
    ids for questions and answers tables also auto increment
*/
 function createQuiz($quiz_name, $conn) {
    $sql = "INSERT INTO quiz (quiz_name) 
    VALUES ('$quiz_name')";
    $conn->query($sql);
 }

 function createQuestion($quizId, $questionText, $conn) {
    $sql = "INSERT INTO questions (quiz_id, question_text) 
    VALUES ($quizId, '$questionText')";
    $conn->query($sql);
 }

function createAnswer ($questionId, $answerText, $conn) {
    $sql = "INSERT INTO answers (question_id, answer_text)
    VALUES ($questionId, '$answerText')";
    $conn->query($sql);
}

/*  This creates a question and uses its question_id as a foreign key for its answer
    use this method to create questions and answers 
    because it ensures that a question points to its answer
*/
function createQuestionAndAnswer($quizId, $questionText, $answerText, $conn) {
    createQuestion($quizId, $questionText, $conn);
    $last_id = $conn->insert_id;
    createAnswer($last_id, $answerText, $conn);
    $last_idAnswer = $conn->insert_id;
    $sql = "UPDATE questions SET answer_id = $last_idAnswer WHERE question_id = $last_id";
    $conn->query($sql);
}
?>