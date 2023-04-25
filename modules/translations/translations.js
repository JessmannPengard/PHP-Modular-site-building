// Translations module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard)

// Get selected language from session, localStorage or default ("en")
const selectedLanguageId = sessionLanguage || localStorage.getItem("selectedLanguageId") || "en";

window.onload = () => {
    // Translate
    if (selectedLanguageId) {
        loadTranslations(selectedLanguageId);
    }
}

const translations = {};

// Load translations from file
function loadTranslations(language) {
    fetch(`/templateB/modules/translations/lang/${language}.json`)
        .then(response => response.json())
        .then(data => {
            translations[language] = data;
            applyTranslations(language);
        })
        .catch(error => {
            console.error(`Error loading translations for language "${language}":`, error);
        });
}

// Apply translations to elements
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

// Translate
function translate(key) {
    return (translations && selectedLanguageId) ? translations[selectedLanguageId][key] : "";
}