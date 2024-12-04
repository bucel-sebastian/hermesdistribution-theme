<?php


class HermesThemeSetup
{
    public function __construct()
    {
        add_action('after_setup_theme', [$this, 'add_woocommerce_theme_support']);
        add_filter('woocommerce_enqueue_styles', '__return_false');

        add_action('wp_enqueue_scripts', [$this, 'enqueue_js']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_css']);
    }

    /**
     * Adds Woocommerce theme support 
     * 
     * @return void
     */
    public function add_woocommerce_theme_support(): void
    {
        add_theme_support('woocommerce');
    }

    public function enqueue_js(): void
    {
        // wp_enqueue_script
    }
    public function enqueue_css(): void
    {
        wp_enqueue_style('global_styles', HERMES_FILE_URI . '/assets/css/globals.css', [], false);
    }
}
