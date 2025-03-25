<?php

class HermesThemeSetup
{
    private $menu_locations;
    private HermesThemeDatabase $theme_db;

    public function __construct()
    {
        $this->theme_db = new HermesThemeDatabase();

        $this->menu_locations = [
            'primary' => 'Primary Menu',
            'footer' => 'Footer Menu',
            'utils' => 'Utils Menu',
            'categories' => 'Categories Menu'
        ];

        add_action('init', [$this, 'register_menus']);

        add_action('after_setup_theme', [$this, 'add_woocommerce_theme_support']);
        add_action('after_switch_theme', [$this, 'theme_activation']);

        add_filter('woocommerce_enqueue_styles', '__return_false');

        add_action('wp_enqueue_scripts', [$this, 'enqueue_js']);
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
        wp_enqueue_script('search_bar', HERMES_FILE_URI . '/assets/js/search-bar.js', ['jquery']);
        wp_localize_script('search_bar', 'search_bar', [
            'ajax_url' => admin_url('admin-ajax.php')
        ]);

        wp_enqueue_script('splidejs', HERMES_FILE_URI . '/assets/js/splide/dist/js/splide.min.js', ['jquery']);

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
        wp_enqueue_style('global_footer_styles', HERMES_FILE_URI . '/assets/css/footer.css', ['global_styles'], false);
        wp_enqueue_style('global_header_styles', HERMES_FILE_URI . '/assets/css/header.css', ['global_styles'], false);
        wp_enqueue_style('global_media_queries_styles', HERMES_FILE_URI . '/assets/css/media-queries.css', ['global_header_styles', 'global_footer_styles', 'global_styles'], false);

        wp_enqueue_style('splidecss', HERMES_FILE_URI . '/assets/js/splide/dist/css/splide.min.css', [], false);

        wp_enqueue_style('woocommerce-layout');
        wp_enqueue_style('woocommerce-general');
        wp_enqueue_style('woocommerce-smallscreen');
    }

    public function theme_activation(): void
    {
        $this->theme_db->create_tables();
    }
}
