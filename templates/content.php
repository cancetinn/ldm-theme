<?php
/**
 * Arina Digital
 *
 **/

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

$thumbnail = get_the_post_thumbnail( get_the_ID(), 'blog_thumb', [ 'alt' => strip_tags(get_the_title()) ] );

?>
<li <?php post_class(); ?>>
    <div class="post-thumbnail">
        <a href="<?php echo the_permalink(); ?>">
            <?php echo $thumbnail; ?>
        </a>
    </div>
    <div class="content">
        <div class="date"><?php the_time('d M Y'); ?></div>

        <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

        <p class="excp"><?php arina_the_excerpt('34'); ?></p>

        <a href="<?php echo the_permalink(); ?>" class="buttonx primary">
            <?php esc_html_e('Devamını gör', ARINA_TEXT); ?>
        </a>
    </div>
</li>
