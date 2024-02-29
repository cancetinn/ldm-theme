<?php
/**
 * Arina Digital
 *
 **/

defined('ABSPATH') || exit; // Exit if accessed directly

?>
<div class="ellipseBanner">
    <img class="lazyload lazyloaded" src="<?php echo ARINA_ASSETS_URI; ?>/img/ellipse-banner.png" alt="Ellipse Banner">
</div>
<header class="header">
    <div class="fixedSpace"></div>
    <div class="headerMain stickyMenu">
        <div class="container header">
            <div class="desktop-menu">
                <div class="logo">
                    <a href="<?php echo home_url(); ?>">
                        <img src="<?php echo ARINA_ASSETS_URI; ?>/icons/logo.svg" alt="Lidoma">
                    </a>
                </div>
                <nav>
                    <?php

                    //echo menu_nav("main-menu");
                    wp_nav_menu([
                        'theme_location' => 'main-menu',
                        'menu_class' => 'arina-nav',
                        'items_wrap' => arina_nav_wrap(),
                        'container' => false
                    ]);

                    ?>
                </nav>
            </div>

            <div class="mobile-menu">
                <div class="logo">
                    <a href="<?php echo home_url(); ?>">
                        <img src="<?php echo ARINA_ASSETS_URI; ?>/icons/logo.svg" alt="Lidoma">
                    </a>
                </div>

                <div class="hamburger-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <div class="sidebar-menu">
                    <nav>
                        <?php

                        //echo menu_nav("main-menu");
                        wp_nav_menu([
                            'theme_location' => 'main-menu',
                            'menu_class' => 'arina-nav',
                            'items_wrap' => arina_nav_wrap(),
                            'container' => false
                        ]);

                        ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
