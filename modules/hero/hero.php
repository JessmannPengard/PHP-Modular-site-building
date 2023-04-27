<!-- Hero module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<!-- Hero section: start -->
<div id="hero-section" class="p-5 text-center bg-image">

    <!-- Masked area: start -->
    <div class="mask">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="text-white">

                <!-- Hero title: start -->
                <h1 class="mb-3" data-i18n="hero title">Hero section</h1>
                <!-- Hero title: end -->

                <!-- Hero text: start -->
                <h5 class="mb-4" data-i18n="hero text">
                    This is a hero section sample
                </h5>
                <!-- Hero text: end -->

                <!-- Hero buttons: start -->
                <a class="btn btn-outline-light btn-lg m-2" href="#" data-i18n="hero btn 1">Action</a>
                <a class="btn btn-outline-light btn-lg m-2" href="#" data-i18n="hero btn 2">Another Action</a>
                <!-- Hero buttons: end -->

            </div>
        </div>
    </div>
    <!-- Masked area: end -->

</div>
<!-- Hero section: end -->

<!-- Styles: start -->
<style>
    #hero-section {
        height: 100vh;
        padding-top: 80px;
        background-size: cover;
        background-position: center;
        background-image: url('img/hero.png');
        position: relative;
    }

    .mask {
        position: absolute;
        left: 0;
        top: 0;
        background-image: linear-gradient(to bottom, rgba(0, 0, 0, 1), rgba(0, 0, 0, 0.3));
        width: 100%;
        height: 100%;
    }
</style>
<!-- Styles: end -->