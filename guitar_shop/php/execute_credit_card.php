<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Custom Guitars LA - Add Credit Card </title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" type="text/css" href="../styles/principal.css">
    <link rel="stylesheet" type="text/css" href="../styles/credit_card.css">
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
                        My Profile
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <div id="outside_container">
        <?php
            include('../php/connect.php');     //db connection

            $number = $_POST["number"];         //getting data from the form
            $owner = $_POST["owner"];
            $security_code = $_POST["security_code"];
            $expiration_date = $_POST["expiration_date"];

            $username = $_SESSION["username"];      //username for retrieving his unique ID in the db for constraints setting
            $account_fk = '';

            $user_selection_query = "SELECT A.ID FROM Account A WHERE A.Username = '".$username."'";

            $result = $mysqli->query($user_selection_query);

            while($result_fetch = $result->fetch_assoc()){
                $account_fk = $result_fetch["ID"];      //getting the user's ID in db
            }

            $insertQuery = "INSERT INTO Credit_card(Account_FK, Number, Owner, Expiration, Security_code) 
                            VALUES('".$account_fk."', '".$number."', '".$owner."', '".$expiration_date."', '".$security_code."')";
            
            $mysqli->query($insertQuery);

            echo("
                <div id='msg_container'>
                    <div id='logo'>
                        <img src='../images/logo_2.png' alt='logo2'>
                    </div>
                    <div id='msg'>
                        <p>
                            You successfully associated your credit card to your profile!
                            <br>
                            You will be redirected to your personal area.
                            <!-- Successfully registering the credit card in makes the page display the msg and wait 3secs after redirecting the user to profile.php -->
                            <!-- In that interval the header menu can still be used -->
                            <script type='text/javascript'>         
                                setTimeout(                         
                                    function(){
                                        window.location.href = '../html/profile.php';
                                    }, 3000);
                            </script>
                        </p>
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