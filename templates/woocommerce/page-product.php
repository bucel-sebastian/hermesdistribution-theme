<?php

defined('ABSPATH') || exit;

global $product;

if (empty($product) || !is_a($product, 'WC_Product')) {
    $product = wc_get_product(get_the_ID());
}

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div class="content-box content-box-centered">
    <div class="product-page-content" id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

        <?php
        if (function_exists('woocommerce_breadcrumb')) {
            woocommerce_breadcrumb([
                'delimiter'   => ' / ',
                'wrap_before' => '<nav class="woocommerce-breadcrumb">',
                'wrap_after'  => '</nav>',
                'before'      => '<span>',
                'after'       => '</span>',
                'home'        => _x('Acasă', 'breadcrumb', 'woocommerce')
            ]);
        }
        ?>

        <div class="product-hero">
            <div class="product-image-container">
                <?php if ($product->is_on_sale()) : ?>

                    <span class="product-flash-sale">
                        Reducere!
                    </span>

                <?php endif;
                ?>

                <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images">
                    <figure class="woocommerce-product-gallery__wrapper">
                        <?php
                        // $attachment_ids = $product->get_gallery_image_ids();
                        $main_image_id = $product->get_image_id();

                        // Main image
                        if ($main_image_id) {
                            $main_image = wp_get_attachment_image($main_image_id, 'woocommerce_single', false, [
                                'class' => 'wp-post-image',
                                'data-zoom-image' => wp_get_attachment_image_url($main_image_id, 'full')
                            ]);
                            echo '<div class="woocommerce-product-gallery__image active">' . $main_image . '</div>';
                        }

                        // Gallery images
                        // if ($attachment_ids) {
                        //     echo '<div class="woocommerce-product-gallery__thumbnails">';
                        //     foreach ($attachment_ids as $attachment_id) {
                        //         $thumbnail = wp_get_attachment_image($attachment_id, 'woocommerce_thumbnail', false, [
                        //             'class' => 'woocommerce-product-gallery__thumbnail',
                        //             'data-full-image' => wp_get_attachment_image_url($attachment_id, 'full')
                        //         ]);
                        //         echo '<div class="woocommerce-product-gallery__thumbnail-item">' . $thumbnail . '</div>';
                        //     }
                        //     echo '</div>';
                        // }
                        ?>
                    </figure>
                </div>


            </div>
            <div class="product-summary-container">
                <?php

                $termsBrand = get_the_terms($product->get_id(), 'brand');
                if ($termsBrand && !is_wp_error($termsBrand)) {
                    foreach ($termsBrand as $term) {
                        echo '<a href="' . esc_url(get_term_link($term)) . '" class="product-category">' . esc_html($term->name) . '</a>';
                    }
                }

                the_title('<h1 class="product_title">', '</h1>');

                // woocommerce_template_single_rating();
                woocommerce_template_single_price();
                // woocommerce_template_single_excerpt();
                ?>
                <form class="cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
                    <div class="single_add_to_cart_button_container">

                        <?php
                        do_action('woocommerce_before_add_to_cart_quantity');

                        woocommerce_quantity_input([
                            'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
                            'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                            'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(),
                        ]);

                        do_action('woocommerce_after_add_to_cart_quantity');
                        ?>

                        <button type="submit"
                            id="add-to-cart-button"
                            name="add-to-cart"
                            value="<?php echo esc_attr($product->get_id()); ?>"
                            class="single_add_to_cart_button button alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M160 112c0-35.3 28.7-64 64-64s64 28.7 64 64l0 48-128 0 0-48zm-48 48l-64 0c-26.5 0-48 21.5-48 48L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-208c0-26.5-21.5-48-48-48l-64 0 0-48C336 50.1 285.9 0 224 0S112 50.1 112 112l0 48zm24 48a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm152 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z" />
                            </svg> <span>Adaugă în coș</span>
                        </button>
                    </div>


                </form>
                <?php

                // woocommerce_template_single_add_to_cart();
                // woocommerce_template_single_meta();
                woocommerce_template_single_sharing();
                ?>
            </div>
        </div>


        <div class="summary entry-summary">

        </div>

        <?php
        /**
         * Display product data tabs, upsells, and related products
         */
        // woocommerce_output_product_data_tabs();
        // woocommerce_upsell_display();
        // woocommerce_output_related_products();
        ?>

        <?php

        $termsCategory = wc_get_product_terms($product->get_id(), 'product_cat', ['fields' => 'id']);

        echo json_encode($termsCategory);

        if (!empty($termsCategory)) {
            $args = [
                'post_type' => 'product',
                'posts_per_page' => 4, // Number of related products to display
                'post__not_in' => array($product->get_id()), // Exclude the current product
                'tax_query' => array(
                    [
                        'taxonomy' => 'product_cat',
                        'field' => 'id',
                        'terms' => $termsCategory,
                    ],
                ),
            ];

            $related_category_products = new WP_Query($args);

            if ($related_category_products->have_posts()) {
        ?>
                <div>
                    <div class="section-title-container">
                        <h3>
                            Produse populare
                        </h3>
                    </div>
                    <div class="products-gallery-container">
                        <ul>
                            <?php
                            while ($related_category_products->have_posts()) {
                                $related_category_products->the_post();
                                wc_get_template_part('content', 'product');
                            }
                            ?>
                        </ul>
                    </div>
                </div>
        <?php
            }
        }


        ?>
    </div>

