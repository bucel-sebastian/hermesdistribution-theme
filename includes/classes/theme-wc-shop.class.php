<?php

class HermesThemeWcShop
{
    public function __construct()
    {
        $this->load_widgets();

        add_action('widgets_init', [$this, 'shop_filters_init']);
        add_action('after_setup_theme', [$this, 'add_shop_filters_widgets']);
        // add_filter('sidebars_widgets', [$this, 'dynamic_category_subcategory_filter']);

        add_action('widgets_init',  [$this, 'register_product_categories_filter_widget']);

        add_action('widgets_init', [$this, 'register_brand_filter_widget']);

        add_filter('woocommerce_catalog_orderby', [$this, 'rename_catalog_orderby']);

        add_filter('wc_empty_cart_message', [$this, 'empty_cart_message']);
    }

    private function load_widgets()
    {
        require_once HERMES_FILE_PATH . '/includes/widgets/product-categories-filter-widget.php';
        require_once HERMES_FILE_PATH . '/includes/widgets/product-brands-filter-widget.php';
    }

    /**
     * Register the shop filters sidebar.
     */
    public function shop_filters_init()
    {
        register_sidebar([
            'name'          => 'Filtre',
            'id'            => 'shop-filters',
            'description'   => 'Shop Filters',
            // 'before_widget' => '<div class="shop-filters-widget" >',
            // 'after_widget'  => '</div>',
            // 'before_title'  => '<h3 class="shop-filters-widget-title" >',
            // 'after_title'   => '</h3>'
        ]);
    }

    public function add_shop_filters_widgets()
    {
        $sidebars_widgets = get_option('sidebars_widgets');

        if (empty($sidebars_widgets['shop-filters'])) {
            $widget_settings = get_option('widget_product_categories_filter', []);
            $widget_settings[1] = array('title' => 'Categorie');
            update_option('widget_product_categories_filter', $widget_settings);

            $widget_settings = get_option('widget_brand_filter', []);
            $widget_settings[1] = array('title' => 'Brand');
            update_option('widget_brand_filter', $widget_settings);

            $sidebars_widgets['shop-filters'] = ['product_categories_filter-1', 'brand_filter-1'];
            update_option('sidebars_widgets', $sidebars_widgets);
        }
    }

    public function register_product_categories_filter_widget()
    {
        if (class_exists('Product_Categories_Filter_Widget')) {
            register_widget('Product_Categories_Filter_Widget');
        }
    }
    public function register_brand_filter_widget()
    {
        if (class_exists('Product_Brands_Filter_Widget')) {
            register_widget('Product_Brands_Filter_Widget');
        }
    }

    public function rename_catalog_orderby($orderby_options)
    {
        $orderby_options = [
            'menu_order' => 'Sortare implicită',
            'popularity' => 'Popularitate',
            'rating'     => 'Recenzii',
            'date'       => 'Dată publicării',
            'price'      => 'Preț asc.',
            'price-desc' => 'Preț desc.',
        ];

        return $orderby_options;
    }

    public function empty_cart_message($message)
    {
        $icon_path = HERMES_TEMPLATE_DIR_URI . '/assets/img/empty-cart-icon.svg';
        $message = "
            <div class='empty-cart-message'>
                <div class='empty-cart-icon'>
                <img src='{$icon_path}' />
                </div>
                <h2>Coșul de cumpărături este gol!</h2>
            </div>
        ";

        return $message;
    }
}
