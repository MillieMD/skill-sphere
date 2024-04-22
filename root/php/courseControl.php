<?php

require_once "db.php";

//text modules will contain: module ID, module Title, module type, module Contents
//video modules will contain: module ID, module Title, module type, youtube video link
//quiz modules will contain: module ID, module Title, module type, QuizID -> then a quiz and answer table will be created as per quiz.php

//the generic setup of the course table will be:  MODULE_ID, MODULE_TITLE, MODULE_TYPE, MODULE_CONTENTS
//eg. MOD01, How to write a description!, Text, Type with your keyboard!
//    MOD02, Example Video!, Video, https://www.youtube.com/watch?v=QdezFxHfatw&pp=ygUXbmV2ZXIgZ29ubmEgZ2l2ZSB5b3UgdXA%3D
//    MOD03, Test!, test, 1a79a4d60de6718e8e5b326e338ae533

echo "begin";

$COURSE_NAME = $_POST['courseName'];
$COURSE_DESC = $_POST['courseDesc'];
$DATE = $_POST['date'];

echo "loaded course info";

$MODULE_NAME = $_POST['modulenames'];
$MODULE_TYPE = $_POST['moduletypes'];
$MODULE_CONTENT = $_POST['modulecontents'];

echo "loaded arrays";

$author = $_COOKIE('id');

echo "loaded author";

$sql = "INSERT INTO CourseTemplate VALUES('0', '".$courseName."', '".$author."', '".$courseDesc."', STR_TO_DATE('".$date."', '%d/%m/%Y'))";
mysqli_query($db, $sql);

echo "inserted course";

for($i = 0; $i < count($MODULE_TYPE); $i++){
   $sql = "SELECT * FROM modules";
   $result = msqli_query($db, $sql);
   $count = mysqli_num_rows($result);

   $sql = "INSERT INTO modules VALUES('".$count."', '".$coursecount."','".$MODULE_NAME[$i]."', '".$MODULE_TYPE[$i]."', '".$MODULE_CONTENT[$i]."')";
   mysqli_query($db, $sql);
}

echo "full finish";

?>