const usernameFiled = document.getElementById("nickname");
const passwordField = document.getElementById("password-register");
const registerButton = document.getElementById("registerButton");
const sexField = document.getElementById("sex");
const ageField = document.getElementById("age");

if(registerButton!=null){
  registerButton.disabled=true;

}

if(sexField!=null){
  sexField.addEventListener("change", (event)=>{
    if(sexField.value.length==0){
      sexField.style = "color: red";
        registerButton.disabled=true;
        alert("inserisci il sesso");
  
    }else{
      sexField.style="";
    }
  });
}



if(usernameFiled!=null){
  usernameFiled.addEventListener("change", (event) => {
    // 1. Crea un nuovo oggetto XMLHttpRequest
    let xhr = new XMLHttpRequest();
    // 2. Lo configura: richiesta GET per l'URL /article/.../load
    xhr.open('GET', 'http://localhost/ristoranti/TechWebProject/checkUsername/' + usernameFiled.value);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    // 3. Invia la richiesta alla rete
    xhr.send();
    // 4. Questo codice viene chiamato dopo la ricezione della risposta
    xhr.onload = function () {
      if (xhr.status != 200) { // analizza lo status HTTP della risposta
        usernameFiled.style = "color: red";
        registerButton.disabled=true;
        alert("username già esistente");
      } else { // mostra il risultato
        //alert(`Done, ${xhr.response}`); // response contiene la risposta del server
        usernameFiled.style = "color: green";
        registerButton.disabled=false;
      }
    };
    xhr.onerror = function () {
  
    };
  
  });
}

if(passwordField!=null){
  passwordField.addEventListener("change", (event) => {
    if (passwordField.value == "") {
      passwordField.style = "color: red";
      registerButton.disabled=true;
    } else {
      if (!passwordField.value.includes(' ')) {
        if (passwordField.value.length < 8) {
          passwordField.style = "color: red";
          registerButton.disabled=true;
          alert("la password deve avere almeno 8 caratteri")
        } else {
          var specialChars = "<>@!#$%^&*()_+[]{}?:;";
          var checkForSpecialChar = function (string) {
            for (i = 0; i < specialChars.length; i++) {
              if (string.indexOf(specialChars[i]) > -1) {
                return false
              }
            }
            return true;
          }
          if (checkForSpecialChar(passwordField.value)) {
            passwordField.style = "color: red";
            registerButton.disabled=true;
            alert("la password deve contenere almeno un carattere speciale")
          } else {
            registerButton.disabled=false;
            passwordField.style = "color: green";
          }
        }
      } else {
        passwordField.style = "color: red";
        registerButton.disabled=true;
        alert("non ammessi spazi bianchi");
      }
  
    }
  
  
  
  
  });
}



