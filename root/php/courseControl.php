<?php

require_once 'db.php';

$COURSE_NAME = $_POST['courseName'];
$COURSE_DESC = $_POST['courseDesc'];
$date = $_POST['date'];

$result = mysqli_query($db, "SELECT * FROM CourseTemplate");
$coursecount = mysqli_num_rows($result) + 2;

echo $COURSE_NAME." ".$COURSE_DESC." ".$date." ".$coursecount;
$MODULE_NAME = $_POST['nameList'];
$MODULE_TYPE = $_POST['modTypes'];
$MODULE_CONTENT = $_POST['contList'];

echo "loaded lists";

if(isset($_COOKIE["id"])){
    $author = $_COOKIE["id"];
}else{
    $author = -1;
}
echo $author;


$sql = "INSERT INTO CourseTemplate VALUES('".$coursecount."', '".$COURSE_NAME."', '".$author."', '".$COURSE_DESC."', STR_TO_DATE('".$date."', '%d/%m/%Y'))";
mysqli_query($db, $sql);

for($i = 0; i < count($MODULE_NAME); $i++){

    $result = mysqli_query($db, "SELECT * FROM modules");
    $modulecount = mysqli_num_rows($result) + 1;

    $sql = "INSERT INTO modules VALUES('".$modulecount."','".$coursecount."','".$MODULE_NAME[$i]."','".$MODULE_TYPE[$i]."','".$MODULE_CONTENT[$i]."')";
    mysqli_query($db, $sql);
}

$db->close();
?>


