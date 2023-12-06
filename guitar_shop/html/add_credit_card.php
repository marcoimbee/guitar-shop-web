<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Custom Guitars LA - Add Credit Card </title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" type="text/css" href="../styles/principal.css">
    <link rel="stylesheet" href="../styles/credit_card.css">
    <script src="../scripts/form_management.js"></script>
</head>

<body>
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
        <div id="credit_card_container">
            <div id="logo">
                <img src="../images/logo_2.png" alt='logo2'>
            </div>
            <div id="form">
                <div id="title">
                    <h2>Register your credit card to start shopping:</h2>
                </div>
                <form method="POST" id="credit_card" action="../php/execute_credit_card.php" name="creditCardForm"
                    novalidate>
                    <div id="form_content">
                        <div class="form_elem">
                            <p>* Card number: </p>
                            <input type="number" name="number" id="Card_number"
                                title="The sixteen digits number on the front side of your credit card" required>
                        </div>
                        <div class="form_elem">
                            <p>* Card owner: </p>
                            <input type="text" name="owner" id="Card_owner" pattern="[A-Za-z ]*"
                                title="This credit card belongs to... ?" required>
                        </div>
                        <div class="form_elem">
                            <p>* Security code: </p>
                            <input type="number" name="security_code" id="Security_code"
                                title="The digits on the back side of your credit card" required>
                        </div>
                        <div class="form_elem">
                            <p>* Expiration date: </p>
                            <input type="date" name="expiration_date" id="Expiration_date" required>
                        </div>
                        <br>
                        <div class="form_elem" id="buttons">
                            <input type="button" value="Add" onclick="validate('credit_card')">
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