<footer class="shadow-lg">
    <div class="d-flex justify-content-between py-3 bg-white fixed-bottom rounded mb-2 mx-2">
        <div class="align-items-center ms-4">
            <span class="mb-3 mb-md-0 text-muted">&copy; 2022 Filip Vaněk</span>
        </div>
        <ul class="nav justify-content-end list-unstyled">
            <li class="ms-3">
                <a class="text-muted" id="footericons" href="https://twitter.com/skeroparno" target="_blank"><i
                        class="fa-brands fa-twitter"></i></a>
            </li>
            <li class="ms-3"><a class="text-muted" id="footericons" href="https://www.instagram.com/_filip.vanek_/"
                    target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
            <li class="ms-3 me-3"><a class="text-muted" id="footericons" href="https://www.facebook.com/skeroparno"
                    target="_blank"><i class="fa-brands fa-facebook"></i>
                </a></li>
        </ul>
    </div>
</footer>
<script>
    window.addEventListener("scroll", function() {
        if (
            window.scrollY + 20 >=
            document.body.offsetHeight - window.innerHeight
        ) {
            document.querySelector("#footer").style.opacity = "0";
            setTimeout(() => {
                document.querySelector("#footer").style.display = "none";
            }, 500);
        } else {
            document.querySelector("#footer").style.opacity = "1";
            setTimeout(() => {
                document.querySelector("#footer").style.display = "block";
            }, 500);
        }
    });

    document.querySelectorAll("#footericons").forEach((item) => {
        item.addEventListener("mouseover", (event) => {
            item.classList.remove("text-muted");
        });
        item.addEventListener("mouseleave", (event) => {
            item.classList.add("text-muted");
        });
    });
</script>
