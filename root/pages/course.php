<?php
    // NEED: course name, course desc, tags,  num enrolled, num ratings, avg score

    require_once '../php/db.php';

    if (!isset($_GET['course'])) {
        header('Location: ../index.php');
    }

    $courseID = $_GET['course'];

    if(!isset($_GET["course"]))
    {
        header("Location: ../index.php");
    }

    $courseID = $_GET["course"];

    // Retrieved here is: name, author, rating information

    $sql = $db->prepare('SELECT courseNAME, users.username, AVG(rating) as courseRATING, COUNT(rating) as numRATINGS
                        FROM CourseTemplate
                        JOIN users ON (users.user_id = CourseTemplate.courseAUTHOR)
                        LEFT JOIN reviews ON (reviews.course_id = CourseTemplate.courseID)
                        WHERE courseID = 2;');

    //$sql->bind_param("i", $courseID);
    $sql->execute();
    $result = $sql->get_result();

    if ($result === false) {
        header('Location: error.html');
        exit;
    }

    $row = $result->fetch_assoc();
    $courseName = $row['courseNAME'];
    $rating = $row['courseRATING'];
    $numRatings = $row['numRATINGS'];


?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>

    <link rel='stylesheet' href='../css/style.css'> <!-- Main style sheet -->

    <!-- Poppins Google Font -->
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet'>

    <title> Skill Sphere - Log In </title>
    <link href = '../img/logo-small-light.svg' rel = 'icon' media = 'prefers-color-scheme: light'>
    <link href = '../img/logo-small-dark.svg' rel = 'icon' media = 'prefers-color-scheme: dark'>
</head>
<body>

    <a href='#main' class='skip-link' id='skip-link' tabindex='0'> Skip to main content </a>

    <header id = 'desktop-header'> <!-- Header for sizes over : 950px-->

        <div>

            <a href = '../index.php'><h1> Skill Sphere </h1></a>

            <a href = '#'> <button class = 'secondary-button' tabindex='-1'> Browse Categories </button> </a>

            <input type = 'text' class = 'search-bar' placeholder='Search for courses...'>

        </div>

        <div> 

            <a href = 'login.php'><button class = 'secondary-button' tabindex='-1'> Log in </button></a>
            <a href = 'register.php'><button class = 'primary-button' tabindex='-1'> Register </button></a>

        </div>

    </header>

    <header id = 'mobile-header'> <!-- Header for sizes under : 950px-->

        <a href = '../index.php'><h1> Skill Sphere </h1> </a>

        <button class = 'invisible-button' onclick = 'showSideNav()'>
            <i class='fa-solid fa-bars'></i>
        </button>
    
    </header>

    <div class = 'side-nav' id = 'mobile-nav'>

        <button class='invisible-button' onclick = 'hideSideNav()'>

            <i class = 'fa-solid fa-xmark'></i>

        </button>

        <div class = 'side-nav-content'>

            <div>

                <input type = 'text' placeholder='Search for courses...'>
            
                <nav>

                    <ul>

                        <li> <a href = '#'> Browse Categories </a> </li>

                    </ul>

                </nav>

            </div>

            <nav>

                <ul>

                <li> 
                    <?php

                   if (isset($_COOKIE['id'])) {
                       echo '<a href = "../pages/editcourse.php"> Create Course </a>';
                   } else {
                       echo '<a href = "../pages/login.php"> Log In </a>';
                   }

                   ?> 
                   </li>
                    <li> 
                    <?php

                   if (isset($_COOKIE['id'])) {
                       echo '<a href = "../pages/profile.php"> View Profile </a>';
                   } else {
                       echo '<a href = "../pages/register.php"> Register </a>';
                   }

                   ?>                        
                    </li>

                </ul>

            </nav>

        </div>
    
    </div>

    <div class = 'dark-overlay' id = 'overlay'></div>

    <main id = 'main'>
        <?php
            $courseID = $_GET["course"];

            $sql = "SELECT * FROM CourseTemplate WHERE courseID = '".$courseID."'";
            $result = mysqli_query($db, $sql);
            $courseData = mysqli_fetch_row($result);

            $sql = "SELECT * FROM userEnrolled WHERE course_id = '".$courseID."'";
            $result = mysqli_query($db, $sql);
            $amountEnrolled = mysqli_num_rows($result);

            $sql = "SELECT * FROM modules WHERE courseID = '".$courseID."'";
            $modules = mysqli_query($db, $sql);



        ?>



        <section id='course' class = 'course-page centre-content centre-self'>

            <div class = 'course-info' id='course-info'>
                
                <h2 id='course-name'> <?php echo $courseData[1]; ?> </h2>

                <div id='desc'><?php echo $courseData[3]; ?></div>

                
                
                <div id='rating'>

                   <?php

                        for ($j = 0; $j < $rating; ++$j) {
                            echo "<i class='fa-solid fa-star'></i>";
                        }

                        for ($j; $j < 5; ++$j) {
                            echo "<i class='fa-regular fa-star'></i>";
                        }

                   ?>

                    <br>

                    <p> <?php echo $numRatings.' ratings'; ?> </p>

                </div>

                <div id='enrolled'><?php echo $amountEnrolled; ?> others have enrolled!</div>

                <div id='tags'>

                    <a href = '#'>
                        Technology
                    </a>

                    <a href = '#'>
                        Programming
                    </a>

                    <a href = '#'>
                        Python
                    </a>


                </div>

            </div>

            <div id='modules'>

                <h3> Lessons </h3>

                <div class = 'module-container'>

                    <?php
                    $i = 0;
                    while ($row = $modules->fetch_assoc()) {
                        ++$i;
                        switch ($row['moduleTYPE']) {
                            case "Text":
                                echo "<div class = 'module' id = module-".$i.">".$row['moduleNAME']."</div>";
                                echo "<div class = 'module-content' id = module-".$i."-content>".$row['moduleCONTENTS']."</div>";
                                break;
                            case "Video":
                                echo "<div class = 'module' id = module-".$i.">".$row['moduleNAME']."</div>";
                                echo "<div class = 'module-content' id = module-".$i."-content>".$row['moduleCONTENTS']."</div>";
                                break;
                            case "Quiz":
                                echo "<div class = 'module' id = module-".$i.">".$row['moduleNAME']."</div>";
                                echo "<div class = 'module-content' id = 'module-".$i."-content><div class = quiz-info>Quiz Placeholder Text</div>";
                                echo "<button class = 'primary-button'>Take Quiz</button></div>";
                        }
                    }

                    ?>







                </div>

            </div>

            <div id='reviews' class = 'reviews flex-col'>

                <h3> Reviews </h3>
    
                <p> Heres what the people who've taken this course have to say! </p>
    
                <!-- TODO: add review graph-->

                <?php

                    require_once 'db.php';

                    $NUM_REVIEWS = 3;

                    $sql = $db->prepare("SELECT users.username as username, reviews.rating as rating, reviews.content as content FROM reviews JOIN users ON (reviews.user_id = users.user_id) WHERE course_id = ? LIMIT ?;");
                    $sql->bind_param('ii', $course_id, $NUM_REVIEWS);
                    $sql->execute();

                    $reviews = $sql->get_result();

                    if ($result === false) {
                        //header("Location: ../../pages/error.html");
                        //exit;
                    }

                    foreach ($reviews as $current) {
                        echo "
                        
                        <div class='review'>
    
                        ".$current['username']."
    
                        <div class='rating'>

                        ";

                        for ($j = 0; $j < $current['rating']; ++$j) {
                            echo "<i class='fa-solid fa-star'></i>";
                        }

                        for ($j; $j < 5; ++$j) {
                            echo "<i class='fa-regular fa-star'></i>";
                        }

                        echo "
                        </div>
        
                        <div class='review-content'>
        
                            ".$current['content']."
        
                        </div>
    
                        <button type='button' class = 'invisible-button'>
    
                            <i class='fa-regular fa-flag'></i> Report this review
    
                        </button>
        
                    </div>
                        
                        
                        ";
                    }
                ?>

                <?php

                    if (isset($_COOKIE['id'])) {
                        echo "
                        <form class = 'flex-col centre-self' action = '../php/sendReview.php' method = 'POST'> 

                            <h4> Leave a review </h4>
        
                            <div class='star-rating'>
        
                                <input type='radio' name='rate' id='five' value = '5'>
                                <label for='five'></label>
                                <input type='radio' name='rate' id='four' value = '4'>
                                <label for='four'></label>
                                <input type='radio' name='rate' id='three' value = '3'>
                                <label for='three'></label>
                                <input type='radio' name='rate' id='two' value = '2'>
                                <label for='two'></label>
                                <input type='radio' name='rate' id='one' value = '1'>
                                <label for='one'></label>
        
                            </div>
        
                            <label for = 'comment'> Leave a comment: </label>
                            <input type = 'textarea' maxlength = '100' name = 'comment' placeholder = 'Add a comment!'>
        
                            <input type = 'hidden' name = 'course_id' value = '".$courseID."'>
        
                            <button type='submit' class = 'secondary-button'> Send Review </button>
    
                        </form> ";
                    }

                ?>

            </div>

        </section>


    </main>

    <footer>

        <h3> Skill Sphere </h3>

        <nav>

            <ul>

                <li><a href = 'about.php'> <p> About </p> </a> </li>
                <li><a href = 'contact'> <p> Contact Us </p> </a> </li>
                <a><li> Copyright </li></a>
                <a><li> Privacy Policy </li></a>
                <a><li> Sitemap </li></a>

            </ul>

        </nav>

    </footer>
    
    <!-- Basic Client Side Validation -->
    <script src = '../js/clientSideAccountValidation.js'></script>
    <script src = 'https://kit.fontawesome.com/d90c26d2f3.js' crossorigin='anonymous'></script>
    <!-- Reveals side nav on mobile -->
    <script src = '../js/mobileHeader.js'></script>

    <script>

            
 

        function deleteModule(id)
        {
            let module = document.getElementById("module-"+id);
            module.remove();

            return false;
        }
        
        const modules = document.getElementsByClassName('module');

        for(let i = 0; i < modules.length; i ++){

            console.log(modules[i]);

            modules[i].addEventListener('click', function(){

                this.classList.toggle('active-module');

                var content = this.nextElementSibling;
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                } else {
                    content.style.maxHeight = content.scrollHeight + 'px';
                } 

            })
        }


    </script>

</body>
</html>