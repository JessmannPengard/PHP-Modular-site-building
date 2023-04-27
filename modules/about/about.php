<section class="section gray-bg" id="about-section">
    <div class="container">
        <div class="row align-items-center justify-content-around flex-row-reverse">
            <div class="col-lg-6">
                <div class="about-text">
                    <h3 class="dark-color">Do some awsome stuff with me.</h3>
                    <h4 class="theme-color">UI / UX Designer &amp; Web Developer</h4>
                    <p>I design and develop services for customers of all sizes, specializing in creating stylish,
                        modern websites, web services and online stores. My passion is to design digital user
                        experiences through the bold interface and meaningful interactions.</p>
                    <p>I design and develop services for customers of all sizes, specializing in creating stylish,
                        modern websites, web services and online stores.</p>
                    <div class="btn-bar">
                        <a class="px-btn theme" href="#">View Works</a>
                        <a class="px-btn theme-t" href="#">Download CV</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 text-center">
                <div class="about-img">
                    <img class="about-profile-picture" src="upload/profiles/qwerty12345.png">
                </div>
            </div>
        </div>
    </div>
</section>

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
        max-width: 100%;
    }

    .theme-color {
        color: #fe4f6c;
    }

    #about-section {
        padding: 50px 0;
        position: relative;
    }

    .gray-bg {
        background-color: #ebf4fa;
    }

    .px-btn.theme {
        background: #fe4f6c;
        color: #ffffff;
        border: 2px solid #fe4f6c;
    }

    .px-btn {
        padding: 0 20px;
        line-height: 42px;
        border: 2px solid transparent;
        position: relative;
        display: inline-block;
        background: none;
        border: none;
        -moz-transition: ease all 0.35s;
        -o-transition: ease all 0.35s;
        -webkit-transition: ease all 0.35s;
        transition: ease all 0.35s;
        border-radius: 5px;
        font-size: 16px;
        font-weight: 500;
    }

    .px-btn.theme-t {
        background: transparent;
        border: 2px solid #fe4f6c;
        color: #fe4f6c;
    }
</style>