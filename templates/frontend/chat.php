 <?php
    if (!defined('ABSPATH')) {
        exit("You must not access this file directly");
    }

    //get the settings
    $tawktocustomise_settings = get_option('tawktocustomise_settings', [
        'widget_position' => 'topRight',
        'gradient_left' => '#27b469',
        'gradient_right' => '#30c651',
        'status' => 'active',
    ]);

    //check if $tawktocustomise_settings status
    if ($tawktocustomise_settings['status'] != 'active') {
        return;
    }
    ?>
 <style>
     .advancetawktocustomise {
         <?php
            if ($tawktocustomise_settings['widget_position'] == 'topRight') {
            ?>right: -31px !important;
         <?php
            } else { ?>left: -31px !important;
         <?php
            };
            ?>
     }

     .advancetawktocustomise-new-design {
         <?php
            if ($tawktocustomise_settings['widget_position'] == 'topRight') {
            ?>border-top-right-radius: 10px !important;
         border-top-left-radius: 10px !important;
         <?php
            } else { ?>border-bottom-right-radius: 10px !important;
         border-bottom-left-radius: 10px !important;
         <?php
            };
            ?>background: linear-gradient(45deg, <?php echo esc_attr($tawktocustomise_settings['gradient_left']); ?>, <?php echo esc_attr($tawktocustomise_settings['gradient_right']); ?>) !important;
     }
 </style>
 <div class="advancetawktocustomise">
     <div class="advancetawktocustomise-new-design">
         <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
             <path d="M64 0C28.7 0 0 28.7 0 64V352c0 35.3 28.7 64 64 64h96v80c0 6.1 3.4 11.6 8.8 14.3s11.9 2.1 16.8-1.5L309.3 416H448c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H64z" />
         </svg>
         <span>
             CHAT
         </span>
     </div>
 </div>