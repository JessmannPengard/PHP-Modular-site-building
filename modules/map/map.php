<!-- Map module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<!-- Google maps Map: start -->
<div class="google-wrapper">

    <!-- Map: start -->
    <div id="google-map"><iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62513.52515193634!2d25.169369155204244!3d46.17595857514815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x474ea6b445f0d63d%3A0x5d14bec93dcb981c!2sTransilvania%2C%20Ruman%C3%ADa!5e0!3m2!1ses!2ses!4v1678554469631!5m2!1ses!2ses"
            width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe></div>
    <!-- Map: end -->

    <!-- Overlay: start -->
    <div id="google-map-overlay"></div>
    <!-- Overlay: end -->

</div>
<!-- Google maps Map: end -->

<!-- Styles: start -->
<style>
    /* Map Overlay */
    .google-wrapper {
        position: relative;
    }

    #google-map-overlay {
        width: 100%;
        height: 100%;
        background: black;
        position: absolute;
        opacity: 0.5;
        top: 0px;
        left: 0px;
        z-index: 99;
        pointer-events: none;
    }
</style>
<!-- Styles: end -->