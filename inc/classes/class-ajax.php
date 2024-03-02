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
        add_action('after_setup_theme', [$this, 'create_wp_applications_table']);
        add_action('admin_post_submit_application_form', [$this, 'save_application_form']);
        add_action('admin_post_nopriv_submit_application_form', [$this, 'save_application_form']);
        add_action('rest_api_init', [$this, 'register_custom_rest_route']);

        /*Tournaments Custom Post Type*/
        add_action('wp_ajax_tournaments', [$this, 'load_works_by_category']);
        add_action('wp_ajax_nopriv_tournaments', [$this, 'load_works_by_category']);

        /*Newsletter Form*/
        add_action('wp_ajax_newsletterForm', [$this, 'save_custom_fields_data']);
        add_action('wp_ajax_nopriv_newsletterForm', [$this, 'save_custom_fields_data']);


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


    // Veri tablosu oluşturma.
    public function create_wp_applications_table()
    {
        global $wpdb;
        $applications_table = $wpdb->prefix . 'applications';
        $applications_accept_table = $wpdb->prefix . 'applications_accept';
        $applications_reject_table = $wpdb->prefix . 'applications_reject';

        // wp_applications tablosu
        $sql1 = "CREATE TABLE IF NOT EXISTS $applications_table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        team_name varchar(100) NOT NULL,
        country varchar(50) NOT NULL,
        player1_fullname varchar(100),
        player1_ign varchar(50),
        player1_uid varchar(50),
        player1_email varchar(100),
        player1_discord varchar(50),
        player2_fullname varchar(100),
        player2_ign varchar(50),
        player2_uid varchar(50),
        player2_email varchar(100),
        player2_discord varchar(50),
        player3_fullname varchar(100),
        player3_ign varchar(50),
        player3_uid varchar(50),
        player3_email varchar(100),
        player3_discord varchar(50),
        player4_fullname varchar(100),
        player4_ign varchar(50),
        player4_uid varchar(50),
        player4_email varchar(100),
        player4_discord varchar(50),
        reserve_player1_fullname varchar(100),
        reserve_player1_ign varchar(50),
        reserve_player1_uid varchar(50),
        reserve_player1_email varchar(100),
        reserve_player1_discord varchar(50),
        reserve_player2_fullname varchar(100),
        reserve_player2_ign varchar(50),
        reserve_player2_uid varchar(50),
        reserve_player2_email varchar(100),
        reserve_player2_discord varchar(50),
        coach_fullname varchar(100),
        coach_email varchar(100),
        coach_discord varchar(50),
        token varchar(255),
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        status varchar(20) DEFAULT 'progress',
        UNIQUE KEY id (id)
    );";

        // wp_applications_accept tablosu
        $sql2 = "CREATE TABLE IF NOT EXISTS $applications_accept_table (
        id mediumint(9) NOT NULL,
        team_name varchar(100) NOT NULL,
        country varchar(50) NOT NULL,
        player1_fullname varchar(100),
        player1_ign varchar(50),
        player1_uid varchar(50),
        player1_email varchar(100),
        player1_discord varchar(50),
        player2_fullname varchar(100),
        player2_ign varchar(50),
        player2_uid varchar(50),
        player2_email varchar(100),
        player2_discord varchar(50),
        player3_fullname varchar(100),
        player3_ign varchar(50),
        player3_uid varchar(50),
        player3_email varchar(100),
        player3_discord varchar(50),
        player4_fullname varchar(100),
        player4_ign varchar(50),
        player4_uid varchar(50),
        player4_email varchar(100),
        player4_discord varchar(50),
        reserve_player1_fullname varchar(100),
        reserve_player1_ign varchar(50),
        reserve_player1_uid varchar(50),
        reserve_player1_email varchar(100),
        reserve_player1_discord varchar(50),
        reserve_player2_fullname varchar(100),
        reserve_player2_ign varchar(50),
        reserve_player2_uid varchar(50),
        reserve_player2_email varchar(100),
        reserve_player2_discord varchar(50),
        coach_fullname varchar(100),
        coach_email varchar(100),
        coach_discord varchar(50),
        token varchar(255),
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        status varchar(20) DEFAULT 'accept',
        FOREIGN KEY (id) REFERENCES $applications_table(id)
    );";

        // wp_applications_reject tablosu
        $sql3 = "CREATE TABLE IF NOT EXISTS $applications_reject_table (
        id mediumint(9) NOT NULL,
        team_name varchar(100) NOT NULL,
        country varchar(50) NOT NULL,
        player1_fullname varchar(100),
        player1_ign varchar(50),
        player1_uid varchar(50),
        player1_email varchar(100),
        player1_discord varchar(50),
        player2_fullname varchar(100),
        player2_ign varchar(50),
        player2_uid varchar(50),
        player2_email varchar(100),
        player2_discord varchar(50),
        player3_fullname varchar(100),
        player3_ign varchar(50),
        player3_uid varchar(50),
        player3_email varchar(100),
        player3_discord varchar(50),
        player4_fullname varchar(100),
        player4_ign varchar(50),
        player4_uid varchar(50),
        player4_email varchar(100),
        player4_discord varchar(50),
        reserve_player1_fullname varchar(100),
        reserve_player1_ign varchar(50),
        reserve_player1_uid varchar(50),
        reserve_player1_email varchar(100),
        reserve_player1_discord varchar(50),
        reserve_player2_fullname varchar(100),
        reserve_player2_ign varchar(50),
        reserve_player2_uid varchar(50),
        reserve_player2_email varchar(100),
        reserve_player2_discord varchar(50),
        coach_fullname varchar(100),
        coach_email varchar(100),
        coach_discord varchar(50),
        token varchar(255),
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        status varchar(20) DEFAULT 'reject',
        FOREIGN KEY (id) REFERENCES $applications_table(id)
    );";


        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql1);
        dbDelta($sql2);
        dbDelta($sql3);
    }

    //form verilerini tabloya yazdır
    public function save_application_form()
    {
        global $wpdb;

        if (!isset($_POST['application_nonce_field']) || !wp_verify_nonce($_POST['application_nonce_field'], 'application_nonce')) {
            wp_die('Nonce doğrulama başarısız.');
        }

        $table_name = $wpdb->prefix . 'applications';

        $team_name = sanitize_text_field($_POST['team_name']);
        $country = sanitize_text_field($_POST['country']);

        $player1_fullname = isset($_POST['player1_fullname']) ? sanitize_text_field($_POST['player1_fullname']) : '';
        $player1_ign = isset($_POST['player1_ign']) ? sanitize_text_field($_POST['player1_ign']) : '';
        $player1_uid = isset($_POST['player1_uid']) ? sanitize_text_field($_POST['player1_uid']) : '';
        $player1_email = isset($_POST['player1_email']) ? sanitize_email($_POST['player1_email']) : '';
        $player1_discord = isset($_POST['player1_discord']) ? sanitize_text_field($_POST['player1_discord']) : '';
        $player2_fullname = isset($_POST['player2_fullname']) ? sanitize_text_field($_POST['player2_fullname']) : '';
        $player2_ign = isset($_POST['player2_ign']) ? sanitize_text_field($_POST['player2_ign']) : '';
        $player2_uid = isset($_POST['player2_uid']) ? sanitize_text_field($_POST['player2_uid']) : '';
        $player2_email = isset($_POST['player2_email']) ? sanitize_email($_POST['player2_email']) : '';
        $player2_discord = isset($_POST['player2_discord']) ? sanitize_text_field($_POST['player2_discord']) : '';
        $player3_fullname = isset($_POST['player3_fullname']) ? sanitize_text_field($_POST['player3_fullname']) : '';
        $player3_ign = isset($_POST['player3_ign']) ? sanitize_text_field($_POST['player3_ign']) : '';
        $player3_uid = isset($_POST['player3_uid']) ? sanitize_text_field($_POST['player3_uid']) : '';
        $player3_email = isset($_POST['player3_email']) ? sanitize_email($_POST['player3_email']) : '';
        $player3_discord = isset($_POST['player3_discord']) ? sanitize_text_field($_POST['player3_discord']) : '';
        $player4_fullname = isset($_POST['player4_fullname']) ? sanitize_text_field($_POST['player4_fullname']) : '';
        $player4_ign = isset($_POST['player4_ign']) ? sanitize_text_field($_POST['player4_ign']) : '';
        $player4_uid = isset($_POST['player4_uid']) ? sanitize_text_field($_POST['player4_uid']) : '';
        $player4_email = isset($_POST['player4_email']) ? sanitize_email($_POST['player4_email']) : '';
        $player4_discord = isset($_POST['player4_discord']) ? sanitize_text_field($_POST['player4_discord']) : '';

        $reserve_player1_fullname = isset($_POST['reserve_player1_fullname']) ? sanitize_text_field($_POST['reserve_player1_fullname']) : '';
        $reserve_player1_ign = isset($_POST['reserve_player1_ign']) ? sanitize_text_field($_POST['reserve_player1_ign']) : '';
        $reserve_player1_uid = isset($_POST['reserve_player1_uid']) ? sanitize_text_field($_POST['reserve_player1_uid']) : '';
        $reserve_player1_email = isset($_POST['reserve_player1_email']) ? sanitize_email($_POST['reserve_player1_email']) : '';
        $reserve_player1_discord = isset($_POST['reserve_player1_discord']) ? sanitize_text_field($_POST['reserve_player1_discord']) : '';

        $reserve_player2_fullname = isset($_POST['reserve_player2_fullname']) ? sanitize_text_field($_POST['reserve_player2_fullname']) : '';
        $reserve_player2_ign = isset($_POST['reserve_player2_ign']) ? sanitize_text_field($_POST['reserve_player2_ign']) : '';
        $reserve_player2_uid = isset($_POST['reserve_player2_uid']) ? sanitize_text_field($_POST['reserve_player2_uid']) : '';
        $reserve_player2_email = isset($_POST['reserve_player2_email']) ? sanitize_email($_POST['reserve_player2_email']) : '';
        $reserve_player2_discord = isset($_POST['reserve_player2_discord']) ? sanitize_text_field($_POST['reserve_player2_discord']) : '';

        $coach_fullname = isset($_POST['coach_fullname']) ? sanitize_text_field($_POST['coach_fullname']) : '';
        $coach_email = isset($_POST['coach_email']) ? sanitize_email($_POST['coach_email']) : '';
        $coach_discord = isset($_POST['coach_discord']) ? sanitize_text_field($_POST['coach_discord']) : '';

        $user_ip = $_SERVER['REMOTE_ADDR'];
        $token = md5($user_ip);

        $insert_result = $wpdb->insert(
            $table_name,
            array(
                'team_name' => $team_name,
                'country' => $country,
                'player1_fullname' => $player1_fullname,
                'player1_ign' => $player1_ign,
                'player1_uid' => $player1_uid,
                'player1_email' => $player1_email,
                'player1_discord' => $player1_discord,
                'player2_fullname' => $player2_fullname,
                'player2_ign' => $player2_ign,
                'player2_uid' => $player2_uid,
                'player2_email' => $player2_email,
                'player2_discord' => $player2_discord,
                'player3_fullname' => $player3_fullname,
                'player3_ign' => $player3_ign,
                'player3_uid' => $player3_uid,
                'player3_email' => $player3_email,
                'player3_discord' => $player3_discord,
                'player4_fullname' => $player4_fullname,
                'player4_ign' => $player4_ign,
                'player4_uid' => $player4_uid,
                'player4_email' => $player4_email,
                'player4_discord' => $player4_discord,
                'reserve_player1_fullname' => $reserve_player1_fullname,
                'reserve_player1_ign' => $reserve_player1_ign,
                'reserve_player1_uid' => $reserve_player1_uid,
                'reserve_player1_email' => $reserve_player1_email,
                'reserve_player1_discord' => $reserve_player1_discord,
                'reserve_player2_fullname' => $reserve_player2_fullname,
                'reserve_player2_ign' => $reserve_player2_ign,
                'reserve_player2_uid' => $reserve_player2_uid,
                'reserve_player2_email' => $reserve_player2_email,
                'reserve_player2_discord' => $reserve_player2_discord,
                'coach_fullname' => $coach_fullname,
                'coach_email' => $coach_email,
                'coach_discord' => $coach_discord,
                'token' => $token,
                'time' => current_time('mysql'),
                'status' => 'progress'
            )
        );

        if ($insert_result === false) {
            wp_die('Veritabanına ekleme başarısız.');
        }

        wp_redirect(home_url('/thank-you/'));
        exit;
    }

    //rest api oluştur
    //url kısmı burada
    public function register_custom_rest_route()
    {
        register_rest_route('appforms/v1', '/form-data', array(
            'methods' => 'GET',
            'callback' => [$this, 'handle_form_data_endpoint'],
            'permission_callback' => [$this, 'handle_form_data_permissions_check']
        ));

        register_rest_route('appforms/v1', '/update-form', array(
            'methods' => 'POST',
            'callback' => [$this, 'handle_form_update_endpoint'],
            'permission_callback' => [$this, 'handle_form_update_permissions_check']
        ));
    }

    //auth ile ulaşmak için bu kısım
    public function handle_form_data_permissions_check($request)
    {
        /*if (!current_user_can('manage_options')) {
            return new \WP_Error('rest_forbidden', esc_html__('You do not have permissions to access this data.', 'my-text-domain'), array('status' => 401));
        }*/
        return true;
    }

    //database bağlantısı ekrana yazdırma
    public function handle_form_data_endpoint($request)
    {
        global $wpdb;
        $params = $request->get_params();
        $query = "SELECT * FROM {$wpdb->prefix}applications";

        if (isset($params['status'])) {
            $status = sanitize_text_field($params['status']);
            $query .= $wpdb->prepare(" WHERE status = %s", $status);
        }

        $query .= " ORDER BY time DESC";

        if (isset($params['limit'])) {
            $limit = intval($params['limit']);
            $query .= $wpdb->prepare(" LIMIT %d", $limit);
        }

        $form_data = $wpdb->get_results($query);

        if (!empty($form_data)) {
            return new \WP_REST_Response($form_data, 200);
        } else {
            return new \WP_Error('no_form_data', 'No form data found', array('status' => 404));
        }
    }

    public function handle_form_update_endpoint($request)
    {
        global $wpdb;

        $params = json_decode($request->get_body());

        $submissionId = isset($params->submissionId) ? intval($params->submissionId) : null;
        $status = isset($params->status) ? sanitize_text_field($params->status) : '';

        if (!$submissionId || !in_array($status, ['approved', 'rejected'])) {
            return new \WP_Error('invalid_request', 'Geçersiz istek.', array('status' => 400));
        }

        $applications_table = $wpdb->prefix . 'applications';
        $accept_table = $wpdb->prefix . 'applications_accept';
        $reject_table = $wpdb->prefix . 'applications_reject';

        $submission = $wpdb->get_row($wpdb->prepare("SELECT * FROM $applications_table WHERE id = %d", $submissionId));
        if (!$submission) {
            return new \WP_Error('not_found', 'Form kaydı bulunamadı.', array('status' => 404));
        }

        $data_array = array(
            'id' => $submission->id,
            'team_name' => $submission->team_name,
            'country' => $submission->country,
            'player1_fullname' => $submission->player1_fullname,
            'player1_ign' => $submission->player1_ign,
            'player1_uid' => $submission->player1_uid,
            'player1_email' => $submission->player1_email,
            'player1_discord' => $submission->player1_discord,
            'player2_fullname' => $submission->player2_fullname,
            'player2_ign' => $submission->player2_ign,
            'player2_uid' => $submission->player2_uid,
            'player2_email' => $submission->player2_email,
            'player2_discord' => $submission->player2_discord,
            'player3_fullname' => $submission->player3_fullname,
            'player3_ign' => $submission->player3_ign,
            'player3_uid' => $submission->player3_uid,
            'player3_email' => $submission->player3_email,
            'player3_discord' => $submission->player3_discord,
            'player4_fullname' => $submission->player4_fullname,
            'player4_ign' => $submission->player4_ign,
            'player4_uid' => $submission->player4_uid,
            'player4_email' => $submission->player4_email,
            'player4_discord' => $submission->player4_discord,
            'reserve_player1_fullname' => $submission->reserve_player1_fullname,
            'reserve_player1_ign' => $submission->reserve_player1_ign,
            'reserve_player1_uid' => $submission->reserve_player1_uid,
            'reserve_player1_email' => $submission->reserve_player1_email,
            'reserve_player1_discord' => $submission->reserve_player1_discord,
            'reserve_player2_fullname' => $submission->reserve_player2_fullname,
            'reserve_player2_ign' => $submission->reserve_player2_ign,
            'reserve_player2_uid' => $submission->reserve_player2_uid,
            'reserve_player2_email' => $submission->reserve_player2_email,
            'reserve_player2_discord' => $submission->reserve_player2_discord,
            'coach_fullname' => $submission->coach_fullname,
            'coach_email' => $submission->coach_email,
            'coach_discord' => $submission->coach_discord,
            'token' => $submission->token,
            'time' => $submission->time,
            'status' => $status

        );

        if ($status === 'approved') {
            $wpdb->replace($accept_table, $data_array);
            $wpdb->delete($reject_table, array('id' => $submissionId));
        } else {
            $wpdb->replace($reject_table, $data_array);
            $wpdb->delete($accept_table, array('id' => $submissionId));
        }

        $wpdb->update(
            $applications_table,
            array('status' => $status),
            array('id' => $submissionId)
        );

        return new \WP_REST_Response('Form güncellendi', 200);
    }


    public function handle_form_update_permissions_check($request)
    {
        //return current_user_can('manage_options');
        return true;
    }


}
