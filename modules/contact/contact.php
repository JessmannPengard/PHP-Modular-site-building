<!-- Contact module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<?php require_once("modules/mail/mail.config.php"); ?>

<!-- Section contact: start -->
<section class="container" id="section-contact">

    <!-- Contact heading: start -->
    <h2 class="h1 font-weight-bold text-center my-4">
        <?= $lang["contact us"] ?>
    </h2>
    <!-- Contact heading: end -->

    <!-- Contact description: start -->
    <p class="text-center mx-auto mb-5">
        <?= $lang["contact message"] ?>
    </p>
    <!-- Contact description: end -->

    <!-- Form: start -->
    <form id="contact-form" name="contact-form" action="" method="POST">

        <!-- Fields: start -->
        <div class="row">
            <div class="col-md-6">
                <label for="contact-name" class="form-label">
                    <?= $lang["your name"] ?>
                </label>
                <input type="text" id="contact-name" name="contact-name" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="contact-email" class="form-label">
                    <?= $lang["your email"] ?>
                </label>
                <input type="email" id="contact-email" name="contact-email" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="contact-subject" class="form-label">
                    <?= $lang["subject"] ?>
                </label>
                <input type="text" id="contact-subject" name="contact-subject" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="contact-message" class="form-label">
                    <?= $lang["your message"] ?>
                </label>
                <textarea type="text" id="contact-message" name="contact-message" rows="5"
                    class="form-control md-textarea" required></textarea>
            </div>
        </div>
        <br>

        <div class="row" hidden>
            <div class="col-md-12">
                <label for="contact-checker" class="form-label">Checker</label>
                <input type="text" id="contact-checker" name="contact-checker" class="form-control"></input>
            </div>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckPrivacy">
            <label class="form-check-label" for="flexCheckPrivacy">
                <?= $lang["privacy policy"] ?>
            </label>
            <a href=""><img src="img/svg/document.svg" alt="" class="icon-privacy"></a>
        </div>
        <!-- Fields: end -->

        <!-- Error message container: start -->
        <div class="row">
            <div class="col-md-12">
                <p class="form-error" id="error"></p>
            </div>
        </div>
        <!-- Error message container: end -->

        <!-- Send button: start -->
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="button" id="contact-form-submit-button" class="btn btn-outline-dark btn-lg m-2">
                    <?= $lang["send"] ?>
                </button>
            </div>
        </div>
        <!-- Send button: end -->

    </form>
    <!-- Form: end -->

    <!-- Sent email modal confirmation: start -->
    <div class="modal fade" id="emailConfirmationModal" tabindex="-1" aria-labelledby="emailConfirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="emailConfirmationModalLabel">
                        <?= $lang["email confirmation"] ?>
                    </h5>
                    <!-- Reload page on close to avoid resending -->
                    <button type="button" onclick="location=location;" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="jumbotron">
                        <h1 class="display-4">
                            <?= $lang["email success"] ?>
                        </h1>
                        <hr class="my-4">
                        <p class="lead">
                            <?= $lang["email thanks"] ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sent email modal confirmation: end -->


</section>
<!-- Section contact: end -->

<!-- Script: start -->
<script>
    // Get Form and Submit button
    const contactForm = document.getElementById('contact-form');
    const contactSubmitButton = document.getElementById('contact-form-submit-button');

    // Form submit
    contactSubmitButton.onclick = (e) => {
        // Checker field
        var checker = document.getElementById('contact-checker').value;
        // Accept privacy policy
        var privacy = document.getElementById('flexCheckPrivacy').checked;

        if (checker == "") {
            if (privacy) {
                // Get fields
                var name = document.getElementById('contact-name').value;
                var email = document.getElementById('contact-email').value;
                var subject = document.getElementById('contact-subject').value;
                var message = document.getElementById('contact-message').value;

                // Check for fullfilled fields
                if (name && email && subject && message) {
                    // Validate email
                    if (ValidateEmail(email)) {

                        // Send mail
                        fetch('modules/mail/sendMail.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({
                                fromName: name,
                                fromEmail: email,
                                toEmail: '<?= MAIL_MYEMAIL ?>',
                                subject: subject,
                                body: message
                            })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.succeed) {
                                    // Show confirmation modal (reload page on close)
                                    var emailConfirmationModal = new bootstrap.Modal(document.getElementById('emailConfirmationModal'), {
                                        backdrop: 'static',
                                        keyboard: false
                                    });
                                    emailConfirmationModal.show();
                                } else {
                                    // Mailer error
                                    document.getElementById('error').innerText = lang["mailer error"];
                                    document.getElementById('contact-name').focus();
                                }
                            })
                            .catch(error => console.error(error));
                    } else {
                        // Invalid email
                        document.getElementById('error').innerText = lang["enter valid email"];
                        document.getElementById('contact-email').focus();
                    }
                } else {
                    // Unfilled fields
                    document.getElementById('error').innerText = lang["fill all fields"];
                    document.getElementById('contact-name').focus();
                }
            } else {
                // Accept privacy policy
                document.getElementById('error').innerText = lang["must accept privacy"];
                document.getElementById('flexCheckPrivacy').focus();
            }
        }
    }

    // Function for validate email
    function ValidateEmail(input) {
        var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

        if (input.match(validRegex)) {
            return true;
        } else {
            return false;
        }
    }
</script>
<!-- Script: end -->

<!-- Styles: start -->
<style>
    #section-contact {
        margin: 40px auto;
        padding: 20px;
        box-shadow: rgba(17, 17, 26, 0.1) 0px 0px 16px;
    }

    .form-error {
        color: red;
    }

    textarea {
        resize: none;
    }

    th {
        width: 30%;
    }

    .icon-privacy {
        width: 16px;
        margin: 0 5px;
    }
</style>
<!-- Styles: end -->