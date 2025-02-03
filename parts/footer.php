<footer class="footer">
    <div class="footer-container">
        <div class="footer-primary-row">
            <div class="footer-primary-col">
                <div class="footer-logo-container">
                    <img src="<?php echo get_template_directory_uri() . '/assets/img/logo_alb_v2.png' ?>" />
                </div>
            </div>
            <div class="footer-primary-col">
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer',
                    'menu_class' => 'footer-menu'
                ]);
                ?>
            </div>
            <div class="footer-primary-col">
                <?php
                wp_nav_menu([
                    'theme_location' => 'utils',
                    'menu_class' => 'footer-menu'
                ]);
                ?>
            </div>
            <div class="footer-primary-col">
                <div class="footer-anpc-bagdes-container">
                    <a class="footer-anpc-bagde" href="https://anpc.ro/ce-este-sal/" target="_blank">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/anpc-sal.svg' ?>" />
                    </a>
                    <a class="footer-anpc-bagde" href="https://ec.europa.eu/consumers/odr" target="_blank">
                        <img src="<?php echo get_template_directory_uri() . '/assets/img/anpc-sol.svg' ?>" />
                    </a>
                </div>
            </div>
        </div>

        <div class="footer-copyrights">
            <div class="footer-copyrights-side footer-copyrights-left">
                <p>&copy; <?php echo date("Y"); ?> - HERMES OPTIM BUSINESS SRL</p>
            </div>
            <div class="footer-copyrights-side footer-copyrights-right">
                <p>
                    Developed by <a href="https://seqbyte.com">Seqbyte Solutions</a>
                </p>
            </div>
        </div>
    </div>
</footer>