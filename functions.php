<?php

if (!defined('HERMES_TEMPLATE_DIR')) {
    define('HERMES_TEMPLATE_DIR', get_template_directory());
}
if (!defined('HERMES_FILE_PATH')) {
    define('HERMES_FILE_PATH', get_theme_file_path());
}
if (!defined('HERMES_FILE_URI')) {
    define('HERMES_FILE_URI', get_theme_file_uri());
}


require_once HERMES_FILE_PATH . '/includes/initialize.php';

if (class_exists('HermesTheme')) {
    $HermesTheme = new HermesTheme();
}

// Snippets