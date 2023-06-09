<!-- Cards module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<!-- Section cards: start -->
<section id="section-cards">
    <div class="container-fluid">

        <!-- Cards heading: start -->
        <h2 class="h1 font-weight-bold text-center my-4">
            <?= $lang["experience"] ?>
        </h2>
        <!-- Cards heading: end -->

        <!-- Cards: start -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 g-4">
            <div class="col">
                <div class="card mb-3 card-h">
                    <div class="row g-0">
                        <div class="col-sm-3 img-card-container">
                            <img src="img/svg/calendar.svg" class="img-fluid rounded-start icon-card" alt="calendar">
                        </div>
                        <div class="col-sm-9">
                            <div class="card-body">
                                <h5 class="card-title">5+</h5>
                                <p class="card-text">
                                    <?= $lang["years developer"] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3 card-h">
                    <div class="row g-0">
                        <div class="col-sm-3 img-card-container">
                            <img src="img/svg/star.svg" class="img-fluid rounded-start icon-card" alt="star">
                        </div>
                        <div class="col-sm-9">
                            <div class="card-body">
                                <h5 class="card-title">15+</h5>
                                <p class="card-text" data-i18n="years entrepreneur">
                                    <?= $lang["years entrepreneur"] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3 card-h">
                    <div class="row g-0">
                        <div class="col-sm-3 img-card-container">
                            <img src="img/svg/smile.svg" class="img-fluid rounded-start icon-card" alt="smile">
                        </div>
                        <div class="col-sm-9">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?= $lang["many"] ?>
                                </h5>
                                <p class="card-text">
                                    <?= $lang["courses"] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-3 card-h">
                    <div class="row g-0">
                        <div class="col-sm-3 img-card-container">
                            <img src="img/svg/keyboard.svg" class="img-fluid rounded-start icon-card" alt="keyboard">
                        </div>
                        <div class="col-sm-9">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?= $lang["thousands"] ?>
                                </h5>
                                <p class="card-text">
                                    <?= $lang["typing code"] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cards: end -->

    </div>
</section>
<!-- Section cards: end -->

<!-- Styles: start -->
<style>
    #section-cards {
        margin-top: 40px;
    }

    .card-h {
        padding: 5px;
    }

    .img-card-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .icon-card {
        width: 40px;
    }

    .card-h .card-title {
        font-weight: bold;
        color: red;
    }
</style>
<!-- Styles: end -->