<?php
/**
 * Arina Digital
 *
 **/

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

get_header();

/*
 * get_the_post_thumbnail_url( get_option('page_for_posts') )
 * get_the_title( get_option('page_for_posts') )
 *
 * */

?>
<!--    <div class="breadWrap">
        <div class="container">
            <nav class="breadcrubs">
                <ul class="breadList">
                    <li class="link home">
                        <a href="<?php /*echo home_url(); */?>">
                            <?php /*echo getRedux('bread_home_text'); */?>
                        </a>
                    </li>
                    <li class="link">
                        <span><?php /*echo getRedux('news_title'); */?></span>
                    </li>
                </ul>
            </nav>
        </div>
    </div>-->

    <main class="blogList">
        <div class="container">
            <div class="blWrap">
                <h1 class="title line center"><?php echo getRedux('news_title'); ?></h1>

                <ul class="blList">
                    <?php

                    if (have_posts()):

                        while (have_posts()): the_post();

                            get_template_part('templates/content');

                        endwhile;

                        wp_reset_postdata();

                    endif;

                    ?>
                </ul>

                <div class="blogPagiSpace">
                    <?php arina_pagination(); ?>
                </div>

                <div class="sidebar">
                    <?php //dynamic_sidebar('sidebar-blog'); ?>
                </div>
            </div>
        </div>
    </main>

    <div class="spacex" style="--spacer:150px"></div>

    <div class="bigText">
        <p><?php echo getRedux('news_title'); ?></p>
    </div>
<?php

get_footer();
