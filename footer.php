<?php
/**
 * Arina Digital
 *
 **/

defined('ABSPATH') || exit; // Exit if accessed directly

// dynamic_sidebar('sidebar-footer')
// dynamic_sidebar('sidebar-footer-2')

?>
<footer>
    footer

    <div id="datajax" data-ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>" data-nonce="<?php echo wp_create_nonce('secure_nonce'); ?>"></div>
</footer>
<?php wp_footer(); ?>

</body>
</html>

