<?php

class HermesThemeHead
{
    public function __construct()
    {
        add_action('init', [$this, 'remove_head_elements']);
        add_action('wp_head', [$this, 'add_head_elements']);
    }

    public function remove_head_elements(): void
    {
        remove_action('wp_head', 'wp_generator');
    }

    public function add_head_elements(): void
    {
        include get_theme_file_path('/parts/head.php');
    }
}
