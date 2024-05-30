<?php
/**
 * Arina Digital
 *
 **/

defined('ABSPATH') || exit; // Exit if accessed directly

$thumbnail = get_the_post_thumbnail( get_the_ID(), 'full', ['alt' => strip_tags(get_the_title()) ] );
$banner = get_field('banner');
$current_page_id = get_queried_object_id();
$title = get_the_title( $current_page_id );
$permalink = get_the_permalink( $current_page_id );
?>

<?php
$template = get_field('page_template');

if($template == 'TEMPLATE_ONE') {
    get_template_part( "templates/single/single", 'template-one' );

}

elseif($template == 'TEMPLATE_TWO') {
    get_template_part( "templates/single/single", 'template-two' );
}

else {
    get_template_part( "templates/single/single", 'template-three' );
}

?>

