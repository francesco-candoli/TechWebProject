//SEARCH BUTTON
const search_button = document.getElementById("search_button");
const search_label = document.getElementById("search_label");
search_button.addEventListener("click", function () {
  if (search_label.value != "") {
    window.location.assign("http://localhost/ristoranti/TechWebProject/profile/".concat(search_label.value));
  }

});
