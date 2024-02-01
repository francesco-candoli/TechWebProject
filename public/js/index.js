var leftSliders = document.querySelectorAll("#left-slider");
var rightSliders = document.querySelectorAll("#right-slider");
var image = document.querySelectorAll("#review_image");

    for (let i = 0; i < leftSliders.length; i++) {
      leftSliders[i].addEventListener("click", function () {
        console.log(photos[4]);
        console.log("searching " + image[i].getAttribute("src") + " in " + (photos[i]))
        let index = photos[i].indexOf(image[i].getAttribute("src"));
        if (index > 0) {
          index = (index - 1);
          image[i].setAttribute("src", photos[i][index]);
        }
      })

      rightSliders[i].addEventListener("click", function () {
        console.log("right slider clicked");
        let index = photos[i].indexOf(image[i].getAttribute("src"));
        if (index < (photos[i].length - 1)) {
          index = index + 1;
          image[i].setAttribute("src", photos[i][index]);
        }
      })
    }

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

    // LIKE
    var like_hiders = document.querySelectorAll("#like_hider");
    var like_divs = document.querySelectorAll("#like_div");
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

    //SEARCH BUTTON
    var search_button = document.getElementById("search_button");
    var search_label = document.getElementById("search_label");
    search_button.addEventListener("click", function () {
      if (search_label.value != "") {
        window.location.assign(profileURL.concat(search_label.value));
      }

    });

    //PROFILE PHOTO BUTTON
    var profile_photo_btn = document.getElementById("change_profile_photo_btn");
    var profile_photo_form = document.getElementById("change_profile_photo_form");
    profile_photo_btn.addEventListener("click", function () {
      if (profile_photo_form.getAttribute("style") == "") {
        profile_photo_form.setAttribute("style", "display:none");
      } else {
        profile_photo_form.setAttribute("style", "");
      }
    })
