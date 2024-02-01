
const notification_delete_btns = document.querySelectorAll('[id^="notification_delete_btn"]');

if(notification_delete_btns!=null){
    for (let i = 0; i < notification_delete_btns.length; i++) {
        notification_delete_btns[i].addEventListener('click', function(){
            
            deleteNotification(notification_delete_btns[i].getAttribute("data-Id"));
        })
    }
}


function deleteNotification(id) {
    // 1. Crea un nuovo oggetto XMLHttpRequest
    let xhr = new XMLHttpRequest();
    // 2. Lo configura: richiesta GET per l'URL /article/.../load
    xhr.open('GET', window.location.href+'/delete/' + id);
    // 3. Invia la richiesta alla rete
    xhr.send();
    // 4. Questo codice viene chiamato dopo la ricezione della risposta
    xhr.onload = function () {
      if (xhr.status != 200) { // analizza lo status HTTP della risposta
        alert(`Error ${xhr.status}: ${xhr.statusText}`); // ad esempio 404: Not Found
      } else { // mostra il risultato
        alert(`Done, ${xhr.response}`); // response contiene la risposta del server
      }
    };
    xhr.onerror = function () {
      alert("error");
    };
    window.location.reload();
    window.location.reload();
  }