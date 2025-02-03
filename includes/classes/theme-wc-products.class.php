<?php

class HermesThemeWcProducts
{
    public function __construct()
    {
        add_filter('woocommerce_get_price_html', [$this, 'woocommerce_get_price_html'], 10, 2);
        add_filter('woocommerce_product_add_to_cart_text', [$this, 'woocommerce_product_add_to_cart_text'], 10, 2);

        add_action('init', [$this, 'create_brand_taxonomy'], 0);
        add_action('init', [$this, 'create_furnizor_taxonomy'], 0);
        add_action('add_meta_boxes', [$this, 'adjust_brand_meta_box_priority'], 10, 2);
    }

    public function woocommerce_get_price_html($price, $product)
    {
        $currency = get_woocommerce_currency_symbol();
        error_log($currency);
        $regular_price = $product->get_regular_price();
        $sale_price = $product->get_sale_price();

        if ('' === $product->get_price()) {
            $price = '';
        } elseif ($product->is_on_sale()) {
            $price = "<div class='product-loop-price-container'>
                <span class='product-loop-regular-price'>
                {$regular_price}
        {$currency}
                </span>
                <span class='product-loop-sale-price'>
                {$sale_price}
        {$currency}
                </span>
            </div>";
        } else {
            $price = "<div class='product-loop-price-container'>
                <span class='product-loop-regular-price'>
                {$regular_price}
        {$currency}
                </span>
            </div>";
        }

        return $price;
    }

    public function woocommerce_product_add_to_cart_text($text, $product)
    {
        $text = $this->is_purchasable() && $this->is_in_stock() ? ' <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M160 112c0-35.3 28.7-64 64-64s64 28.7 64 64l0 48-128 0 0-48zm-48 48l-64 0c-26.5 0-48 21.5-48 48L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-208c0-26.5-21.5-48-48-48l-64 0 0-48C336 50.1 285.9 0 224 0S112 50.1 112 112l0 48zm24 48a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm152 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/></svg> <span>Adaugă în coș</span> ' : 'Află mai multe';
        return $text;
    }

    public function create_brand_taxonomy()
    {
        $labels = [
            'name'              => _x('Brands', 'taxonomy general name', 'textdomain'),
            'singular_name'     => _x('Brand', 'taxonomy singular name', 'textdomain'),
            'search_items'      => __('Search Brands', 'textdomain'),
            'all_items'         => __('All Brands', 'textdomain'),
            'parent_item'       => __('Parent Brand', 'textdomain'),
            'parent_item_colon' => __('Parent Brand:', 'textdomain'),
            'edit_item'         => __('Edit Brand', 'textdomain'),
            'update_item'       => __('Update Brand', 'textdomain'),
            'add_new_item'      => __('Add New Brand', 'textdomain'),
            'new_item_name'     => __('New Brand Name', 'textdomain'),
            'menu_name'         => __('Brands', 'textdomain'),
        ];

        $args = [
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => 'brand'],
        ];


        register_taxonomy('brand', 'product', $args);
    }
    public function create_furnizor_taxonomy()
    {
        $labels = [
            'name'              => _x('Furnizori', 'taxonomy general name', 'textdomain'),
            'singular_name'     => _x('Furnizor', 'taxonomy singular name', 'textdomain'),
            'search_items'      => __('Search Furnizori', 'textdomain'),
            'all_items'         => __('All Furnizori', 'textdomain'),
            'parent_item'       => __('Parent Furnizor', 'textdomain'),
            'parent_item_colon' => __('Parent Furnizor:', 'textdomain'),
            'edit_item'         => __('Edit Furnizor', 'textdomain'),
            'update_item'       => __('Update Furnizor', 'textdomain'),
            'add_new_item'      => __('Add New Furnizor', 'textdomain'),
            'new_item_name'     => __('New Furnizor Name', 'textdomain'),
            'menu_name'         => __('Furnizor', 'textdomain'),
        ];

        $args = [
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => 'furnizor'],
        ];


        register_taxonomy('furnizor', 'product', $args);
    }

    public function adjust_brand_meta_box_priority($post_type, $context)
    {
        if ($post_type === 'product') {
            // Change the priority of the "Brand" meta box
            global $wp_meta_boxes;
            if (isset($wp_meta_boxes['product']['side']['core']['tagsdiv-brand'])) {
                $wp_meta_boxes['product']['side']['core']['tagsdiv-brand']['priority'] = 'high'; // Set priority to high
            }
            if (isset($wp_meta_boxes['product']['side']['core']['tagsdiv-furnizor'])) {
                $wp_meta_boxes['product']['side']['core']['tagsdiv-furnizor']['priority'] = 'high'; // Set priority to high
            }
        }
    }
}
