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

    <title> Skill Sphere - Forgot Password </title>
    <link href = "../img/logo-small-light.svg" rel = "icon" media = "prefers-color-scheme: light">
    <link href = "../img/logo-small-dark.svg" rel = "icon" media = "prefers-color-scheme: dark">
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
                if(isset($_COOKIE['id'])){
                    echo ('<a href = "course.php"><button class = "secondary-button" tabindex="-1"> Create Course </button></a>');
                    echo ('<a href = "profile.php"><button class = "primary-button" tabindex="-1"> Profile </button></a>');
                }else{
                    echo ('<a href = "login.php"><button class = "secondary-button" tabindex="-1"> Log in </button></a>');
                    echo ('<a href = "register.php"><button class = "primary-button" tabindex="-1"> Register </button></a>');
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
                   
                   if(isset($_COOKIE['id'])){
                       echo ('<a href = "course.php"> Create Course </a>');
                   }else{
                       echo ('<a href = "login.php"> Log In </a>');
                   }
                   
                   ?> 
                   </li>
                    <li> 
                    <?php 
                   
                   if(isset($_COOKIE['id'])){
                       echo ('<a href = "profile.php"> View Profile </a>');
                   }else{
                       echo ('<a href = "register.php"> Register </a>');
                   }
                   
                   ?>                        
                    </li>

                </ul>

            </nav>

        </div>
    
    </div>

    <div class = "dark-overlay" id = "overlay"></div>

    <main id = "main">

        <section id="login">

            <form class = "flex-col card centre-content centre-self">

                <h1> Forgotten your password? </h1>

                <label for = "email"> <p> Enter your email to recieve a password reset link </p> </label>
                <input type = text name = "email"  class = "text-input" id = "email" placeholder = "email@email.com">

                <p id = "message"></p>

                <button type = "button" onclick = "resetPassword()" class = "primary-button"> Send Reset Link </button>

            </form>

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

    <script>

        function resetPassword(){
            document.getElementById("If an account with that email exists, a password reset link has been sent to that address"); // Message could do with tweaking

            // Call some PHP to reset the password
        }


    </script>

    <script src = "https://kit.fontawesome.com/d90c26d2f3.js" crossorigin="anonymous"></script>
    <!-- Reveals side nav on mobile -->
    <script src = "../js/mobileHeader.js"></script>

</body>
</html>