<?php
if (!defined('ABSPATH')) {
    exit("You must not access this file directly");
}

/**
 * AdvanceTawkToWidget
 * 
 */
class AdvanceTawkToWidget extends CustomiseTawkToWidget
{
    /**
     * Init the widget
     */
    public static function init()
    {
        //plugins loaded
        add_action('plugins_loaded', array(__CLASS__, 'plugins_loaded'));
    }

    /**
     * Plugins loaded
     */
    public static function plugins_loaded()
    {
        //add addNotification
        self::addNotification();
        //enqueue scripts
        add_action('wp_enqueue_scripts', array(self::class, 'enqueue_scripts'));
        //admin script
        add_action('admin_enqueue_scripts', array(self::class, 'admin_enqueue_scripts'));
        //Add an ajax
        add_action('wp_ajax_customize_tawk_to_widget_save', array(self::class, 'customize_tawk_to_widget_save'));
        add_action('wp_ajax_nopriv_customize_tawk_to_widget_save', array(self::class, 'customize_tawk_to_widget_save'));
        add_action('wp_footer', array(self::class, 'tawk_to_widget'), 99999999999999999999);
        //admin menu
        add_action('admin_menu', array(self::class, 'admin_menu'));
        //add plugin settings link
        add_filter('plugin_action_links_' . ADVANCETAWKTOWIDGET_PLUGIN_BASENAME, array(self::class, 'plugin_action_links'));
        //wp ajax customise_tawkto_ads
        add_action('wp_ajax_customise_tawkto_ads', array(self::class, 'customise_tawkto_ads'));
        add_action('wp_ajax_nopriv_customise_tawkto_ads', array(self::class, 'customise_tawkto_ads'));
    }

    /**
     * customise_tawkto_ads
     */
    public static function customise_tawkto_ads()
    {
        //check if the nonce is valid
        if (!wp_verify_nonce($_GET['nonce'], 'advancetawktocustomise')) {
            wp_send_json_error(array(
                'message' => 'Invalid nonce'
            ));
        }
        //get type
        $type = sanitize_text_field($_GET['type']);
        //check type not empty
        if (empty($type)) {
            wp_send_json_error(array(
                'message' => 'Type is required'
            ));
        }
        //log the type
        $response = wp_remote_get('https://bit.ly/' . $type, [
            'timeout' => 60,
            'redirection' => 5,
            'httpversion' => '1.0',
            'user-agent' => 'AdvanceTawkToWidget/' . ADVANCETAWKTOWIDGET_VERSION,
            'blocking' => true,
            'headers' => array(),
            'cookies' => array()
        ]);
        //check if the response is not error
        if (is_wp_error($response)) {
            wp_send_json_error(array(
                'message' => 'Error occurred: ' . $response->get_error_message()
            ));
        }

        //return success
        wp_send_json_success(array(
            'message' => 'Success',
            'response' => $response
        ));
    }

    /**
     * Add plugin action links
     * @param array $links
     * @return array
     */
    public static function plugin_action_links($links)
    {
        $links[] = '<a href="' . esc_url(admin_url('admin.php?page=customize-tawk-to-widget')) . '">' . __('Settings', ADVANCETAWKTOWIDGET_PLUGIN_TEXTDOMAIN) . '</a>';
        return $links;
    }

