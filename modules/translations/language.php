<?php
// Languages configuration file
require_once("language.config.php");

// Start session if not started yet
session_status() == PHP_SESSION_NONE ? session_start() : null;

// Define selected language
if (isset($_SESSION['language']) && in_array($_SESSION['language'], $supported_languages)) {
    // By session
    $language = $_SESSION['language'];
} else {
    // By country (only if server has GeoIp installed)
    if (function_exists('geoip_country_code_by_name')) {
        $country_code = geoip_country_code_by_name($_SERVER['REMOTE_ADDR']);
        foreach ($languages_by_country as $language_code => $countries) {
            if (in_array($country_code, $countries)) {
                $language = $language_code;
                break;
            }
        }
    }
    // Default
    if (!isset($language)) {
        $language = $default_language;
    }
}

// Get data from language file
$lang_file = 'lang/' . $language . '.json';
$lang_data = file_get_contents($lang_file, FILE_USE_INCLUDE_PATH);
$lang = json_decode($lang_data, true);

// Global variable for JS scripts
echo '<script>var lang = ' . json_encode($lang) . ';</script>';

// How to use:
//      PHP: echo $lang[key];
//      JS: console.log(lang[key]);
///////////////////////////////////