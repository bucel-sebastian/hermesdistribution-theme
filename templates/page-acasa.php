<?php


?>

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
                <button class="slider-controls-prev">&#10094;</button> <!-- Previous button -->
                <button class="slider-controls-next">&#10095;</button> <!-- Next button -->
            </div>
        </div>
        <div class="categories-slider-container">
            <div class="categories-slider">
                <div class="categories-slider-items">

                    <?php
                    $categories = get_terms([
                        'taxonomy' => 'product_cat',
                        'hide_empty' => false,
                        'parent' => 0
                    ]);
                    // echo print_r($categories);
                    $default_image = wc_placeholder_img_src('full');

                    foreach ($categories as $category) {
                        $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                        $image_url = $thumbnail_id
                            ? wp_get_attachment_image_src($thumbnail_id, 'full')[0]
                            : $default_image;
                        $category_link = get_term_link($category);

                    ?>
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
                    <?php
                    }
                    ?>
                </div>

            </div>

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
        const slider = document.querySelector('.categories-slider-items');
        const items = document.querySelectorAll('.categories-slider-item');
        const totalItems = items.length;
        let currentIndex = 0;
        let isDragging = false;
        let startPosX = 0;
        let currentTranslate = 0;
        let prevTranslate = 0;
        const cardsToShow = 6; // Number of cards to show at once (desktop)

        // Next and Previous Buttons
        const nextButton = document.querySelector('.slider-controls .slider-controls-next');
        const prevButton = document.querySelector('.slider-controls .slider-controls-prev');

        // Update slider position
        function updateSliderPosition() {
            const offset = -currentIndex * (100 / cardsToShow);
            slider.style.transform = `translateX(${offset}%)`;
        }

        // Move to next item
        function moveToNextItem() {
            if (currentIndex < totalItems - cardsToShow) {
                currentIndex++;
                updateSliderPosition();
            }
        }

        // Move to previous item
        function moveToPrevItem() {
            if (currentIndex > 0) {
                currentIndex--;
                updateSliderPosition();
            }
        }

        // Auto-move slider
        let autoSlideInterval = setInterval(moveToNextItem, 3000);

        // Pause auto-slide on hover
        slider.addEventListener('mouseenter', () => clearInterval(autoSlideInterval));
        slider.addEventListener('mouseleave', () => {
            autoSlideInterval = setInterval(moveToNextItem, 3000);
        });

        // Touch and Drag Controls
        slider.addEventListener('touchstart', (e) => {
            isDragging = true;
            startPosX = e.touches[0].clientX;
            prevTranslate = -currentIndex * (100 / cardsToShow);
        });

        slider.addEventListener('touchmove', (e) => {
            if (isDragging) {
                const currentPosX = e.touches[0].clientX;
                const diffX = currentPosX - startPosX;
                currentTranslate = prevTranslate + (diffX / slider.offsetWidth) * 100;

                // Prevent dragging beyond the first or last card
                const maxTranslate = 0;
                const minTranslate = -((totalItems - cardsToShow) * (100 / cardsToShow));
                currentTranslate = Math.min(maxTranslate, Math.max(minTranslate, currentTranslate));

                slider.style.transform = `translateX(${currentTranslate}%)`;
            }
        });

        slider.addEventListener('touchend', () => {
            if (isDragging) {
                isDragging = false;
                const movedBy = currentTranslate - prevTranslate;

                // Snap to the nearest card
                if (movedBy < -10 && currentIndex < totalItems - cardsToShow) {
                    currentIndex++;
                } else if (movedBy > 10 && currentIndex > 0) {
                    currentIndex--;
                }

                updateSliderPosition();
            }
        });

        // Click Controls
        nextButton.addEventListener('click', () => {
            clearInterval(autoSlideInterval);
            moveToNextItem();
            autoSlideInterval = setInterval(moveToNextItem, 3000);
        });
        prevButton.addEventListener('click', () => {
            clearInterval(autoSlideInterval);
            moveToPrevItem();
            autoSlideInterval = setInterval(moveToNextItem, 3000);
        });
    });
</script>