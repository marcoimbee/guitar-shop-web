//displays the products responding to the given filters
function display_products(where_clause) {
    try {
        var xmlHttp = new XMLHttpRequest();                //creating object XMLHttpRequest

        /*
        -> first call: onload of html page
            -> no filters are selected so where_clause in quesry is empty == displays all the products
        -> next calls: submitting filters
            -> where clause is calculated in composeWhereClause
        */
        //url format must be: "file.php?var1=value1&var2=value2... , blank spaces are written as '+'"
        if (where_clause == '') {
            xmlHttp.open("GET", "../php/get_products.php", true);     //request towards the server, executed code is in get_products.php, GET method
        } else {
            var sendParam = "?filters=" + where_clause;             //building the string to be appended to the url
            xmlHttp.open("GET", "../php/get_products.php" + sendParam, true);     //request towards the server, executed code is in get_products.php, GET method
        }

        //function to be executed when the server will respond. Gets executed only when the value of this.readyState changes
        xmlHttp.onreadystatechange = function () {
            var DONE = 4;
            var OK = 200;
            //readyState = 4 -> request accepted, processed and answer is available
            //status = 200 -> request status is OK
            if (this.readyState === DONE && this.status === OK) {
                //console.log(xmlHttp.responseText);
                //console.log(JSON.parse(xmlHttp.responseText));      //converts to JSON decoded the answer encoded by the server
                var result = JSON.parse(xmlHttp.responseText);
                //console.log(result);

                var main = document.getElementById("main");

                //DELETING THE PREVIOUS QUERY RESULTS
                initForNewQuery(main);

                //DISPLAYING QUERY RESULT
                if (result.length != 0) {
                    for (var i = 0; i < result.length; i++) {
                        createContent(result, i, main);
                    }
                } else {
                    createContent('', 0, main);         //no results with the applied filters, i send '' as a parameter and take care of it in the function
                }
            }
        }
        //sending request with parameter 'filters'
        //appends where_clause to the url sent
        //if called from onload(), appends '', else appends the chosen filters
        xmlHttp.send(null);
    } catch (e) {
        alert("Not supported");
    }
}



//clears the "main" div for displaying the rersult of the new query
function initForNewQuery(main) {
    while (main.firstChild) {           //while there still are children
        main.removeChild(main.firstChild);  //remove the first of them
    }
}



//composes the WHERE clause for the php query
function composeWhereClause() {
    var appliedFilters = '';        //has to be resetted at every call

    var form = document.getElementsByTagName("input");

    //guitars - basses
    if (form[0].checked && !form[1].checked) {
        appliedFilters += 'P.Type+=+"G"';         //displays only guitars, P.Type = 'G'
    } else if (!form[0].checked && form[1].checked) {
        appliedFilters += 'P.Type+=+"B"';         //displays only basses , P.Type = 'B'
    } else {
        appliedFilters += '(P.Type+=+"G"+OR+P.Type+=+"B")';    //displays guitars OR basses, P.Type = 'B' OR 'G'
    }

    var from, to;
    //console.log(form);

    from = form[2].value;
    to = form[3].value;

    if (from == '') {       //if the from value is left unwritten, start displaying from 0$
        from = '0';
    }

    if (to == '') {     //if the to value is left unwritten, assume a maximum of 1000000$
        to = '1000000';
    }

    if (Number(from) > Number(to)) {    //if the interval is set and is incorrect, return with an error alert
        alert("Incorrect price range: check again!");
        return;
    }

    // console.log(from);
    // console.log(to);

    appliedFilters += ('+AND+(P.Price+BETWEEN+' + from + '+AND+' + to + ')');  //P.Tipo = ... AND (P.Prezzo BETWEEN from AND to)

    if (form[4].checked || (!form[4].checked && !form[5].checked)) {       //if left untouched displays products ASC
        appliedFilters += '+ORDER+BY+P.Price+ASC';
    } else {
        appliedFilters += '+ORDER+BY+P.Price+DESC';
    }

    //console.log(appliedFilters);          //up here P.Tipo = ... AND (P.Prezzo BETWEEN from AND to) ORDER BY P.Prezzo ASC/DESC
    display_products(appliedFilters);       //displays the products specyfing the chosen filters
}



