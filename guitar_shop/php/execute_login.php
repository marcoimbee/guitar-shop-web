<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Custom Guitars LA - Login </title>
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
            
            //NO CONTROL ON THE SESSION BECAUSE IF THIS PAGE IS VISITED THE USER IS LOGGING IN AND NO SESSION IS SET
            if(isset($_POST["username"]) && isset($_POST["password"])){     //if the parameters have been inserted 
                $username = $_POST["username"];
                $password = $_POST["password"];         //get the parameters
                                
                $controlQuery = "SELECT A.Name, A.Surname, A.Email, A.Username, A.Password, A.Address FROM Account A";     //get all the entries

                $resultControl = $mysqli->query($controlQuery);         //execute the query

                $registered = false;            //i start assuming the user is not registeredm then eventually i change the value if registered
                
                while($returned = $resultControl->fetch_assoc()){
                    if($returned["Username"] == $username && password_verify($password, $returned["Password"])){          //if i find an entry matching username AND password then the user can login
                        $registered = true;             //the user is registered and can login
                        $_SESSION['logged'] = 1;        //i get his personal data as i find his entry
                        $_SESSION['name'] = $returned['Name'];
                        $_SESSION['surname'] = $returned['Surname'];
                        $_SESSION['email'] = $returned['Email'];
                        $_SESSION['address'] = $returned['Address'];
                        $_SESSION['username'] = $returned['Username'];
                        break;          //i can stop as i found the matching result
                    }
                }

                if($registered){        //if the user is registered i display a div with a success message
                    echo("
                        <div id='msg_container'>
                            <div id='logo'>
                                <img src='../images/logo_2.png' alt='logo2'>
                            </div>
                            <div id='msg'>
                                <p>
                                    Hello ".$username.", you successfully logged in.
                                    <br>
                                    <br>
                                    You will be redirected to the Homepage.
                                </p>
                            </div>
                        </div>

                        <!-- Successfully logging in makes the page display the msg and wait 3secs after redirecting the user to index.php -->
                        <!-- In that interval the header menu can still be used -->
                        <script type='text/javascript'>         
                            setTimeout(                         
                                function(){
                                    window.location.href = '../index.php';
                                }, 3000);
                        </script>
                    ");
                }else{                      //actions if username or password are wrong
                    echo ("
                        <script type='text/javascript'>     
                            window.location.href = '../html/login.php?loginOK=false';      //get back to the login page appending a parameter to the URL i am redirecting to     
                        </script>   
                    ");
                    //header('../html/login.php?loginOK=false');
                }
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