<!-- Cards module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<!-- Section cards: start -->
<section id="section-cards">
    <div class="container-fluid">

        <!-- Cards heading: start -->
        <h2 class="h1 font-weight-bold text-center my-4">
            <?= $lang["cards-v heading"] ?>
        </h2>
        <!-- cards heading: end -->

        <!-- Cards: start -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-5 g-3">
            <div class="col">
                <div class="card card-v bg-light">
                    <img src="modules/cards/img/padel.jpg" class="card-img-top" alt="padel">
                    <div class="card-body">
                        <small class="card-title">
                            <?= $lang["paddle title"] ?>
                        </small>
                        <p class="text-muted">
                            <?= $lang["paddle text"] ?>
                        </p>
                    </div>
                    <div class="card-footer text-center">
                        <p><small><a href="" class="card-link">
                                    <?= $lang["visit web"] ?>
                                </a></small></p>
                        <p><small><a href="" class="card-link">
                                    <?= $lang["repo"] ?>
                                </a></small></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-v bg-light">
                    <img src="modules/cards/img/transylvania.jpg" class="card-img-top" alt="transylvania">
                    <div class="card-body">
                        <small class="card-title">
                            <?= $lang["heavy title"] ?>
                        </small>
                        <p class="text-muted">
                            <?= $lang["heavy text"] ?>
                        </p>
                    </div>
                    <div class="card-footer text-center">
                        <p><small><a href="" class="card-link">
                                    <?= $lang["visit web"] ?>
                                </a></small></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-v bg-light">
                    <img src="modules/cards/img/lopaje.jpg" class="card-img-top" alt="lopaje">
                    <div class="card-body">
                        <small class="card-title">
                            <?= $lang["voting title"] ?>
                        </small>
                        <p class="text-muted">
                            <?= $lang["voting text"] ?>
                        </p>
                    </div>
                    <div class="card-footer text-center">
                        <p><small><a href="" class="card-link">
                                    <?= $lang["visit web"] ?>
                                </a></small></p>
                        <p><small><a href="" class="card-link">
                                    <?= $lang["repo"] ?>
                                </a></small></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-v bg-light">
                    <img src="modules/cards/img/padel.jpg" class="card-img-top" alt="padel">
                    <div class="card-body">
                        <small class="card-title">
                            <?= $lang["paddle title"] ?>
                        </small>
                        <p class="text-muted">
                            <?= $lang["paddle text"] ?>
                        </p>
                    </div>
                    <div class="card-footer text-center">
                        <p><small><a href="" class="card-link">
                                    <?= $lang["visit web"] ?>
                                </a></small></p>
                        <p><small><a href="" class="card-link">
                                    <?= $lang["repo"] ?>
                                </a></small></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-v bg-light">
                    <img src="modules/cards/img/transylvania.jpg" class="card-img-top" alt="transylvania">
                    <div class="card-body">
                        <small class="card-title">
                            <?= $lang["heavy title"] ?>
                        </small>
                        <p class="text-muted">
                            <?= $lang["heavy text"] ?>
                        </p>
                    </div>
                    <div class="card-footer text-center">
                        <p><small><a href="" class="card-link">
                                    <?= $lang["visit web"] ?>
                                </a></small></p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-v bg-light">
                    <img src="modules/cards/img/lopaje.jpg" class="card-img-top" alt="lopaje">
                    <div class="card-body">
                        <small class="card-title">
                            <?= $lang["voting title"] ?>
                        </small>
                        <p class="text-muted">
                            <?= $lang["voting text"] ?>
                        </p>
                    </div>
                    <div class="card-footer text-center">
                        <p><small><a href="" class="card-link">
                                    <?= $lang["visit web"] ?>
                                </a></small></p>
                        <p><small><a href="" class="card-link">
                                    <?= $lang["repo"] ?>
                                </a></small></p>
                    </div>
                </div>
            </div>
            <!-- Cards: end -->

        </div>
</section>
<!-- Section cards: end -->

<!-- Styles: start -->
<style>
    .card-v {
        margin: 0 10px;
        border: none;
        --bs-card-inner-border-radius: 0;
    }

    .card-v .card-title {
        font-weight: bold;
    }

    .card-v .card-body {
        padding-bottom: 0;
    }

    .card-v .card-body p {
        margin-bottom: 5px;
    }

    .card-v .card-footer {
        margin-top: 5px;
    }

    .card-v .card-footer p {
        margin-bottom: 0;
    }

    .card-link {
        text-decoration: none;
        color: red;
    }
</style>
<!-- Styles: end