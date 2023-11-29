<!-- Language dropdown: start -->
<?php
// Languages
require_once("modules/language/language.php");

// Generate language list
$languages_list = [];
foreach ($supported_languages as $sup_language) {
    // Get file name (without extension)
    $name = $sup_language;
    // Get file name of the picture
    $image = "modules/language/lang/" . $sup_language . ".png";
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
        <img src="modules/language/lang/<?= $language ?>.png" alt="" class="menu-icon" id="language-selected-image">
    </a>

    <ul class="dropdown-menu dropdown-menu-end">
        <?php foreach ($languages_list as $language_item) { ?>
            <li class="language-item" data-language-id="<?= $language_item["id"] ?>">
                <a class="dropdown-item" href="">
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
    window.onload = function() {
        const languageItems = document.querySelectorAll(".language-item");

        languageItems.forEach(item => {
            item.addEventListener("click", function() {
                // Set language
                var language = this.getAttribute("data-language-id");
                setLanguage(language);
                // Reload page with new selected language
                window.location.reload();
            });
        });

        // Function to set current language
        function setLanguage(language) {
            var langFormdata = new FormData();
            langFormdata.append('action', 'set_language');
            langFormdata.append('new_language', language);
            fetch('modules/language/language.functions.php', {
                    method: 'POST',
                    body: langFormdata
                })
                .then((response) => response.json())
                .then((data) => {
                    // Success
                }).catch(function(error) {
                    // Error
                    console.log(error);
                });
        }
    }
</script>