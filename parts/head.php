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
    Hermes Distribution
</title>

<meta name="author" content="Seqbyte Solutions">

<meta name="description" content="<?php _e("", "hermesdistribution"); ?>">
<meta name="keywords" content="<?php _e("", "hermesdistribution"); ?>">


<link rel="apple-touch-icon" sizes="180x180" href="<?php echo HERMES_FILE_URI . '/assets/img/favicon/apple-touch-icon.png' ?>">
<link rel="icon" type="image/png" sizes="192x192" href="<?php echo HERMES_FILE_URI . '/assets/img/favicon/android-chrome-192x192.png' ?>">
<link rel="icon" type="image/png" sizes="512x512" href="<?php echo HERMES_FILE_URI . '/assets/img/favicon/android-chrome-512x512.png' ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo HERMES_FILE_URI . '/assets/img/favicon/favicon-16x16.png' ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo HERMES_FILE_URI . '/assets/img/favicon/favicon-32x32.png' ?>">
<link rel="shortcut icon" href="<?php echo HERMES_FILE_URI . '/assets/img/favicon/favicon.ico'; ?>">