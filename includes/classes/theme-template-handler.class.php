<?php

class HermesThemeTemplateHandler
{
    public function __construct() {}

    public function render()
    {
        global $post;

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

            <main>

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
