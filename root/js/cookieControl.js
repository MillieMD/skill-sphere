//accessable cookies will be: Username, Email, Joindate


function setCookie(name,value) {
  console.log("creating cookie!");
  document.cookie = name + "=" + value  + "; path= '/'; httpOnly = false";
}
function getCookie(name, docID) {

  $.ajax({
    url : '../php/userData.php',
    type : 'POST',
    data : {
        "cName" : name,       
    },
    success : function (result) {
      if(name == "Joindate"){result = dateReconfig(result);}
        document.getElementById(docID).innerHTML = result;       
    },
    error : function () {
       console.log ('error');
    }
  });
}
function eraseCookie(name) {   
  document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function dateReconfig(date){
  var date = date.split('-');
  newDate = date[2] + "-" + date[1] + "-" + date[0];
  return newDate;
}