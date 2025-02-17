<?php

/**
 * The template for displaying the shop page.
 *
 * @package your-theme
 */

get_header(); ?>

<div class="content-box content-box-centered">
    <div class="woocommerce-shop-container">
        <div class="shop-sidebar">
            <?php
            dynamic_sidebar('shop-filters');
            ?>
        </div>

        <div class="shop-main">
            <?php
            // Display the sorting selector
            woocommerce_catalog_ordering();

            // Display the products
            if (have_posts()) {
            ?>
                <ul class="products-gallery-list-with-sidebar">


                    <?php

                    while (have_posts()) {
                        the_post();
                        wc_get_template_part('content', 'product');
                    }

                    ?>


                </ul>
            <?php
                // Display pagination
                woocommerce_pagination();
            } else {
                echo '<p>Nu a fost găsit niciun produs.</p>';
            }
            ?>
        </div>
    </div>

</div>