<?php

get_header();

$default_image = wc_placeholder_img_src('full');

$current_category = get_queried_object();
$category_id = $current_category->term_id;

$subcategories = get_terms([
    'taxonomy' => 'product_cat',
    'child_of' => $category_id,
    'hide_empty' => false,
]);

$products = new WP_Query([
    'post_type' => 'product',
    'posts_per_page' => 20,
    'tax_query' => [
        [
            'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => $category_id,
            'include_children' => false,
        ],
    ],
]);

?>

<div class="content-box content-box-centered">
    <div class="woocommerce-shop-container">
        <div class="shop-sidebar">
            <?php
            dynamic_sidebar('shop-filters');
            ?>
        </div>
        <div class="shop-main">
            <h2><?php echo esc_html($current_category->name); ?></h2>
            <br />
            <?php
            if ($products->have_posts()) {
            ?><ul class="products-gallery-list"><?php
                                                while ($products->have_posts()) {
                                                    $products->the_post();
                                                    wc_get_template_part('content', 'product');
                                                }
                                                ?>
                </ul><?php
                    } else {
                        echo '<p>Nu a fost găsit niciun produs.</p>';
                    }
                        ?>
        </div>
    </div>
</div>