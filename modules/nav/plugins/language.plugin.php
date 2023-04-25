<!-- Language dropdown: start -->
<?php
$languages = [];
foreach (glob("modules/translations/lang/*.json") as $file) {
    // Obtener el nombre del archivo (sin la extensión)
    $name = basename($file, ".json");
    // Obtener el nombre del archivo de imagen correspondiente
    $image = "modules/translations/lang/" . $name . ".png";
    // Agregar el idioma a la lista
    $languages[] = [
        "id" => $name,
        "name" => ucfirst($name),
        // Convertir la primera letra a mayúscula
        "image" => $image,
    ];
}
?>
<!-- Generar el HTML -->
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

    // Selección de idioma
    window.onload = function () {
        const languageItems = document.querySelectorAll(".language-item");

        languageItems.forEach(item => {
            item.addEventListener("click", function () {
                // Obtener la imagen y el icono del item seleccionado
                const imageUrl = this.querySelector("img").src;
                const selectedIcon = document.querySelector("#language-selected-icon");
                // Cambiar la imagen del botón del dropdown-toggle
                document.querySelector("#language-selected-image").src = imageUrl;
                // Mover el icono de seleccionado al nuevo item seleccionado
                if (selectedIcon) {
                    selectedIcon.parentNode.removeChild(selectedIcon);
                }
                const icon = document.createElement("span");
                icon.id = "language-selected-icon";
                icon.innerText = "\u2714";
                const dropdownItem = this.querySelector(".dropdown-item");
                insertAfter(icon, dropdownItem.lastElementChild);

                // Obtener el data-language-id del item seleccionado
                const languageId = this.getAttribute("data-language-id");
                // Traducir
                loadTranslations(languageId);
                // Guardar en local el idioma seleccionado
                localStorage.setItem("selectedLanguageId", languageId);
            });
            // Seleccionar el elemento correspondiente al valor guardado en local
            if (selectedLanguageId && item.getAttribute("data-language-id") === selectedLanguageId) {
                item.click();
            }
        });

        function insertAfter(newNode, existingNode) {
            existingNode.parentNode.insertBefore(newNode, existingNode.nextSibling);
        }
    }

</script>