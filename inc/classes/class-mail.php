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

    function __construct() {
        add_action('wp_ajax_nopriv_contact_form', [$this, 'contact_form']);
        add_action('wp_ajax_contact_form', [$this, 'contact_form']);
    }

    public function contact_form() {
        // check security
        check_ajax_referer('secure_nonce', 'security');

        // format tr timezone
        date_default_timezone_set('Europe/Istanbul');
        $date = date("d/m/Y H:i");

        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->isHTML(true);

        //$mail->SMTPDebug = 2;
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->CharSet = 'UTF-8';
        $mail->Username = 'arina.develop@gmail.com';
        $mail->Password = 'dkqnxcqpfdfiotfb';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('arina.develop@gmail.com', 'Arina Dev');
        $mail->addAddress('akif.aykan@arinadigital.com', 'Arina Dev');


        $template_name = 'mail';
        $templateMail = [
            'name'          => $_POST['name'],
            'phone'         => $_POST['phone'],
            'email'         => $_POST['email'],
            'cttitle'       => $_POST['cttitle'],
            'ctpermalink'   => $_POST['ctpermalink'],
        ];

        $mail->Subject = 'Form Dolduruldu ' . $date;
        $mail->MsgHTML( self::mail_template($template_name, $templateMail) );

        if(!$mail->send()) :
            echo '<div class="contact_message error_message">'.esc_html__('Bir hata oluştu.', ARINA_TEXT).'</div>';
            echo $mail->ErrorInfo;
        else :
            echo '<div class="contact_message success_message">'.esc_html__('Mesajınız başarılı bir şekilde gönderildi.', ARINA_TEXT).'</div>';
        endif;

        die;
    }

    public function mail_template($template, $args){
        ob_start();
        get_template_part("templates/$template", "template", $args);
        $templateContent = ob_get_clean();

        return $templateContent;
    }
}
