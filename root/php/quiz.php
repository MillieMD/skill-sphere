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

/*  Creates a quiz, quiz_id auto increments.
    Ids for questions and answers tables also auto increment
    also returns the id of the created quiz.
*/
 function createQuiz($quiz_name, $conn) {
    $sql = "INSERT INTO quiz (quiz_name) 
    VALUES ('$quiz_name')";
    $conn->query($sql);
    $last_id = $conn->insert_id;
    return $last_id;
 }

 function getQuizIdFromName($quizName, $conn) {
    $sql = "SELECT quiz_id FROM quiz WHERE quiz_name = '$quizName' ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row["quiz_id"];
 }
/*
    returns the id of the question that can be used in the createAnswer function.
*/
 function createQuestion($quizId, $questionText, $questionType, $conn) {
    $sql = "INSERT INTO questions (quiz_id, question_text, question_type)
    VALUES ($quizId, '$questionText', '$questionType')";
    $conn->query($sql);
    $last_id = $conn->insert_id;
    return $last_id;
 }

function createAnswer ($questionId, $answerText, $correct, $conn) {
    $sql = "INSERT INTO answers (question_id, answer_text, correct)
    VALUES ($questionId, '$answerText', $correct)";
    return $conn->query($sql);
}

/*  This creates a question and uses its question_id as a foreign key for its answer
    use this method to create questions and answers 
    because it ensures that a question points to its answer
*/
function createQuestionAndAnswer($quizId, $questionType, $questionText, $answerText, $conn) {
    createQuestion($quizId, $questionText, $questionType, $conn);
    $last_id = $conn->insert_id;
    createAnswer($last_id, $answerText, $conn);
    $last_idAnswer = $conn->insert_id;
    $sql = "UPDATE questions SET answer_id = $last_idAnswer WHERE question_id = $last_id";
    $conn->query($sql);
}

/*  Selects all questions that belong to the quiz ID provided.
    returns the IDs of questions in an array
*/
function getQuestions($quizId, $conn) {
    $sql = "SELECT question_id FROM questions WHERE quiz_id = $quizId";
    $result = $conn->query($sql);
    $resultArray = array();
    while ($row = $result -> fetch_assoc()) {
        array_push($resultArray, $row["question_id"]);
    }
    return $resultArray;
}
/*
    returns all answers for the provided question regardless of correctness
    stores results in an array
*/
function getAnswer($questionId, $conn) {
    $sql = "SELECT answer_id FROM answers WHERE question_id = $questionId";
    $result = $conn->query($sql);
    $resultArray = array();
    while ($row = $result -> fetch_assoc()) {
        array_push($resultArray, $row["answer_id"]);
    }
    return $resultArray;
    
}

function checkAnswer($questionId, $conn) {

}

function startQuiz($quizId, $conn) {
    $questions = array();
    $questions = getQuestions($quizId, $conn);

    while ($questions) {

    } 
}
$answers =  getAnswer(20, $conn);
echo $answers[1];

/*
$sql = "SELECT question_type FROM questions WHERE question_id = $questionId";
    $questionType = $conn ->query($sql);
    if ($questionType == "single Answer") {
        return $result;
    }
*/
?>
