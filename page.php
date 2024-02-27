<?php
/**
 * Arina Digital
 *
 **/

defined('ABSPATH') || exit; // Exit if accessed directly

get_header();

if (!is_front_page() && !is_home()) :
    ?>
    <div class="breadWrap">
        <div class="container">
            <?php arina_breadcrumbs(); ?>
        </div>
    </div>
<?php
endif;

$isElementor = !isElementorPage(get_the_ID());

$startContainer = $isElementor ? "<div class='notElementor'><div class='container'>" : "";
$endContainer = $isElementor ? "</div></div>" : "";
$title = $isElementor ? "<h1 class='pageTitle'>".get_the_title()."</h1>" : "";

?>
    <main>
        <?php

        echo $startContainer;

        echo $title;

        if (have_posts()) :

            while (have_posts()): the_post();

                the_content();

            endwhile;

        endif;

        echo $endContainer;

        ?>
    </main>
<?php

get_footer();
