const usernameFiled = document.getElementById("nickname");
const passwordField = document.getElementById("password-register");
const registerButton = document.getElementById("registerButton");
const ageField = document.getElementById("age");

const checker=[0,0,0];

if(registerButton!=null){
  registerButton.disabled=true;

}


if(ageField!=null){
  ageField.addEventListener("change", (event)=>{
    if(ageField.value<16){
      ageField.style = "color: red";
        checker[0]=0;
        alert("Devi avere almeno 16 anni");
        checkSubmit()
  
    }else{
      checker[0]=1;
      checkSubmit()
      ageField.style="";
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
        checker[1]=0;
        checkSubmit()
        alert("username già esistente");
      } else { // mostra il risultato
        //alert(`Done, ${xhr.response}`); // response contiene la risposta del server
        usernameFiled.style = "color: green";
        checker[1]=1;
        checkSubmit()
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
      checker[2]=0;
      checkSubmit()
    } else {
      if (!passwordField.value.includes(' ')) {
        if (passwordField.value.length < 8) {
          passwordField.style = "color: red";
          checker[2]=0;
          checkSubmit()
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
            checker[2]=0;
            checkSubmit()
            alert("la password deve contenere almeno un carattere speciale")
          } else {
            checker[2]=1;
            checkSubmit()
            passwordField.style = "color: green";
          }
        }
      } else {
        passwordField.style = "color: red";
        checker[2]=0;
        checkSubmit()
        alert("non ammessi spazi bianchi");
      }
  
    }
  });
}

function checkSubmit(){
  if(checker[0]==1 && checker[1]==1 && checker[2]==1){
    registerButton.disabled=false;
  }else{
    registerButton.disabled=true;
  }
}

