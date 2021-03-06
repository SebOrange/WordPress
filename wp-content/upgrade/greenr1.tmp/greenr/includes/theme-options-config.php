<?php
/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
 * */

if (!class_exists("Redux_Framework_sample_config")) {

    class Redux_Framework_sample_config {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {
            // This is needed. Bah WordPress bugs.  ;)
            if ( strpos( Redux_Helpers::cleanFilePath( __FILE__ ), Redux_Helpers::cleanFilePath( get_template_directory() ) ) !== false) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);    
            }
        }

        public function initSettings() {

            if ( !class_exists("ReduxFramework" ) ) {
                return;
            }       
            
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/plugin/hooks', array( $this, 'remove_demo' ) );
            // Function to test the compiler hook and demo CSS output.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2); 
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            // Dynamically add a section. Can be also used to modify sections/fields
            add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css) {
            //echo "<h1>The compiler hook has run!";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
              require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
              $wp_filesystem->put_contents(
              $filename,
              $css,
              FS_CHMOD_FILE // predefined mode settings for WP files
              );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'redux-framework-demo'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
                'icon' => 'fa fa fa-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = "Testing filter hook!";

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::get_instance(), 'plugin_meta_demo_mode_link'), null, 2);
            }

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action('admin_notices', array(ReduxFrameworkPlugin::get_instance(), 'admin_notices'));
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode(".", $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[] = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct = wp_get_theme();
            $this->theme = $ct;
            $item_name = $this->theme->get('Name');
            $tags = $this->theme->Tags;
            $screenshot = $this->theme->get_screenshot();
            $class = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'redux-framework-demo'), $this->theme->display('Name'));
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
            <?php endif; ?>

                <h4>
            <?php echo $this->theme->display('Name'); ?>
                </h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'redux-framework-demo'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'redux-framework-demo'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'redux-framework-demo') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
                <?php
                if ($this->theme->parent()) {
                    printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'redux-framework-demo'), $this->theme->parent()->display('Name'));
                }
                ?>

                </div>

            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $page_builder = __( 'Page Builder', 'greenr' );
            $page_builder_details = __( 'Boxy Pro supports Page Builder. All our shortcodes can be used as widgets too. You can drag and drop our widgets with page builder visual editor.', 'greenr' );
            $page_layout = __( 'Page Layout', 'greenr' );
            $page_layout_details = __( 'Boxy Pro offers many different page layouts so you can quickly and easily create your pages with various layout without any hassle!', 'greenr' );
            $unlimited_sidebar = __( 'Unlimited Sidebar', 'greenr' );
            $unlimited_sidebar_details = __( 'Unlimited sidebars allows you to create multiple sidebars. Check out our demo site to see how different pages displays different sidebars!', 'greenr' );
            $shortcode_builder = __( 'Shortcode Builder', 'greenr' );
            $shortcode_builder_details = __( 'With our shortcode builder and lots of shortcodes, you can easily create nested shortcodes and build custom pages!', 'greenr' );
            $portfolio = __( 'Multi Portfolio', 'greenr' );
            $portfolio_details = __( '7 portfolio layouts with Isotope filtering, 3 blog layouts and multiple other alternate layouts for interior pages!', 'greenr' );
            $typography = __( 'Typography', 'greenr' );
            $typography_details = __( 'Boxy Pro loves typography, you can choose from over 500+ Google Fonts and Standard Fonts to customize your site!', 'greenr' );
            $slider = __( 'Awesome Sliders', 'greenr' );
            $slider_details = __( 'Boxy Pro includes two types of slider. You can use both Flex and Elastic sliders anywhere in your site.', 'greenr' );
            $woocommerce = __( 'Woo Commerce', 'greenr' );
            $woocommerce_details = __( 'Boxy Pro has full design/code integration for WooCommerce, your shop will look as good as the rest of your site!', 'greenr' );
            $custom_widget = __( 'Custom Widget', 'greenr' );
            $custom_widget_details = __( 'We offer many custom widgets that are stylized and ready for use. Simply drag &amp; drop into place to activate!', 'greenr' );
            $advanced_admin = __( 'Advanced Admin', 'greenr' );
            $advanced_admin_details = __( 'Advanced Redux Framework for theme options panel, you can customize any part of your site quickly and easily!', 'greenr' );
            $font_awesome = __( 'Font Awesome', 'greenr' );
            $font_awesome_details = __( 'Font Awesome icons are fully integrated into the theme. Use them anywhere in your site in 6 different sizes!', 'greenr' );
            $responsive_layout = __( 'Responsive Layout', 'greenr' );
            $responsive_layout_details = __( 'Boxy Pro is fully responsive and can adapt to any screen size. Resize your browser window to view it!', 'greenr' );
            $testimonials = __( 'Testimonials', 'greenr' );
            $testimonials_details = __( 'With our testimonial post type, shortcode and widget, Displaying testimonials is a breeze.', 'greenr' );
            $social_media = __( 'Social Media', 'greenr' );
            $social_media_details = __( 'Want your users to stay in touch? No problem, Boxy Pro has Social Media icons all throughout the theme!', 'greenr' );
            $google_map = __( 'Google Map', 'greenr' );
            $google_map_details = __( 'Boxy Pro includes Goole Map as shortcode and widget. So, you can use it anywhere in your site!', 'greenr' );


            $featuresHTML = <<< FEATURES
            <div class="one-third column">
                <div class="icon-wrap"><i class="fa fa-cog"></i></div>
                <h3>$page_builder</h3>
                <p>$page_builder_details</p>
            </div>
            <div class="one-third column">
                <div class="icon-wrap"><i class="fa fa-th-large"></i></div>
                <h3>$page_layout</h3>
                <p>$page_layout_details</p>
            </div>
            <div class="one-third column">
                <div class="icon-wrap"><i class="fa fa-th"></i></div>
                <h3>$unlimited_sidebar</h3>
                <p>$unlimited_sidebar_details</p>
            </div>
            <div class="one-third column">
                <div class="icon-wrap"><i class="fa fa-code-fork"></i></div>
                <h3>$shortcode_builder</h3>
                <p>$shortcode_builder_details</p>
            </div>
            <div class="one-third column">
                <div class="icon-wrap"><i class="fa fa-camera"></i></div>
                <h3>$portfolio</h3>
                <p>$portfolio_details</p>
            </div>
            <div class="one-third column">
                <div class="icon-wrap"><i class="fa fa-font"></i></div>
                <h3>$typography</h3>
                <p>$typography_details</p>
            </div>
            <div class="one-third column">
                <div class="icon-wrap"><i class="fa fa-slideshare"></i></div>
                <h3>$slider</h3>
                <p>$slider_details</p>
            </div>
            <div class="one-third column">
                <div class="icon-wrap"><i class="fa fa-leaf"></i></div>
                <h3>$woocommerce</h3>
                <p>$woocommerce_details</p>
            </div>
            <div class="one-third column">
                <div class="icon-wrap"><i class="fa fa-tasks"></i></div>
                <h3>$custom_widget</h3>
                <p>$custom_widget_details</p>
            </div>
            <div class="one-third column">
                <div class="icon-wrap"><i class="fa fa-dashboard"></i></div>
                <h3>$advanced_admin</h3>
                <p>$advanced_admin_details</p>
            </div>
            <div class="one-third column">
                <div class="icon-wrap"><i class="fa fa-magic"></i></div>
                <h3>$font_awesome</h3>
                <p>$font_awesome_details</p>
            </div>
            <div class="one-third column">
                <div class="icon-wrap"><i class="fa fa-arrows"></i></div>
                <h3>$responsive_layout</h3>
                <p>$responsive_layout_details</p>
            </div>
            <div class="one-third column">
                <div class="icon-wrap"><i class="fa fa-magic"></i></div>
                <h3>$testimonials</h3>
                <p>$testimonials_details</p>
            </div>
            <div class="one-third column">
                <div class="icon-wrap"><i class="fa fa-twitter"></i></div>
                <h3>$social_media</h3>
                <p>$social_media_details</p>
            </div>
            <div class="one-third column">
                <div class="icon-wrap"><i class="fa fa-map-marker"></i></div>
                <h3>$google_map</h3>
                <p>$google_map_details</p>
            </div>
        </div>
