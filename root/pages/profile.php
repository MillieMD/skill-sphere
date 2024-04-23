<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/style.css"> <!-- Main style sheet -->

    <!-- Poppins Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title> USERNAME's Profile </title>
    <link href = "../img/logo-small-light.svg" rel = "icon" media = "prefers-color-scheme: light">
    <link href = "../img/logo-small-dark.svg" rel = "icon" media = "prefers-color-scheme: dark">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/Encryption.js"></script>
    <script type="text/javascript"  src="../js/cookieControl.js"></script>
</head>
<body onload="getCookie('Username', 'username'); getCookie('Joindate', 'datejoined')">

    <a href="#main" class="skip-link" id="skip-link" tabindex="0"> Skip to main content </a>

    <header id = "desktop-header"> <!-- Header for sizes over : 950px-->

        <div>

            <a href = "../index.php"><h1> Skill Sphere </h1></a>

            <a href = "browse.php"> <button class = "secondary-button"> Browse Categories </button> </a>

            <input type = "text" class = "search-bar" placeholder="Search for courses...">

        </div>

        <div> 

            <?php
                if(isset($_COOKIE['id'])){
                    echo ('<a href = "../pages/editcourse.php"><button class = "secondary-button" tabindex="-1"> Create Course </button></a>');
                    echo ('<a href = "../pages/profile.php"><button class = "primary-button" tabindex="-1"> Profile </button></a>');
                }else{
                    echo ('<a href = "../pages/login.php"><button class = "secondary-button" tabindex="-1"> Log in </button></a>');
                    echo ('<a href = "../pages/register.php"><button class = "primary-button" tabindex="-1"> Register </button></a>');
                }
            ?>

        </div>

    </header>

    <header id = "mobile-header"> <!-- Header for sizes under : 950px-->

        <a href = "../index.php"><h1> Skill Sphere </h1> </a>

        <button class = "invisible-button" onclick = "showSideNav()">
            <i class="fa-solid fa-bars"></i>
        </button>
    
    </header>

    <div class = "side-nav" id = "mobile-nav">

        <button class="invisible-button" onclick = "hideSideNav()">

            <i class = "fa-solid fa-xmark"></i>

        </button>

        <div class = "side-nav-content">

            <div>

                <input type = "text" placeholder="Search for courses...">
            
                <nav>

                    <ul>

                        <li> <a href = "browse.php"> Browse Categories </a> </li>

                    </ul>

                </nav>

            </div>

            <nav>

            <li> 
                    <?php 
                   
                   if(isset($_COOKIE['id'])){
                       echo ('<a href = "../pages/editcourse.php"> Create Course </a>');
                   }else{
                       echo ('<a href = "../pages/login.php"> Log In </a>');
                   }
                   
                   ?> 
                   </li>
                    <li> 
                    <?php 
                   
                   if(isset($_COOKIE['id'])){
                       echo ('<a href = "../pages/profile.php"> View Profile </a>');
                   }else{
                       echo ('<a href = "../pages/register.php"> Register </a>');
                   }
                   
                   ?>                        
                    </li>

            </nav>

        </div>
    
    </div>

    <div class = "dark-overlay" id = "overlay"></div>

    <main id = "main" class = "profile">

        <section id="user-info" class = "card">

            <img src="../img/profile.png" alt="profile picture">

            <h1 id = "username"> USERNAME </h1>

                   <?php
                   
                   require_once "../php/db.php";

                   $sql = $db->prepare("SELECT count(user_id) as count FROM userEnrolled WHERE user_id = ?");
                   $sql->bind_param("i", $_COOKIE["id"]);
                   $sql->execute();

                   $result = $sql->get_result();
                   $enrolledNumber = $result->fetch_assoc()["count"];

                   ?>

            <p> Enrolled in <strong> <?php echo($enrolledNumber); ?> </strong> courses </p>

            <p id = "datejoined"> Joined in <strong> MONTH YEAR </strong></p>

            <div class = "badge-container" id = "badge container">

                <!-- TODO: Badges need to be images in final version - these divs are placeholders -->

                <div style = "border-radius: 50%; background-color: orange; aspect-ratio: 1/1;"> 1 </div>
                <div style = "border-radius: 50%; background-color: orange;"> 2 </div>
                <div style = "border-radius: 50%; background-color: orange;"> 3</div>

            </div>

        </section>

        <!-- Horizontal divider on desktop, vertical on mobile -->

        <!-- 2 wide on desktop, 1 wide on mobile -->
        <section id="user-courses">

            <h2> <?php echo($_COOKIE["Username"]."'s");?> Courses </h2>

            <div  class ="grid" data-direction = "veritcal">

            <?php

                require_once "../php/db.php";

                $sql = $db->prepare("SELECT courseNAME, courseID, AVG(rating) as rating
                                            FROM CourseTemplate C
                                            LEFT JOIN reviews R ON C.courseID = R.course_id
                                            WHERE C.courseAUTHOR = ?
                                            GROUP BY courseNAME, courseID;");
                $sql->bind_param("i", $_COOKIE["id"]);
                $sql->execute();

                $results = $sql->get_result();

                if($results != false)
                {

                    while($row = $results->fetch_assoc())
                    {
                        echo("
                        <a href = '../pages/course.php?courseID=".$row["courseID"]."' class='course card stacked' hover = 'true' id = ".$row["courseID"].">
    
                        <img src = '../img/courses/course-name.jpg'>
    
                        <div id = 'course-info' class = 'card-info'>
    
                            <h3 id = 'course-name'> ".$row["courseNAME"]." </h3>
                            <div id = 'course-rating'>");
                                                        
                                for($i = 0; $i < $row["rating"]; $i++){
    
                                    echo("<i class='fa-solid fa-star'></i>");
                                }
    
                                for($i; $i < 5; $i++){
                                    echo("<i class='fa-regular fa-star'></i>");
                                }
                                
                            echo("</div> </div> </a>");
                    }


                }

            ?>

                <!-- BUTTON TO ADD NEW COURSE -->
                <div class="card stacked centre-content" hover = "true" onclick = "newCourse()">

                    <i class="fa-solid fa-plus fa-2xl"></i>

                </div>

            </div>

        </section>

        <section id="enrolled-courses">

            <h2> Enrolled Courses </h2>

            <div  class ="grid" data-direction = "veritcal">

                <?php
            
                    $sql = $db->prepare("SELECT courseNAME, courseID, AVG(rating) as rating
                                        FROM CourseTemplate C
                                        RIGHT JOIN userEnrolled E ON E.course_id = C.courseID
                                        LEFT JOIN reviews R ON C.courseID = R.course_id
                                        WHERE E.user_id = ?
                                        GROUP BY courseNAME, courseID;");
                    $sql->bind_param("i", $_COOKIE["id"]);
                    $sql->execute();

                    $results = $sql->get_result();

                    if($results != false)
                    {

                        while($row = $results->fetch_assoc())
                        {
                            echo("
                            <a href = '../pages/course.php?courseID=".$row["courseID"]."' class='course card stacked' hover = 'true' id = ".$row["courseID"].">
        
                            <img src = '../img/courses/course-name.jpg'>
        
                            <div id = 'course-info' class = 'card-info'>
        
                                <h3 id = 'course-name'> ".$row["courseNAME"]." </h3>
                                <div id = 'course-rating'>");
                                                            
                                    for($i = 0; $i < $row["rating"]; $i++){
        
                                        echo("<i class='fa-solid fa-star'></i>");
                                    }
        
                                    for($i; $i < 5; $i++){
                                        echo("<i class='fa-regular fa-star'></i>");
                                    }
                                    
                                echo("</div> </div> </a>");
                        }


                    }

                
                ?>

            </div>
            
        </section>

    </main>

    <footer>

        <h3> Skill Sphere </h3>

        <nav>

            <ul>

                <li><a href = "../pages/about.php"> <p> About </p> </a> </li>
                <li><a href = "../pages/contact"> <p> Contact Us </p> </a> </li>
                <a><li> Copyright </li></a>
                <a><li> Privacy Policy </li></a>
                <a><li> Sitemap </li></a>

            </ul>

        </nav>

    </footer>

    <!-- Basic Client Side Validation -->
    <script src = "../js/clientSideAccountValidation.js"> </script>
    <script src = "https://kit.fontawesome.com/d90c26d2f3.js" crossorigin="anonymous"></script>
    <!-- Reveals side nav on mobile -->
    <script src = "../js/mobileHeader.js"></script>

    <script>

        function newCourse(){

            console.log("new course");

            window.location.href = "editcourse.php";

        }

    </script>

    
</body>
</html>