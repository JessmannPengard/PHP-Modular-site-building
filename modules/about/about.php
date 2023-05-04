<!-- About module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<!-- Section about: start -->
<section class="section bg-light" id="section-about">
    <div class="container">
        <div class="row align-items-center justify-content-around flex-row-reverse">

            <!-- About text area: start -->
            <div class="col-lg-6">
                <div class="about-text">

                    <!-- About title: start -->
                    <h3>
                        <?= $lang["about title"] ?>
                    </h3>
                    <!-- About title: end -->

                    <!-- About subtitle: start -->
                    <h4 class="theme-color">
                        <?= $lang["about subtitle"] ?>
                    </h4>
                    <!-- About subtitle: end -->

                    <!-- About text: start -->
                    <p>
                        <?= $lang["about text"] ?>
                    </p>
                    <!-- About text: end -->

                    <!-- About buttons: start -->
                    <div class="btn-bar">
                        <a class="btn btn-outline-dark btn-lg m-2" href="#">
                            <?= $lang["about btn 1"] ?>
                        </a>
                        <a class="btn btn-dark btn-lg m-2" href="#">
                            <?= $lang["about btn 2"] ?>
                        </a>
                    </div>
                    <!-- About buttons: end -->

                </div>
            </div>
            <!-- About text area: end -->

            <!-- About image area: start -->
            <div class="col-lg-5 text-center">
                <div class="about-img">
                    <img class="about-profile-picture" src="upload/profiles/qwerty12345.png">
                </div>
            </div>
            <!-- About image area: end -->

        </div>
    </div>
</section>
<!-- Section about: end -->

<!-- styles: start -->
<style>
    @media (max-width: 991px) {
        .about-text {
            margin-top: 40px;
        }
    }

    .about-text h3 {
        font-size: 45px;
        font-weight: 700;
        margin: 0 0 10px;
    }

    @media (max-width: 767px) {
        .about-text h3 {
            font-size: 35px;
        }
    }

    .about-text h4 {
        font-weight: 600;
        margin-bottom: 15px;
    }

    @media (max-width: 767px) {
        .about-text h4 {
            font-size: 18px;
        }
    }

    .about-text p {
        font-size: 18px;
    }

    .about-text .btn-bar {
        padding-top: 8px;
    }

    .about-text .btn-bar a {
        min-width: 150px;
        text-align: center;
        margin-right: 10px;
    }

    @media (max-width: 991px) {
        .about-img {
            margin-top: 30px;
        }
    }

    .about-profile-picture {
        border-radius: 200px;
        max-width: 80%;
    }

    .theme-color {
        color: #fe4f6c;
    }

    #about-section {
        padding: 50px 0;
        position: relative;
    }
</style>
<!-- styles: end -->