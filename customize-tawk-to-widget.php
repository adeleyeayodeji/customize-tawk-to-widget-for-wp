<?php

/**
 * Plugin Name: Customize Tawk.to Widget
 * Plugin URI: https://wordpress.org/plugins/customize-tawk-to-widget
 * Author: Adeleye Ayodeji
 * Author URI: https://adeleyeayodeji.com
 * Description: This plugin allows you to customize the Tawk.to widget.
 * Version: 1.3.3
 * License: 1.3.3
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: customize-tawk-to-widget
 */

if (!defined('ABSPATH')) {
    exit("You must not access this file directly");
}

//define constants
define('ADVANCETAWKTOWIDGET_VERSION', time());
define('ADVANCETAWKTOWIDGET_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ADVANCETAWKTOWIDGET_PLUGIN_URL', plugin_dir_url(__FILE__));
define('ADVANCETAWKTOWIDGET_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('ADVANCETAWKTOWIDGET_PLUGIN_TEXTDOMAIN', 'customize-tawk-to-widget');


require_once ADVANCETAWKTOWIDGET_PLUGIN_DIR . 'inc/CustomiseNotification.php';
require_once ADVANCETAWKTOWIDGET_PLUGIN_DIR . 'inc/main.php';

function customise_tawkto_widget_notice()
{
?>
    <div class="error">
        <p>Customize Tawk.to Widget is enabled but not effective. It requires
            <?php
            echo sprintf(
                '<a class="install-now button" data-slug="%s" href="%s" aria-label="%s" data-name="%s">%s </a>',
                esc_attr("tawk-to-live-chat"),
                esc_url(wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=tawk-to-live-chat'), 'install-plugin_woocommerce')),
                esc_attr(sprintf(_x('Install %s now', 'plugin'), "Tawk.to Live Chat")),
                esc_attr("Tawk.to Live Chat"),
                __('Tawk.to Live Chat')
            );
            ?>
            in order to work.
        </p>
    </div>
<?php
}


$pluginList = get_option('active_plugins');
$plugin = 'tawkto-live-chat/tawkto.php';
if (!in_array($plugin, $pluginList)) {
    add_action('admin_notices', 'customise_tawkto_widget_notice');
} else {
    //initialize the class
    AdvanceTawkToWidget::init();
}

//A very simple solution for WordPress Community