    // I was trying to figure out a way to print the date and time to a input and then take that input into the PHP. I learned that it was just easier to do that in the PHP section itself and not bother in printing it at all - K. Feeney    
    
    
    // ********************************************************
    
    
    /* @ref: https://www.w3schools.com/js/js_date_methods.asp */

        /*var d = new Date(); 
        var year    = d.getFullYear();
        var month   = document.getElementById("form").innerHTML = d.getMonth(); 
        month = month+1;
        var day     = document.getElementById("form").innerHTML = d.getDate();
        var hour    = document.getElementById("form").innerHTML = d.getHours();
        var minute  = document.getElementById("form").innerHTML = d.getMinutes();*/

/* @ref: https://docs.microsoft.com/en-us/scripting/javascript/reference/date-now-function-javascript */
/*var date = Date.now();
document.write(date); */

/* @ref: https://stackoverflow.com/questions/30158574/how-to-convert-result-from-date-now-to-yyyy-mm-dd-hhmmss-ffff, edited by Feeney, K. */
/*function Login()
    {
        var result1="";
        
        var d = new Date();
        
        var year            = d.getFullYear();
        var month           = d.getMonth()+1;
        month               = '0' + month.toString().slice(-2); /*to show leading zero, returns last 2 numbers only, sp 012 -> 12. // @ref:https://stackoverflow.com/questions/3605214/javascript-add-leading-zeroes-to-date & https://stackoverflow.com/questions/30273220/uncaught-typeerror-rand-slice-is-not-a-function*/ 
        /*var day             = d.getDate();
        var hour            = d.getHours();
        var minute          = d.getMinutes();
        var second          = d.getSeconds();
                 
        result1 = year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
        var login = document.getElementById('login');
        login.value=result1;
    }*/
    
    /* document.write(date()); /* Testing */
    
/*@ref: based primarily on https://stackoverflow.com/questions/30158574/how-to-convert-result-from-date-now-to-yyyy-mm-dd-hhmmss-ffff, edited by Feeney, K. */
/*function hashed()
    {
        var result2="";
        
        var password = document.getElementById('password');
        result2 = '123abc' + password + '456def';
        
        var password_hashed = document.getElementById('password_hashed');
        password_hashed.value=result2;
    }*
    
    
    /* @ref: https://stackoverflow.com/questions/21727317/how-to-check-confirm-password-field-in-form-without-reloading-page */
    
    
    // ONLY WORKS ON INDIVIDUAL PAFE, WON'T WORK IN JS FILE ///
    
    /*var check = function() { 
        var password_verify = document.getElementById('password_verify');
        
        
        if ((document.getElementById('password').value != '') && (document.getElementById('confirm_password').value != '')){
        
            if (document.getElementById('password').value ==
                document.getElementById('confirm_password').value) {
                document.getElementById('message').style.color = '#3eb740';
                document.getElementById('message').innerHTML = '&#10004;'; //displays green check mark
                password_verify.value = "true";
                
            } else {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = '&#10008;'; //displays red X
                password_verify.value = "";
            }
        }
        else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = '&#10008;'; //displays red X
            password_verify.value = "";
        }
    } */

/*function create_cookie(name, value) {
  var date = new Date();
  date.setTime(date.getTime() + (30 * 24 * 60 * 60 * 1000));
  var expires = date.toUTCString();
  document.cookie = name + '=' + value + ';' +
                   'expires=' + expires + ';' +
                   'path=/;';
}

function delete_cookie(name){
  document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
} */

