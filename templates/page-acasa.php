<section class="home-hero-section">
    <div class="content-box content-box-centered">
        <div class="home-hero-slider">
            <img class="slider-item-background" src="<?php echo HERMES_FILE_URI . '/assets/img/hero-img-1.jpg' ?>" />
            <div class="slider-item-content">
                <h2>
                    Livrare gratuită
                </h2>
                <h2>
                    în județul Constanța
                </h2>
            </div>
        </div>
    </div>
</section>

<section class="home-categories-section">
    <div class="content-box content-box-centered">
        <div class="section-title-container section-title-with-buttons">
            <h3>
                Categoriile noastre de produse
            </h3>
            <div class="slider-controls">
                <button class="slider-controls-prev" id="categories-slider-control-prev">&#10094;</button> <!-- Previous button -->
                <button class="slider-controls-next" id="categories-slider-control-next">&#10095;</button> <!-- Next button -->
            </div>
        </div>
        <div class="categories-slider-container">

            <div class="splide categories-slider-splide" id="categories-slider-splide">
                <div class="splide__track">
                    <div class="splide__list">
                        <?php
                        $categories = get_terms([
                            'taxonomy' => 'product_cat',
                            'hide_empty' => false,
                            'parent' => 0,
                            'exclude' => [get_option('default_product_cat')] // Exclude "Uncategorized"
                        ]);

                        $default_image = wc_placeholder_img_src('full');

                        foreach ($categories as $category) {
                            $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                            $image_url = $thumbnail_id
                                ? wp_get_attachment_image_src($thumbnail_id, 'full')[0]
                                : $default_image;
                            $category_link = get_term_link($category);

                        ?>
                            <li class="splide__slide">
                                <div class="categories-slider-item">
                                    <a href="<?php echo $category_link ?>">
                                        <div class="categories-slider-item-card">
                                            <img src="<?php echo $image_url; ?>" />
                                            <span>
                                                <?php
                                                echo $category->name;
                                                ?>
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- <div class="categories-slider">
                <div class="categories-slider-items">

                </div>

            </div> -->

        </div>
    </div>
</section>

<section class="home-products-section">
    <div class="content-box content-box-centered">
        <div class="section-title-container">
            <h3>
                Produse populare
            </h3>
        </div>
        <div class="products-gallery-container">
            <?php
            $related_products = new WP_Query([
                'post_type' => 'product',
                'posts_per_page' => 10,
                'orderby' => 'rand',
                'tax_query' => [
                    [
                        'taxonomy' => 'product_visibility',
                        'field' => 'name',
                        'terms' => 'featured',
                    ],
                ],
            ]);

            if ($related_products->have_posts()) {
            ?>
                <ul class="products-gallery-list">
                    <?php
                    while ($related_products->have_posts()) {
                        $related_products->the_post();
                        wc_get_template_part('content', 'product');
                    }
                    ?>
                </ul>
            <?php
            } else {
            ?>

            <?php
            }
            ?>
        </div>
    </div>

</section>

<section class="home-values-section">
    <div class="content-box content-box-centered">
        <div class="our-values-container">
            <div class="our-values-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                    <path d="M48 0C21.5 0 0 21.5 0 48L0 368c0 26.5 21.5 48 48 48l16 0c0 53 43 96 96 96s96-43 96-96l128 0c0 53 43 96 96 96s96-43 96-96l32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64 0-32 0-18.7c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7L416 96l0-48c0-26.5-21.5-48-48-48L48 0zM416 160l50.7 0L544 237.3l0 18.7-128 0 0-96zM112 416a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm368-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                </svg>
                <h3>
                    Livrare gratuită în județul Constanța
                </h3>
                <p>Comandă fără griji! Oferim livrare gratuită în tot județul Constanța, rapid și fără costuri suplimentare.</p>
            </div>
            <div class="our-values-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M0 80L0 229.5c0 17 6.7 33.3 18.7 45.3l176 176c25 25 65.5 25 90.5 0L418.7 317.3c25-25 25-65.5 0-90.5l-176-176c-12-12-28.3-18.7-45.3-18.7L48 32C21.5 32 0 53.5 0 80zm112 32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                </svg>
                <h3>
                    Cele mai bune oferte și prețuri

                </h3>
                <p>La noi găsești cele mai bune oferte și prețuri competitive. Profită de reducerile noastre și cumpără inteligent!

                </p>
            </div>
            <div class="our-values-item">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M50.7 58.5L0 160l208 0 0-128L93.7 32C75.5 32 58.9 42.3 50.7 58.5zM240 160l208 0L397.3 58.5C389.1 42.3 372.5 32 354.3 32L240 32l0 128zm208 32L0 192 0 416c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-224z" />
                </svg>
                <h3>
                    Sortiment larg de produse
                </h3>
                <p>Avem un portofoliu variat de produse pentru toate nevoile tale. Găsește exact ceea ce cauți, într-un singur loc!

                </p>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let categoriesSlider = new Splide('#categories-slider-splide', {
            type: 'loop',
            perPage: 6,
            breakpoints: {
                1024: {
                    perPage: 4,
                },
                768: {
                    perPage: 2
                },
            },
            gap: 10,
            padding: {
                top: 0,
                bottom: 10
            },
            perMove: 1,
            autoplay: true,
            arrows: false,
            pagination: false,
            autoHeight: true
        });
        categoriesSlider.mount();

        let categoriesSliderNextButton = document.getElementById('categories-slider-control-next');
        categoriesSliderNextButton.addEventListener('click', () => {
            categoriesSlider.go('+');
        });

        let categoriesSliderPrevButton = document.getElementById('categories-slider-control-prev');
        categoriesSliderPrevButton.addEventListener('click', () => {
            categoriesSlider.go('-');
        });
    });
</script>