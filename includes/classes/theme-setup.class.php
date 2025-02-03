<?php


class HermesThemeSetup
{
    private $menu_locations;

    public function __construct()
    {
        $this->menu_locations = [
            'primary' => 'Primary Menu',
            'footer' => 'Footer Menu',
            'utils' => 'Utils Menu',
            'categories' => 'Categories Menu'
        ];

        add_action('init', [$this, 'register_menus']);

        add_action('after_setup_theme', [$this, 'add_woocommerce_theme_support']);
        add_filter('woocommerce_enqueue_styles', '__return_false');

        add_action('wp_enqueue_scripts', [$this, 'enqueue_js'], 100);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_css']);
    }

    public function register_menus(): void
    {
        register_nav_menus($this->menu_locations);
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
        wp_enqueue_script('jquery');

        wp_enqueue_script('cart_button', HERMES_FILE_URI . '/assets/js/cart-button.js', ['jquery']);

        // wp_enqueue_script('wc-add-to-cart');
        // wp_enqueue_script('woocommerce');
        // wp_enqueue_script('wc-cart-fragments');
        // wp_enqueue_script('wc-single-product');
        // wp_enqueue_script('zoom');
        // wp_enqueue_script('flexslider');
        // wp_enqueue_script('wc-checkout');
        // wp_enqueue_script('wc-add-payment-method');
        // wp_enqueue_script('wc-lost-password');
        // wp_enqueue_script('wc-address-i18n');
        // wp_enqueue_script('wc-country-select');
        // wp_enqueue_script('wc-password-strength-meter');
        // wp_enqueue_script('wc-credit-card-form');
        // wp_enqueue_script('wc-payment-method');
        // wp_enqueue_script('wc-cart');
        // wp_enqueue_script('wc-chosen');
        // wp_enqueue_script('wc-enhanced-select');
        // wp_enqueue_script('wc-swatch');
        // wp_enqueue_script('wc-add-to-cart-variation');
        // wp_enqueue_script('wc-product-gallery');
        // wp_enqueue_script('wc-product-gallery-slider');
        // wp_enqueue_script('wc-product-gallery-zoom');
    }
    public function enqueue_css(): void
    {
        wp_enqueue_style('global_styles', HERMES_FILE_URI . '/assets/css/globals.css', [], false);
        wp_enqueue_style('global_footer_styles', HERMES_FILE_URI . '/assets/css/footer.css', [], false);
        wp_enqueue_style('global_header_styles', HERMES_FILE_URI . '/assets/css/header.css', [], false);

        wp_enqueue_style('woocommerce-layout');
        wp_enqueue_style('woocommerce-general');
        wp_enqueue_style('woocommerce-smallscreen');
    }
}
