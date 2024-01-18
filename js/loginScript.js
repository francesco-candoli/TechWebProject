var loginButton=document.getElementById("login");
var registerButton=document.getElementById("registrati");
var form=document.getElementById("result");

loginButton.addEventListener('click',function(){
    form.innerHTML="<form action='auth/' method='POST'><input type='text' id='login' class='fadeIn second' name='uname' placeholder='username'><input type='password' id='password' class='fadeIn third' name='passw' placeholder='password'><input type='submit' class='fadeIn fourth' value='Log In'></form>";
    $('#registrati').removeClass('active');
    $('#login').removeClass('inactive underlineHover');
    $('#login').toggleClass('active');
    $('#registrati').toggleClass('inactive underlineHover');
});
registerButton.addEventListener('click', function(){
    form.innerHTML="<form action='auth/' method='POST'><input type='text' id='login' class='fadeIn second' name='uname' placeholder='username'><input type='password' id='password' class='fadeIn third' name='passw' placeholder='password'><input type='submit' class='fadeIn fourth' value='Log In'></form> DIO pORCO";
    $('#login').removeClass('active');
    $('#registrati').removeClass('inactive underlineHover');
    $('#registrati').toggleClass('active');
    $('#login').toggleClass('inactive underlineHover');
});