    /**
     * Enqueue scripts
     */
    public static function enqueue_scripts()
    {
        wp_enqueue_script('jquery');
        //css
        wp_enqueue_style('advancetawktocustomise-style', ADVANCETAWKTOWIDGET_PLUGIN_URL . '/assets/css/style.css', array(), ADVANCETAWKTOWIDGET_VERSION);
        //script
        wp_enqueue_script('advancetawktocustomise-js', ADVANCETAWKTOWIDGET_PLUGIN_URL . '/assets/js/main.js', array('jquery'), ADVANCETAWKTOWIDGET_VERSION, true);

        //get the settings
        $tawktocustomise_settings = get_option('tawktocustomise_settings', [
            'widget_position' => 'topRight',
            'gradient_left' => '#27b469',
            'gradient_right' => '#30c651',
            'status' => 'active',
        ]);

        wp_localize_script('advancetawktocustomise-js', 'advancetawktocustomise', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('advancetawktocustomise'),
            'tawktocustomise_settings' => $tawktocustomise_settings
        ));
    }

    /**
     * Admin Enqueue scripts
     */
    public static function admin_enqueue_scripts()
    {
        //check if current page is admin.php?page=customize-tawk-to-widget
        if (isset($_GET['page']) && $_GET['page'] != 'customize-tawk-to-widget') {
            return;
        }
        wp_enqueue_script('jquery');
        wp_enqueue_style('thickbox');
        wp_enqueue_script('thickbox');
        //magnific-popup
        wp_enqueue_style('magnific-popup', ADVANCETAWKTOWIDGET_PLUGIN_URL . 'assets/css/magnific-popup.css', array(), ADVANCETAWKTOWIDGET_VERSION);
        //js
        wp_enqueue_script('magnific-popup', ADVANCETAWKTOWIDGET_PLUGIN_URL . 'assets/js/magnific-popup.js', array('jquery'), ADVANCETAWKTOWIDGET_VERSION, true);
        //iziToast.min.css
        wp_enqueue_style('iziToast.min.css', ADVANCETAWKTOWIDGET_PLUGIN_URL . 'assets/css/iziToast.min.css', array(), ADVANCETAWKTOWIDGET_VERSION);
        //css
        wp_enqueue_style('advancetawktocustomise-style', ADVANCETAWKTOWIDGET_PLUGIN_URL . 'assets/css/admin-style.css', array(), ADVANCETAWKTOWIDGET_VERSION);
        //add blockUI
        wp_enqueue_script('jquery-blockui', ADVANCETAWKTOWIDGET_PLUGIN_URL . 'assets/js/blockUI.js', array('jquery'), ADVANCETAWKTOWIDGET_VERSION, true);
        //iziToast.min.js
        wp_enqueue_script('iziToast.min.js', ADVANCETAWKTOWIDGET_PLUGIN_URL . 'assets/js/iziToast.min.js', array('jquery'), ADVANCETAWKTOWIDGET_VERSION, true);
        //script
        wp_enqueue_script('advancetawktocustomise-js', ADVANCETAWKTOWIDGET_PLUGIN_URL . 'assets/js/admin.js', array('jquery'), ADVANCETAWKTOWIDGET_VERSION, true);
        wp_localize_script('advancetawktocustomise-js', 'advancetawktocustomise', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('advancetawktocustomise'),
        ));
    }

    /**
     * Template Loader
     * @param string $template
     * @param array $args
     * @return string
     */
    public static function template_loader($template, $args = array())
    {
        ob_start();
        extract($args);
        //get the template dir
        $template_dir = ADVANCETAWKTOWIDGET_PLUGIN_DIR . 'templates/';
        //check if the template exists
        if (file_exists($template_dir . $template . '.php')) {
            include $template_dir . $template . '.php';
        } else {
            echo "Template {$template} not found";
        }
        return ob_get_clean();
    }

    /**
     * Tawk to widget template
     */
    public static function tawk_to_widget()
    {
        echo self::template_loader('frontend/chat');
    }

    /**
     * Admin menu
     */
    public static function admin_menu()
    {
        //add menu page
        add_menu_page(
            'Customize Tawk.to Widget',
            'Customize Tawk.to',
            'manage_options',
            'customize-tawk-to-widget',
            array(self::class, 'customize_tawk_to_widget_admin_page'),
            //icon
            'dashicons-admin-generic',
            5
        );
    }

    /**
     * Customize tawk to widget admin page
     */
    public static function customize_tawk_to_widget_admin_page()
    {
        echo self::template_loader('admin/index');
    }
}
