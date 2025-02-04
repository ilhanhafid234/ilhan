<?php
/**
 * Help Panel.
 *
 * @package wedding_event_management
 */
?>

<div id="help-panel" class="panel-left visible">
    <div id="#help-panel" class="steps">  
        <h4 class="c">
            <?php esc_html_e( 'Quick Setup for Home Page', 'wedding-event-management' ); ?>
            <a href="<?php echo esc_url( 'https://demo.asterthemes.com/docs/wedding-event-management-free/' ); ?>" class="button button-primary" style="margin-left: 5px; margin-right: 10px;" target="_blank"><?php esc_html_e( 'Free Documentation', 'wedding-event-management' ); ?></a>
        </h4>
        <hr class="quick-set">
        <p><?php esc_html_e( '1) Go to the dashboard. navigate to pages, add a new one, and label it "home" or whatever else you like.The page has now been created.', 'wedding-event-management' ); ?></p>
        <p><?php esc_html_e( '2) Go back to the dashboard and then select Settings.', 'wedding-event-management' ); ?></p>
        <p><?php esc_html_e( '3) Then Go to readings in the setting.', 'wedding-event-management' ); ?></p>
        <p><?php esc_html_e( '4) There are 2 options your latest post or static page.', 'wedding-event-management' ); ?></p>
        <p><?php esc_html_e( '5) Select static page and select from the dropdown you wish to use as your home page, save changes.', 'wedding-event-management' ); ?></p>
        <p><?php esc_html_e( '6) You can set the home page in this manner.', 'wedding-event-management' ); ?></p>
        <hr>
        <h4><?php esc_html_e( 'Setup Banner Section', 'wedding-event-management' ); ?></h4>
        <hr class="quick-set">
        <p><?php esc_html_e( '1) Go to dashboard > Go to appereance > then Go to customizer.', 'wedding-event-management' ); ?></p>
        <p><?php esc_html_e( '2) In Customizer > Go to Front Page Options > Go to Banner Section.', 'wedding-event-management' ); ?></p>
        <p><?php esc_html_e( '3) For Setup Banner Section you have to create post in dashbord first.', 'wedding-event-management' ); ?></p>
        <p><?php esc_html_e( '4) In Banner Section > Enable the Toggle button > and fill the following details.', 'wedding-event-management' ); ?></p>
        <p><?php esc_html_e( '5) In this way you can set Banner Section.', 'wedding-event-management' ); ?></p>
        <hr>
        <h4><?php esc_html_e( 'Setup Testimonial Section', 'wedding-event-management' ); ?></h4>
        <hr class="quick-set">
        <p><?php esc_html_e( '1) Go to dashboard > Go to Page/Post > then add new page or post.', 'wedding-event-management' ); ?></p>
        <p><?php esc_html_e( '3) In Customizer > Go to Front Page Options > Go to Testimonial Section.', 'wedding-event-management' ); ?></p>
        <p><?php esc_html_e( '4) In Testimonial Section > Enable the Toggle button > and select the category whick you want display.', 'wedding-event-management' ); ?></p>
        <p><?php esc_html_e( '5) In this way you can set Testimonial Section.', 'wedding-event-management' ); ?></p>
    </div>
    <hr>
    <div class="custom-setting">
        <h4><?php esc_html_e( 'Quick Customizer Settings', 'wedding-event-management' ); ?></h4>
        <span><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" target="_blank"><?php esc_html_e( 'Customize', 'wedding-event-management' ); ?></a></span>
    </div>
    <hr>
   <div class="setting-box">
        <div class="custom-links">
            <div class="icon-box">
                <span class="dashicons dashicons-admin-site-alt3"></span>
            </div>
            <h5><?php esc_html_e( 'Site Logo', 'wedding-event-management' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=custom_logo' ) ); ?>" target="_blank"><?php esc_html_e( 'Customize', 'wedding-event-management' ); ?></a>
        </div>
        <div class="custom-links">
            <div class="icon-box">
                <span class="dashicons dashicons-color-picker"></span>
            </div>
            <h5><?php esc_html_e( 'Color', 'wedding-event-management' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=primary_color' ) ); ?>" target="_blank"><?php esc_html_e( 'Customize', 'wedding-event-management' ); ?></a>
        </div>
        <div class="custom-links">
            <div class="icon-box">
                <span class="dashicons dashicons-screenoptions"></span>
            </div>
            <h5><?php esc_html_e( 'Theme Options', 'wedding-event-management' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=wedding_event_management_theme_options' ) ); ?>"target="_blank"><?php esc_html_e( 'Customize', 'wedding-event-management' ); ?></a>
        </div>
    </div>
    <div class="setting-box">
        <div class="custom-links">
            <div class="icon-box">
                <span class="dashicons dashicons-format-image"></span>
            </div>
            <h5><?php esc_html_e( 'Header Image ', 'wedding-event-management' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=header_image' ) ); ?>" target="_blank"><?php esc_html_e( 'Customize', 'wedding-event-management' ); ?></a>
        </div>
        <div class="custom-links">
            <div class="icon-box">
                <span class="dashicons dashicons-align-full-width"></span>
            </div>
            <h5><?php esc_html_e( 'Footer Options ', 'wedding-event-management' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=wedding_event_management_footer_copyright_text' ) ); ?>" target="_blank"><?php esc_html_e( 'Customize', 'wedding-event-management' ); ?></a>
        </div>
        <div class="custom-links">
            <div class="icon-box">
                <span class="dashicons dashicons-admin-page"></span>
            </div>
            <h5><?php esc_html_e( 'Front Page Options', 'wedding-event-management' ); ?></h5>
            <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=wedding_event_management_front_page_options' ) ); ?>" target="_blank"><?php esc_html_e( 'Customize', 'wedding-event-management' ); ?></a>
        </div>
    </div>
</div>