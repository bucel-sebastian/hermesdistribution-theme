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
                        } else {
                            $main_image = wc_placeholder_img('woocommerce_single');
                        }
                        echo '<div class="woocommerce-product-gallery__image active">' . $main_image . '</div>';

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

                <div class="product-meta">
                    <?php
                    $product_sku = $product->get_sku();
                    if ($product_sku) {
                    ?>
                        <div class="product-meta-row">
                            <?php
                            echo '<span class="sku_wrapper">' . 'SKU -' . ' <span class="sku">' . $product_sku . '</span></span>';
                            ?>
                        </div>
                    <?php
                    }

                    echo wc_get_product_category_list($product->get_id(), ', ', '<div class="product-meta-row">' . _n('Categorie -', 'Categorii -', count($product->get_category_ids()), 'woocommerce') . ' ', '</div>');

                    echo wc_get_product_tag_list($product->get_id(), ', ', '<div class="product-meta-row">' . _n('Tag -', 'Tag-uri -', count($product->get_tag_ids()), 'woocommerce') . ' ', '</div>');
                    ?>
                </div>

                <div class="product-shipping-notice">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                        <path d="M48 0C21.5 0 0 21.5 0 48L0 368c0 26.5 21.5 48 48 48l16 0c0 53 43 96 96 96s96-43 96-96l128 0c0 53 43 96 96 96s96-43 96-96l32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64 0-32 0-18.7c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7L416 96l0-48c0-26.5-21.5-48-48-48L48 0zM416 160l50.7 0L544 237.3l0 18.7-128 0 0-96zM112 416a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm368-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                    </svg>
                    <p>
                        Livrările în Constanța sunt efectuate de către noi, iar pentru comenzile în afara orașului vă vom contacta telefonic în vederea stabilirii costului de transport.
                    </p>
                </div>

                <div class="product-share-buttons">
                    <h3>Distribuie acest produs</h3>
                    <div class="products-share-buttons-container">
                        <a class="product-share-button" style="background:#1877F2;" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-button facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z" />
                            </svg>
                        </a>
                        <a class="product-share-button" style="background:#000000;" href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-button twitter">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                            </svg>
                        </a>
                        <a class="product-share-button" style="background:#0077B5;" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-button linkedin">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M100.3 448H7.4V148.9h92.9zM53.8 108.1C24.1 108.1 0 83.5 0 53.8a53.8 53.8 0 0 1 107.6 0c0 29.7-24.1 54.3-53.8 54.3zM447.9 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z" />
                            </svg>
                        </a>
                        <a class="product-share-button" style="background:#25D366;" href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_the_title() . ' ' . get_permalink()); ?>" target="_blank" class="share-button whatsapp">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                            </svg>
                        </a>
                        <a class="product-share-button" style="background:#E60023;" href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&media=<?php echo urlencode(get_the_post_thumbnail_url($product->get_id(), 'full')); ?>&description=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-button pinterest">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                <path d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z" />
                            </svg>
                        </a>
                    </div>
                </div>
                <?php

                // woocommerce_template_single_add_to_cart();
                // woocommerce_template_single_meta();
                woocommerce_template_single_sharing();
                ?>
            </div>
        </div>


        <div class="summary entry-summary">

        </div>


        <div class="product-how-to-order-container">
            <div class="section-title-container">
                <h3>
                    Cum puteți comanda?
                </h3>
                <div class="section-title-breakline"></div>
            </div>
            <p>
                Simplu! Fie comandați online produsele dorite, fie puteți trimite o comandă telefonică sau prin email.
                <br />
                Stocurile sunt limitate, așadar vă vom contacta în cazul în care nu avem pe stoc produsele dorite.
            </p>
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

        $termsCategory = wc_get_product_terms($product->get_id(), 'product_cat');

        if (!empty($termsCategory)) {
            $args = [
                'post_type' => 'product',
                'posts_per_page' => 4, // Number of related products to display
                'post__not_in' => array($product->get_id()), // Exclude the current product
                'tax_query' => array(
                    [
                        'taxonomy' => 'product_cat',
                        'field' => 'id',
                        'terms' => $termsCategory[0]->term_id,
                    ],
                ),
            ];

            $related_category_products = new WP_Query($args);

            if ($related_category_products->have_posts()) {
        ?>
                <div class="product-related-products-container">
                    <div class="section-title-container">
                        <h3>
                            Produse populare
                        </h3>
                        <div class="section-title-breakline"></div>
                    </div>
                    <div class="products-gallery-container">
                        <ul class="products-gallery-list">
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

        if (!empty($termsBrand)) {
            $args = [
                'post_type' => 'product',
                'posts_per_page' => 4, // Number of related products to display
                'post__not_in' => array($product->get_id()), // Exclude the current product
                'tax_query' => array(
                    [
                        'taxonomy' => 'brand',
                        'field' => 'id',
                        'terms' => $termsBrand[0]->term_id,
                    ],
                ),
            ];

            $related_brand_products = new WP_Query($args);

            if ($related_brand_products->have_posts()) {
            ?>
                <div class="product-related-products-container">
                    <div class="section-title-container">
                        <h3>
                            Te-ar mai putea interesa și
                        </h3>
                        <div class="section-title-breakline"></div>
                    </div>
                    <div class="products-gallery-container">
                        <ul class="products-gallery-list">
                            <?php
                            while ($related_brand_products->have_posts()) {
                                $related_brand_products->the_post();
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