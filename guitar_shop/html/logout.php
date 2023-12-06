<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Custom Guitars LA - Logout </title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" type="text/css" href="../styles/principal.css">
    <link rel="stylesheet" href="../styles/register.css">
</head>

<body>
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
        <div id="msg_container">
            <div id="logo">
                <img src="../images/logo_2.png" alt="logo2">
            </div>
            <?php
                unset($_SESSION['logged']);
            ?>
            <div id="msg">
                <p>
                    You successfully logged out.
                    <br>
                    <br>
                    You will be redirected to the Homepage.
                </p>
            </div>
        </div>
        <!-- Successfully logging out makes the page display the msg and wait 5secs after redirecting the user to index.php -->
        <!-- In that interval the header menu can still be used, as the session var gets unset at the beginning -->
        <script type='text/javascript'>
        setTimeout(
            function() {
                window.location.href = '../index.php';
            }, 5000);
        </script>
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
</body>

</html>