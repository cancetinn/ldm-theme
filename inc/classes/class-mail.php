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

        //Tournament FORM AJAX
        add_action('wp_ajax_nopriv_tournaments_form', [$this, 'tournaments_form']);
        add_action('wp_ajax_tournaments_form', [$this, 'tournaments_form']);

        //Arab Tournament FORM AJAX
        add_action('wp_ajax_nopriv_arab_tournament', [$this, 'arab_tournament']);
        add_action('wp_ajax_arab_tournament', [$this, 'arab_tournament']);
    }

    public function contact_form()
    {
		self::checkNonce("contact_form_nonce");

	    $args = [
            'name'      => $_POST['name'],
            'phone'     => $_POST['phone'],
		    'email'     => $_POST['email'],
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

    public function tournaments_form()
    {

        self::checkNonce("tournament_form_nonce");


        $args = [
            'name'          => $_POST['name'],
            'name2'         => $_POST['name2'],
            'player1email'  => $_POST['player1email'],
            'template'      => 'tournament', // contact-template.php
            'required'  => ['name', 'player1email',],
        ];

        $messages = [
            'error'     => esc_html__("Please fill in the required fields.", ARINA_TEXT),
            'success'   => esc_html__("Mesajınız başarılı bir şekilde gönderildi.", ARINA_TEXT),
        ];

        //self::phpMailer($args, $messages);

        $userEmailArgs = $args;
        $userEmailArgs['player1email'] = $_POST['player1email'];
        $userEmailArgs['template'] = 'application';
        $userEmailMessages = [
            'error'   => esc_html__("E-posta gönderilemedi.", ARINA_TEXT),
            'success' => esc_html__("Başvurunuz alındı.", ARINA_TEXT),
        ];

    self::phpMailer($userEmailArgs, $userEmailMessages);

    if (!empty($_POST['email2'])) {
        $userEmail2Args = $args;
        $userEmail2Args['email'] = $_POST['email2'];
        $userEmail2Args['template'] = 'application';
        self::phpMailer($userEmail2Args, $userEmailMessages);
    }

        //user subject mail
        $userEmailSubject = 'Your Application Received - LIDOMA' . date_i18n('d/m/Y H:i', current_time('timestamp'));
        self::phpMailer($userEmailArgs, $userEmailMessages, $userEmailSubject);
        if (!empty($_POST['email2'])) {
            $userEmail2Subject = 'Your Application Received - LIDOMA' . date_i18n('d/m/Y H:i', current_time('timestamp'));
            self::phpMailer($userEmail2Args, $userEmailMessages, $userEmail2Subject);
        }


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

    public function arab_tournament()
    {
        self::checkNonce("arab_form_nonce");

        $emails = [
            $_POST['player1email'],
            $_POST['player2email'],
            $_POST['player3email'],
            $_POST['player4email'],
            $_POST['player5email'],
            $_POST['substitute1_email'],
            $_POST['substitute2_email'],
        ];

        $args = [
            'emails'        => $emails,
            'template'      => 'application',
        ];

        $messages = [
            'error'     => esc_html__("Please fill in the required fields.", ARINA_TEXT),
            'success'   => esc_html__("Your tournament application has been successfully received.", ARINA_TEXT),
        ];

        self::phpMailer($args, $messages);

        die;
    }
}
