<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Custom Guitars LA - Login </title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" type="text/css" href="../styles/principal.css">
    <link rel="stylesheet" href="../styles/login.css">
    <script src="../scripts/form_management.js"></script>
</head>

<!-- onload calls the js function to display the error msg if the username or password are wrong (first call does nothing) -->

<body onload="wrong_credentials_action()">
    <?php session_start(); ?>
    <header>
        <div class="header_container">
            <img src="../images/logo.png" alt="logo">
            <nav>
                <div class="nav_elem">
                    <a href="../index.php">
                        Homepage
                    </a>
                </div>
                <div class="nav_elem">
                    <a href="../html/products.php">
                        Products
                    </a>
                </div>
                <div class="nav_elem">
                    <a href="#">
                        Login
                    </a>
                </div>
                <div class="nav_elem">
                    <a href="../html/profile.php">
                        My profile
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <div id="outside_container">
        <div id="login_container">
            <div id="logo">
                <img src="../images/logo_2.png" alt="logo2">
            </div>
            <?php
                if(isset($_SESSION['logged'])){     //the session is active so no need to login
                    //echo("<script> console.log(".$_SESSION['logged']."); </script>");
                    echo("
                        <div id='msg'>
                            <p>
                                You are logged in as ".$_SESSION['username'].".
                                <br>
                                If you want to logout, click the 'Logout' button in your personal area!
                            </p>
                        </div>
                    ");
                }else{                  //displays the login form and redirects then to execute_login.php to set everything up
                    //echo("<script> console.log('session unset'); </script>");
                    echo("
                        <div id='form'>
                            <div id='title'>
                                <h2>Login</h2>
                            </div>
                            <form action='../php/execute_login.php' method='POST' name='loginForm' autocomplete='on'>
                                <div class='login_elem'>
                                    <div>
                                        Username:
                                        <br><br>
                                        Password:
                                    </div>
                                    <div>
                                        <input type='text' name='username' required>
                                        <br><br>
                                        <input type='password' name='password' required>
                                    </div>
                                </div>
                                <input type='submit' value='LOGIN'>
                            </form>
                        </div>
                        <div id='register'>
                            <div>
                                <p>Not registered yet?</p>
                            </div>
                            <div>
                                <a href='../html/register.php'>Register</a>
                            </div>
                        </div>
                    ");
                }
            ?>
        </div>
    </div>

    <footer>
        <div class="footer_obj" id="logo_footer">
            <a href="#">
                <img id="footer_logo" src="../images/logo.png" alt="logo">
            </a>
        </div>

        <div class="footer_obj">
            <h3>
                Sponsors:
            </h3>
            <a href="https://www.daddario.com/" target="_blank">
                <img src="../images/sponsors/daddario.jpg" alt="d'addario" class="sponsor">
            </a>
            <br>
            <br>
            <a href="https://www.seymourduncan.com/" target="_blank">
                <img src="../images/sponsors/seymour.jpg" alt="seymour duncan" class="sponsor">
            </a>
        </div>
        <div class="footer_obj">
            <h3>
                Opening time:
            </h3>
            <ul id="opening_time_list">
                <li> Mon-Fri: 9:00am-17:00pm </li>
                <li> Sat: 9:00am-12:30am </li>
            </ul>
        </div>
        <div class="footer_obj" id="contacts">
            <h3>
                Contact us:
            </h3>
            <ul>
                <li> Local phone: (813) 600-3920 </li>
                <li> Fax: (813) 600-3933</li>
                <li> Info: <a href="mailto:lacustomguitars@info.us">lacustomguitars@info.us</a></li>
                <li> Business: <a href="mailto:lacustomguitars@business.us">lacustomguitars@business.us</a></li>
            </ul>
        </div>
        <div class="footer_obj">
            <a href="#">
                <img id="back_up_button" src="../images/top.png" alt="top_of_the_page">
            </a>
        </div>
    </footer>
    <div id="guide">
        <?php
            if(isset($_SESSION['logged'])){         //is the session is set then there is a login executing and i display the username
                echo("
                    <div>
                        Logged in as: ".$_SESSION['username']."
                    </div>
                ");
            }
        ?>
    </div>
</body>

</html>