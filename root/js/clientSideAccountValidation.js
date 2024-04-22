        // Some small checks, feel free to add
        // Currently checks for: is there a password, is there a username, etc
$.getscript("../js/Encryption.js",function(){
       Encrypt();
});

function registerChecks(){
    

    console.log("checking validity of inputs");

    let warning = false;

    let email = document.getElementById("email").value
    let username = document.getElementById("username").value;
    let password = document.getElementById("pass").value;
    let confirm = document.getElementById("confirm-pass").value;
    

    correctness = valuePresent(email) && valuePresent(username) && passMatch(password.value, confirm.value);
    console.log("warning is = " + warning);

    
    if(!correctness){
        let warningText = document.getElementById("warning");
        console.log("warning!");

        if(warningText != null){
            warning.innerHTML = "Please check your details and re-enter";
        }

    }else{
        console.log("no warning!");
        console.log(username + " | " + password + " | " + email);
        // Call PHP that handles entering data into database
        $.ajax({
            url : '../php/userRegister.php',
            type : 'POST',
            data : {
                "userName" : username,
                "passWord" : Encrypt(password),
                "emailS" : email,
                "date" : new Date().toLocaleDateString(),
            },
            success : function (result) {
                console.log(result.toString().split(">")[2]);
                if(result.toString().split(">")[2] == "\nLOGGED_IN"){
                    window.location.replace("https://selene.hud.ac.uk/u2265397/root/pages/profile.php");
                }else{
                    let warningText =  document.getElementById("warning");
                    warningText.innerHTML = result;
                }
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


    username = document.getElementById("username").value;
    password = document.getElementById("pass").value;


    warning = valuePresent(username) && valuePresent(password);


    if(!warning){
        let warningText = document.getElementById("warning");

        if(warningText != null){
            warningText.innerHTML = "Please check your details and re-enter";
        }

    }else{
        
        
        // Call PHP to handle loggin user in
        console.log(username + " | " + password);
        $.ajax({
            url : '../php/userLogin.php',
            type : 'POST',
            data : {
                "userName" : username,
                "passWord" : Encrypt(password),
            },
            success : function (result) {
                console.log(result.toString().split(">")[2]);
                if(result.toString().split(">")[2] == "\nLOGGED_IN"){
                    window.location.replace("https://selene.hud.ac.uk/u2265397/root/pages/profile.php");
                }else{
                    let warningText =  document.getElementById("warning");
                    warningText.innerHTML = result;
                }
               
            },
            error : function () {
               console.log ('error');
            }
       
          });
    
    }

    return false; // Stop screen refresh


}

function valuePresent(element){

    if(element == ""){
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