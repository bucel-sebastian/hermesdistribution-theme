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
                'posts_per_page' => 8,
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

<!-- Atuus -->


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