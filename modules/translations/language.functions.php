<?php

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
            echo json_encode(array('success' => false));
            break;
    }
}

// Function to get current language
function getLanguage()
{
    global $language;
    echo json_encode(array('language' => $language));
}

// Function to set current language
function setLanguage($new_language)
{
    global $supported_languages;
    if (in_array($new_language, $supported_languages)) {
        $_SESSION['language'] = $new_language;
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false));
    }
}
