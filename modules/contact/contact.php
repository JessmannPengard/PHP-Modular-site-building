<!-- Contact module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<!-- Section contact -->
<section class="container" id="section-contact">

    <!-- Contact heading: start -->
    <h2 class="h1 font-weight-bold text-center my-4" data-i18n="contact us">Contact us</h2>
    <!-- Contact heading: end -->

    <!-- Contact description: start -->
    <p class="text-center mx-auto mb-5" data-i18n="contact message">Do you have any questions? Please do not hesitate to contact us
        directly. Our team will come back to you within a matter of hours to help you.</p>
    <!-- Contact description: end -->

    <!-- Form: start -->
    <form id="contact-form" name="contact-form" action="" method="POST">

        <!-- Fields: start -->
        <div class="row">
            <div class="col-md-6">
                <label for="contact-name" class="form-label" data-i18n="your name">Your name</label>
                <input type="text" id="contact-name" name="contact-name" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="contact-email" class="form-label" data-i18n="your email">Your email</label>
                <input type="email" id="contact-email" name="contact-email" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="contact-subject" class="form-label" data-i18n="subject">Subject</label>
                <input type="text" id="contact-subject" name="contact-subject" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="contact-message" class="form-label" data-i18n="your message">Your message</label>
                <textarea type="text" id="contact-message" name="contact-message" rows="5" class="form-control md-textarea" required></textarea>
            </div>
        </div>
        <br>

        <div class="row" hidden>
            <div class="col-md-12">
                <label for="contact-checker" class="form-label">Checker</label>
                <input type="text" id="contact-checker" name="contact-checker" class="form-control"></input>
            </div>
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
                <button type="button" id="contact-form-submit-button" class="btn btn-primary" data-i18n="send">Send</button>
            </div>
        </div>
        <!-- Send button: end -->

    </form>
    <!-- Form: end -->

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

        if (checker == "") {
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
                    fetch('modules/phpmailer/src/mail.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: new URLSearchParams({
                                name: name,
                                email: email,
                                subject: subject,
                                message: message
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.succeed) {
                                // Show modal, then redirect
                                // TODO *******************
                                location = location;
                            } else {
                                // Mailer error
                                document.getElementById('error').innerText = translations ? translate("mailer error") : "Message could not be sent. Mailer Error";
                                document.getElementById('contact-name').focus();
                            }
                        })
                        .catch(error => console.error(error));
                } else {
                    // Invalid email
                    document.getElementById('error').innerText = translations ? translate("enter valid email") : "Please, enter a valid email";
                    document.getElementById('contact-email').focus();
                }
            } else {
                // Unfilled fields
                document.getElementById('error').innerText = translations ? translate("fill all fields") : "You must fill all the fields";
                document.getElementById('contact-name').focus();
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
        margin-bottom: 20px;
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
</style>
<!-- Styles: end -->