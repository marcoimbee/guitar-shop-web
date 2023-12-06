<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta id="viewport" content="width=device-width, initial-scale=1.0">
    <title> Custom Guitars LA - Register </title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" type="text/css" href="../styles/principal.css">
    <link rel="stylesheet" href="../styles/register.css">
    <script src="../scripts/form_management.js"></script>
</head>

<body onload="username_already_taken_action()">
    <? session_start(); ?>
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
                    <a href="../html/login.php">
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
        <div id="register_container">
            <div id="logo">
                <img src="../images/logo_2.png" alt="logo2">
            </div>
            <div id="form">
                <div id="title">
                    <h2>Register</h2>
                </div>
                <form method="POST" id="register" action="../php/execute_register.php" name="registerForm"
                    autocomplete="off" novalidate>
                    <div id="form_content">
                        <div class="form_elem">
                            <p>* Name: </p>
                            <input type="text" name="name" id="Name" pattern="[A-Za-z ]*"
                                title="Alphabetical characters only" required>
                        </div>
                        <div class="form_elem">
                            <p>* Surname: </p>
                            <input type="text" name="surname" id="Surname" pattern="[A-Za-z ]*"
                                title="Alphabetical characters only" required>
                        </div>
                        <div class="form_elem">
                            <p>* E-mail address: </p>
                            <input type="email" name="email" id="E-mail" required>
                        </div>
                        <div class="form_elem">
                            <p>* Address: </p>
                            <input type="text" name="address" id="Address" required>
                        </div>
                        <br>
                        <div class="form_elem">
                            <p>* Username: </p>
                            <input type="text" name="username" id="Username" pattern=".{4,}"
                                title="At least 4 characters" required>
                        </div>
                        <div class="form_elem">
                            <p>* Password: </p>
                            <input type="password" name="pwd" id="pwd" pattern=".{8,}" required>
                        </div>
                        <div class="form_elem">
                            <p>* Repeat password: </p>
                            <input type="password" id="pwd2" pattern=".{8,}" required>
                        </div>
                        <br>
                        <div class="form_elem" id="buttons">
                            <input type="button" value="register" onclick="validate('register')">
                            <input type="reset" value="reset">
                        </div>
                    </div>
                    <div id="alert">
                        <p>Fields marked with '*' are mandatory.</p>
                    </div>
                </form>
            </div>
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