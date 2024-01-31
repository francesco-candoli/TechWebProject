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
