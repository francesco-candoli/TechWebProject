// LIKE
const like_hiders = document.querySelectorAll('[id^="like_hider"]');
const like_divs = document.querySelectorAll('[id^="like_div"]');
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