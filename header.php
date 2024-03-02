<?php
/**
 * Arina Digital
 *
 **/

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

$pageSlug = get_post_field('post_name', get_post());

?>
    <!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="<?php bloginfo('charset'); ?>">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php wp_head(); ?>

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-D2FJ27Q3K5"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-D2FJ27Q3K5');
        </script>
    </head>
<body <?php body_class( $pageSlug ); ?>>
<?php get_template_part("templates/header/layout"); ?>
