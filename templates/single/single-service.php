<?php
/**
 * Arina Digital
 *
 **/

defined('ABSPATH') || exit; // Exit if accessed directly

$thumbnail = get_the_post_thumbnail( get_the_ID(), 'full', ['alt' => strip_tags(get_the_title()) ] );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="postSingle">
        <div class="container single-post">
            <div class="postTitle">
                <h1 class="title"><?php the_title(); ?></h1>
            </div>
            <div class="servicesContentArea">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</article>
