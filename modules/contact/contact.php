<section class="container">

    <!--Section heading-->
    <h2 class="h1 font-weight-bold text-center my-4">Contact us</h2>

    <!--Section description-->
    <p class="text-center mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us
        directly. Our team will come back to you within
        a matter of hours to help you.</p>

    <!--Form-->
    <form id="contact-form" name="contact-form" action="modules/contact/mail.php" method="POST">

        <div class="row">
            <div class="col-md-6">
                <label for="name" class="form-label">Your name</label>
                <input type="text" id="contact-name" name="contact-name" class="form-control" required
                    placeholder="Enter your name">
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">Your email</label>
                <input type="email" id="contact-email" name="contact-email" class="form-control" required
                    placeholder="Enter your email">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" id="contact-subject" name="contact-subject" class="form-control" required
                    placeholder="Enter the subject">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="message" class="form-label">Your message</label>
                <textarea type="text" id="contact-message" name="contact-message" rows="2"
                    class="form-control md-textarea" required placeholder="Enter your question"></textarea>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-md-12 text-center">
                <button type="button" id="contact-form-submit-button" data-bs-toggle="modal"
                    data-bs-target="#confirm-submit" class="btn btn-primary">Send</button>
            </div>
        </div>

        <div class="status"></div>

    </form>

    <!--Form-->

    <!-- Modal I'm not a robot -->
    <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="confirm-submit-label"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="confirm-submit-label">Contact</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Please, confirm the details
                    <!-- We display the details entered by the user here -->
                    <table class="table">
                        <tr>
                            <th>Your name</th>
                            <td id="contactName"></td>
                        </tr>
                        <tr>
                            <th>Your email</th>
                            <td id="contactEmail"></td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td id="contactSubject"></td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td id="contactMessage"></td>
                        </tr>
                    </table>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirm-submit-button">Send</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal I'm not a robot -->

</section>

<script>
    const contactSubmitButton = document.getElementById('contact-form-submit-button');
    const contactFormSubmit = document.getElementById('confirm-submit-button');
    const contactForm = document.getElementById('contact-form');

    contactSubmitButton.onclick = () => {
        document.getElementById('contactName').innerText = document.getElementById('contact-name').value;
        document.getElementById('contactEmail').innerText = document.getElementById('contact-email').value;
        document.getElementById('contactSubject').innerText = document.getElementById('contact-subject').value;
        document.getElementById('contactMessage').innerText = document.getElementById('contact-message').value;
    }

    contactFormSubmit.onclick = () => {

        // Hacer petición AJAX en lugar de submit para evitar recargar la página y limpiar los campos
        // Añadir opción de enviar copia al usuario
        // Mostrar mensaje de mensaje enviado durante X segundos??
        contactForm.submit();
    }

</script>