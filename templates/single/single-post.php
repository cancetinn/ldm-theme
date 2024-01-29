<?php
/**
 * Arina Digital
 *
 **/

defined('ABSPATH') || exit; // Exit if accessed directly

$thumbnail = get_the_post_thumbnail( get_the_ID(), 'full', ['alt' => strip_tags(get_the_title()) ] );

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="top_img">
        <div class="clip_path">
            <div class="content_header">
                <h1 class="title medium"><?php the_title(); ?></h1>
            </div>
            <?php echo $thumbnail; ?>
        </div>
    </div>

    <div class="container">
        <div class="content_main">
            <div class="content_left">
                <div class="date post">
                    <?php the_time('d M Y'); ?>
                </div>
                <div class="single_content">
                    <?php the_content(); ?>
                </div>
            </div>

            <div class="sidebar">
                <?php dynamic_sidebar('sidebar-blog'); ?>
            </div>
        </div>
    </div>
</article>
