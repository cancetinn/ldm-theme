<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc;

use ARINA_THEME\Inc\Traits\Singleton;

use PHPMailer\mail\PHPMailer;
use PHPMailer\mail\Exception;

require ARINA_INC_DIR . '/mail/Exception.php';
require ARINA_INC_DIR . '/mail/PHPMailer.php';
require ARINA_INC_DIR . '/mail/SMTP.php';
require ARINA_INC_DIR . '/mail/OAuth.php';

defined('ABSPATH') || exit; // Exit if accessed directly

class Mail {

    use Singleton;

    function __construct()
    {
		// Contact form ajax
        add_action('wp_ajax_nopriv_contact_form', [$this, 'contact_form']);
        add_action('wp_ajax_contact_form', [$this, 'contact_form']);

        //Arab Tournament FORM AJAX
        add_action('wp_ajax_nopriv_tournaments_form', [$this, 'arabtournaments_form']);
        add_action('wp_ajax_tournaments_form', [$this, 'arabtournaments_form']);
        
    }

    public function contact_form()
    {
		self::checkNonce("contact_form_nonce");

	    $args = [
            'name'      => $_POST['name'],
            'phone'     => $_POST['phone'],
		    'email'     => $_POST['email'],
            'dbaction'  => $_POST['dbaction'],
		    'template'  => 'contact', // contact-template.php
		    'required'  => ['name'],
        ];

	    $messages = [
		    'error'     => esc_html__("Bir hata oluştu!", ARINA_TEXT),
		    'success'   => esc_html__("Mesajınız başarılı bir şekilde gönderildi.", ARINA_TEXT),
	    ];

        self::phpMailer($args, $messages);

        die;
    }

    public function phpMailer($args, $messages, $subject = 'Tournament Application Received')
    {
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->isHTML(true);
        $mail->Host = MAIL_HOST;
        $mail->Port = MAIL_PORT;
        $mail->SMTPSecure = MAIL_SECURE;
        $mail->SMTPAuth = true;
        $mail->CharSet = 'UTF-8';
        $mail->Username = MAIL_USERNAME;
        $mail->Password = MAIL_PASSWORD;
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];

        $mail->setFrom(MAIL_USERNAME, 'Tournament Registration');
        foreach ($args['emails'] as $email) {
            $mail->addAddress($email); // Add a recipient
        }

        $mail->Subject = $subject;
        $mail->MsgHTML(self::mailTemplate($args));

        if(!$mail->send()) {
            self::sendJsonFormat("error", $messages['error']);
        } else {
            self::sendJsonFormat("success", $messages['success']);
        }
    }


	public function validateFields($fields){
		$check_field = [];

		if (isset( $fields )) {
			foreach ($fields as $field) {
				if (empty( $_POST[$field] )) {
					$check_field[] = $field;
				}
			}

			if (!empty( $check_field )) {
				self::sendJsonFormat("error", esc_html__("Please fill in the required fields.", ARINA_TEXT));
			}
		}
	}

	public function sendJsonFormat($status, $message) {
		wp_send_json([
			'status' => $status,
			'message' => $message
		]);
	}

	public function checkNonce($name, $intent = "security"){
		$nonce = check_ajax_referer($name, $intent, false);
		if (!$nonce) {
			self::sendJsonFormat("error", esc_html__("Kullanıcı doğrulaması başarısız!", ARINA_TEXT));
		}
	}

    public function mailTemplate($args)
    {
	    $args['thetitle'] = $_POST['thetitle'];
	    $args['thepermalink'] = $_POST['thepermalink'];
	    $templateName = $args['template'];

        ob_start();
        get_template_part("templates/mail/$templateName", "template", $args);
        $templateContent = ob_get_clean();

        return $templateContent;
    }

    public function arabtournaments_form()
        {
            // Check nonce
            check_ajax_referer('tournament_form_nonce', 'security');

            global $wpdb;
            $table_name = $wpdb->prefix . 'arab_tournament';

            // Sanitize and assign form data
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
            $reference = sanitize_text_field($_POST['reference']);
            $nonce = sanitize_text_field($_POST['security']);

            // File upload
            $file_url = '';
            if (!empty($_FILES['teamlogo']['name'])) {
                $file = $_FILES['teamlogo'];

                if ($file['error']) {
                    wp_send_json_error('File upload error!');
                }

                $upload = wp_handle_upload($file, array('test_form' => false));

                if (isset($upload['url']) && !isset($upload['error'])) {
                    $file_url = $upload['url'];
                } else {
                    wp_send_json_error('File upload error: ' . $upload['error']);
                }
            }

            // Insert data into database
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

            // Prepare email data
            $emails = [
                $player1_email,
                $player2_email,
                $player3_email,
                $player4_email,
                $player5_email,
                $substitute1_email,
                $substitute2_email,
            ];

            $args = [
                'emails'        => $emails,
                'template'      => 'application',
            ];

            $messages = [
                'error'     => esc_html__("Please fill in the required fields.", ARINA_TEXT),
                'success'   => esc_html__("Your tournament application has been successfully received.", ARINA_TEXT),
            ];

            // Send email
            self::phpMailer($args, $messages);

            wp_send_json_success('Form submitted and email sent successfully!');
            die;
        }

}
