const leftSliders = document.querySelectorAll('[id^="left_slider"]');
const rightSliders = document.querySelectorAll('[id^="right_slider"]');
const image = document.querySelectorAll('[id^="review_image"]');

    for (let i = 0; i < leftSliders.length; i++) {
      leftSliders[i].addEventListener("click", function () {
        let index = photos[i].indexOf(image[i].getAttribute("src"));
        if (index > 0) {
          index = (index - 1);
          image[i].setAttribute("src", photos[i][index]);
        }
      })

      rightSliders[i].addEventListener("click", function () {
        let index = photos[i].indexOf(image[i].getAttribute("src"));
        if (index < (photos[i].length - 1)) {
          index = index + 1;
          image[i].setAttribute("src", photos[i][index]);
        }
      })
    }
