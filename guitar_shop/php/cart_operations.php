<?php
    session_start();

    include('../php/connect.php');      //connection to db

    //ADDING TO CART PHP SCRIPT
    //if the user is logged he can add items to his shopping cart
    //$_GET['cart_id'] has to be unset because when i have to delete an item from cart the session is also set.
    //Without that extra check the script will get into this first if() also when I have to remove an item.
    if(isset($_SESSION['logged']) && !isset($_GET['Cart_id'])){         

        $username = $_SESSION['username'];      //retrieve his username through session variables
        
        $product_id = $_GET['Prod_id'];        //retrieve the product ID to be added by the parameter in the url (see shop_management.js)

        $user_id_query = 'SELECT A.ID FROM Account A WHERE A.Username = "'.$username.'"';   //query for retrieving the user's unique ID

        $resultControl = $mysqli->query($user_id_query);        //execute the query for the user's ID

        $user_id = '';
        while($returned = $resultControl->fetch_assoc()){
            $user_id = $returned['ID'];         //getting the ID
        }
        
        //insert query
        $insert_query = 'INSERT INTO Shopping_cart (ID_user, ID_product) VALUES ('.$user_id.', '.$product_id.')';
        $mysqli->query($insert_query);

        //update query
        //when an item is added to a cart i decrement is availability in the Product table
        $update_query = 'UPDATE Product SET Amount = Amount - 1 WHERE ID = '.$product_id;
        $mysqli->query($update_query);

        //alert to be sent back to AJAX
        echo("INSERTED");

        $mysqli->close();  
    }else{
        //alert to be sent back to AJAX
        echo("NOT_LOGGED");
    }

    //REMOVING FROM CART PHP SCRIPT
    if(isset($_GET['Cart_id'])){            //script gets executed only if the GET global var is set. The var gets set by AJAX in shop_management.js
        $cart_id = $_GET['Cart_id'];

        //incrementing the availability of the just removed product
        $update_cart_query = 'UPDATE Product SET Amount = Amount + 1 WHERE ID = (SELECT S.ID_product FROM Shopping_cart S WHERE S.ID = '.$cart_id.')';
        $mysqli->query($update_cart_query);

        //deleting the item that has the AJAX passed ID
        $delete_cart_query = 'DELETE FROM Shopping_cart WHERE ID = '.$cart_id;
        $mysqli->query($delete_cart_query);

        $mysqli->close();

        echo("DONE");
    }
?>