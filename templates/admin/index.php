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
            <h2 class="customise-ads-header-title">OTHER AMAZING PLUGINS</h2>
            <div class="customise-ads customise-ads-1">
                <img src="https://ps.w.org/codedeyo-google-trends-for-bloggers/assets/banner-772x250.png?rev=2928244" alt="Google Trends for WP" class="customise-ads-image">
                <div class="customise-ads-actions">
                    <h3>Google Trends for WP</h3>
                    <div class="customise-ads-sub-action">
                        <a href="javascript:;" class="button-primary customise-ads-demo-video" data-video="https://www.youtube.com/embed/yJYo8ifhyyE?si=iZ2aI5LdCFpFJJYt">
                            Demo
                        </a>
                        <a href="javascript:;" class="button customise-ads-learn-more" data-plugin-slug="codedeyo-google-trends-for-bloggers">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal dialog -->
    <div class="modal">
        <div class="modal-content">
            <p class="close-action">
                <span class="close-button">×</span>
            </p>
            <iframe width="560" height="315" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
    </div>
</div>