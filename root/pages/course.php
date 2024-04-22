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
                   
                   if(isset($_COOKIE['id'])){
                       echo ('<a href = "pages/course.php"> Create Course </a>');
                   }else{
                       echo ('<a href = "pages/login.php"> Log In </a>');
                   }
                   
                   ?> 
                   </li>
                    <li> 
                    <?php 
                   
                   if(isset($_COOKIE['id'])){
                       echo ('<a href = "pages/profile.php"> View Profile </a>');
                   }else{
                       echo ('<a href = "pages/register.php"> Register </a>');
                   }
                   
                   ?>                        
                    </li>

                </ul>

            </nav>

        </div>
    
    </div>

    <div class = 'dark-overlay' id = 'overlay'></div>

    <main id = 'main'>

        <section id='course' class = 'course-page centre-content centre-self'>

            <div class = 'course-info' id='course-info'>
                
                <h2 id='course-name'> Python for Beginners </h2>

                <div id='desc'>

                    An introductory python course. Teaches you the basics of python data types, operators, functions and much more to get you started on your programming journey!

                </div>

                
                
                <div id='rating'>

                    <i class='fa-solid fa-star'></i>
                    <i class='fa-solid fa-star'></i>
                    <i class='fa-solid fa-star'></i>
                    <i class='fa-regular fa-star'></i>
                    <i class='fa-regular fa-star'></i>

                    <br>

                    <p> 700 ratings </p>

                </div>

                <div id='enrolled'>

                    5.7k

                </div>

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

                    <div class = 'module completed' id = 'module-0'>

                        Lesson 1 - Sample Video

                    </div>

                    <div class = 'module-content' id = 'module-0-content'>

                        <video src = ../vid/sample.mp4 controls controlslist='play timeline volume'></video>

                    </div>

                    <div class = 'module' id = 'module-1'>

                        Lesson 2 - Sample Quiz

                    </div>

                    <div class = 'module-content' id = 'module-1-content'>

                        <div class='quiz-info'>

                            This quiz will assess your knowledge from module 1

                        </div>

                        <button class = 'primary-button'> Take Quiz </button>

                    </div>

                    <div class = 'module' id = 'module-2'>

                        Lesson 3- Test 3

                    </div>

                    <div class = 'module-content' id = 'module-2-content'>

                        It all works!

                    </div>

                    <div class = 'module' id = 'module-3'>

                        Lesson 3- Test 3

                    </div>

                    <div class = 'module-content' id = 'module-3-content'>

                        It all works!

                    </div>

                    <div class = 'module' id = 'module-4'>

                        Lesson 3- Test 3

                    </div>

                    <div class = 'module-content' id = 'module-4-content'>

                        It all works!

                    </div>

                    <div class = 'module' id = 'module-5'>

                        Lesson 3- Test 3

                    </div>

                    <div class = 'module-content' id = 'module-5-content'>

                        It all works!

                    </div>

                    <div class = 'module' id = 'module-6'>

                        Lesson 3- Test 3

                    </div>

                    <div class = 'module-content' id = 'module-6-content'>

                        It all works!

                    </div>

                    <div class = 'module' id = 'module-7'>

                        Lesson 3- Test 3

                    </div>

                    <div class = 'module-content' id = 'module-7-content'>

                        It all works!

                    </div>

                </div>

            </div>

            <div id='reviews' class = 'reviews flex-col'>

                <h3> Reviews </h3>
    
                <p> Heres what the people who've taken this course have to say! </p>
    
                <!-- TODO: add review graph-->

                <?php
                
                    include '../php/retrieveReviews.php';

                    foreach($reviews as $current)
                    {
                        echo("
                        
                        <div class='review'>
    
                        ".$current["username"]."
    
                        <div class='rating'>

                        ");

                        for($j = 0; $j < $current["rating"]; $j++){
                            echo("<i class='fa-solid fa-star'></i>");
                        }

                        for($j; $j < 5; $j++)
                        {
                            echo("<i class='fa-regular fa-star'></i>");
                        }

                        echo("
                        </div>
        
                        <div class='review-content'>
        
                            ".$current['content']."
        
                        </div>
    
                        <button type='button' class = 'invisible-button'>
    
                            <i class='fa-regular fa-flag'></i> Report this review
    
                        </button>
        
                    </div>
                        
                        
                        ");
                    }

                ?>

                <?php
                
                    if(isset($_COOKIE["id"]))
                    {
                        echo("
                        <form class = 'flex-col centre-self' action = '../php/sendReview.php' method = 'POST'> 

                            <h4> Leave a review </h4>
        
                            <!-- <div class='star-rating'> -->
        
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
        
                            <!-- </div> -->
        
                            <label for = 'comment'> Leave a comment: </label>
                            <input type = 'textarea' maxlength = '100' name = 'comment' placeholder = 'Add a comment!'>
        
                            <input type = 'hidden' name = 'course_id' value = '0'>
        
                            <button type='submit' class = 'secondary-button'> Send Review </button>
    
                        </form> ");
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