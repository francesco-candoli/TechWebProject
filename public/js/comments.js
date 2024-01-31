  // COMMENTI
  var comment_hiders = document.querySelectorAll("#comment_hider");
  var comment_divs = document.querySelectorAll("#comment_div");
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