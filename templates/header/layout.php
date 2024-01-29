<?php
/**
 * Arina Digital
 *
 **/

defined('ABSPATH') || exit; // Exit if accessed directly

// menu_nav("top-menu")

?>
<header>
    header

    <?php

    //echo menu_nav("main-menu");
    wp_nav_menu([
        'theme_location' => 'main-menu',
        'menu_class' => 'arina-nav',
        'items_wrap' => arina_nav_wrap(),
        'container' => false
    ]);

    ?>
</header>
