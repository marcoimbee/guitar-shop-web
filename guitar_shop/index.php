<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Custom Guitars LA - Homepage </title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" type="text/css" href="styles/principal.css">
    <script src="scripts/gallery.js"></script>
</head>

<body>
    <!-- mandatory for displaying the username at the bottom of the page, in here as in all the other pages -->
    <?php session_start(); ?>
    <header>
        <div class="header_container">
            <img src="images/logo.png" alt="logo">
            <nav>
                <div class="nav_elem">
                    <a href="#">
                        Homepage
                    </a>
                </div>
                <div class="nav_elem">
                    <a href="html/products.php">
                        Products
                    </a>
                </div>
                <div class="nav_elem">
                    <a href="html/login.php">
                        Login
                    </a>
                </div>
                <div class="nav_elem">
                    <a href="html/profile.php">
                        My profile
                    </a>
                </div>
            </nav>
        </div>
    </header>
    <div class="body_container">
        <section class="object">
            <div class="split">
                <div class="left_container">
                    <h1> New Arrivals </h1>
                    <p>
                        For more than 15 years, lead guitarist Phil Demmel contributed his lightning-fast riffs to metal
                        outfit Machine Head.
                        <br>
                        As Demmel forges ahead to his next chapter, he’ll be well-armed with the all-new Pro Series
                        Signature Demmelition Fury PD — an affordable metal axe that can hang with everything Demmel
                        throws its way.
                        <br>
                        Ready for mayhem, the Pro Fury PD is available in a mesmerizing Red Tide Fade finish.
                        <br>
                        <br>
                        <a href="html/products.php"> Come check it out in the shop!</a>
                    </p>
                </div>
                <div class="gallery">
                    <div id="left_gallery">
                        <button onclick="rotate('left')">
                            <img src="images/left_arrow.png" alt="left">
                        </button>
                    </div>
                    <div id="gallery_content">
                        <img src="images/gallery/img1.png" alt="spacer" id="displayed_img">
                    </div>
                    <div id="right_gallery">
                        <button onclick="rotate('right')">
                            <img src="images/right_arrow.png" alt="right">
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <section class="object">
            <div class="split">
                <div class="left_container">
                    <img src="images/black_sabbath.jpg" alt="black_sabbath">
                </div>
                <div class="right_container">
                    <h1> Latest News </h1>
                    <p>
                        Sad news for the music world: the british heavy metal pioneers <strong>Black Sabbath</strong>
                        are retiring.
                        <br>
                        The legendary band, seller of over 170 millions of records worldwide, shared the news today via
                        their <a href="https://www.instagram.com/blacksabbath/?hl=en" target="_blank">official Instagram
                            account</a>.
                    </p>
                </div>
            </div>
        </section>
        <section class="object">
            <div class="split">
                <div class="left_container">
                    <h1> Upcoming Events </h1>
                    <p>
                        With <strong>Metallica</strong>'s frontman, singer and songwriter <strong>James
                            Hetfield</strong> we aere going to take a deep dive into his world of guitars, gear and
                        influences. We will discuss how the music industry is nowadays so different than
                        how it was back in the 80s.
                        <br>
                        He will also be speaking about <strong>Metallica</strong>'s most successful LPs and play some
                        new amazing riffs from the band's upcoming record.
                    </p>
                </div>
                <div class="right_container">
                    <img src="images/james_hetfield.jpg" alt="james_hetfield">
                </div>
            </div>
        </section>
    </div>

    <footer>
        <div class="footer_obj" id="logo_footer">
            <a href="#">
                <img id="footer_logo" src="images/logo.png" alt="logo">
            </a>
        </div>

        <div class="footer_obj">
            <h3>
                Sponsors:
            </h3>
            <a href="https://www.daddario.com/" target="_blank">
                <img src="images/sponsors/daddario.jpg" alt="d'addario" class="sponsor">
            </a>
            <br>
            <br>
            <a href="https://www.seymourduncan.com/" target="_blank">
                <img src="images/sponsors/seymour.jpg" alt="seymour duncan" class="sponsor">
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
                <img id="back_up_button" src="images/top.png" alt="top_of_the_page">
            </a>
        </div>
    </footer>
    <div id="guide">
        <div>
            <a href="html/user_guide.html" target="_blank">How to use this website?</a>
        </div>
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