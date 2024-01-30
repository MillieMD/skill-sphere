        // Some small checks, feel free to add
        // Currently checks for: is there a password, is there a username, etc
function registerChecks(){

    let warning = false;

    let email = document.getElementById("email");
    let username = document.getElementById("username");
    let password = document.getElementById("pass");
    let confirm = document.getElementById("confirm-pass");

    warning = valuePresent(email) && valuePresent(username) && checkLength(password.value, 5, 32) && passMatch(password.value, confirm.value);

    if(warning){
        let warningText = document.getElementById("warning");

        if(warningText != null){
            warning.innerHTML = "Please check your details and re-enter";
        }

    }else{
        // Call PHP that handles entering data into database
    }

    return false; // Stop screen refresh

}

function loginChecks(){

    let warning = false;

    let username = document.getElementById("username");
    let password = document.getElementById("pass");

    warning = valuePresent(username) && valuePresent(password);

    if(warning){
        let warningText = document.getElementById("warning");

        if(warningText != null){
            warningText.innerHTML = "Please check your details and re-enter";
        }

    }else{
        // Call PHP to handle loggin user in
    }

    return false; // Stop screen refresh


}

function valuePresent(element){

    if(element.value == ""){
        
        return false;
    }

    return true;

}

function checkLength(value, min, max){

    if(value.length > max){
        return false;
    }

    if(value.length < min){
        return false;
    }

    return true;

}

function passMatch(password, confirm){

    return(password == confirm);

}