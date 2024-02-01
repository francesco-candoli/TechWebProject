//SEARCH BUTTON
const search_button = document.getElementById("search_button");
const search_label = document.getElementById("search_label");
search_button.addEventListener("click", function () {
  if (search_label.value != "") {
    window.location.assign(profileURL.concat(search_label.value));
  }

});

//PROFILE PHOTO BUTTON
const profile_photo_btn = document.getElementById("change_profile_photo_btn");
const profile_photo_form = document.getElementById("change_profile_photo_form");
profile_photo_btn.addEventListener("click", function () {
  if (profile_photo_form.getAttribute("style") == "") {
    profile_photo_form.setAttribute("style", "display:none");
  } else {
    profile_photo_form.setAttribute("style", "");
  }
});
