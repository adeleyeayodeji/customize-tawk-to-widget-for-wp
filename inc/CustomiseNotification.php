<?php
if (!defined('ABSPATH')) {
    exit("You must not access this file directly");
}

class CustomiseTawkToWidget
{

    public static function addNotification()
    {
        $currenttime = date('Y-m-d H:i:s');
        if (!get_option('tawktocustomise_custom_time' . self::getUserIpAddr())) {
            add_option('tawktocustomise_custom_time' . self::getUserIpAddr(), "$currenttime", '', 'yes');
        }
    }

    // public static function updateNotification()
    // {
    //     header('Content-Type: application/json');

    //     $currenttime = date('Y-m-d H:i:s');
    //     //add 12 hours
    //     $newtime = date('Y-m-d H:i:s', strtotime($currenttime . ' +12 hours'));
    //     if (isset($_GET["customise_tawk_to_widget_notification"]) && get_option('tawktocustomise_custom_time' . self::getUserIpAddr())) {
    //         update_option('tawktocustomise_custom_time' . self::getUserIpAddr(), "$newtime", '', 'yes');
    //         echo wp_send_json(array('status' => 'success', 'date' => get_option('tawktocustomise_custom_time' . self::getUserIpAddr())));
    //         die;
    //     }
    //     echo wp_send_json(array('status' => 'error'));
    //     die;
    // }

    /**
     * Ajax Request
     */
    public static function customize_tawk_to_widget_save()
    {
        //get the nonce
        $nonce = isset($_POST['nonce']) ? sanitize_text_field($_POST['nonce']) : '';
        //verify the nonce
        if (!wp_verify_nonce($nonce, 'advancetawktocustomise')) {
            wp_send_json([
                'code' => 401,
                'message' => 'Unauthorized access, please try again',
            ]);
        }

        //get the data
        $widget_position = sanitize_text_field($_POST['widget_position']);
        $gradient_left = sanitize_text_field($_POST['gradient_left']);
        $gradient_right = sanitize_text_field($_POST['gradient_right']);
        $status = sanitize_text_field($_POST['switch']);

        //save settings
        $data = [
            'widget_position' => $widget_position,
            'gradient_left' => $gradient_left,
            'gradient_right' => $gradient_right,
            'status' => $status,
        ];

        //update the settings
        update_option('tawktocustomise_settings', $data);

        //send response
        wp_send_json([
            'code' => 200,
            'message' => 'Settings saved successfully',
        ]);
    }

    public static function displayNotification()
    {
        $notification_time = get_option('tawktocustomise_custom_time' . self::getUserIpAddr());
        //check if $notification_time is available
        if (!$notification_time) {
            return 0;
        }

        $currenttime = date('Y-m-d H:i:s');
        $now = new DateTime("$currenttime");
        $ref = new DateTime("$notification_time");
        $diff = $now->diff($ref);
        if ($diff->h <= 5) {
            return 0;
        } else {
            return 1;
        }
    }

    public static function getUserIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        //check if user is logged in
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            $ip = $current_user->user_email . '@' . $ip;
        } else {
            $ip = 'guest@' . $ip;
        }
        return $ip;
    }
}
