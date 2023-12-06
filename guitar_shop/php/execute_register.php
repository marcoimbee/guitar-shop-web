<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Custom Guitars LA - Register </title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" type="text/css" href="../styles/principal.css">
    <link rel="stylesheet" type="text/css" href="../styles/register.css">
</head>

<body>
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

            $name = $_POST["name"];
            $surname = $_POST["surname"];
            $email = $_POST["email"];
            $address = $_POST["address"];
            $username = $_POST["username"];
            $pwd = $_POST["pwd"];

            $controlQuery = "SELECT A.Username, A.Email FROM Account A";

            $alredyRegistered = false;

            $resultControl = $mysqli->query($controlQuery);

            while($returned = $resultControl->fetch_assoc()){
                if($returned["Username"] == $username || $returned["Email"] == $email){
                    $alredyRegistered = true;
                    break;
                }
            }

            if($alredyRegistered){
                //username already taken
                echo ("
                    <script type='text/javascript'>     
                        window.location.href = '../html/register.php?registerOK=false';      //get back to the login page appending a parameter to the URL i am redirecting to     
                    </script>   
                ");
                /*
                echo("
                    <div id='msg_container'>
                        <div id='logo'>
                            <img src='../images/logo_2.png' alt='logo2'>
                        </div>
                        <div id='msg'>
                            <p>
                                You have already registered on this website!
                                <br>
                                Login <a id='loginLink' href='../html/login.php' target='_self'> here </a>.
                            </p>
                        </div>
                    </div>
                ");
                */
            }else{
                $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                $insertQuery = "INSERT INTO Account(Name, Surname, Email, Username, Password, Address) 
                                VALUES('".$name."', '".$surname."', '".$email."', '".$username."', '".$hashedPwd."', '".$address."')";
                $mysqli->query($insertQuery);
                echo("
                    <div id='msg_container'>
                        <div id='logo'>
                            <img src='../images/logo_2.png' alt='logo2'>
                        </div>
                        <div id='msg'>
                            <p>
                                Hello ".$username.", you successfully registered!
                                <br>
                                Login <a id='loginLink' href='../html/login.php' target='_self'> here </a>.
                            </p>
                        </div>
                    </div>
                ");
            }

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
</body>

</html>