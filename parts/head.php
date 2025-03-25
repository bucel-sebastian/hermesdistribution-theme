<?php

$post = get_queried_object();
if ($post) {
    $pagetitle = $post->post_title;
}
?>

<!-- Hermes Distribution -->
<!-- Developed By Seqbyte Solutions (seqbyte.com) -->
<!-- ---- -->
<!-- Head -->
<!-- ---- -->
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>
    <?php
    if (is_product()) {
        echo get_the_title() . ' - Hermes Distribution';
    } else if (is_product_category()) {
        echo single_term_title("", false) . ' - Hermes Distribution';
    } else if (is_cart()) {
        echo "Coșul de cumpărături" . ' - Hermes Distribution';
    } else if (is_checkout()) {
        echo "Finalizare comandă" . ' - Hermes Distribution';
    } else if (is_account_page()) {
        echo "Contul meu" . ' - Hermes Distribution';
    } else if (is_shop()) {
        echo "Magazin" . ' - Hermes Distribution';
    } else if (is_404()) {
        echo " Pagina nu a fost găsită" . ' - Hermes Distribution';
    } else if (is_search()) {
        echo "Rezultate căutare" . ' - Hermes Distribution';
    } else if (is_front_page()) {
        echo "Hermes Distribution";
    } else {
        echo $pagetitle . ' - Hermes Distribution';
    }
    ?>
</title>

<meta name="author" content="Seqbyte Solutions">

<meta name="description" content="<?php
                                    if (is_product()) {
                                        echo get_the_excerpt();
                                    } else if (is_product_category()) {
                                        echo category_description();
                                    } else if (is_cart()) {
                                        echo "Coșul de cumpărături";
                                    } else if (is_checkout()) {
                                        echo "Finalizare comandă";
                                    } else if (is_account_page()) {
                                        echo "Contul meu";
                                    } else if (is_shop()) {
                                        echo "Magazin";
                                    } else if (is_404()) {
                                        echo "Pagina nu a fost găsită";
                                    } else if (is_search()) {
                                        echo "Rezultate căutare";
                                    } else {
                                        _e("", "hermesdistribution");
                                    }
                                    ?>">
<meta name="keywords" content="<?php _e("en gros, alimente, dulciuri, alimente de baza", "hermesdistribution"); ?>">


<link rel="apple-touch-icon" sizes="180x180" href="<?php echo HERMES_FILE_URI . '/assets/img/favicon/apple-touch-icon.png' ?>">
<link rel="icon" type="image/png" sizes="192x192" href="<?php echo HERMES_FILE_URI . '/assets/img/favicon/android-chrome-192x192.png' ?>">
<link rel="icon" type="image/png" sizes="512x512" href="<?php echo HERMES_FILE_URI . '/assets/img/favicon/android-chrome-512x512.png' ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo HERMES_FILE_URI . '/assets/img/favicon/favicon-16x16.png' ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo HERMES_FILE_URI . '/assets/img/favicon/favicon-32x32.png' ?>">
<link rel="shortcut icon" href="<?php echo HERMES_FILE_URI . '/assets/img/favicon/favicon.ico'; ?>">