FEATURES;

            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'title' => __('General Settings', 'greenr'),
                'desc' => __('General Settings of Theme to change look and feel through out the site', 'greenr'),
                'icon' => 'fa fa fa-cogs',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields' => array(  
                    array(
                        'id'=>'breadcrumb',
                        'type' => 'switch', 
                        'title' => __('Enable Breadcrumb Navigation', 'greenr'),
                        'subtitle'=> __('Check to display breadcrumb navigation.', 'greenr'),
                        'default' => 1,
                        'on' => 'Enable',
                        'off' => 'Disable',
                        ),      

                    array(
                        'id'=>'breadcrumb-char',
                        'type' => 'select',
                        'title' => __('Breadcrumb Character', 'greenr'),
                        'subtitle'=> __('Check to display breadcrumb navigation.', 'greenr'),
                        'options' => array( '1' => ' &raquo; ', '2' => ' / ', '3' => ' > ' ),
                        'default' => '1'
                        ),

                    array(
                        'id'        => 'upgrade-notice-1',
                        'type'      => 'info',
                        'notice'    => true,
                        'style'     => 'critical',
                        'icon'      => 'fa fa-info-circle',
                        'title'     => __('Greenr Pro Options. <a href="http://www.webulous.in/?add-to-cart=27">Upgrade Now</a> for just $39.', 'greenr'),
                        'desc'      => __('These options are available only in Greenr Pro version theme. Upgrade now for just $39.', 'greenr')
                    ),
                    array(
                        'id'=>'pagenavi',
                        'type' => 'switch', 
                        'title' => __('Enable Numeric Page Navigation', 'greenr'),
                        'subtitle'=> __('Check to display numeric page navigation, instead of Previous Posts / Next Posts links.', 'greenr'),
                        'default'       => 1,
                        'on' => 'Enable',
                        'off' => 'Disable',
                        ),      
                    array(
                        'id'=>'slicknav',
                        'type' => 'switch', 
                        'title' => __('Enable SlickNav', 'greenr'),
                        'subtitle'=> __('Check to display reponsive menu using SlickNav', 'greenr'),
                        'default'       => 1,
                        'on' => 'Enable',
                        'off' => 'Disable',
                        ), 
                    array(
                        'id'=>'layout',
                        'type' => 'image_select',
                        'compiler'=>true,
                        'title' => __('Main Layout', 'greenr' ), 
                        'subtitle' => __('Select main content and sidebar alignment.', 'greenr' ),
                        'options' => array(
                            '2' => array('alt' => 'Right Sidebar', 'img' => ReduxFramework::$_url.'assets/img/2cl.png'),
                            '3' => array('alt' => 'Left Sidebar', 'img' => ReduxFramework::$_url.'assets/img/2cr.png'),
						),
                        'default' => '3'
                        ),

                    array(
                        'id'=>'custom-js',
                        'type' => 'textarea',
                        'title' => __('Custom Javascript', 'greenr'), 
                        'subtitle' => __('Quickly add some Javascript to your theme by adding it to this block.', 'greenr'),
                        //'validate' => 'js',
                        'desc' => 'Validate that it\'s javascript!',
                        ),      
               array(
                        'id'=>'custom-css',
                        'type' => 'ace_editor',
                        'title' => __('Custom CSS', 'greenr'), 
                        'subtitle' => __('Quickly add some CSS to your theme by adding it to this block.', 'greenr'),
                        'mode' => 'css',
                  'theme' => 'monokai',
                        'desc' => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                        )
                )
            );


            $this->sections[] = array(
                'title' => __('Header', 'greenr'),
                'desc' => __('Theme options related to header section', 'greenr'),
                'icon' => 'fa fa-arrow-up',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields' => array(  

                    array(
                        'id'=>'site-title',
                        'type' => 'switch', 
                        'title' => __('Logo as site title', 'greenr'),
                        'subtitle'=> __('Enable to load custom logo as site title in header.', 'greenr'),
                        "default"       => 0,
                        'on' => 'Enable',
                        'off' => 'Disable',
                        ),

                    array(
                        'id'=>'custom-logo',
                        'type' => 'media', 
                        'url'=> true,
                        'title' => __('Custom Logo', 'greenr'),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'=> __('Upload logo to use as site title', 'greenr'),
                        'subtitle' => __('Upload any media using the WordPress native uploader', 'greenr'),
                        'default'=>array('url'=>'http://s.wordpress.org/style/images/codeispoetry.png'),
                        ),

                    array(
                        'id'=>'site-description',
                        'type' => 'switch', 
                        'title' => __('Site Description', 'greenr'),
                        'subtitle'=> __('Enable to show site description in header.', 'greenr'),
                        "default"       => 1,
                        'on' => 'Enable',
                        'off' => 'Disable',
                        ),

                    array(
                        'id'=>'contact',
                        'type' => 'text', 
                        'title' => __('Conact Us', 'greenr'),
                        'subtitle'=> __('Enter Contact Info Phone/Email.', 'greenr'),
                        'default' => __( 'Call Us: +01 234 567 890', 'greenr' ),
                        ),

                    array(
                        'id'        => 'upgrade-notice-2',
                        'type'      => 'info',
                        'notice'    => true,
                        'style'     => 'critical',
                        'icon'      => 'fa fa-info-circle',
                        'title'     => __('Greenr Pro Options. <a href="http://www.webulous.in/?add-to-cart=27">Upgrade Now</a> for just $39.', 'greenr'),
                        'desc'      => __('These options are available only in Greenr Pro version theme. Upgrade now for just $39.', 'greenr')
                    ),
                    array(
                        'id'=>'favicon',
                        'type' => 'media', 
                        'preview'=> false,
                        'title' => __('Custom Favicon (ICO)', 'greenr'),
                        'desc' => __('You can upload an ico image that will represent your website\'s favicon (16px X 16px)', 'greenr'),
                        ),

                    array(
                        'id'=>'ipad-icon-retina',
                        'type' => 'media', 
                        'preview'=> false,
                        'title' => __('Apple iPad Retina Icon Upload (144px X 144px)', 'greenr'),
                        'desc'=> __('For third-generation iPad with high-resolution Retina display', 'greenr'),
                        ),

                    array(
                        'id'=>'iphone-icon-retina',
                        'type' => 'media', 
                        'preview'=> false,
                        'title' => __('Apple iPhone Retina Icon Upload (114px X 114px)', 'greenr'),
                        'desc'=> __('For iPhone with high-resolution Retina display', 'greenr'),
                        ),

                    array(
                        'id'=>'ipad-icon',
                        'type' => 'media', 
                        'preview'=> false,
                        'title' => __('Apple iPad Icon Upload (72px X 72px)', 'greenr'),
                        'desc'=> __('For first- and second-generation iPad', 'greenr'),
                        ),

                    array(
                        'id'=>'iphone-icon',
                        'type' => 'media', 
                        'preview'=> false,
                        'title' => __('Apple iPhone Icon Upload (57px X 57px)', 'greenr'),
                        'desc'=> __('For non-Retina iPhone, iPod Touch, and Android 2.1+ devices', 'greenr'),
                        ),          

                    array(
                        'id'=>'google-analytics',
                        'type' => 'textarea',
                        'title' => __('Tracking Code', 'greenr'), 
                        'subtitle' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'greenr'),
                        //'validate' => 'js',
                        'desc' => 'Validate that it\'s javascript!',
                    ),

                    array(
                        'id'=>'analytics-place',
                        'type' => 'switch', 
                        'title' => __('Load Tracking Code in Footer', 'greenr'),
                        'subtitle'=> __('Check to load analytics in footer. Uncheck to load in header.', 'greenr'),
                        'default' => 0,
                        'on' => 'In Footer',
                        'off' => 'In Header',
                    ),

                )
            );


            $this->sections[] = array(
                'title' => __('Footer', 'greenr'),
                'desc' => __('Theme options related to footer area of theme', 'greenr'),
                'icon' => 'fa fa-arrow-down',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields' => array(  

                    array(
                        'id'=>'footer-widgets',
                        'type' => 'switch', 
                        'title' => __('Enable Footer Widget Area', 'greenr'),
                        'subtitle'=> __('Check to enable 4 Column Footer widget Area', 'greenr'),
                        "default"       => 0,
                        'on' => 'Enable',
                        'off' => 'Disable',
                        ),

                    array(
                        'id'        => 'upgrade-notice-3',
                        'type'      => 'info',
                        'notice'    => true,
                        'style'     => 'critical',
                        'icon'      => 'fa fa-info-circle',
                        'title'     => __('Greenr Pro Options. <a href="http://www.webulous.in/?add-to-cart=27">Upgrade Now</a> for just $39.', 'greenr'),
                        'desc'      => __('These options are available only in Greenr Pro version theme. Upgrade now for just $39.', 'greenr')
                    ),
                    array(
                        'id'=>'footer-text',
                        'type' => 'textarea',
                        'title' => __('Footer Copyright Text', 'greenr'), 
                        'subtitle' => __('Footer copyright text. HTML Allowed', 'greenr'),
                        'desc' => __('This field is even HTML validated!', 'greenr'),
                        'default' => __( 'Powered by <a href="http://wordpress.org/" target="_blank">WordPress</a>. Theme by <a href="http://www.webulous.in/">Webulous</a>.', 'greenr' ),
                        'validate' => 'html',
                        ),

                    array(
                        'id'=>'footer-menu',
                        'type' => 'select',
                        'data' => 'menus',
                        'title' => __('Select Menu', 'greenr'),
                        'subtitle'=> __('Select menu to display in footer.', 'greenr'),
                        ),

                    )
            );

            $this->sections[] = array(
                'title' => __('Home', 'greenr'),
                'desc' => __('Theme options related to home page', 'greenr'),
                'icon' => 'fa fa-home',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields' => array(
                    array(
                        'id'=>'slides',
                        'type' => 'slides',
                        'title' => __('Flex Slider Options', 'greenr' ),
                        'subtitle'=> __('Unlimited slides with drag and drop sortings.', 'greenr' )
                    ),


                    array(
                        'id'=>'info',
                        'type' => 'textarea',
                        'title' => __('Info', 'greenr' ), 
                        'validate' => 'html',
                        'default' => __('<div class="one-third column"><img src="' . get_template_directory_uri() . '/images/info.png' . '"></div><div class="two-thirds column"><h2>There are many variations of passages of Lorem Ipsum available</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using "Content here, content here", making it look like readable English.</p><div class="row"><div class="eight columns"><h2>Branding Design</h2><p>Duis blandit eget leo eu interdum. Mauris accumsan euismod aliquet. Phasellus quis mi vitae orci tempor tempus vel sit amet nulla. Fusce gravida ligula et felis ultricies, lobortis interdum est ultrices. Praesent commodo justo eget sapien ornare hendrerit. Cras consequat lobortis velit, et hendrerit sapien. Sed commodo vel sem a convallis.</p><a href="#">Keep Reading</a></div><div class="eight columns"><h2>Web Development</h2><p>Duis blandit eget leo eu interdum. Mauris accumsan euismod aliquet. Phasellus quis mi vitae orci tempor tempus vel sit amet nulla. Fusce gravida ligula et felis ultricies, lobortis interdum est ultrices. Praesent commodo justo eget sapien ornare hendrerit. Cras consequat lobortis velit, et hendrerit sapien. Sed commodo vel sem a convallis.</p><a href="#">Keep Reading</a></div></div></div>', 'greenr'),
                    ),  

                    array(
                        'id'=>'testimonial',
                        'type' => 'textarea',
                        'title' => __('Testimonial', 'greenr' ), 
                        'subtitle' => __('A list is best, like "Why Us?", "Features".', 'greenr' ),
                        'validate' => 'html',
                        'default' => __('<div class="container gap"><div class="testimonials"><ul class="slides"><li><div class="testimony"><img src="'. get_template_directory_uri() . '/images/client.png"><p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum blandit ex a erat aliquet.</p><p class="client"><strong>Lord Varys</strong>, Spy Master, Iron Throne</p></div></li></ul><br class="clear"/></div></div>', 'greenr'),
                    ),

                    array(
                    'id'=>'service-icon-1',
                    'type' => 'text',
                    'title' => __('1. Service Icon', 'greenr' ), 
                    'subtitle' => __('Enter Font Awesome Icon name. e.g. fa fa-bullhorn', 'greenr' ),
                    'default' => 'fa fa-bullhorn'
                    ),
                    array(
                        'id'=>'service-title-1',
                        'type' => 'text',
                        'title' => __('Service Title', 'greenr' ), 
                        'desc' => __('Enter title of this service', 'greenr' ),
                        'default' => __('Research', 'greenr'),
                    ),
                    array(
                        'id'=>'service-description-1',
                        'type' => 'textarea',
                        'title' => __('1. Service Description', 'greenr' ), 
                        'validate' => 'html',
                        'default' => __('<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.</p>', 'greenr'),
                    ),

                    array(
                        'id'=>'service-icon-2',
                        'type' => 'text',
                        'title' => __('2. Service Icon', 'greenr' ), 
                        'subtitle' => __('Enter Font Awesome Icon name. e.g. fa fa-bullhorn', 'greenr' ),
                        'default' => 'fa fa-cogs',
                    ),
                    array(
                        'id'=>'service-title-2',
                        'type' => 'text',
                        'title' => __('Service Title', 'greenr' ), 
                        'desc' => __('Enter title of this service', 'greenr' ),
                        'default' => __('Usability', 'greenr'),
                    ),
                    array(
                        'id'=>'service-description-2',
                        'type' => 'textarea',
                        'title' => __('2. Service Description', 'greenr' ), 
                        'validate' => 'html',
                        'default' => __('<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.</p>', 'greenr'),
                    ),

                    array(
                        'id'=>'service-icon-3',
                        'type' => 'text',
                        'title' => __('3. Service Icon', 'greenr' ), 
                        'subtitle' => __('Enter Font Awesome Icon name. e.g. fa fa-bullhorn', 'greenr' ),
                        'default' => 'fa fa-twitter',
                    ),
                    array(
                        'id'=>'service-title-3',
                        'type' => 'text',
                        'title' => __('Service Title', 'greenr' ), 
                        'desc' => __('Enter title of this service', 'greenr' ),
                        'default' => __('Design', 'greenr'),
                    ),
                    array(
                        'id'=>'service-description-3',
                        'type' => 'textarea',
                        'title' => __('3. Service Description', 'greenr' ), 
                        'validate' => 'html',
                        'default' => __('<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.</p>', 'greenr'),
                    ),

                    array(
                        'id'=>'service-icon-4',
                        'type' => 'text',
                        'title' => __('4. Service Icon', 'greenr' ), 
                        'subtitle' => __('Enter Font Awesome Icon name. e.g. fa fa-bullhorn', 'greenr' ),
                        'default' => 'fa fa-group',
                    ),
                    array(
                        'id'=>'service-title-4',
                        'type' => 'text',
                        'title' => __('Service Title', 'greenr' ), 
                        'desc' => __('Enter title of this service', 'greenr' ),
                        'default' => __('Design', 'greenr'),
                    ),
                    array(
                        'id'=>'service-description-4',
                        'type' => 'textarea',
                        'title' => __('4. Service Description', 'greenr' ), 
                        'default' => __('<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.</p>', 'greenr'),
                        'validate' => 'html',
                    ),

                    array(
                        'id'=>'cta',
                        'type' => 'textarea',
                        'title' => __('Additional Info', 'greenr' ), 
                        'validate' => 'html',
                        'default' => __('<div class="callout-widget"><div class="call-content"><p>Vestibulum dapibus, elis id lacinia efficitur, ex mi iaculis ipsum, ac posuere dui tellus a odio. </p></div><div class="callout-btn"><a href="http://www.webulous.in/?add-to-cart=27">Purchase Now</a></div><br class="clear"></div>', 'greenr'),
                    ), 

                    array(
                        'id'        => 'upgrade-notice-4',
                        'type'      => 'info',
                        'notice'    => true,
                        'style'     => 'critical',
                        'icon'      => 'fa fa-info-circle',
                        'title'     => __('Greenr Pro Options. <a href="http://www.webulous.in/?add-to-cart=27">Upgrade Now</a> for just $39.', 'greenr'),
                        'desc'      => __('These options are available only in Greenr Pro version theme. Upgrade now for just $39.', 'greenr')
                    ),
                    array(
                        "id" => "homepage_blocks",
                        "type" => "sorter",
                        "title" => "Homepage Layout Manager",
                        "desc" => "Organize how you want the layout to appear on the homepage",
                        "compiler"=>'true',
                        'options' => array(
                            "enabled" => array(
                                "placebo" => "placebo", //REQUIRED!
                                "slider" => "Slider",
                                "services" => "Services",
                                "team" => "Team Members",
                                "features" => "Why Us and Skills",
                                "extra-info" => "Additioanl Section for Extra information",
                                'recent_posts' => 'Recent Posts',
                            ),
                            "disabled" => array(
                                "placebo" => "placebo", //REQUIRED!
                                'default' => "Default content"
                            ),
                        ),
                    ),  
                    array(
                        'id'=>'home-pagebuilder',
                        'type' => 'switch', 
                        'title' => __('Disable Home Options.', 'greenr'),
                        'subtitle'=> __('Check this to disable options for home page content and use page builder to enter content', 'greenr'),
                        "default" => 0,
                        'on' => 'Enable',
                        'off' => 'Disable',
                        ),

                    array(
                        'id' => 'home-flexslider',
                        'type' => 'text',
                        'title' => __( 'Enter FlexSlider shortcode', 'greenr' ),
                        'subtitle' => __( 'FlexSlider for Home Page', 'greenr' ),
                        'desc' => __( 'Enter a FlexSlider shortcode to be displayed on Home Page', 'greenr' ),

                    ), 
                )
            );


            $this->sections[] = array(
                'title' => __('Blog', 'greenr'),
                'desc' => __('Blog options for site', 'greenr'),
                'icon' => 'fa fa-file',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields' => array(  

                    array(
                        'id'=>'featured-image',
                        'type' => 'switch', 
                        'title' => __('Featured Image', 'greenr'),
                        'subtitle'=> __('Check to show featured image', 'greenr'),
                        "default"       => 1,
                        'on' => 'Show',
                        'off' => 'Hide',
                        ),

                    array(
                        'id'=>'single-featured-image',
                        'type' => 'switch', 
                        'title' => __('Single Post Featured Image', 'greenr'),
                        'subtitle'=> __('Check to show featured image on single post', 'greenr'),
                        "default"       => 1,
                        'on' => 'Show',
                        'off' => 'Hide',
                        ),

                    array(
                        'id'        => 'upgrade-notice-5',
                        'type'      => 'info',
                        'notice'    => true,
                        'style'     => 'critical',
                        'icon'      => 'fa fa-info-circle',
                        'title'     => __('Greenr Pro Options. <a href="http://www.webulous.in/?add-to-cart=27">Upgrade Now</a> for just $39.', 'greenr'),
                        'desc'      => __('These options are available only in Greenr Pro version theme. Upgrade now for just $39.', 'greenr')
                    ),
                    
                    array(
                        'id'=>'show-author-bio',
                        'type' => 'switch', 
                        'title' => __('Author Bio Box', 'greenr'),
                        'subtitle'=> __('Show Author information box below single post.', 'greenr'),
                        "default"       => 0,
                        'on' => 'Show',
                        'off' => 'Hide',
                        ),

                    array(
                        'id'=>'show-social-sharing',
                        'type' => 'switch', 
                        'title' => __('Social Sharing Box', 'greenr'),
                        'subtitle'=> __('Show social sharing options box below single post.', 'greenr'),
                        "default"       => 0,
                        'on' => 'Show',
                        'off' => 'Hide',
                        ),

                    array(
                        'id'=>'show-related-posts',
                        'type' => 'switch', 
                        'title' => __('Related Posts', 'greenr'),
                        'subtitle'=> __('Show related posts.', 'greenr'),
                        "default"       => 0,
                        'on' => 'Show',
                        'off' => 'Hide',
                        ),

                    array(
                        'id'=>'show-comments',
                        'type' => 'switch', 
                        'title' => __('Comments', 'greenr'),
                        'subtitle'=> __('Show comments.', 'greenr'),
                        "default"       => 1,
                        'on' => 'Show',
                        'off' => 'Hide',
                        ),

                    array(
                        'id'=>'show-post-meta',
                        'type' => 'switch', 
                        'title' => __('Post Meta', 'greenr'),
                        'subtitle'=> __('Show post meta.', 'greenr'),
                        "default"       => 1,
                        'on' => 'Show',
                        'off' => 'Hide',
                        ),
                    /*
                     array(
                        'id'=>'post-content',
                        'type' => 'select',
                        'title' => __('Post Content', 'greenr'),
                        'subtitle'=> __('Select Excerpt or Full Content  to show on blog / archive pages.', 'greenr'),
                        'options' => array( '1' => ' Excerpt ', '2' => ' Full Content ' ),
                        'default' => '1'
                    ),
                    */


                    array(
                        'id'=>'excerpt-length',
                        'type' => 'text',
                        'title' => __('Excerpt Length', 'greenr' ), 
                        'subtitle' => __('Input the number of words you want to cut from the content to be the excerpt of search and archive page.', 'greenr' ),
                        'default' => 100,
                        ),
                )
            );

            $this->sections[] = array(
                'title' => __('Support', 'greenr'),
                'desc' => __('Documentation', 'greenr'),
                'icon' => 'fa fa-user',
                'fields' => array(

                    array(
                        'id'        => 'support-notice',
                        'type'      => 'info',
                        'style'     => 'critical',
                        'title'     => __('Support and Documentation.', 'redux-framework-demo'),
                        'desc'      => __('Please refer to documentation page of this site\'s demo to know how to use theme options specific to this theme. For professional support about customization and other advices from theme author, Please <a href="http://www.webulous.in/?add-to-cart=27">Upgrade</a> to Greenr Pro Version', 'greenr')
                    ),
                )
            );

            $this->sections[] = array(
                'title' => __('Why Upgrade?', 'greenr'),
                'desc' => __('Features you\'ll get in Pro Version', 'greenr'),
                'icon' => 'fa fa-magic',
                'fields' => array(
                    
                    array(
                        'id'        => 'pro-features',
                        'type'      => 'raw',
                        'content'   => $featuresHTML,
                    ),
                    

                )
            );

            $this->sections[] = array(
                'title' => __('Social Sharing Box', 'greenr'),
                'desc' => __('Social Sharing Icons Setup', 'greenr'),
                'icon' => 'fa fa-share',
                'fields' => array(  
                    array( 
                        'id' => 'ss_box_facebook',
                        'type' => 'switch',
                        'title' => 'Facebook',
                        'subtitle' => 'Show facebook sharing option in single posts.',
                        'default' => 0,
                        'on' => 'Show',
                        'off' => 'Hide',
                    ), 

                    array( 
                        'id' => 'ss_box_twitter',
                        'type' => 'switch',
                        'title' => 'Twitter',
                        'subtitle' => 'Show twitter sharing option in single posts.',
                        'default' => 0,
                        'on' => 'Show',
                        'off' => 'Hide',
                    ),

                    array( 
                        'id' => 'ss_box_linkedin',
                        'type' => 'switch',
                        'title' => 'LinkedIn',
                        'subtitle' => 'Show linkedin sharing option in single posts.',
                        'default' => 0,
                        'on' => 'Show',
                        'off' => 'Hide',
                    ),

                    array( 
                        'id' => 'ss_box_googleplus',
                        'type' => 'switch',
                        'title' => 'Google Plus',
                        'subtitle' => 'Show googleplus sharing option in single posts.',
                        'default' => 0,
                        'on' => 'Show',
                        'off' => 'Hide',
                    ),

                    array( 
                        'id' => 'ss_box_email',
                        'type' => 'switch',
                        'title' => 'Email',
                        'subtitle' => 'Show email sharing option in single posts.',
                        'default' => 0,
                        'on' => 'Show',
                        'off' => 'Hide',
                    ),
                )
            );

            $this->sections[] = array(
                'title' => __('Social Network', 'greenr'),
                'desc' => __('Social Network Links', 'greenr'),
                'icon' => 'fa fa-share',
                'fields' => array(

                    array( 
                        'id' => 'social-digg',
                        'type' => 'text',
                        'title' => 'Digg',
                        'subtitle' => 'Your Digg link',
                    ),

                    array( 
                        'id' => 'social-dribble',
                        'type' => 'text',
                        'title' => 'Dribble',
                        'subtitle' => 'Your Dribble link',
                    ),

                    array( 
                        'id' => 'social-facebook',
                        'type' => 'text',
                        'title' => 'Facebook',
                        'subtitle' => 'Your Facebook link',
                    ),

                    array( 
                        'id' => 'social-flickr',
                        'type' => 'text',
                        'title' => 'Flickr',
                        'subtitle' => 'Your Flickr link',
                    ),

                    array( 
                        'id' => 'social-google',
                        'type' => 'text',
                        'title' => 'Google',
                        'subtitle' => 'Your Google link',
                    ),

                    array( 
                        'id' => 'social-linkedin',
                        'type' => 'text',
                        'title' => 'LinkedIn',
                        'subtitle' => 'Your LinkedIn link',
                    ),

                    array( 
                        'id' => 'social-pinterest',
                        'type' => 'text',
                        'title' => 'Pinterest',
                        'subtitle' => 'Your Pinterest link',
                    ),

                    array( 
                        'id' => 'social-rss',
                        'type' => 'text',
                        'title' => 'RSS',
                        'subtitle' => 'Your RSS link',
                    ),

                    array( 
                        'id' => 'social-skype',
                        'type' => 'text',
                        'title' => 'Skype',
                        'subtitle' => 'Your Skype link',
                    ),

                    array( 
                        'id' => 'social-tumblr',
                        'type' => 'text',
                        'title' => 'Tumblr',
                        'subtitle' => 'Your Tumblr link',
                    ),

                    array( 
                        'id' => 'social-twitter',
                        'type' => 'text',
                        'title' => 'Twitter',
                        'subtitle' => 'Your Twitter link',
                    ),

                    array( 
                        'id' => 'social-vimeo',
                        'type' => 'text',
                        'title' => 'Vimeo',
                        'subtitle' => 'Your Vimeo link',
                    ),

                    array( 
                        'id' => 'social-youtube',
                        'type' => 'text',
                        'title' => 'YouTube',
                        'subtitle' => 'Your YouTube link',
                    ),

                )
            );

            $this->sections[] = array(
                'title' => __('Flex Slider', 'greenr'),
                'desc' => __('Flex Slider Settings', 'greenr'),
                'icon' => 'fa fa-photo',
                'fields' => array(

                    array(
                        'id'        => 'upgrade-notice-6',
                        'type'      => 'info',
                        'notice'    => true,
                        'style'     => 'critical',
                        'icon'      => 'fa fa-info-circle',
                        'title'     => __('Greenr Pro Options. <a href="http://www.webulous.in/?add-to-cart=27">Upgrade Now</a> for just $39.', 'greenr'),
                        'desc'      => __('These options are available only in Greenr Pro version theme. Upgrade now for just $39.', 'greenr')
                    ),
                    
                    array(
                        'id' => 'flexslider_animation',
                        'type' => 'select',
                        'title' => 'Animation',
                        'subtitle' => 'Select slider animation effect.',
                        'default' => '1',
                        'options' => array( 1 => 'fade', 2 => 'slide'),
                    ),

                    array(
                        'id' => 'flexslider_slide_direction',
                        'type' => 'select',
                        'title' => 'Slide Direction',
                        'subtitle' => 'Select direction to slide (if you are using the "Slide" animation)',
                        'default' => '1',
                        'options' => array( '1' => 'horizontal', '2' => 'vertical' ),
                    ),

                    array(
                        'id'        => 'flexslider_slideshow_speed',
                        'type'      => 'spinner',
                        'title'     => 'Slideshow Speed',
                        'subtitle'      => 'Set the delay between each slide animation (in milliseconds)',
                        'default'       => '7000',
                      'min' => '0',
                      'max' => '10000',
                      'step' => '100',
                    ),

                    array(
                        'id'        => 'flexslider_animation_speed',
                        'type'      => 'spinner',
                        'title'     => 'Animation Speed',
                        'subtitle'      => 'Set the duration of each slide animation (in milliseconds)',
                        'default'       => '600',
                      'min' => '0',
                      'max' => '10000',
                      'step' => '100',
                    ),

                    array(
                        'id' => 'flexslider_slideshow',
                        'type'      => 'switch',
                        'title' => 'Slideshow',
                        'subtitle' => 'Animate the slideshows automatically',
                        'default' => 0,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ), 

                    array(
                        'id' => 'flexslider_smooth_height',
                        'type'      => 'switch',
                        'title' => 'Auto Height',
                        'subtitle' => 'Adjust the height of the slideshow to the height of the current slide',
                        'default' => 0,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ), 

                    array(
                        'id' => 'flexslider_direction_nav',
                        'type'      => 'switch',
                        'title' => 'Previous / Next Buttons',
                        'subtitle' => 'Display the "Previous/Next" Buttons',
                        'default' => 0,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ), 

                    array(
                        'id' => 'flexslider_control_nav',
                        'type'      => 'switch',
                        'title' => 'Pagination',
                        'subtitle' => 'Display the slideshow pagination',
                        'default' => 0,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ), 

                    array(
                        'id' => 'flexslider_keyboard_nav',
                        'type'      => 'switch',
                        'title' => 'Keyboard Navigation',
                        'subtitle' => 'Enable keyboard navigation',
                        'default' => 0,
                        'on'        => 'Enable',
                        'off'       => 'Disable',
                    ), 

                    array(
                        'id' => 'flexslider_mousewheel_nav',
                        'type'      => 'switch',
                        'title' => 'Mouse Wheel Navigation',
                        'subtitle' => 'Enable the mousewheel navigation',
                        'default' => 0,
                        'on'        => 'Enable',
                        'off'       => 'Disable',
                    ), 


                    array(
                        'id' => 'flexslider_pauseplay',
                        'type'      => 'switch',
                        'title' => 'Pause / Play',
                        'subtitle' => 'Enable the "Pause/Play" event',
                        'default' => 0,
                        'on'        => 'Enable',
                        'off'       => 'Disable',
                    ), 

                    array(
                        'id' => 'flexslider_randomize',
                        'type'      => 'switch',
                        'title' => 'Random Slides',
                        'subtitle' => 'Randomize the order of slides in slideshows',
                        'default' => 0,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ), 

                    array(
                        'id' => 'flexslider_animation_loop',
                        'type'      => 'switch',
                        'title' => 'Loop Slideshow',
                        'subtitle' => 'Loop the slideshow animations',
                        'default' => 0,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ), 

                    array(
                        'id' => 'flexslider_pause_on_action',
                        'type'      => 'switch',
                        'title' => 'Pause On Action',
                        'subtitle' => 'Pause the slideshow autoplay when using the pagination or "Previous/Next" navigation',
                        'default' => 0,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ), 

                    array(
                        'id' => 'flexslider_pause_on_hover',
                        'type'      => 'switch',
                        'title' => 'Pause On Hover',
                        'subtitle' => 'Pause the slideshow autoplay when hovering over a slide',
                        'default' => 0,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ), 

                    array(
                        'id'        => 'flexslider_prev_text',
                        'type'      => 'text',
                        'title'     => '"Previous" Button',
                        'subtitle'      => 'The text to display on the "Previous" button.',
                        'default'       => 'Previous',
                    ),

                    array(
                        'id'        => 'flexslider_next_text',
                        'type'      => 'text',
                        'title'     => '"Next" Button',
                        'subtitle'      => 'The text to display on the "Next" button.',
                        'default'       => 'Next',
                    ),

                    array(
                        'id'        => 'flexslider_play_text',
                        'type'      => 'text',
                        'title'     => '"Play" Button',
                        'subtitle'      => 'The text to display on the "Play" button.',
                        'default'       => 'Play',
                    ),

                    array(
                        'id'        => 'flexslider_pause_text',
                        'type'      => 'text',
                        'title'     => '"Pause" Button',
                        'subtitle'      => 'The text to display on the "Pause" button.',
                        'default'       => 'Pause',
                    ),
                )
            );

            $this->sections[] = array(
                'title' => __('Light Box', 'greenr'),
                'desc' => __('Light Box Settings', 'greenr'),
                'icon' => 'fa fa-lightbulb-o',
                'fields' => array(

                    array(
                        'id'        => 'upgrade-notice-7',
                        'type'      => 'info',
                        'notice'    => true,
                        'style'     => 'critical',
                        'icon'      => 'fa fa-info-circle',
                        'title'     => __('Greenr Pro Options. <a href="http://www.webulous.in/?add-to-cart=27">Upgrade Now</a> for just $39.', 'greenr'),
                        'desc'      => __('These options are available only in Greenr Pro version theme. Upgrade now for just $39.', 'greenr')
                    ),
                    
                    array( 
                        'id' => 'lightbox_theme',
                        'type' => 'select',
                        'title' => 'Lightbox Theme',
                        'subtitle' => '',
                        'default' => '1',
                        'options' => array(
                            '1' => 'pp_default',
                            '2' => 'light_rounded',
                            '3' => 'dark_rounded',
                            '4' => 'light_square',
                            '5' => 'dark_square',
                            '6' => 'facebook'
                        ),
                    ),
                                        
                    array( 
                        'id' => 'lightbox_animation_speed',
                        'type' => 'select',
                        'title' => 'Animation Speed',
                        'subtitle' => '',
                        'default' => '1',
                        'options' => array( '1' => 'Fast', '2' => 'Slow', '3' => 'Normal' ),
                    ),

                    array( 
                        'id' => 'lightbox_slideshow',
                        'type' => 'spinner',
                        'title' => 'Autoplay Gallery Speed',
                        'subtitle' => 'If autoplay is set to true, select the slideshow speed in ms. (Default: 5000, 500 ms = 1 second)',
                        'default' => '5000',
                        'min' => '1000',
                        'max' => '10000',
                        'step' => '100',
                    ),

                    array( 
                        'id' => 'lightbox_autoplay_slideshow',
                        'type'      => 'switch',
                        'title' => 'Autoplay Gallery',
                        'subtitle' => 'Check to autoplay the lightbox gallery',
                        'default' => 0,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ),

                    array( 
                        'id' => 'lightbox_opacity',
                        'type' => 'text',
                        'title' => 'Background Opacity',
                        'subtitle' => 'Enter 0.1 to 1.0',
                        'default' => '0.7',
                    ),

                    array( 
                        'id' => 'lightbox_show_title',
                        'type'      => 'switch',
                        'title' => 'Title',
                        'subtitle' => 'Select visibility of the title',
                        'default' => 1,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ),


                    array( 
                        'id' => 'lightbox_overlay_gallery',
                        'type'      => 'switch',
                        'title' => 'Show Gallery Thumbnails',
                        'subtitle' => 'Check to show gallery thumbnails',
                        'default' => 1,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ),


                    array( 
                        'id' => 'lightbox_social_tools',
                        'type'      => 'switch',
                        'title' => 'Social Icons',
                        'subtitle' => 'Check to show social sharing icons',
                        'default' => 1,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ),

                )
            );


        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id' => 'redux-opts-1',
                'title' => __('Theme Information 1', 'redux-framework-demo'),
                'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );

            $this->args['help_tabs'][] = array(
                'id' => 'redux-opts-2',
                'title' => __('Theme Information 2', 'redux-framework-demo'),
                'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'greenr', // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'), // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'), // Version that appears at the top of your panel
                'menu_type' => 'submenu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true, // Show the sections below the admin menu item or not
                'menu_title' => __('Theme Options', 'redux-framework-demo'),
                'page' => __('Theme Options', 'redux-framework-demo'),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '', // Must be defined to add google fonts to the typography module
                //'admin_bar' => false, // Show the panel pages on the admin bar
                'global_variable' => '', // Set a different name for your global variable other than the opt_name
                'dev_mode' => false, // Show the time the page took to load, etc
                'customizer' => true, // Enable basic customizer support
                // OPTIONAL -> Give you extra features
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'menu_icon' => '', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                //'domain'             	=> 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
                //'footer_credit'      	=> '', // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => true, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array('docs'),
                'help_sidebar' => '', // __( '', $this->args['domain'] );            
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.		
            $this->args['share_icons'][] = array(
                'url' => 'https://github.com/venkatraj',
                'title' => 'Visit me on GitHub',
                'icon' => 'fa fa-github'
                    // 'img' => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url' => 'https://www.facebook.com/pages/webulous/170827696548',
                'title' => 'Like us on Facebook',
                'icon' => 'fa fa-facebook'
            );
            $this->args['share_icons'][] = array(
                'url' => 'https://twitter.com/webulous',
                'title' => 'Follow us on Twitter',
                'icon' => 'fa fa-twitter'
            );
            $this->args['share_icons'][] = array(
                'url' => 'https://www.linkedin.com/company/coding-geek',
                'title' => 'Find us on LinkedIn',
                'icon' => 'fa fa-linkedin'
            );



            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace("-", "_", $this->args['opt_name']);
                }
                //$this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo'), $v);
                $this->args['intro_text'] = sprintf(__('<p class="btn-upgrade"><a href="http://www.webulous.in/?add-to-cart=27"><i class="fa fa-upload"></i> Upgrade for just $39</a> <a href="http://demo.webulous.in/greenr" class="vide-demo"><i class="fa fa-eye"></i>View Demo</p>', 'redux-framework-demo'), $v);
            } else {
                $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo');
            }

            // Add content after the form.
            //$this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo');
        }

    }

    new Redux_Framework_sample_config();
}


/**

  Custom function for the callback referenced above

 */
if (!function_exists('redux_my_custom_field')):

    function redux_my_custom_field($field, $value) {
        print_r($field);
        print_r($value);
    }

endif;

/**

  Custom function for the callback validation referenced above

 * */
if (!function_exists('redux_validate_callback_function')):

    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';
        /*
          do your validation

          if(something) {
          $value = $value;
          } elseif(something else) {
          $error = true;
          $value = $existing_value;
          $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }


endif;
