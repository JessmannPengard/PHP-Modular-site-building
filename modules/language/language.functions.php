<?php

// Languages configuration file
require_once("language.config.php");

// Start session if not started yet
session_status() == PHP_SESSION_NONE ? session_start() : null;

// POST 'action' manage
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    switch ($action) {
            // Get current language
        case 'get_language':
            getLanguage();
            break;
            // Set new language
        case 'set_language':
            if (isset($_POST['new_language'])) {
                setLanguage($_POST['new_language']);
            }
            break;
            // Action not defined
        default:
            echo json_encode(['success' => false]);
            break;
    }
} else {
    echo json_encode(['msg' => 'Error 403: Forbidden']);
}

// Function to get current language
function getLanguage(): void
{
    global $default_language;

    $language = $_SESSION["language"] ?? $default_language;

    echo json_encode(['language' => $language]);
}

// Function to set current language
function setLanguage(string $new_language): void
{
    global $supported_languages;

    if (in_array($new_language, $supported_languages)) {
        $_SESSION['language'] = $new_language;
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
