<?php
    /*
    *
    *
    * encoding the retrieved data from the db in utf8 format (JSON not working with any format other than utf8 or so it seems)
    * CREDITS TO: https://hotexamples.com/it/examples/-/-/utf8ize/php-utf8ize-function-examples.html
    */
    function utf8ize($d) {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = utf8ize($v);
            }
        } else if (is_string ($d)) {
            return utf8_encode($d);
        }
        return $d;
    }
    /*
    *
    *
    *
    *
    */

    include('../php/connect.php');

    $where_clause = '';     //init
    $selection_attr = 'P.ID, P.Name, P.Price, P.Amount, P.Description, P.Image';

    if (isset($_GET['filters'])) {
        $where_clause = $_GET['filters'];
        //console_log($where_clause);
        $query1 = 'SELECT ' .$selection_attr. ' FROM Product P WHERE ' . $where_clause;      //query to be executed if some filters are chosen
        //$query1 = 'SELECT * FROM Prodotto P WHERE ' . $where_clause;
    }else{
        //$query1 = 'SELECT * FROM Prodotto P WHERE P.Prezzo < 300';
        $query1 = 'SELECT ' .$selection_attr. ' FROM Product P';         //query to be executed onload of html page
        //console_log($query1);
    }

    $result = $mysqli->query($query1);          //execution of query

    $result_ajax = array();         //array for the results to be put in
    
    while ($info = $result->fetch_assoc()) {
        $result_ajax[] = $info;                  
    }

    print json_encode(utf8ize($result_ajax));       //encodes the db results in JSON format and sends back to client

    $mysqli->close();
?>