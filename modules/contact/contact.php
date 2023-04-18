<section class="container">

    <!--Section heading-->
    <h2 class="h1 font-weight-bold text-center my-4">Contact us</h2>

    <!--Section description-->
    <p class="text-center mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us
        directly. Our team will come back to you within a matter of hours to help you.</p>

    <!--Form-->
    <form id="contact-form" name="contact-form" action="modules/contact/mail.php" method="POST">

        <div class="row">
            <div class="col-md-6">
                <label for="contact-name" class="form-label">Your name</label>
                <input type="text" id="contact-name" name="contact-name" class="form-control" required
                    placeholder="Enter your name">
            </div>

            <div class="col-md-6">
                <label for="contact-email" class="form-label">Your email</label>
                <input type="email" id="contact-email" name="contact-email" class="form-control" required
                    placeholder="Enter your email">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="contact-subject" class="form-label">Subject</label>
                <input type="text" id="contact-subject" name="contact-subject" class="form-control" required
                    placeholder="Enter the subject">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="contact-message" class="form-label">Your message</label>
                <textarea type="text" id="contact-message" name="contact-message" rows="5"
                    class="form-control md-textarea" required placeholder="Enter your question"></textarea>
            </div>
        </div>
        <br>

        <div class="row" hidden>
            <div class="col-md-12">
                <label for="contact-checker" class="form-label">Checker</label>
                <input type="text" id="contact-checker" name="contact-checker" class="form-control"></input>
            </div>
        </div>

        <!-- Mostramos el mensaje de error, si lo hubiera -->
        <div class="row">
            <div class="col-md-12">
                <p class="form-error" id="error"></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <button type="button" id="contact-form-submit-button" class="btn btn-primary">Send</button>
            </div>
        </div>

        <div class="status"></div>

    </form>

    <!--Form-->

</section>

<script>
    const contactForm = document.getElementById('contact-form');
    const contactSubmitButton = document.getElementById('contact-form-submit-button');

    contactSubmitButton.onclick = (e) => {
        var checker = document.getElementById('contact-checker').value;

        if (checker == "") {
            var name = document.getElementById('contact-name').value;
            var email = document.getElementById('contact-email').value;
            var subject = document.getElementById('contact-subject').value;
            var message = document.getElementById('contact-message').value;

            if (name && email && subject && message) {
                if (ValidateEmail(email)) {

                    fetch('modules/contact/mail.php', {
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
                            document.getElementById('error').innerText = data.msg;
                            setTimeout(() => {
                                document.getElementById('error').innerText = "";
                            }, 10000);
                            document.getElementById('contact-name').value = "";
                            document.getElementById('contact-email').value = "";
                            document.getElementById('contact-subject').value = "";
                            document.getElementById('contact-message').value = "";

                        })
                        .catch(error => console.error(error));

                } else {
                    document.getElementById('error').innerText = "Please, enter a valid email";
                    document.getElementById('contact-email').focus();
                }
            } else {
                document.getElementById('error').innerText = "You must fill all the fields";
                document.getElementById('contact-name')
            }

        } else {
            window.location = "modules/contact/bot-detected.php";
        }
    }

    function ValidateEmail(input) {
        var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

        if (input.match(validRegex)) {
            return true;
        } else {
            return false;
        }
    }

</script>

<style>
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