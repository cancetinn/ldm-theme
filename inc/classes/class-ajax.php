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
        add_action('wp_ajax_tournaments_form', [$this,'arabtournament_save_detail']);
        add_action('wp_ajax_nopriv_tournaments_form', [$this,'arabtournament_save_detail']);

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

    // arabs tournament db save
    public function arabtournament_save_detail() {
    check_ajax_referer('tournament_form_nonce', 'security');

    global $wpdb;
    $table_name = $wpdb->prefix . 'arab_tournament';

    $team_name = sanitize_text_field($_POST['teamname']);
    $team_country = sanitize_text_field($_POST['teamcountry']);
    $leader_phone = sanitize_text_field($_POST['leaderphone']);
    $player1_ign = sanitize_text_field($_POST['player1ign']);
    $player1_uid = sanitize_text_field($_POST['player1uid']);
    $player1_discord = sanitize_text_field($_POST['player1dc']);
    $player1_email = sanitize_email($_POST['player1email']);
    $player2_ign = sanitize_text_field($_POST['player2ign']);
    $player2_uid = sanitize_text_field($_POST['player2uid']);
    $player2_discord = sanitize_text_field($_POST['player2dc']);
    $player2_email = sanitize_email($_POST['player2email']);
    $player3_ign = sanitize_text_field($_POST['player3ign']);
    $player3_uid = sanitize_text_field($_POST['player3uid']);
    $player3_discord = sanitize_text_field($_POST['player3dc']);
    $player3_email = sanitize_email($_POST['player3email']);
    $player4_ign = sanitize_text_field($_POST['player4ign']);
    $player4_uid = sanitize_text_field($_POST['player4uid']);
    $player4_discord = sanitize_text_field($_POST['player4dc']);
    $player4_email = sanitize_email($_POST['player4email']);
    $player5_ign = sanitize_text_field($_POST['player5ign']);
    $player5_uid = sanitize_text_field($_POST['player5uid']);
    $player5_discord = sanitize_text_field($_POST['player5dc']);
    $player5_email = sanitize_email($_POST['player5email']);
    $substitute1_ign = sanitize_text_field($_POST['substitute1_ign']);
    $substitute1_uid = sanitize_text_field($_POST['substitute1_uid']);
    $substitute1_discord = sanitize_text_field($_POST['substitute1_discord']);
    $substitute1_email = sanitize_email($_POST['substitute1_email']);
    $substitute2_ign = sanitize_text_field($_POST['substitute2_ign']);
    $substitute2_uid = sanitize_text_field($_POST['substitute2_uid']);
    $substitute2_discord = sanitize_text_field($_POST['substitute2_discord']);
    $substitute2_email = sanitize_email($_POST['substitute2_email']);
    $reference = sanitize_email($_POST['reference']);
    $nonce = sanitize_text_field($_POST['security']);

    // Dosya yükleme işlemi
    $file_url = '';
    if (!empty($_FILES['teamlogo']['name'])) {
        $file = $_FILES['teamlogo'];

        // Yükleme hatalarını kontrol et
        if ($file['error']) {
            wp_send_json_error('File upload error!');
        }

        // Dosyayı WordPress'e yükle
        $upload = wp_handle_upload($file, array('test_form' => false));

        if (isset($upload['url']) && !isset($upload['error'])) {
            $file_url = $upload['url'];
        } else {
            wp_send_json_error('File upload error: ' . $upload['error']);
        }
    }

    // Veritabanına veriyi kaydet
    $wpdb->insert(
        $table_name,
        [
            'team_name' => $team_name,
            'team_logo' => $file_url,
            'team_country' => $team_country,
            'leader_phone' => $leader_phone,
            'player1_ign' => $player1_ign,
            'player1_uid' => $player1_uid,
            'player1_discord' => $player1_discord,
            'player1_email' => $player1_email,
            'player2_ign' => $player2_ign,
            'player2_uid' => $player2_uid,
            'player2_discord' => $player2_discord,
            'player2_email' => $player2_email,
            'player3_ign' => $player3_ign,
            'player3_uid' => $player3_uid,
            'player3_discord' => $player3_discord,
            'player3_email' => $player3_email,
            'player4_ign' => $player4_ign,
            'player4_uid' => $player4_uid,
            'player4_discord' => $player4_discord,
            'player4_email' => $player4_email,
            'player5_ign' => $player5_ign,
            'player5_uid' => $player5_uid,
            'player5_discord' => $player5_discord,
            'player5_email' => $player5_email,
            'substitute1_ign' => $substitute1_ign,
            'substitute1_uid' => $substitute1_uid,
            'substitute1_discord' => $substitute1_discord,
            'substitute1_email' => $substitute1_email,
            'substitute2_ign' => $substitute2_ign,
            'substitute2_uid' => $substitute2_uid,
            'substitute2_discord' => $substitute2_discord,
            'substitute2_email' => $substitute2_email,
            'reference' => $reference,
            'nonce' => $nonce
        ]
    );

    wp_send_json_success('Form submitted successfully!');
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