</div>

<?php
woocommerce_output_all_notices();
?>

<script>
    jQuery(document).ready(function($) {
        // $('.woocommerce-product-gallery__thumbnail-item img').on('click', function() {
        //     var $this = $(this);
        //     var fullImageUrl = $this.data('full-image');

        //     // Remove active class from all thumbnails
        //     $('.woocommerce-product-gallery__thumbnail-item').removeClass('active');
        //     $this.closest('.woocommerce-product-gallery__thumbnail-item').addClass('active');

        //     // Update main image
        //     var $mainImageContainer = $('.woocommerce-product-gallery__image');
        //     var $mainImage = $mainImageContainer.find('img');

        //     $mainImage.attr('src', fullImageUrl);
        //     $mainImage.attr('data-zoom-image', fullImageUrl);
        // });

        // Basic zoom functionality
        $('.woocommerce-product-gallery__image img').on('mousemove', function(e) {
            var $this = $(this);
            var zoomImageUrl = $this.data('zoom-image');

            if (zoomImageUrl) {
                var container = $this.parent();
                var containerWidth = container.width();
                var containerHeight = container.height();

                var mouseX = e.pageX - container.offset().left;
                var mouseY = e.pageY - container.offset().top;

                var percentX = (mouseX / containerWidth) * 100;
                var percentY = (mouseY / containerHeight) * 100;

                $this.css({
                    'transform-origin': percentX + '% ' + percentY + '%',
                    'transform': 'scale(2)'
                });
            }
        }).on('mouseleave', function() {
            $(this).css('transform', 'scale(1)');
        });
    });
</script>


<style>
    .woocommerce-product-gallery__wrapper {
        position: relative;
    }

    .woocommerce-product-gallery__image {
        max-width: 100%;
        overflow: hidden;
    }

    .woocommerce-product-gallery__image img {
        width: 100%;
        height: auto;
        transition: transform 0.3s ease;
    }

    .woocommerce-product-gallery__thumbnails {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .woocommerce-product-gallery__thumbnail-item img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        cursor: pointer;
        opacity: 0.6;
        transition: opacity 0.3s ease;
    }

    .woocommerce-product-gallery__thumbnail-item.active img,
    .woocommerce-product-gallery__thumbnail-item img:hover {
        opacity: 1;
    }
</style>

<script>
    jQuery(function($) {
        $('.cart').on('submit', function(e) {
            e.preventDefault();
            var $thisbutton = $(this),
                $form = $thisbutton.closest('form'),
                productID = $form.find('button[name="add-to-cart"]').val(),
                quantity = $form.find('input[name="quantity"]').val();

            var data = {
                action: 'woocommerce_add_to_cart',
                product_id: productID,
                quantity: quantity
            };

            $(document.body).trigger('adding_to_cart', [$thisbutton, data]);

            $.ajax({
                type: 'post',
                url: wc_add_to_cart_params.wc_ajax_url.replace('%%endpoint%%', 'add_to_cart'),
                data: data,
                beforeSend: function(response) {
                    $thisbutton.removeClass('added').addClass('loading');
                    $('#add-to-cart-button').prop('disabled', true); // Disable button
                },
                complete: function(response) {
                    $thisbutton.addClass('added').removeClass('loading');
                    $('#add-to-cart-button').prop('disabled', false);
                },
                success: function(response) {
                    if (response.error & response.product_url) {
                        window.location = response.product_url;
                        return;
                    }

                    $(document.body).trigger('hermes_cart_updated');
                    // var noticeMessage = 'This is a custom notice triggered by jQuery!';

                    // // Create a new WooCommerce-like success notice
                    // var notice = $('<div class="woocommerce-message"></div>')
                    //     .addClass('success') // You can change this to 'error' or 'info' as needed
                    //     .text(noticeMessage)
                    //     .appendTo('body') // Append the notice to the body or any other container
                    //     .fadeIn(400) // Make it fade in
                    //     .delay(3000) // Keep the notice visible for 3 seconds (adjust as needed)
                    //     .fadeOut(400, function() {
                    //         $(this).remove(); // Remove the notice after it fades out
                    //     });
                    // $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                },
            });

            return false;
        });
    });
</script>