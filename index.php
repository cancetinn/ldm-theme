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
 * esc_url(home_url( '/' ))
 *
 * */

?>
<main>
    <div class="blogList">
        <div class="container">
            <div class="bl-wrap">
                <ul class="bl-list">
                    <?php

                    if (have_posts()):

                        while (have_posts()): the_post();

                            get_template_part('templates/content');

                        endwhile;
                        wp_reset_postdata();
                    endif;

                    //arina_pagination();

                    ?>
                </ul>

                <div class="sidebar">
                    <?php //dynamic_sidebar('sidebar-blog'); ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php

get_footer();
