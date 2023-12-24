// loads the images onto an collection of img elements
const imgs = document.getElementsByTagName("img");
// sets the first image as the current one and hides the others
let currentIndex = 0;
imgs[currentIndex].classList.add("current");
hideNonCurrent();
// sets the second image as visible
imgs[currentIndex+1].style.visibility = "visible";

for (let i = 0; i < imgs.length; i++) {
    imgs[i].addEventListener("click", function () {
        // if the clicked image is already the current one, do nothing
        if (i === currentIndex) return;
        // switches the current image
        imgs[currentIndex].classList.remove("current");
        currentIndex = i;
        imgs[currentIndex].classList.add("current");
        // hides all the images except the current one and the adjacent ones
        hideNonCurrent();
        if (currentIndex > 0) imgs[currentIndex-1].style.visibility = "visible";
        if (currentIndex < imgs.length-1) imgs[currentIndex+1].style.visibility = "visible";
    });
}

/**
 * Hides all the images except the current one
 */
function hideNonCurrent() {
    for (let i = 0; i < imgs.length; i++) {
        if (i !== currentIndex) imgs[i].style.visibility = "hidden";
    }
}