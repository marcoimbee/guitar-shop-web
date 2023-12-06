<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Custom Guitars LA - Checkout </title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" type="text/css" href="../styles/principal.css">
    <link rel="stylesheet" type="text/css" href="../styles/register.css">
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
        <?php
            include('../php/connect.php');     //db connection

            $address = $_SESSION['address'];
            $username = $_SESSION['username'];

            //delete query
            $delete_cart_query = 'DELETE FROM Shopping_Cart WHERE ID_user = (SELECT A.ID FROM Account A WHERE A.Username = "'.$username.'")';
            $mysqli->query($delete_cart_query);

            echo("
                <div id='msg_container'>
                    <div id='logo'>
                        <img src='../images/logo_2.png' alt='logo2'>
                    </div>
                    <div id='msg'>
                        <p>
                            Thank you for choosing Custom Guitar LA!
                            <br>
                            Items will be shipped to '".$address."'.
                            <br>
                            <br>
                            You will be redirected to the Homepage.
                        </p>

                        <script type='text/javascript'>         
                            setTimeout(                         
                                function(){
                                    window.location.href = '../index.php';
                                }, 3000);
                        </script>
                    </div>
                </div>
            ");
            
            $mysqli->close();
        ?>
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