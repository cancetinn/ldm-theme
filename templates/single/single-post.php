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
            <div class="postThumb">
                <?php echo $thumbnail; ?>
            </div>
            <div class="postTitle">
                <h1 class="title"><?php the_title(); ?></h1>
            </div>

            <div class="stWrap">
                <div class="timeArea">
                    <?php the_time('d M Y'); ?>
                </div>
                <div class="shareArea">
                    share:
                </div>
            </div>

            <div class="contentArea">
                <?php the_content(); ?>
            </div>
        </div>

        <!--Latest Post Area-->
        <div class="container latest-post">
            <?php
            $args = [
                'post_type'      => 'post',
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
                'posts_per_page' => 3,
            ];

            $query = new \WP_Query($args);
            ?>

            <div class="bigTitle">
                <span>NEWS</span>
                <h1 class="title">Our Latest News</h1>
            </div>

            <div class="lbWrap">
                <?php
                    if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                    $thumbnail = get_the_post_thumbnail( get_the_ID(), 'portfolio_thumb', ['alt' => strip_tags(get_the_title()) ] );
                    $post_time = get_the_time('U');
                    $current_time = current_time('timestamp');
                    $time_diff = $current_time - $post_time;

                    $time_string = '';
                    if ($time_diff < 24 * HOUR_IN_SECONDS) {
                        $time_string = '<div class="post-time">' . human_time_diff($post_time, $current_time) . ' ago</div>';
                    } else {
                        $time_string = '<div class="post-time">' . get_the_date() . '</div>';
                    }
                ?>
                <div class="lbItem">
                    <a href="<?php echo the_permalink(); ?>">
                        <div class="lbItemImg">
                            <?php echo $thumbnail; ?>
                        </div>
                    </a>
                    <div class="lbItemFlex">
                        <div class="lbItemDesc">
                            <a href="<?php echo the_permalink(); ?>">
                                <div class="lbItemTitle">
                                    <a href="<?php echo the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </div>
                            </a>
                            <?php echo $time_string; ?>
                        </div>
                    </div>
                </div>
                <?php
                    endwhile;
                    endif;
                ?>
            </div>
        </div>
    </div>
</article>