//displays the i-th product's section with all his data
function createContent(result, i, main) {
    if (result == '') {             //if the query returned empty resultset
        var msg_div = document.createElement("div");
        msg_div.setAttribute("id", "no_results_msg");
        var h4_msg = document.createElement("h4");
        h4_msg.textContent = "0 products found. Try modifying some filters!";
        msg_div.appendChild(h4_msg);
        main.appendChild(msg_div);
        return;
    }

    //getting query attributes for result i passed as parameter
    var name_query = result[i].Name;
    var img_src_query = result[i].Image;
    var price_query = result[i].Price + " $";
    var availability_query;
    if (Number(result[i].Amount) <= 0) {
        availability_query = " 0 left";          //already composing the string
    } else {
        availability_query = result[i].Amount + " left";
    }
    var description_query = result[i].Description;

    //getting the product id for the adding to cart function
    var id_query = result[i].ID;

    //div id="product" containing product name, img, info
    var product = document.createElement("div");
    product.setAttribute("id", "product");

    //appending product container to main container
    main.appendChild(product);

    //getting the just created div id="product"
    product_div = document.getElementById("product");

    //product name node: <div id="product_name"><h2>...</h2></div>
    var product_name = document.createElement("div");
    product_name.setAttribute("id", "product_name");
    var h2_name = document.createElement("h2");
    h2_name.textContent = name_query;
    product_name.appendChild(h2_name);

    //creating hr element
    var hr = document.createElement("hr");

    //product data CREATION (appending all together at the end)
    //outer div: <div id="product_data"> ... </div>
    var product_data = document.createElement("div");
    product_data.setAttribute("id", "product_data");

    //product image: container div and actual img element
    //<div id="product_img"> <img src="..." alt="..."> </div>
    var product_img = document.createElement("div");
    product_img.setAttribute("id", "product_img");
    var image = document.createElement("img");
    image.setAttribute("src", img_src_query);
    image.setAttribute("alt", img_src_query);
    product_img.appendChild(image);

    //product description: container div and actual description p element
    //<div id="description"> <p> ... </p> </div>
    var description = document.createElement("div");
    description.setAttribute("id", "description");
    var p_descr = document.createElement("p");
    p_descr.textContent = description_query;
    description.appendChild(p_descr);

    //product price: container div, h4 title and p element
    //<div id="price"> <h4>Price: </h4> <p>...</p> </div>
    var price = document.createElement("div");
    price.setAttribute("id", "price");
    var h4_price = document.createElement("h4");
    var p_price = document.createElement("p");
    p_price.textContent = price_query;
    h4_price.textContent = "Price: ";
    price.appendChild(h4_price);
    price.appendChild(p_price);

    //product availability: container div, h4 title and p element
    //<div id="availability"> <h4>Availability:</h4> <p>...</p> </div>
    var availability = document.createElement("div");
    availability.setAttribute("id", "availability");
    var h4_availability = document.createElement("h4");
    var p_availability = document.createElement("p");
    p_availability.textContent = availability_query;
    h4_availability.textContent = "Availability: ";
    availability.appendChild(h4_availability);
    availability.appendChild(p_availability);

    //add to cart section
    //<div id="cart"> <a href="..."> Add to cart </a> </div>
    var cart_div = document.createElement("div");
    cart_div.setAttribute("id", "cart");
    var button_cart = document.createElement("button");

    //if there is no availability I display an alert, otherwise i set the event handler for the click to take care of the adding to cart action
    if (Number(result[i].Amount) <= 0) {
        //event onclick to display a msg
        button_cart.onclick = function (event) {
            alert("This item is not available at the moment");
            //console.log("NOT_AVAILABLE");
        }
    } else {
        //adding the onclick event to the div
        //(using AJAX here because I didn't want the alert to erase the filters query results)
        button_cart.onclick = function (event) {
            try {
                var xmlHttp = new XMLHttpRequest();                //creating object XMLHttpRequest

                xmlHttp.open("GET", "../php/cart_operations.php?Prod_id=" + id_query, true);     //request towards the server, executed code is in add_to_cart.php, GET method
        
                //function to be executed when the server will respond. gets executed only when the value of this.readyState changes
                xmlHttp.onreadystatechange = function () {
                    var DONE = 4;           //same as display_products()
                    var OK = 200;
                    if (this.readyState === DONE && this.status === OK) {
                        //console.log(xmlHttp.responseText);
                        //the php page responds with the string 'INSERTED' if the user is logged in and the item has been inserted in his cart,
                        //otherwise the string 'NOT_LOGGED' is sent and the other alert is shown
                        if (xmlHttp.responseText == 'INSERTED') alert('Item added to your shopping cart.');
                        else alert('Login in order to start shopping!');
                    }
                }

                xmlHttp.send(null);
            } catch (e) {
                alert("Not supported");
            }
        }
    }

    button_cart.textContent = "Add to cart";
    cart_div.appendChild(button_cart);

    //appending elements to product_data div
    product_data.appendChild(product_img);
    product_data.appendChild(description);
    product_data.appendChild(price);
    product_data.appendChild(availability);
    product_data.appendChild(cart_div);

    //appending name and product_data div to product container
    product_div.appendChild(product_name);
    product_div.appendChild(hr);
    product_div.appendChild(product_data);

    //console.log(product_div);
}



//REMOVE FROM CART FUNCTION - CALLED FROM onclick EVENT AT profile.php
function remove_from_cart(cart_id) {
    //console.log(cart_id);
    try {
        var xmlHttp = new XMLHttpRequest();                //creating object XMLHttpRequest

        xmlHttp.open("GET", "../php/cart_operations.php?Cart_id=" + cart_id, true);     //request towards the server, executed code is in cart_oprations.php, GET method

        //function to be executed when the server will respond. gets executed only when the value of this.readyState changes
        xmlHttp.onreadystatechange = function () {
            var DONE = 4;
            var OK = 200;
            if (this.readyState === DONE && this.status === OK) {
                console.log(xmlHttp.responseText);
                alert('Item removed from your shopping cart.');

                location.reload();      //reloading profile.php so the removed element is not showing anymore
            }
        }

        xmlHttp.send(null);
    } catch (e) {
        alert("Not supported");
    }
}