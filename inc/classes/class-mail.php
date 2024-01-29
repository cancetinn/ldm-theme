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

    public function phpMailer($args, $messages)
    {
		self::validateFields( $args['required'] );

        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->isHTML(true);
        //$mail->SMTPDebug = 2;

        $mail->Host = MAIL_HOST;
        $mail->Port = MAIL_PORT;
        $mail->SMTPSecure = MAIL_SECURE;
        $mail->SMTPAuth = true;
        $mail->CharSet = 'UTF-8';
        $mail->Username = MAIL_USERNAME;
        $mail->Password = MAIL_PASSWORD;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->setFrom(MAIL_USERNAME, MAIL_TEXT);
        $mail->addAddress('akif.aykan@arinadigital.com', MAIL_TEXT);

	    // Format date/time
	    $date = date_i18n('d/m/Y H:i', current_time('timestamp'));
	    $mail->Subject = 'Form Dolduruldu ' . $date;

        $mail->MsgHTML( self::mailTemplate($args) );

        if(!$mail->send()) :
	        self::sendJsonFormat("error", $messages['error']);
        else :
	        self::sendJsonFormat("success", $messages['success']);
        endif;
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
				self::sendJsonFormat("error", esc_html__("Lütfen gerekli alanları doldurun!", ARINA_TEXT));
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
}
