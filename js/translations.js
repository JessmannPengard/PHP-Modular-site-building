// Traducir
// Recuperar el idioma seleccionado del almacenamiento local (si existe)
const selectedLanguageId = localStorage.getItem("selectedLanguageId");

window.onload = () => {
    // Traducir
    if (selectedLanguageId) {
        loadTranslations(selectedLanguageId);
    }
}

const translations = {};

function loadTranslations(language) {
    fetch(`/templateB/lang/${language}.json`)
        .then(response => response.json())
        .then(data => {
            translations[language] = data;
            applyTranslations(language);
        })
        .catch(error => {
            console.error(`Error loading translations for language "${language}":`, error);
        });
}

function applyTranslations(language) {
    const elements = document.querySelectorAll("[data-i18n]");
    elements.forEach(element => {
        const key = element.getAttribute("data-i18n");
        const translation = translations[language][key];
        if (translation) {
            element.textContent = translation;
        } else {
            console.warn(`Translation not found for key "${key}" in language "${language}"`);
        }
    });
}