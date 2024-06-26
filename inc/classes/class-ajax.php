<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc;

use ARINA_THEME\Inc\Traits\Singleton;

defined('ABSPATH') || exit; // Exit if accessed directly

class Ajax
{
    use Singleton;

    function __construct()
    {
        add_action('wp_ajax_load_posts_by_category', [$this, 'load_posts_by_category']);
        add_action('wp_ajax_nopriv_load_posts_by_category', [$this, 'load_posts_by_category']);

        /*Tournaments Custom Post Type*/
        add_action('wp_ajax_tournaments', [$this, 'load_works_by_category']);
        add_action('wp_ajax_nopriv_tournaments', [$this, 'load_works_by_category']);

        /*Newsletter Form*/
        add_action('wp_ajax_newsletterForm', [$this, 'save_custom_fields_data']);
        add_action('wp_ajax_nopriv_newsletterForm', [$this, 'save_custom_fields_data']);

        /*arab tournament save db*/
        add_action('init', [$this, 'create_arabtournament_db']);

    }


    public function load_posts_by_category()
    {
        check_ajax_referer('load_more_posts', 'security');

        $paged = $_POST['page'];
        $catId = $_POST['catId'];
        $thumbId = $_POST['thumbId'];
        $postNumber = $_POST['postNumber'];
        $buttonText = $_POST['buttonText'];

        $args = array(
            'post_type' => 'stories',
            'post_status' => 'publish',
            'posts_per_page' => $postNumber,
            'paged' => $paged,
            'tax_query' => array(
                array(
                    'taxonomy' => 'story_categories',
                    'field' => 'id',
                    'terms' => $catId,
                ),
            ),
        );

        $loop = new \WP_Query($args);

        if ($loop->have_posts()) :

            while ($loop->have_posts()) : $loop->the_post();

                // the_title();

            endwhile;

        endif;

        wp_die();
    }

    //arina ajax paged
    public function arinaQuery( $taxonomy, $option = [] ){
        $cats = ($option['cat_id'] !== "0") ? $option['cat_id'] : $option['cats'];

        $args = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'order'          => $option['order'],
            'posts_per_page' => $option['limit'],
            'tax_query' => [
                [
                    'taxonomy'  => $taxonomy,
                    'field'     => 'term_id',
                    'terms'     => $cats,
                ],
            ]
        ];

        // Load more pagination
        $paged = 1;

        if( !empty( $option['paged'] ) ){
            $paged = intval( $option['paged'] );
        }

        $args['paged'] = $paged;

        // Run the Query
        $query = new \WP_Query( $args );
        $query->set( 'new_max_num_pages', $query->max_num_pages );

        return $query;
    }

    function save_custom_fields_data()
    {
        $email = sanitize_text_field($_POST['email']);

        $args = [
            'post_type' => 'newsletter',
            'post_title' => $email,
            'post_status' => 'publish',
        ];

        $post_id = wp_insert_post($args);

        echo 'Form verileri başarıyla kaydedildi!';
        wp_die();
    }


// arabs tournament create database
public function create_arabtournament_db() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'arab_tournament';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        team_name tinytext NOT NULL,
        team_logo text,
        team_country text NOT NULL,
        leader_phone text NOT NULL,
        player1_ign tinytext NOT NULL,
        player1_uid text NOT NULL,
        player1_discord text NOT NULL,
        player1_email text NOT NULL,
        player2_ign tinytext,
        player2_uid text,
        player2_discord text,
        player2_email text,
        player3_ign tinytext,
        player3_uid text,
        player3_discord text,
        player3_email text,
        player4_ign tinytext,
        player4_uid text,
        player4_discord text,
        player4_email text,
        player5_ign tinytext,
        player5_uid text,
        player5_discord text,
        player5_email text,
        substitute1_ign tinytext,
        substitute1_uid text,
        substitute1_discord text,
        substitute1_email text,
        substitute2_ign tinytext,
        substitute2_uid text,
        substitute2_discord text,
        substitute2_email text,
        reference text,
        nonce text NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

public function handle_form_update_permissions_check($request)
{
    return current_user_can('manage_options');
}

}
