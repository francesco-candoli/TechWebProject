// SLIDER IMMAGINI

const leftSliders = document.querySelectorAll("#left-slider");
const rightSliders = document.querySelectorAll("#right-slider");
const image = document.querySelectorAll("#review_image");

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






// COMMENTI

const comment_hiders = document.querySelectorAll("#comment_hider");
const comment_divs = document.querySelectorAll("#comment_div");
console.log(comment_divs.length);
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

const like_hiders = document.querySelectorAll("#like_hider");
const like_divs = document.querySelectorAll("#like_div");
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