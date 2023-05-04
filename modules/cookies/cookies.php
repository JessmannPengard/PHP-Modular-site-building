<!-- Cookie Banner: start -->
<div id="cookie-banner" class="alert alert-dark text-center mb-0" role="alert">
    <?= $lang["cookie banner"] ?>
    <a href="legal/cookies.policy.php" target="blank">
        <?= $lang["learn more"] ?>
    </a>
    <button type="button" class="btn btn-outline-light btn-sm ms-3" id="btn-refuse-cookies">
        <?= $lang["refuse"] ?>
    </button>
    <button type="button" class="btn btn-light btn-sm ms-3" id="btn-accept-cookies" autofocus>
        <?= $lang["accept"] ?>
    </button>
</div>
<!-- Cookie Banner: end -->

<!-- Script: start -->
<script>
    /* Show and hide cookie banner using localStorage */
    document.addEventListener('DOMContentLoaded', function () {
        let cookieBanner = document.getElementById("cookie-banner");
        let btnAcceptCookies = document.getElementById("btn-accept-cookies");
        let btnRefuseCookies = document.getElementById("btn-refuse-cookies");

        btnAcceptCookies.addEventListener("click", acceptCookies);
        btnRefuseCookies.addEventListener("click", refuseCookies);

        initializeCookieBanner();

        /* Shows the Cookie banner */
        function showCookieBanner() {
            cookieBanner.classList.add("slide-up");
        }

        /* Hides the Cookie banner and saves the value to localStorage */
        function acceptCookies() {
            localStorage.setItem("isCookieAccepted", "yes");
            cookieBanner.style.display = "none";
        }

        /* Hides the Cookie banner and saves the value to localStorage */
        function refuseCookies() {
            localStorage.setItem("isCookieAccepted", "no");
            cookieBanner.style.display = "none";
        }

        /* Checks the localStorage and shows Cookie banner based on it. */
        function initializeCookieBanner() {
            let isCookieAccepted = localStorage.getItem("isCookieAccepted");

            switch (isCookieAccepted) {
                case null: // Not set
                    localStorage.setItem("isCookieAccepted", "no");
                    disableCookies();
                    showCookieBanner();
                    break;
                case "no": // Not accepted
                    disableCookies();
                    showCookieBanner();
                default: // Accepted

                    break;
            }
        }

        // Disable cookies
        function disableCookies() {
            document.cookie = "cookieName=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        }
    });
</script>
<!-- Script: end -->

<!-- Styles: start -->
<style>
    #cookie-banner {
        background-color: black;
        color: white;
        position: fixed;
        width: 100%;
        z-index: 999;
        border: none;
        border-radius: 0;
        /* Slide up */
        bottom: -100%;
        left: 0;
        /* Slide right */
        /*bottom: 0;
        left: -100%;*/
        transition: all 2s ease-out;
    }

    #cookie-banner.slide-up {
        bottom: 0;
        /* Slide right */
        /*left: 0;*/
    }
</style>
<!-- Styles: end -->