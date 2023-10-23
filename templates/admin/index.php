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

?>
<div class="customise-tawk-to-widget-container">
    <div class="customise-tawk-to-widget-container--header">
        <h3>Customise Tawk.to Widget</h3>
    </div>
    <div class="customise-tawk-to-widget-container--body">
        <div class="customise-tawk-to-main-body">
            <div>
                <h4>Site Widget Status</h4>
                <div class="customise-tawk-to-widget-container--body--site-widget-status customise-tawk-to-widget-card ">
                    <div class="customise-toggler">
                        <input type="checkbox" id="customise-tawk-to-widget-switch" class="customise-toggler" <?php echo $tawktocustomise_settings['status'] == 'active' ? 'checked' : '' ?> /><label for="customise-tawk-to-widget-switch">Toggle</label>
                    </div>
                    <span>
                        <?php echo $tawktocustomise_settings['status'] == 'active' ? 'Active' : 'Inactive' ?>
                    </span>
                </div>
            </div>
            <div class="cmt-3">
                <h4>Widget Position</h4>
                <div class="customise-tawk-to-widget-container--body--site-widget-position customise-tawk-to-widget-card">
                    <div class="customise-tawk-to-label">
                        <label for="widget_position">Widget Position</label>
                        <select name="widget_position" id="widget_position">
                            <option value="topRight" <?php echo selected($tawktocustomise_settings['widget_position'], 'topRight'); ?>>Top Right</option>
                            <option value="topLeft" <?php echo selected($tawktocustomise_settings['widget_position'], 'topLeft'); ?>>Top Left</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="cmt-3">
                <h4>Widget Appearance</h4>
                <div class="customise-tawk-to-widget-container--body--site-widget-appearance customise-tawk-to-widget-card">
                    <div class="customise-tawk-to-label">
                        <label for="gradient_left">Gradient Left</label>
                        <input type="color" name="gradient_left" id="gradient_left" value="<?php echo esc_attr($tawktocustomise_settings['gradient_left']) ?>">
                    </div>
                    <hr class="cmb-1 cmt-1">
                    <div class="customise-tawk-to-label">
                        <label for="gradient_right">Gradient Right</label>
                        <input type="color" name="gradient_right" id="gradient_right" value="<?php echo esc_attr($tawktocustomise_settings['gradient_right']) ?>">
                    </div>
                </div>
            </div>
            <div class="cmt-3">
                <button class="customise-tawk-to-widget-container--body--site-widget-save" type="button">Save</button>
            </div>
        </div>
        <div class="customise-ads-area">
            <div class="ads-1">
                <p>
                    ADS
                </p>
            </div>
        </div>
    </div>
</div>