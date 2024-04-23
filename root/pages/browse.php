<?php

    require_once '../php/db.php';

    $courses = [];
    $title;

    if (isset($_GET['category'])) {
        $id = $_GET['category'];

        $sql = $db->prepare('SELECT courseNAME, courseID, AVG(rating) as rating, cat_name
                            FROM CourseTemplate C 
                            JOIN courseTagged CT ON CT.course_id = C.courseID
                            JOIN tags T ON CT.tag_id = T.tag_id
                            JOIN categories Ca ON T.category_id = Ca.cat_id
                            LEFT JOIN reviews R ON R.course_id = C.courseID
                            WHERE cat_id = ?
                            GROUP BY C.courseID, cat_name;');
        $sql->bind_param('i', $id);
        $sql->execute();

        $result = $sql->get_result();

        if ($result === false) {
            echo 'No courses found';
        } else {
            $currentid = -1;

            while ($row = $result->fetch_assoc()) {
                if ($currentid != $row['courseID']) {
                    array_push($courses, $row);
                    $currentid = $row['courseID'];
                }

                $title = $row['cat_name'];
            }
        }
    }

    if (isset($_GET['tag'])) {
        $id = $_GET['tag'];

        $sql = $db->prepare('SELECT courseNAME, courseID, AVG(rating) as rating, T.name
                            FROM CourseTemplate C 
                            JOIN courseTagged CT ON CT.course_id = C.courseID
                            JOIN tags T ON CT.tag_id = T.tag_id
                            LEFT JOIN reviews R ON R.course_id = C.courseID
                            WHERE T.tag_id = ?
                            GROUP BY C.courseID, T.name');
        $sql->bind_param('i', $id);
        $sql->execute();

        $result = $sql->get_result();

        if ($result === false) {
            echo 'No courses found';
        } else {
            $currentid = -1;

            while ($row = $result->fetch_assoc()) {
                if ($currentid < $row['courseID']) {
                    array_push($courses, $row);
                    $currentid = $row['courseID'];
                }

                $title = $row['name'];
            }
        }
    }

    if (!isset($_GET['category']) && !isset($_GET['tag'])) {
        $title = 'All';

        $sql = $db->prepare('SELECT courseNAME, courseID, AVG(rating) as rating
            FROM CourseTemplate C LEFT JOIN reviews R ON R.course_id = C.courseID
            GROUP BY courseID;');

        $sql->execute();

        $result = $sql->get_result();

        if (!$result === false) {
            while ($row = $result->fetch_assoc()) {
                array_push($courses, $row);
            }
        }
    }

?>

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

    <title> Skill Sphere - Create Account </title>
    <link href = "../img/logo-small-light.svg" rel = "icon" media = "prefers-color-scheme: light">
    <link href = "../img/logo-small-dark.svg" rel = "icon" media = "prefers-color-scheme: dark">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/cookieControl.js"></script>
    <script type="text/javascript" src="../js/Encryption.js"></script>
</head>
<body>

    <a href="#main" class="skip-link" id="skip-link" tabindex="0"> Skip to main content </a>

    <header id = "desktop-header"> <!-- Header for sizes over : 950px-->

        <div>

            <a href = "../index.php"><h1> Skill Sphere </h1></a>

            <a href = "#"> <button class = "secondary-button" tabindex="-1"> Browse Categories </button> </a>

            <input type = "text" class = "search-bar" placeholder="Search for courses...">

        </div>

        <div> 

        <?php
            if (isset($_COOKIE['id'])) {
                echo '<a href = "course.php"><button class = "secondary-button" tabindex="-1"> Create Course </button></a>';
                echo '<a href = "profile.php"><button class = "primary-button" tabindex="-1"> Profile </button></a>';
            } else {
                echo '<a href = "login.php"><button class = "secondary-button" tabindex="-1"> Log in </button></a>';
                echo '<a href = "register.php"><button class = "primary-button" tabindex="-1"> Register </button></a>';
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

                        <li> <a href = "#"> Browse Categories </a> </li>

                    </ul>

                </nav>

            </div>

            <nav>

                <ul>

                <li> 
                    <?php

                   if (isset($_COOKIE['id'])) {
                       echo '<a href = "course.php"> Create Course </a>';
                   } else {
                       echo '<a href = "login.php"> Log In </a>';
                   }

                   ?> 
                   </li>
                    <li> 
                    <?php

                   if (isset($_COOKIE['id'])) {
                       echo '<a href = "profile.php"> View Profile </a>';
                   } else {
                       echo '<a href = "register.php"> Register </a>';
                   }

                   ?>                        
                    </li>

                </ul>

            </nav>

        </div>
    
    </div>

    <div class = "dark-overlay" id = "overlay"></div>

    <main id = "main" class = "browse">

        <aside class = "filter">

            <div id = "categories">
            <!-- All categories -->

                <h3> Categories </h3>

                <?php

                   require_once '../php/db.php';

                   $sql = $db->prepare('SELECT cat_id, cat_name FROM categories;');
                   $sql->execute();

                   $result = $sql->get_result();

                   while ($row = $result->fetch_assoc()) {
                       echo "
                    <a href='browse.php?category=".$row['cat_id']."'>".$row['cat_name'].'</a>
                    
                    ';
                   }

                ?>

            </div>

            <?php

                if (isset($_GET['category'])) {
                    $sql = $db->prepare('SELECT tags.name, tags.tag_id
                                        FROM tags JOIN categories ON (categories.cat_id = tags.category_id)
                                        WHERE tags.category_id = ?;');
                    $sql->bind_param('i', $id);

                    $sql->execute();

                    $result = $sql->get_result();

                    echo "<div id='tags'>
                    <h4> Refine your search further with tags: </h4> ";

                    if ($result === false) {
                        echo 'No tags found for this category...';
                    } else {
                        while ($row = $result->fetch_assoc()) {
                            echo "<a href = 'browse.php?tag=".$row['tag_id']."'>".$row['name'].'</a>';
                        }
                    }
                    echo '</div>';
                }

            ?>

        </aside>

        <section id="results" class = "results">

        <h2> <?php echo $title; ?> courses </h2>

        <div  class = "grid" data-direction = "horizontal">

        <?php

                foreach ($courses as $course) {
                    echo "
                    <a href = 'course.php?course=".$course['courseID']."' class='course card stacked' hover = 'true' id = ".$course['courseID'].">

                    <div id = 'course-info' class = 'card-info'>

                        <h3 id = 'course-name'> ".$course['courseNAME']." </h3>
                        <div id = 'course-rating'>";

                    for ($i = 0; $i < $course['rating']; ++$i) {
                        echo "<i class='fa-solid fa-star'></i>";
                    }

                    for ($i; $i < 5; ++$i) {
                        echo "<i class='fa-regular fa-star'></i>";
                    }

                    echo '</div> </div> </a>';
                }

        ?>

        </div>

        </section>

    </main>

    <footer>

        <h3> Skill Sphere </h3>

        <nav>

            <ul>

                <li><a href = "about.php"> <p> About </p> </a> </li>
                <li><a href = "contact"> <p> Contact Us </p> </a> </li>
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

    
</body>
</html>