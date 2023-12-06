//*****************************************//
//
//     FORM VALIDATION FUNCTIONS FILE
//
//****************************************//


//validation of form fields given a parameter identifying the form that is being processed
function validate(what) {
    //console.log(what);
    switch (what) {
        case "credit_card":
            var creditCardForm = document.getElementById("credit_card");
            //number, owner, security code, expiration date, add, reset
            for (var i = 0; i < creditCardForm.length; i++){
                if (checkField(creditCardForm[i], creditCardForm[i].validity) == false) {
                    return;
                } else {
                    console.log(creditCardForm[i].id + " ok");
                }
            }
            document.creditCardForm.submit();
            break;
    
        case "register":
            var registerForm = document.getElementById("register");
            //name, surname, email, address, username, password, repeat password, submit, reset
            for (var i = 0; i < registerForm.length - 4; i++){          //i check the passwords by themselves (the last elements are the two buttons and the two password fields)
                if (checkField(registerForm[i], registerForm[i].validity) == false) {
                    return;
                } else {
                    console.log(registerForm[i].id + " ok");
                }
            }
            //special control for the password fields
            if (checkPasswords(registerForm[5], registerForm[5].validity, registerForm[6], registerForm[6].validity) == false) {
                return;
            } else {
                console.log("pwds are ok");
            }
            document.registerForm.submit();
            break;
    }
}


//checks the insertion of the field and if its pattern is matching
//called by both credit_card and register switch cases
//elem: actual html element, check: elem.validity
function checkField(elem, check) {
    var elemName = elem.id;
    elemName = elemName.replace("_", " ");

    if (check.valueMissing) {
        alert(elemName + " field is invalid or missing");
        elem.focus();
        return false;
    }

    if (elem.hasAttribute("pattern")) {
        if (check.patternMismatch) {
            if (elem.id == "username") {            //called by register case
                alert("Invalid Username: at least 4 characters long");
            } else {
                alert("Invalid " + elemName);       //other fields in credit card case
            }
            elem.focus();
            return false;
        }
    }

    if (elem.hasAttribute("type")) {
        if (check.typeMismatch) {
            alert("Invalid " + elemName + " format");
            elem.focus();
            return false;
        }
    }

    return true;
}

//checks the passwords inserted in the register forms
function checkPasswords(pwd1, pwd1Check, pwd2, pwd2Check) {
    if (pwd1Check.valueMissing) {
        alert("Password field is missing");
        pwd1.focus();
        return false;
    }

    if (pwd2Check.valueMissing) {
        alert("Repeat password field is missing");
        pwd2.focus();
        return false;
    }

    if (pwd1Check.patternMismatch) {
        alert("Invalid Password: at least 8 characters long");
        pwd1.focus();
        return false;
    }

    if (pwd1.value != pwd2.value) {
        alert("Passwords aren't matching");
        pwd1.focus();
        return false;
    }

    return true;
}









//APPENDS DIV WITH MSG TO DISPLAY IF THE LOGIN FORM GETS WRONG USERNAME/PASSOWRD
function wrong_credentials_action() {
    var param = location.search.split("loginOK")[1];            //gets the parameter appended by login.php in case username or password are wrong
                                                                //i cannot split by '=' because there could be other equals signs in the URL, i need the string after the last one

    var loginOK = param.substring(1);                           //removes '='
    //console.log(loginOK);                   //FIRST CALL: js error -> the parameter hasn't been appended to URL yet, so substring() gets undefined and returns error
                                            //SECOND CALL: all is working -> the parameter has been set by login.php and the function can get it and work with it
    
    //It could have been done with an AJAX call but that seemed to me too much of an overkill solution
    //(i just need to display a simple error text message)
    //The page needs to get rid of the appended parameter because leaving it there will cause the other links in the page to stop working (because the URL changed)
    
    //cleaning the URL after getting the appended parameter so i don't lose it
    const cleanURL = '../html/login.php';                  //URL that willl replace the one with the appended param
    const URLtitle = 'Custom Guitars LA - Login'            //title to be displayed with the cleaned URL
    const URLstate = { additionalInformation: '' };         //the function needs this extra parameter, i leave it blank
    
    window.history.replaceState(URLstate, URLtitle, cleanURL);          //replaces the present URL withh the cleaned one

    //if the appended parameter is false (always), appends the div between the form div and the register link div
    if (loginOK == 'false') {
        var form_container = document.getElementById('form');

        var wrongLoginMsg = 'Wrong username and/or password. Try again.';

        var errorMsg_div = document.createElement('div');
        errorMsg_div.setAttribute('id', 'wrong_credentials');

        var p_errorMsg = document.createElement('p');
        var p_text_node_errorMsg = document.createTextNode(wrongLoginMsg);

        p_errorMsg.appendChild(p_text_node_errorMsg);
        errorMsg_div.appendChild(p_errorMsg);

        form_container.parentNode.insertBefore(errorMsg_div, form_container.nextSibling);       //appending between two nodes
    }
}





//APPENDS DIV WITH MSG TO DISPLAY IF THE USERNAME IS ALREADY TAKEN IN THE REGISTRATION FORM
function username_already_taken_action() {
    var param = location.search.split("registerOK")[1];            //gets the parameter appended by login.php in case username or password are wrong
                                                                //i cannot split by '=' because there could be other equals signs in the URL, i need the string after the last one

    var registerOK = param.substring(1);                           //removes '='
    //console.log(loginOK);                   //FIRST CALL: js error -> the parameter hasn't been appended to URL yet, so substring() gets undefined and returns error
                                            //SECOND CALL: all is working -> the parameter has been set by login.php and the function can get it and work with it
    
    //It could have been done with an AJAX call but that seemed to me too much of an overkill solution
    //(i just need to display a simple error text message)
    //The page needs to get rid of the appended parameter because leaving it there will cause the other links in the page to stop working (because the URL changed)
    
    //cleaning the URL after getting the appended parameter so i don't lose it
    const cleanURL = '../html/register.php';                  //URL that willl replace the one with the appended param
    const URLtitle = 'Custom Guitars LA - Register'            //title to be displayed with the cleaned URL
    const URLstate = { additionalInformation: '' };         //the function needs this extra parameter, i leave it blank
    
    window.history.replaceState(URLstate, URLtitle, cleanURL);          //replaces the present URL withh the cleaned one

    //if the appended parameter is false (always), appends the div between the form div and the register link div
    if (registerOK == 'false') {
        var form_container = document.getElementById('buttons');

        var wrongLoginMsg = 'Username already taken. Choose another username.';

        var errorMsg_div = document.createElement('div');
        errorMsg_div.setAttribute('id', 'username_taken');

        var p_errorMsg = document.createElement('p');
        var p_text_node_errorMsg = document.createTextNode(wrongLoginMsg);

        p_errorMsg.appendChild(p_text_node_errorMsg);
        errorMsg_div.appendChild(p_errorMsg);

        form_container.parentNode.insertBefore(errorMsg_div, form_container.nextSibling);       //appending between two nodes
    }
}