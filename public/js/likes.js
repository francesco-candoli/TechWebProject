// LIKE
const like_hiders = document.querySelectorAll('[id^="like_hider"]');
const like_divs = document.querySelectorAll('[id^="like_div"]');
if(like_hiders != null){
  for (let i = 0; i < like_hiders.length; i++) {
    like_hiders[i].addEventListener("click", function () {
      if (like_divs[i].getAttribute("style") == "") {
        like_divs[i].setAttribute("style", "display:none");
        like_hiders[i].setAttribute("class", "btn btn-outline-danger");
      } else {
        like_divs[i].setAttribute("style", "");
        like_hiders[i].setAttribute("class", "btn btn-danger");
      }
    })
  }
}


const like_btns = document.querySelectorAll('[id^="like_btn"]');
if(like_btns!=null){
  for (let i = 0; i < like_btns.length; i++) {
    like_btns[i].onclick = function(){
      changeStatusOfLike(like_btns[i].getAttribute("data-userId"),like_btns[i].getAttribute("data-reviewId"));
    }
  }
}


function changeStatusOfLike(user_id, review_id) {
  // 1. Crea un nuovo oggetto XMLHttpRequest
  let xhr = new XMLHttpRequest();
  // 2. Lo configura: richiesta GET per l'URL /article/.../load
  xhr.open('GET', subfolderURL + "like/changeStatus/" + user_id + "_" + review_id);
  // 3. Invia la richiesta alla rete
  xhr.send();
  // 4. Questo codice viene chiamato dopo la ricezione della risposta
  xhr.onload = function () {
    if (xhr.status != 200) { // analizza lo status HTTP della risposta
      alert(`Error ${xhr.status}: ${xhr.statusText}`); // ad esempio 404: Not Found
    } else { // mostra il risultato
      //alert(`Done, ${xhr.response}`); // response contiene la risposta del server
    }
  };
  xhr.onerror = function () {
    alert("Request failed");
  };
  window.location.reload();
  window.location.reload();
}