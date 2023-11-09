<?php
/**
 * Arina Digital
 *
 **/

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

get_header();

if ( !is_front_page() && !is_home() ) :
    arina_breadcrumbs();
endif;

echo "<main>";

//echo do_shortcode('[contact_now]');

?>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const contactForm = document.querySelector('#contactform')
            const datAjax = document.querySelector("#datajax")
            const {nonce, ajaxurl} = datAjax.dataset

            contactForm.addEventListener('submit', (e) => {
                e.preventDefault()

                const formData = new FormData(contactForm)
                formData.append('action', 'contact_form')
                formData.append('security', nonce)

                fetch(ajaxurl, {
                    method: 'POST',
                    body: formData,
                })
                    .then(response => response.text())
                    .then(data => {
                        console.log(data)
                    })
            })
        })
    </script>
<?php

if ( have_posts() ) :

    while ( have_posts() ): the_post();

        the_content();

        the_post_thumbnail('post_thumb');

        the_post_thumbnail();

        echo wp_get_attachment_image( get_post_thumbnail_id(), 'full' );

    endwhile;

endif;

echo "</main>";

get_footer();
