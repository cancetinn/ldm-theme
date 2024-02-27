<?php
/**
 * Arina Digital
 *
 **/

namespace ARINA_THEME\Inc;

use ARINA_THEME\Inc\Traits\Singleton;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly

class Core
{
    use Singleton;

    /**
     * Store htaccess_file, used to store path of htaccess file.
     *
     * @var string
     */
    public $htaccess_file;

    /**
     * Store unique_string, used to identify codes in htaccess file.
     *
     * @var string
     */
    public string $unique_string;

    /**
     * Store htaccess_cntn, used to store htaccess file content.
     *
     * @var string
     */
    public $htaccess_cntn;

    /**
     * Store valid, use to check true false.
     *
     * @var bool
     */
    public bool $valid;

    /**
     * Store pattern, used to remove plugin code from htaccess file.
     *
     * @var string
     */
    public string $pattern;

    /**
     * Store message, used to add admin notice etc.
     *
     * @var string
     */
    public string $message;

    /**
     * Store plugin action link.
     *
     * @var string
     */
    public string $custom_link;

    /**
     * This will add code, if not found. and also call deactivation_hook
     */
    public function __construct()
    {
        $this->htaccess_file = wp_normalize_path(ABSPATH . '.htaccess');

        // Go ahead, if file exist.
        if (file_exists($this->htaccess_file)) {

            // Go ahead, if file readable and writable.
            if (is_readable($this->htaccess_file) && is_writable($this->htaccess_file)) {

                // Check if code already present in htaccess.
                $this->unique_string = 'LBROWSERCSTART';
                $this->htaccess_cntn = file_get_contents($this->htaccess_file);
                $this->valid = false;

                if (str_contains($this->htaccess_cntn, $this->unique_string)) {
                    $this->valid = true;
                }

                if (!$this->valid) {
                    // Code does not have in htaccess file. let add them.
                    // Present code + plugin code.
                    $this->htaccess_cntn = $this->htaccess_cntn . $this->code_to_add();

                    file_put_contents($this->htaccess_file, $this->htaccess_cntn);
                    // Welcome.
                }
            } else {
                add_action('admin_notices', array($this, 'no_htaccess_access_notice'));
            }
        } else {
            add_action('admin_notices', array($this, 'no_htaccess_notice'));
        }

        // Theme deactivation remove_code
        $code = ABSPATH;
        $this->wp_register_theme_deactivation_hook($code, array($this, 'remove_code'));
    }

    /**
     * Theme deactivation removed all code
     */
    public function wp_register_theme_deactivation_hook($code, $function) {
        $hook_name = "switch_theme";
        $option_name = "theme_is_activated_" . $code;

        $GLOBALS["wp_register_theme_deactivation_hook_function" . $code] = $function;

        $fn = function ($theme) use ($code) {
            call_user_func($GLOBALS["wp_register_theme_deactivation_hook_function" . $code]);
            delete_option("theme_is_activated_" . $code);
        };

        add_action($hook_name, $fn);
    }

    /**
     * This will remove code from htaccess, if found.
     */
    public function remove_code()
    {

        $this->htaccess_file = wp_normalize_path(ABSPATH . '.htaccess');

        // Go ahead, if file exist.
        if (file_exists($this->htaccess_file)) {

            // Go ahead, if file readable and writable.
            if (is_readable($this->htaccess_file) && is_writable($this->htaccess_file)) {

                // Check if code already present.
                $this->unique_string = 'LBROWSERCSTART';
                $this->htaccess_cntn = file_get_contents($this->htaccess_file);
                $this->valid = false;

                if (strpos($this->htaccess_cntn, $this->unique_string) !== false) {
                    $this->valid = true;
                }

                if ($this->valid) {
                    // Code found, remove them.
                    $this->pattern = '/#\s?LBROWSERCSTART.*?LBROWSERCEND/s';
                    $this->htaccess_cntn = preg_replace($this->pattern, '', $this->htaccess_cntn);
                    $this->htaccess_cntn = preg_replace("/\n+/", "\n", $this->htaccess_cntn);

                    file_put_contents($this->htaccess_file, $this->htaccess_cntn);
                    // Bye Bye.
                }
            } else {
                // Note: no_htaccess_access_notice.
                self::no_htaccess_access_notice();
            }
        } else {
            // Note: no_htaccess_notice.
            self::no_htaccess_notice();
        }
    }

