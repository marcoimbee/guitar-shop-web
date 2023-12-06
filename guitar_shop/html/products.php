<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Custom Guitars LA - Products </title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" type="text/css" href="../styles/principal.css">
    <link rel="stylesheet" type="text/css" href="../styles/filter_tab.css">
    <link rel="stylesheet" type="text/css" href="../styles/products_tab.css">
    <script src="../scripts/shop_management.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body onload="display_products('')">
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
                    <a href="#">
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

    <div class="body_container_products">
        <div id="filters_container">
            <div id="filters_title">
                <h2>Filters</h2>
            </div>
            <hr>
            <form id="filters" method="GET" action="javascript:composeWhereClause()">
                <div class="filters_elem">
                    <div>
                        Guitars:
                        <br><br>
                        Basses:
                    </div>
                    <div>
                        <input type="checkbox" name="guitars">
                        <br><br>
                        <input type="checkbox" name="basses">
                    </div>
                </div>
                <hr>
                <div class="filters_elem">
                    <div>
                        From:
                        <br><br>
                        To:
                    </div>
                    <div>
                        <input type="number" name="from" min="0">
                        <br><br>
                        <input type="number" name="to" min="1">
                    </div>
                </div>
                <hr>
                <div class="filters_elem">
                    <div>
                        Low to high:
                        <br><br>
                        High to low:
                    </div>
                    <div>
                        <input type="radio" name="order" value="asc">
                        <br><br>
                        <input type="radio" name="order" value="desc">
                    </div>
                </div>
                <hr>
                <div class="filters_elem">
                    <input type="submit" value="Apply">
                </div>
            </form>
        </div>

        <!-- APPENDING ALL THE JS GENERATED ELEMENTS TO THIS DIV -->
        <div id="main"></div>
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