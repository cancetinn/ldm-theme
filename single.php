<?php
/**
 * Arina Digital
 *
 **/

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

get_header();

if( have_posts() ):

    while( have_posts() ): the_post();

        $postTypeName = get_post_type( get_the_ID() );
        get_template_part( "templates/single/single", $postTypeName );

    endwhile;

    wp_reset_postdata();

endif;

get_footer();