    /**
     * Codes to be add.
     */
    public function code_to_add()
    {
        $this->htaccess_cntn = "\n";
        $this->htaccess_cntn .= '# LBROWSERCSTART secure' . "\n";
        $this->htaccess_cntn .= '<IfModule mod_expires.c>' . "\n";
        $this->htaccess_cntn .= 'ExpiresActive On' . "\n";
        $this->htaccess_cntn .= 'ExpiresByType image/jpg "access plus 1 year"' . "\n";
        $this->htaccess_cntn .= 'ExpiresByType image/jpeg "access plus 1 year"' . "\n";
        $this->htaccess_cntn .= 'ExpiresByType image/gif "access plus 1 year"' . "\n";
        $this->htaccess_cntn .= 'ExpiresByType image/png "access plus 1 year"' . "\n";
        $this->htaccess_cntn .= 'ExpiresByType image/webp "access plus 1 year"' . "\n";
        $this->htaccess_cntn .= 'ExpiresByType image/x-icon "access plus 1 year"' . "\n";
        $this->htaccess_cntn .= 'ExpiresByType application/vnd.ms-fontobject "access plus 1 year"' . "\n";
        $this->htaccess_cntn .= 'ExpiresByType application/x-font-ttf "access plus 1 year"' . "\n";
        $this->htaccess_cntn .= 'ExpiresByType application/x-font-opentype "access plus 1 year"' . "\n";
        $this->htaccess_cntn .= 'ExpiresByType application/x-font-woff "access plus 1 year"' . "\n";
        $this->htaccess_cntn .= 'ExpiresByType application/x-font-woff2 "access plus 1 year"' . "\n";
        $this->htaccess_cntn .= 'ExpiresByType image/svg+xml "access plus 1 year"' . "\n";
        $this->htaccess_cntn .= 'AddType application/vnd.ms-fontobject .eot' . "\n";
        $this->htaccess_cntn .= 'AddType application/x-font-ttf .ttf' . "\n";
        $this->htaccess_cntn .= 'AddType application/x-font-opentype .otf' . "\n";
        $this->htaccess_cntn .= 'AddType application/x-font-woff .woff' . "\n";
        $this->htaccess_cntn .= 'AddType application/x-font-woff2 .woff2' . "\n";
        $this->htaccess_cntn .= 'AddType image/svg+xml .svg' . "\n";
        $this->htaccess_cntn .= '</IfModule>' . "\n";
        $this->htaccess_cntn .= '<Files xmlrpc.php>'. "\n";
        $this->htaccess_cntn .= 'order deny,allow'. "\n";
        $this->htaccess_cntn .= 'deny from all'. "\n";
        $this->htaccess_cntn .= 'allow from 123.123.123.123'. "\n";
        $this->htaccess_cntn .= '</Files>'. "\n";
        $this->htaccess_cntn .= '<IfModule mod_rewrite.c>' . "\n";
        $this->htaccess_cntn .= 'RewriteEngine On' . "\n";
        $this->htaccess_cntn .= 'RewriteBase /' . "\n";
        $this->htaccess_cntn .= 'RewriteRule ^wp-admin/includes/ - [F,L]' . "\n";
        $this->htaccess_cntn .= 'RewriteRule !^wp-includes/ - [S=3]' . "\n";
        $this->htaccess_cntn .= 'RewriteRule ^wp-includes/[^/]+\.php$ - [F,L]' . "\n";
        $this->htaccess_cntn .= 'RewriteRule ^wp-includes/js/tinymce/langs/.+\.php - [F,L]' . "\n";
        $this->htaccess_cntn .= 'RewriteRule ^wp-includes/theme-compat/ - [F,L]' . "\n";
        $this->htaccess_cntn .= '</IfModule>' . "\n";
        $this->htaccess_cntn .= 'Options -Indexes' . "\n";
        $this->htaccess_cntn .= '<files wp-config.php>' . "\n";
        $this->htaccess_cntn .= 'order allow,deny' . "\n";
        $this->htaccess_cntn .= 'deny from all' . "\n";
        $this->htaccess_cntn .= '</files>' . "\n";
        $this->htaccess_cntn .= '<files .htaccess>' . "\n";
        $this->htaccess_cntn .= 'order allow,deny' . "\n";
        $this->htaccess_cntn .= 'deny from all' . "\n";
        $this->htaccess_cntn .= '</files>' . "\n";
        $this->htaccess_cntn .= '<files wp-load.php>' . "\n";
        $this->htaccess_cntn .= 'order allow,deny' . "\n";
        $this->htaccess_cntn .= 'deny from all' . "\n";
        $this->htaccess_cntn .= '</files>' . "\n";
        $this->htaccess_cntn .= '# END secure LBROWSERCEND';

        return $this->htaccess_cntn;
    }

    /**
     * If htaccess is not exists.
     */
    public function no_htaccess_notice()
    {
        $this->message = '<div class="error"><p>';
        $this->message .= __('Tema Önbellek modülü: .htaccess dosyası bulunamadı. Bu modül yalnızca Apache sunucusu için çalışır. Apace sunucusu kullanıyorsanız, lütfen oluşturun.', ARINA_TEXT);
        $this->message .= '</p></div>';
        echo wp_kses_post($this->message);
    }

    /**
     * If htaccess is not access able.
     */
    public function no_htaccess_access_notice()
    {
        $this->message = '<div class="error"><p>';
        $this->message .= __('Tema Önbellek modülü: .htaccess dosyası okunamaz veya yazılamaz. Lütfen .htaccess dosyasının iznini değiştirin.', ARINA_TEXT);
        $this->message .= '</p></div>';
        echo wp_kses_post($this->message);
    }

}
