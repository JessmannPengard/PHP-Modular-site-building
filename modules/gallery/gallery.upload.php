<!-- Gallery (upload) module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<?php

// Auth session
require("../user/user.authsession.php");

// Requires
require("../../config/app.php");
require("../database/database.php");
require("gallery.model.php");
require("gallery.config.php");
require("../user/user.model.php");
require("../language/language.php");

// DB connection
$db = new Database();

// Path for uploaded pictures
$upload_path = GALLERY_UPLOAD_PATH;

// Error messages variable
$msg = "";

// If an image was sent:
if (isset($_POST["file"])) {
    // Verify file and errors
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Verify allowed file
        $allowed = array('image/jpeg', 'image/png');
        if (in_array($_FILES['image']['type'], $allowed)) {
            // Verify file size
            if ($_FILES['image']['size'] <= MAX_SIZE_UPLOAD) {
                // Set file name with uniqid()
                $file_name = uniqid('imagen_', true) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                // Upload file
                if (move_uploaded_file($_FILES['image']['tmp_name'], '../../' . $upload_path . $file_name)) {
                    // Success:
                    // Get id's from user and image
                    $user = new User($db->getConnection());
                    $image = new Gallery($db->getConnection());
                    // Save data in DB
                    $image->upload($user->getId($_SESSION["username"]), $upload_path . $file_name);
                    $msg = $lang["upload pic success"];
                    // Reload page
                    header("Location: ../../index.php");
                } else {
                    // Error:
                    $msg = $lang["upload pic error"];
                }
            } else {
                // File is bigger than allowed
                $msg = $lang["upload pic big"];
            }
        } else {
            // File type not allowed
            $msg = $lang["upload type error"];
        }
    } else {
        // Error uploading
        $msg = $lang["upload pic error"];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>
        <?= BRAND ?>
    </title>

    <!-- Bootstrap -->
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="img/favicon.ico">

</head>

<body>

    <!-- Nav-lite: start -->
    <?php require("../nav/nav.lite.php"); ?>
    <!-- Nav-lite: end -->

    <!-- Upload image: start -->
    <div class="container-fluid upload-image">
        <div class="row">
            <div class="col-md-6 mx-auto">

                <!-- Form title: start -->
                <h3>
                    <?= $lang["upload pic"] ?>
                </h3>
                <!-- Form title: end -->
                <hr>

                <!-- Upload image info: start -->
                <div>
                    <p>
                        <?= $lang["upload pic specs"] ?>
                    </p>
                </div>
                <!-- Upload image info: end -->

                <!-- Preview image: start -->
                <div class="form-group d-none" id="previewImg">
                    <img id="preview" src="#" alt="Previsualización de la imagen">
                </div>
                <!-- Preview image: end -->

                <!-- Upload form: start -->
                <form id="formulario" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" class="form-control-file" id="image" name="image"
                            accept="image/png, image/jpeg">
                    </div>

                    <!-- Error message -->
                    <div class="mb-3">
                        <p class='error-text'>
                            <?php echo $msg; ?>
                        </p>
                    </div>

                    <!-- Submit form: start -->
                    <button type="submit" name="file" class="btn btn-primary d-none" id="file"><i
                            class="fa-solid fa-cloud-arrow-up"></i>
                        <?= $lang["upload"] ?>
                    </button>
                    <!-- Submit form: end -->

                </form>
                <!-- Upload form: end -->

            </div>
        </div>
    </div>
    <!-- Upload image: end -->

    <!-- Footer-lite: start -->
    <?php require("../footer/footer.lite.php"); ?>
    <!-- Footer-lite: end -->

</body>

</html>

<!-- Script: start -->
<script>

    // Image preview
    const imageInput = document.querySelector('#image');
    const preview = document.querySelector('#preview');
    const previewImg = document.querySelector('#previewImg');
    const file = document.querySelector('#file');
    if (imageInput != null) {
        imageInput.addEventListener('change', () => {
            const selectedFile = imageInput.files[0];
            if (selectedFile) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.setAttribute('src', e.target.result);
                    previewImg.classList.remove('d-none');
                    file.classList.remove('d-none');
                }
                reader.readAsDataURL(selectedFile);
            }
        });
    }

</script>
<!-- Script: end -->

<!-- Styles: start -->
<style>
    .upload-image {
        margin-top: 100px;
    }

    #preview {
        max-width: 100%;
        height: auto;
    }
</style>
<!-- Styles: end -->