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
                echo '<a href = "../pages/editcourse.php"><button class = "secondary-button" tabindex="-1"> Create Course </button></a>';
                echo '<a href = "../pages/profile.php"><button class = "primary-button" tabindex="-1"> Profile </button></a>';
            } else {
                echo '<a href = "../pages/login.php"><button class = "secondary-button" tabindex="-1"> Log in </button></a>';
                echo '<a href = "../pages/register.php"><button class = "primary-button" tabindex="-1"> Register </button></a>';
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

    <div class = "dark-overlay" id = "overlay"></div>

    <main id = "main">

        <form class = "quiz-wrapper"> 

            <div id = "question-0" class = "card quiz-question">

                <div class = "question-title">

                    Which answer is correct?

                </div>

                <div class="answer-option">

                    <input type="radio" name="answer-0" id="answer-0" value = "optionA">
                    <label for="answer-0"> Option A</label>

                </div>

                <div class="answer-option">

                    <input type="radio" name="answer-0" id="answer-1" value = "optionB">
                    <label for="answer-1"> Option B</label>

                </div>

                <div class="answer-option">

                    <input type="radio" name="answer-0" id="answer-2" value = "optionC">
                    <label for="answer-2"> Option C</label>

                </div>

            </div>

            <div id = "question-1" class = "card quiz-question" style = "display:none">

                <div class = "question-title">

                    Which option is correct?

                </div>

                <div class="answer-option">

                    <input type="radio" name="answer-1" id="answer-0" value = "optionD">
                    <label for="answer-0"> Option D</label>

                </div>

                <div class="answer-option">

                    <input type="radio" name="answer-1" id="answer-1" value = "optionE">
                    <label for="answer-1"> Option E</label>

                </div>

                <div class="answer-option">

                    <input type="radio" name="answer-1" id="answer-2" value = "optionF">
                    <label for="answer-2"> Option F</label>

                </div>

            </div>

            <button class = "primary-button" type = "button"> Next Question </button>

        </form>

        <div class = "quiz-progress">

            <label for="quiz-progress"> Question 1 of 10</label>
            <progress id = "quiz-progress" class = "quiz-tracker" max = "10" value = "1"> Question 1 of 10 </progress>
    
            </div>

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

    <!-- TODO: -->
    <!-- Quiz loading from database -->
    <!-- Next Question function: -->
    <!-- JS function that moves the style =  "display: inline;" -->

    
</body>
</html>