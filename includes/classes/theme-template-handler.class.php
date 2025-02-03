<?php

class HermesThemeTemplateHandler
{
    public function __construct()
    {
        add_filter('template_include', [$this, 'template_include'], 99);
    }

    public function template_include($template)
    {
        $this->render();
        return HERMES_FILE_PATH . '/woocommerce.php';
    }

    public function render()
    {
        global $post;
        global $wp_query;

        if (is_404()) {
            $this->render404();
            return;
        }

        ob_start();
?>
        <!DOCTYPE html>
        <html lang="ro">

        <head>
            <?php
            wp_head();
            ?>
        </head>

        <body>
            <?php
            get_template_part('parts/header');
            ?>

            <main class="page-main">
                <?php
                if (is_woocommerce() || is_cart() || is_checkout() || is_account_page() || is_shop()) {
                    if (is_cart()) {
                        echo "is cart";
                        get_template_part('templates/woocommerce/page-cart');
                    } else if (is_checkout()) {
                        echo "is checkout";
                        get_template_part('templates/woocommerce/page-checkout');
                    } else if (is_account_page()) {
                        echo "is account";
                        get_template_part('templates/woocommerce/page-account');
                    } else if (is_product()) {
                        get_template_part('templates/woocommerce/page-product');
                    } else if (is_shop()) {
                        get_template_part('templates/woocommerce/page-shop');
                    }
                    echo print_r($wp_query->get_queried_object());
                } else if ($post->post_parent === 0) {
                    get_template_part('templates/page-' . $post->post_name);
                }
                ?>
            </main>

            <?php
            get_template_part('parts/footer');
            ?>
        </body>

        </html>

<?php
        $content = ob_get_clean();

        echo $content;
    }
    public function render404()
    {
        status_header(404);
        get_header();
        include HERMES_TEMPLATE_DIR . '/templates/404.php';
        get_footer();
    }
}
