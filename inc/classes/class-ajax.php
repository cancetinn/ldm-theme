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
        username varchar(50) NOT NULL,
        team_name varchar(100) NOT NULL,
        message text NOT NULL,
        token varchar(32) NOT NULL,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        status varchar(20) DEFAULT 'progress',
        UNIQUE KEY id (id)
        );";

        // wp_applications_accept tablosu
        $sql2 = "CREATE TABLE IF NOT EXISTS $applications_accept_table (
        id mediumint(9) NOT NULL,
        username varchar(50) NOT NULL,
        team_name varchar(100) NOT NULL,
        message text NOT NULL,
        token varchar(32) NOT NULL,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        status varchar(20) DEFAULT 'accept',
        FOREIGN KEY (id) REFERENCES $applications_table(id)
        );";

        // wp_applications_reject tablosu
        $sql3 = "CREATE TABLE IF NOT EXISTS $applications_reject_table (
        id mediumint(9) NOT NULL,
        username varchar(50) NOT NULL,
        team_name varchar(100) NOT NULL,
        message text NOT NULL,
        token varchar(32) NOT NULL,
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

        if (isset($_POST['application_nonce_field']) && !wp_verify_nonce($_POST['application_nonce_field'], 'application_nonce')) {
            return;
        }

        $username = isset($_POST['username']) ? sanitize_text_field($_POST['username']) : '';
        $team_name = isset($_POST['team_name']) ? sanitize_text_field($_POST['team_name']) : '';
        $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';

        $token = wp_generate_password(32, false);

        $table_name = $wpdb->prefix . 'applications';

        $insert_result = $wpdb->insert(
            $table_name,
            array(
                'username' => $username,
                'team_name' => $team_name,
                'message' => $message,
                'token' => $token,
                'time' => current_time('mysql'),
            )
        );

        wp_redirect(home_url('/tesekkurler/'));
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

        $query = "SELECT * FROM {$wpdb->prefix}applications";

        $params = $request->get_params();

        if (isset($params['after'])) {
            $after = sanitize_text_field($params['after']);
            $query .= $wpdb->prepare(" WHERE time > %s", $after);
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

        if ($status === 'approved') {
            $wpdb->replace(
                $accept_table,
                array(
                    'id' => $submission->id,
                    'username' => $submission->username,
                    'team_name' => $submission->team_name,
                    'message' => $submission->message,
                    'token' => $submission->token,
                    'time' => $submission->time,
                    'status' => $status
                )
            );

            $wpdb->delete($reject_table, array('id' => $submissionId));
        } else {
            $wpdb->replace(
                $reject_table,
                array(
                    'id' => $submission->id,
                    'username' => $submission->username,
                    'team_name' => $submission->team_name,
                    'message' => $submission->message,
                    'token' => $submission->token,
                    'time' => $submission->time,
                    'status' => $status
                )
            );

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
