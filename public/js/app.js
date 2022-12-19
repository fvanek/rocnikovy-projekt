import "./bootstrap";

window.addEventListener("scroll", function () {
    if (window.scrollY >= document.body.offsetHeight - window.innerHeight) {
        document.querySelector("footer").style.display = "none";
    }
    if (window.scrollY < document.body.offsetHeight - window.innerHeight) {
        document.querySelector("footer").style.display = "block";
    }
});
