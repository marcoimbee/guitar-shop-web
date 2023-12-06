<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Custom Guitars LA - Personal Area </title>
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" type="text/css" href="../styles/principal.css">
    <link rel="stylesheet" type="text/css" href="../styles/personal_area.css">
    <script src="../scripts/shop_management.js"></script>
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
                    <a href="#">
                        My profile
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <div id="body_container">
        <div id="container">
            <?php
                //displays the cart elements in the user's cart at the moment
                //remove button calls remove_from_cart() with argument the id of the element to be removed from the Shopping_cart table in the DB
                function display_cart_element($name, $price, $image, $cart_id){
                    echo("
                        <div id='cart_item'>
                            <div id='item_data'>
                                <div id='item_name'>
                                    <h4>Name: </h4>
                                    <p>".$name."</p>
                                </div>
                                <div id='item_price'>
                                    <h4>Price: </h4>
                                    <p>".$price."$</p>
                                </div>
                                <br>
                                <div id='item_remove'>
                                    <button onclick='remove_from_cart(".$cart_id.")' id='remove_button'>Remove</button>
                                </div>
                            </div>
                            <div id='item_image'>
                                <img src='".$image."' id='item_img' alt='item_element'>
                            </div>
                        </div>
                        <hr>
                    ");
                }

                if(isset($_SESSION["logged"])){             //if the user is logged (see setting of the variable in login.php)
                    $name = $_SESSION["name"];          //retrieving personal data for displaying
                    $surname = $_SESSION["surname"];    
                    $email = $_SESSION["email"];
                    $address = $_SESSION["address"];
                    $username = $_SESSION["username"];

                    //console_log($_SESSION["logged"]);

                    //starting displaying
                    echo("
                        <div class='data'>
                    ");
                    
                    //PROFILE INFO DISPLAYING
                    echo("
                            <div class='section_name'>
                                <h2>".$username."'s personal area</h2>
                            </div>
                            <hr>
                            <div>
                                <div>
                                    <h4>Name: </h4>
                                    <p>".$name."</p>
                                </div>
                                <div>
                                    <h4>Surname: </h4>
                                    <p>".$surname."</p>
                                </div>
                                <div>
                                    <h4>E-mail address: </h4>
                                    <p>".$email."</p>
                                </div>
                                <div>
                                    <h4>Address: </h4>
                                    <p>".$address."</p>
                                </div>
                                <div>
                                    <h4>Logged in as: </h4>
                                    <p>".$username."</p>
                                </div>
                            </div>
                            <br>
                            <div id='logout'> <!-- As the user chooses to logout he gets redirected to the logout page where the session var gets unset -->
                                <a href='../html/logout.php'>Logout</a>
                            </div>
                            <br>
                    ");

                    //CREDIT CARD AND CART ELEMENTS NEED THE DB CONNECTION TO BE DISPLAYED
                    //YOU CAN ACCESS THE PERSONAL AREA IF LOGGED IN -> SESSION VARIABLES ARE SURELY SET IF YOU ARE VISITING THIS PAGE
                    //NO NEED TO ACCESS THE DB FOR THE ACCOUNT DATA
                    //NEED TO ACCESS THE DB FOR THE CARD AND CART DATA BECAUSE USER COULD HAVE NO CARD AND/OR NO ELEMENTS SAVED IN HIS CART

                    include('../php/connect.php');     //db connection

                    //CARD DATA DISPLAYING
                    //start by displaying the title of the section anyway
                    echo("
                        <div class='section_name'>
                            <h2>Credit card data:</h2>
                        </div>
                        <hr>
                    ");
                    //selecting the credit card data to display
                    $query_credit_card = "SELECT C.Number, C.Expiration, C.Owner FROM Credit_card C INNER JOIN Account A ON (C.Account_FK = A.ID) WHERE A.Username = '".$username."'";
                    
                    $result_credit_card = $mysqli->query($query_credit_card);

                    //result_credit_card = returned resultset
                    //returned_credit_card = row fetched by fetch_assoc()

                    //if the query returned THE result
                    if($result_credit_card->num_rows != 0){
                        //getting all the values (while() only cicles 1 time)
                        while($returned_credit_card = $result_credit_card->fetch_assoc()){
                            $card_number = $returned_credit_card['Number'];
                            $card_expiration = $returned_credit_card['Expiration'];
                            $card_owner = $returned_credit_card['Owner'];
                        }

                        //i display the card number as xx** **** **** **xx
                        for($i = 0; $i < strlen($card_number); $i++){
                            if(($i >= 2) && ($i <= strlen($card_number) - 3)){
                                $card_number[$i] = '*';
                            }
                        }

                        echo("
                            <div>
                                <div>
                                    <h4>Owner: </h4>
                                    <p>".$card_owner."</p>
                                </div>
                                <div>
                                    <h4>Number: </h4>
                                    <p>".$card_number."</p>
                                </div>
                                <div>
                                    <h4>Valid until: </h4>
                                    <p>".$card_expiration."</p>
                                </div>
                            </div>
                            <br>
                        ");
                    }else{    //no card is associated to the account (yet), display the possibility to register one
                        echo("
                            <p id='card_msg'>You still haven't associated any credit card to your account.</p>
                            <br>
                            <br>
                            <div id='add_card'>
                                <a href='../html/add_credit_card.php'>Add credit card</a>
                            </div>
                            <br>
                        ");
                    }

                    //CART ELEMENTS DISPLAYING
                    //start by displaying the title of the section anyway
                    echo("
                        <div class='section_name'>
                            <h2>".$username."'s shopping cart:</h2>
                        </div>
                        <hr>
                    ");

                    //gets the elements added to the shopping cart by the user
                    $query_shopping_cart = 'SELECT P.Name, P.Price, P.Image, S.ID FROM Product P INNER JOIN Shopping_cart S ON (P.ID = S.ID_product) WHERE S.ID_user = (SELECT A.ID FROM Account A WHERE A.Username = "'.$username.'")';
                    
                    $result_shopping_cart = $mysqli->query($query_shopping_cart);

                    if(mysqli_num_rows($result_shopping_cart) == 0){
                        echo("
                            <p id='cart_msg'>Your cart is currently empty.</p>
                            <br>
                            <br>
                        ");
                    }else{
                        while($returned_shopping_cart = $result_shopping_cart->fetch_assoc()){
                            $name = $returned_shopping_cart['Name'];
                            $image = $returned_shopping_cart['Image'];
                            $price = $returned_shopping_cart['Price'];
                            $cart_id = $returned_shopping_cart['ID'];
                            display_cart_element($name, $price, $image, $cart_id);
                        }
                        
                        $tot = 0;
                        $total_query = 'SELECT TRUNCATE(SUM(P.Price), 2) AS TOT FROM Product P INNER JOIN Shopping_cart S ON (P.ID = S.ID_product) WHERE S.ID_user = (SELECT A.ID FROM Account A WHERE A.Username = "'.$username.'")';
                        $result_total_query = $mysqli->query($total_query);
                        while($returned_total_query = $result_total_query->fetch_assoc()){
                            $tot = $returned_total_query['TOT'];
                        }

                        /*User cannot checkout if his credit card data hasn't been inserted yet.
                        This query's purpose is to check that case.
                        If the returned rows number is 0 then he hasn't registered a credit card yet.*/
                        $check_query = 'SELECT COUNT(*) AS TOT FROM Credit_Card C INNER JOIN Account A ON C.Account_FK = A.ID WHERE A.Username = "'.$username.'"';
                        $result_control = $mysqli->query($check_query);

                        $credit_card_found = false;
                        while($returned = $result_control->fetch_assoc()){
                            if($returned["TOT"] != 0){
                                $credit_card_found = true;
                                break;
                            }
                        }
 
                        //DISPLAY TOTAL PRICE
                        echo("
                            <br>
                            <div class='checkout'>
                                <p>Total: ".$tot."$</p>
                            </div>
                        ");
                        if($credit_card_found == true){
                            echo("
                                <div class='checkout'>
                                    <a href='../html/checkout.php'>Checkout</a>
                                </div>
                            ");
                        }else{
                            echo("
                                <div id='credit_card_msg'> 
                                    <p> You haven't associated any credit card to your account yet. <br>
                                    In order to checkout, register a credit card. </p>
                                </div>
                            ");
                        }
                    }

                    //CLOSES THE UPPER <div class='data'> 
                    echo("</div>");
                }else{      //user is not logged in and i show an error msg
                    echo("
                        <div id='error_msg'>
                            <p>You are not logged in.</p>
                        </div>
                    ");
                }
            ?>
        </div>
    </div>
    <footer>
        <div class="footer_obj" id="logo_footer">
            <a href="../index.html">
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