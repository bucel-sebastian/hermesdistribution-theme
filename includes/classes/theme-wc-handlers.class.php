<?php

class HermesThemeWcHandlers
{
    public function __construct()
    {
        add_action('wp_ajax_get_cart_item_count', 'get_cart_item_count');
        add_action('wp_ajax_nopriv_get_cart_item_count', 'get_cart_item_count');
    }

    public function get_cart_item_count()
    {
        if (WC()->cart) {
            // Get the cart item count
            $count = WC()->cart->get_cart_contents_count();

            // Return the count in a success response
            wp_send_json_success(array('count' => $count));
        } else {
            wp_send_json_error();
        }
    }
}
