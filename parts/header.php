<header class="header">
    <div class="header-top">
        <div class="header-content-box">
            <div class="header-top-container">
                <div class="header-top-side">
                    <a href="mailto: ">
                        office@hermesdistribution.ro
                    </a>
                    <span>|</span>
                    <a href="tel: ">
                        +40 770 12 34 56
                    </a>
                </div>
                <div class="header-top-side">
                    <p>Livrare gratuită în județul Constanța</p>
                </div>
            </div>
            <div class="header-top-container-mobile">
                <div class="header-top-slider">
                    <div class="header-top-slider-items">
                        <div class="header-top-slider-item">
                            <a href="mailto: office@hermesdistribution.ro">
                                office@hermesdistribution.ro
                            </a>
                        </div>
                        <div class="header-top-slider-item">
                            <a href="tel: ">
                                +40 770 12 34 56
                            </a>
                        </div>
                        <div class="header-top-slider-item">
                            <p>Livrare gratuită în județul Constanța</p>
                        </div>
                        <div class="header-top-slider-item">
                            <a href="mailto: office@hermesdistribution.ro">
                                office@hermesdistribution.ro
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                const headerTopSliderItems = document.querySelector('.header-top-slider-items');
                let headerTopSliderIndex = 0;
                let headerTopSliderItem = document.querySelectorAll('.header-top-slider-item');
                let headerTopSliderItemsCount = headerTopSliderItem.length;

                setInterval(() => {
                    headerTopSliderIndex++;
                    headerTopSliderItems.style.transform = `translateX(calc(-${headerTopSliderIndex} * (100vw - 40px)))`;
                    if (headerTopSliderIndex + 1 === headerTopSliderItemsCount) {
                        setTimeout(() => {
                            headerTopSliderItems.style.transition = `none`;
                            headerTopSliderItems.style.transform = `translateX(0)`;
                            setTimeout(() => {
                                headerTopSliderItems.style.transition = `0.3s ease`;
                            }, 50);
                            headerTopSliderIndex = 0;
                        }, 500);
                    }
                },
                3000);
            </script>
        </div>
    </div>
    <div class="header-bottom">
        <div class="header-content-box">
            <div class="header-bottom-container">
                <div class="header-bottom-upper-row">
                    <div class="header-logo-container">
                        <a href="/">
                            <img src="<?php echo get_template_directory_uri() . '/assets/img/logo.png' ?>" />
                        </a>
                    </div>

                    <div class="header-search-container">
                        <div class="header-search">
                            <form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url(home_url('/')); ?>">
                                <input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="<?php echo esc_attr__('Search products…', 'woocommerce'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                                <button type="submit" value="<?php echo esc_attr_x('Search', 'submit button', 'woocommerce'); ?>"><?php echo esc_html_x('Search', 'submit button', 'woocommerce'); ?></button>
                                <input type="hidden" name="post_type" value="product" />
                            </form>
                            <div class="header-search-suggestions" id="search-suggestions" style="display:none;"></div>
                        </div>
                    </div>

                    <div class="header-shop-links-container">
                        <!-- <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="header-account-link" title="Contul meu">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M399 384.2C376.9 345.8 335.4 320 288 320l-64 0c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z" />
                            </svg>
                        </a> -->
                        <a href="<?php echo wc_get_cart_url(); ?>" class="header-cart-link" title="Coș de cumpărături">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                            </svg>
                            <?php
                            if (WC()->cart->get_cart_contents_count() !== 0) {
                            ?>
                                <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count() < 10 ? WC()->cart->get_cart_contents_count() : "9+"; ?></span>
                            <?php
                            }
                            ?>
                        </a>
                    </div>

                    <div class="header-mobile-menu-button-container">
                        <button class="header-mobile-menu-button ">
                            <div class="header-mobile-menu-button-bar header-mobile-menu-button-bar-1"></div>
                            <div class="header-mobile-menu-button-bar header-mobile-menu-button-bar-2"></div>
                            <div class="header-mobile-menu-button-bar header-mobile-menu-button-bar-3"></div>
                        </button>
                    </div>
                </div>
                <div class=" header-bottom-lower-row">
                    <div class="header-categories-button-container">
                        <div class="header-categories-button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
                            </svg>
                            <span>Categorii</span>
                        </div>
                        <div class="header-categories-container">
                            <ul class="header-categories-list">
                                <?php
                                wp_nav_menu(
                                    ['theme_location' => 'categories', 'menu_class' => 'header-categories-menu']
                                );
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'primary',
                            'menu_class' => 'header-primary-menu'
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-sticky">

    </div>
</header>