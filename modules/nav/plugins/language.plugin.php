<!-- Language plugin by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<!-- Language dropdown: start -->
<?php
$languages = [];
foreach (glob("modules/translations/lang/*.json") as $file) {
    // Get file name (without extension)
    $name = basename($file, ".json");
    // Get file name of the picture
    $image = "modules/translations/lang/" . $name . ".png";
    // Add language to list
    $languages[] = [
        "id" => $name,
        // First character to uppercase
        "name" => ucfirst($name),
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
        <?php foreach ($languages as $language) { ?>
            <li class="language-item" data-language-id="<?= $language["id"] ?>">
                <a class="dropdown-item" href="#">
                    <img src="<?= $language["image"] ?>" alt="" class="menu-icon">
                    <span>
                        <?= $language["name"] ?>
                    </span>
                    <?php if ($language["id"] === $selectedLanguageId) { ?>
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
                // Get picture and icon from selected item
                const imageUrl = this.querySelector("img").src;
                const selectedIcon = document.querySelector("#language-selected-icon");
                // Change selected picture
                document.querySelector("#language-selected-image").src = imageUrl;
                // Move selection icon to the selected item
                if (selectedIcon) {
                    selectedIcon.parentNode.removeChild(selectedIcon);
                }
                const icon = document.createElement("span");
                icon.id = "language-selected-icon";
                icon.innerText = "\u2714";
                const dropdownItem = this.querySelector(".dropdown-item");
                insertAfter(icon, dropdownItem.lastElementChild);

                // Get data-language-id attribute from selected item
                const languageId = this.getAttribute("data-language-id");
                // Translate
                loadTranslations(languageId);
                // Store selected item in localStorage
                localStorage.setItem("selectedLanguageId", languageId);
            });
            // Select element that match localStorage value
            if (selectedLanguageId && item.getAttribute("data-language-id") === selectedLanguageId) {
                item.click();
            }
        });

        function insertAfter(newNode, existingNode) {
            existingNode.parentNode.insertBefore(newNode, existingNode.nextSibling);
        }
    }
</script>