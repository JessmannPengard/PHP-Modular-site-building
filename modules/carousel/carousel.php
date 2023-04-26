<!-- Carousel module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<!-- Carousel section: start -->
<section id="section-carousel">

    <!-- Carousel: start -->
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">

        <!-- Carousel indicators: start -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" aria-label="Slide 1" class="active"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
        </div>
        <!-- Carousel indicators: end -->

        <!-- Carousel inner: start -->
        <div class="carousel-inner">

            <!-- Carousel items: start -->
            <div class="carousel-item active">
                <img src="modules/carousel/img/carousel1.jpg" alt="" class="img-fluid">
                <div class="container">
                    <!-- Content start -->
                    <div class="carousel-caption text-start">
                        <h1 data-i18n="carouselH1">Example headline.</h1>
                        <p data-i18n="carouselB1">Some representative placeholder content for the first slide of the carousel.</p>
                        <button class="btn btn-primary" data-i18n="carouselBTN1">Do something</button>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="modules/carousel/img/carousel2.jpg" alt="" class="img-fluid">
                <div class="container">
                    <!-- Content middle -->
                    <div class="carousel-caption">
                        <h1 data-i18n="carouselH2">Another example headline.</h1>
                        <p data-i18n="carouselB2">Some representative placeholder content for the second slide of the carousel.</p>
                        <button class="btn btn-warning" data-i18n="carouselBTN2">Do something</button>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="modules/carousel/img/carousel3.jpg" alt="" class="img-fluid">
                <div class="container">
                    <!-- Content end -->
                    <div class="carousel-caption text-end">
                        <h1 data-i18n="carouselH3">One more for good measure.</h1>
                        <p data-i18n="carouselB3">Some representative placeholder content for the third slide of this carousel.</p>
                        <button class="btn btn-danger" data-i18n="carouselBTN3">Do something</button>
                    </div>
                </div>
            </div>
            <!-- Carousel items: end -->

        </div>
        <!-- Carousel inner: end -->

        <!-- Carousel controls: start -->
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden" data-i18n="previous">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden" data-i18n="next">Next</span>
        </button>
        <!-- Carousel controls: end -->

    </div>
    <!-- Carousel: end -->

</section>
<!-- Carousel section: end -->

<!-- Carousel styles: start -->
<style>
    #myCarousel {
        margin-top: 80px;
    }

    .carousel-item .img-fluid {
        width: 100%;
        height: 100%;
    }
</style>
<!-- Carousel styles: end -->