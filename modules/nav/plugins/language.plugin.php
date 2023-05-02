<!-- Language plugin by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<!-- Language dropdown: start -->
<?php
// Languages configuration file
require_once("modules/translations/language.config.php");
require_once("modules/translations/language.php");

// Generate language list
$languages_list = [];
foreach ($supported_languages as $sup_language) {
    // Get file name (without extension)
    $name = $sup_language;
    // Get file name of the picture
    $image = "modules/translations/lang/" . $sup_language . ".png";
    // Add language to list
    $languages_list[] = [
        "id" => $sup_language,
        // First character to uppercase
        "name" => ucfirst($sup_language),
        "image" => $image,
    ];
}
?>
<!-- Generate HTML -->
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="" alt="" class="menu-icon" id="language-selected-image">
    </a>

    <ul class="dropdown-menu dropdown-menu-end">
        <?php foreach ($languages_list as $language_item) { ?>
            <li class="language-item" data-language-id="<?= $language_item["id"] ?>">
                <a class="dropdown-item" href="#">
                    <img src="<?= $language_item["image"] ?>" alt="" class="menu-icon">
                    <span>
                        <?= $language_item["name"] ?>
                    </span>
                    <?php if ($language_item["id"] === $language) { ?>
                        <span id="language-selected-icon">&#x2714;</span>
                    <?php } ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</li>
<!-- Language dropdown: end -->

<script>
    // Language selection
    window.onload = function () {
        const languageItems = document.querySelectorAll(".language-item");

        languageItems.forEach(item => {
            item.addEventListener("click", function () {
                // Set language
                var language = this.getAttribute("data-language-id");
                setLanguage(language);
                // Reload page
                location = location;
            });
        });

        function insertAfter(newNode, existingNode) {
            existingNode.parentNode.insertBefore(newNode, existingNode.nextSibling);
        }

        // Function to get current language
        function getLanguage() {
            fetch('modules/translations/language.php?action=get_language', {
                method: 'GET'
            }).then(function (response) {
                return response.json();
            }).then(function (data) {
                console.log(data);
                //
            }).catch(function (error) {
                console.log(error);
            });
        }

        // Function to set current language
        function setLanguage(language) {
            fetch('modules/translations/language.php?action=set_language', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    language: language
                })
            }).then(function (response) {
                return response.json();
            }).then(function (data) {
                console.log(data);
                //
            }).catch(function (error) {
                console.log(error);
            });
        }
    }
</script>