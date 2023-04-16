<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" aria-label="Slide 1"
            class="active"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4" class=""></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="modules/carousel/img/carousel1.jpg" alt="" class="img-fluid">
            <div class="container">
                <div class="carousel-caption text-start">
                    <h1>Example headline.</h1>
                    <p>Some representative placeholder content for the first slide of the carousel.</p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img src="modules/carousel/img/carousel2.jpg" alt="" class="img-fluid">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Another example headline.</h1>
                    <p>Some representative placeholder content for the second slide of the carousel.</p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img src="modules/carousel/img/carousel3.jpg" alt="" class="img-fluid">
            <div class="container">
                <div class="carousel-caption text-end">
                    <h1>One more for good measure.</h1>
                    <p>Some representative placeholder content for the third slide of this carousel.</p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img src="modules/carousel/img/carousel4.jpg" alt="" class="img-fluid">
            <div class="container">
                <div class="carousel-caption">
                    <h1>One more for good measure.</h1>
                    <p>Some representative placeholder content for the third slide of this carousel.</p>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<style>
    #myCarousel{
        margin-top: 80px;
    }
    .carousel-item .img-fluid {
        width: 100%;
        height: 100%;
    }
</style>