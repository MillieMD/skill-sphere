        // Some small checks, feel free to add
        // Currently checks for: is there a password, is there a username, etc
function registerChecks(){

    console.log("checking validity of inputs");

    let warning = false;

    let email = "testinput123";//document.getElementById("email");
    let username = "testinput123";//document.getElementById("username");
    let password = "testinput123"; //document.getElementById("pass");
    let confirm = "testinput123";//document.getElementById("confirm-pass");

    //correctness = valuePresent(email) && valuePresent(username) && checkLength(password.value, 5, 32) && passMatch(password.value, confirm.value);
    //console.log("warning is = " + warning);

    if(false){
        let warningText = document.getElementById("warning");
        console.log("warning!");

        if(warningText != null){
            warning.innerHTML = "Please check your details and re-enter";
        }

    }else{
        console.log("no warning!");
        // Call PHP that handles entering data into database
        $.ajax({

            url : '../php/userRegister.php',
            type : 'POST',
            success : function (result) {
               console.log (result); // Here, you need to use response by PHP file.
            },
            error : function () {
               console.log ('error');
            }
       
          });
    
    }

    console.log("false return!");

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
        console.log("Null value");
        return false;
    }
    console.log("Present value");
    return true;

}

function checkLength(value, min, max){

    if(value.length > max){
        console.log("too big");
        return false;
        
    }

    if(value.length < min){
        console.log("too small");
        return false;
    }

    console.log("correct length");
    return true;

}

function passMatch(password, confirm){
    console.log("matched passwords");
    return(password == confirm);

}