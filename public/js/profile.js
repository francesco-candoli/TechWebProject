
//PROFILE PHOTO BUTTON
const profile_photo_btn = document.getElementById("change_profile_photo_btn");
const profile_photo_form = document.getElementById("change_profile_photo_form");
if (profile_photo_btn != null) {
  profile_photo_btn.addEventListener("click", function () {
    if (profile_photo_form.getAttribute("style") == "") {
      profile_photo_form.setAttribute("style", "display:none");
    } else {
      profile_photo_form.setAttribute("style", "");
    }
  });
}


const delete_profile_image_btn = document.getElementById("delete_profile_image_btn");
if (delete_profile_image_btn != null) {
  delete_profile_image_btn.addEventListener("click", function () {
    deleteProfileImage();
  })
}

function deleteProfileImage() {

  // 1. Crea un nuovo oggetto XMLHttpRequest
  let xhr = new XMLHttpRequest();
  // 2. Lo configura: richiesta GET per l'URL /article/.../load
  xhr.open('GET', subfolderURL + 'deleteProfileImage');
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

const change_follow_status_btn = document.getElementById("change_follow_status_btn");
if (change_follow_status_btn != null) {
  change_follow_status_btn.addEventListener("click", function () {
    changeFollowStatus(change_follow_status_btn.getAttribute("data-profileId"));
  })
}

function changeFollowStatus(user_id) {

  // 1. Crea un nuovo oggetto XMLHttpRequest
  let xhr = new XMLHttpRequest();
  // 2. Lo configura: richiesta GET per l'URL /article/.../load
  xhr.open('GET', subfolderURL + 'follow/changeStatus/' + user_id);
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