//COMMENTI
const comment_hiders = document.querySelectorAll('[id^="comment_hider"]');
const comment_divs = document.querySelectorAll('[id^="comment_div"]');
if(comment_hiders!=null){
  for (let i = 0; i < comment_hiders.length; i++) {
    
    comment_hiders[i].addEventListener("click", function () {
      if (comment_divs[i].getAttribute("style") == "") {
        comment_divs[i].setAttribute("style", "display:none");
        comment_hiders[i].setAttribute("class", "btn btn-outline-primary");
      } else {
        comment_divs[i].setAttribute("style", "");
        comment_hiders[i].setAttribute("class", "btn btn-primary");
      }
    })
  }
}


const comment_btns = document.querySelectorAll('[id^="comment_btn"]');
const comment_labels = document.querySelectorAll('[id^="comment_label"]');
if(comment_btns!=null){
  for (let i = 0; i < comment_btns.length; i++) {
    comment_btns[i].addEventListener('click',function() {
      addComment(comment_btns[i].getAttribute("data-reviewId"), comment_labels[i].value)
    })
  }
}


function addComment(review_id, content){
  alert(review_id + " " + content);
  
  // 1. Crea un nuovo oggetto XMLHttpRequest
  let xhr = new XMLHttpRequest();
  // 2. Lo configura: richiesta GET per l'URL /article/.../load
  xhr.open('POST', subfolderURL + "addComment");
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  // 3. Invia la richiesta alla rete
  xhr.send("review_id="+review_id+"&content="+content);
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