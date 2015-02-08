<?php
/*
 * 
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 * Also if running on windows you may have url problems, which can be fixed by defining the framework url first
 *
 */
//define('NHP_OPTIONS_URL', site_url('path the options folder'));
if(!class_exists('NHP_Options')){
	require_once( dirname( __FILE__ ) . '/options/options.php' );
}

/*
 * 
 * Custom function for filtering the sections array given by theme, good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for urls, and dir will NOT be available at this point in a child theme, so you must use
 * get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections){
	
	//$sections = array();
	$sections[] = array(
				'title' => __('A Section added by hook', 'nhp-opts'),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.</p>', 'nhp-opts'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_062_attach.png',
				//Lets leave this as a blank section, no options just some intro text set above.
				'fields' => array()
				);
	
	return $sections;
	
}//function
//add_filter('nhp-opts-sections-twenty_eleven', 'add_another_section');


/*
 * 
 * Custom function for filtering the args array given by theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
	
	//$args['dev_mode'] = false;
	
	return $args;
	
}//function
//add_filter('nhp-opts-args-twenty_eleven', 'change_framework_args');









/*
 * This is the meat of creating the optons page
 *
 * Override some of the default values, uncomment the args and change the values
 * - no $args are required, but there there to be over ridden if needed.
 *
 *
 */

function setup_framework_options(){
$args = array();

//Set it to dev mode to view the class settings/info in the form - default is false
$args['dev_mode'] = false;

//google api key MUST BE DEFINED IF YOU WANT TO USE GOOGLE WEBFONTS
//$args['google_api_key'] = '***';

//Remove the default stylesheet? make sure you enqueue another one all the page will look whack!
//$args['stylesheet_override'] = true;

//Add HTML before the form
$args['intro_text'] = __('<p>Thank you for using our Themes4all.com theme. Please follow us on <a href="https://www.facebook.com/Themes4all">Facebook</a>, <a href="https://twitter.com/Themes4all">Twitter</a> or <a href="https://plus.google.com/u/0/b/106001525873448285383/106001525873448285383/posts">Google+</a>.</p>', 'nhp-opts');

//Setup custom links in the footer for share icons
$args['share_icons']['facebook'] = array(
										'link' => 'https://www.facebook.com/Themes4all',
										'title' => 'Folow us on Facebook', 
										'img' => get_template_directory_uri().'/images/common/ico-facebook.png'
										);
$args['share_icons']['twitter'] = array(
										'link' => 'https://twitter.com/Themes4all',
										'title' => 'Folow us on Twitter', 
										'img' => get_template_directory_uri().'/images/common/ico-twitter.png'
										);                                       
$args['share_icons']['linked_in'] = array(
										'link' => 'https://plus.google.com/u/0/b/106001525873448285383/106001525873448285383/posts',
										'title' => 'Find us on Google+', 
										'img' => get_template_directory_uri().'/images/common/ico-google.png'
										);                  

//Choose to disable the import/export feature
//$args['show_import_export'] = false;

//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
$args['opt_name'] = 'basic';

//Custom menu icon
//$args['menu_icon'] = '';

//Custom menu title for options page - default is "Options"
$args['menu_title'] = __('Theme Options', 'nhp-opts');

//Custom Page Title for options page - default is "Options"
$args['page_title'] = __('Basic Theme Options', 'nhp-opts');

//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "nhp_theme_options"
$args['page_slug'] = 'nhp_theme_options';

//Custom page capability - default is set to "manage_options"
//$args['page_cap'] = 'manage_options';

//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
//$args['page_type'] = 'submenu';

//parent menu - default is set to "themes.php" (Appearance)
//the list of available parent menus is available here: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
//$args['page_parent'] = 'themes.php';

//custom page location - default 100 - must be unique or will override other items
$args['page_position'] = 27;

//Custom page icon class (used to override the page icon next to heading)
//$args['page_icon'] = 'icon-themes';

//Want to disable the sections showing as a submenu in the admin? uncomment this line
//$args['allow_sub_menu'] = false;
		
//Set ANY custom page help tabs - displayed using the new help tab API, show in order of definition		
$args['help_tabs'][] = array(
							'id' => 'nhp-opts-1',
							'title' => __('Theme Information 1', 'nhp-opts'),
							'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'nhp-opts')
							);
$args['help_tabs'][] = array(
							'id' => 'nhp-opts-2',
							'title' => __('Theme Information 2', 'nhp-opts'),
							'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'nhp-opts')
							);

//Set the Help Sidebar for the options page - no sidebar by default										
$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'nhp-opts');

// Pull all pages into an array
    $options_pages = array();
    $options_pages_obj = get_pages();
    foreach ($options_pages_obj as $page) {
        $options_pages[$page->ID] = $page->post_title;
    }
// Pull all the categories into an array
    $options_categories = array();
    $options_categories_obj = get_categories();
    foreach ($options_categories_obj as $category) {
        $options_categories[$category->cat_ID] = $category->cat_name;
    }    
    $gw_fonts = array();
    foreach ($GLOBALS['gfonts'] as $k => $l){
        $gw_fonts[$k] = $k;    
    }


$sections = array();

    $sections[] = array(
        'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_137_computer_service.png',
        'title' => __('General Settings', 'simple'),
        'desc' => __('<p class="description"></p>', 'simple'),
        'fields' => array(
            array(
                'id' => 'basic_logo', //must be unique
                'type' => 'upload', //builtin fields include:
                //text|textarea|editor|checkbox|multi_checkbox|radio|radio_img|button_set|select|multi_select|color|date|divide|info|upload
                'title' => __('Custom Logo', 'simple'),
                'sub_desc' => __('', 'simple'),
                'desc' => __('Choose your own logo.', 'simple'),
            ),
            array(
                'id' => 'basic_favicon',
                'type' => 'upload',
                'title' => __('Custom Favicon', 'simple'),
                'sub_desc' => __('', 'simple'),
                'desc' => __("Choose a 16px x 16px image that will represent your website's favicon.", 'simple'),
                'msg' => '',
                'std' => ''
            ),
            array(
                'id' => 'basic_facebooklink',
                'type' => 'text',
                'title' => __('Facebook profile URL', 'simple'),
                'sub_desc' => __('', 'simple'),
                //'desc' => __('Enter your facebook profile URL', 'simple'),
                'std' => ''// 1 = on | 0 = off
            ),
            array(
                'id' => 'basic_googlelink',
                'type' => 'text',
                'title' => __('Google+ profile URL', 'simple'),
                'sub_desc' => __('', 'simple'),
                //'desc' => __('Enter your Google plus profile link', 'simple'),
                'std' => ''// 1 = on | 0 = off
            ),
            array(
                'id' => 'basic_twitterlink',
                'type' => 'text',
                'title' => __('Twitter profile URL', 'simple'),
                'sub_desc' => __('', 'simple'),
                //'desc' => __('Enter your twitter profile link', 'simple'),
                'std' => ''// 1 = on | 0 = off
            ),
            array(
                'id' => 'basic_rsslink',
                'type' => 'text',
                'title' => __('RSS profile URL ', 'simple'),
                'sub_desc' => __('', 'simple'),
                //'desc' => __('Enter your rss profile link', 'simple'),
                'std' => ''// 1 = on | 0 = off
            ),
            array(
						'id' => 'breadcrumb_display',
						'type' => 'radio',
						'title' => __('Breadcrumb display Settings', 'nhp-opts'), 
						'sub_desc' => __('', 'nhp-opts'),
						'desc' => __('', 'nhp-opts'),
						'options' => array('1' => 'On','2' => 'Off'),
						'std' => '1'
						),
            array(
						'id' => 'comment_display',
						'type' => 'radio',
						'title' => __('Comment display Settings', 'simple'), 
						'sub_desc' => __('', 'nhp-opts'),
						'desc' => __('', 'nhp-opts'),
						'options' => array('1' => 'On','2' => 'Off'),
						'std' => '1'
						)
        )
    );


    $sections[] = array(
        'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_020_home.png',
        'title' => __('Home Page Settings', 'simple'),
        //'desc' => __('<p class="description">These options for home page settings</p>', 'simple'),
        'fields' => array(
            array(
						    'id' => '25',
						    'type' => 'info',
						    'desc' => __('<p class="description">Select an individual page for each of the three boxes below.</p>', 'nhp-opts')
						),
            array(
                'id' => 'basic_homebox1',
                'type' => 'select',
                'title' => __('Select a page for the First Box', 'simple'),
                'sub_desc' => __('', 'simple'),
                'desc' => __('', 'simple'),
                'options' => $options_pages
            ),
            array(
                'id' => 'homepage_first_ico',
                'type' => 'select',
                'title' => __('Select ico for first box', 'simple'),
                'sub_desc' => __('', 'simple'),
                'desc' => __('', 'simple'),
                'options' =>array(
                                  '1' => 'Fast forward',
                                  '2' => 'Guitar',
                                  '3' => 'Play',
                                  '4' => 'CD',
                                  '5' => 'Pause',
                                  '6' => 'Microphone',
                                  '7' => 'Violin clef',
                                  '8' => 'Equalizer')
            ),
            array(
                'id' => 'basic_homebox2',
                'type' => 'select',
                'title' => __('Select a page for the Second Box', 'simple'),
                'sub_desc' => __('', 'simple'),
                'desc' => __('', 'simple'),
                'options' => $options_pages
            ),
            array(
                'id' => 'homepage_second_ico',
                'type' => 'select',
                'title' => __('Select ico for second box', 'simple'),
                'sub_desc' => __('', 'simple'),
                'desc' => __('', 'simple'),
                'options' =>array(
                                  '1' => 'Fast forward',
                                  '2' => 'Guitar',
                                  '3' => 'Play',
                                  '4' => 'CD',
                                  '5' => 'Pause',
                                  '6' => 'Microphone',
                                  '7' => 'Violin clef',
                                  '8' => 'Equalizer')
            ),    
            array(
                'id' => 'basic_homebox3',
                'type' => 'select',
                'title' => __('Select a page for the Third Box', 'simple'),
                'sub_desc' => __('', 'simple'),
                'desc' => __('', 'simple'),
                'options' => $options_pages
            ),
            array(
                'id' => 'homepage_third_ico',
                'type' => 'select',
                'title' => __('Select ico for third box', 'simple'),
                'sub_desc' => __('', 'simple'),
                'desc' => __('', 'simple'),
                'options' =>array(
                                  '1' => 'Fast forward',
                                  '2' => 'Guitar',
                                  '3' => 'Play',
                                  '4' => 'CD',
                                  '5' => 'Pause',
                                  '6' => 'Microphone',
                                  '7' => 'Violin clef',
                                  '8' => 'Equalizer')
            ),
            array(
                'id' => 'player_page',
                'type' => 'select',
                'title' => __('Select a page with mp3 player', 'simple'),
                'sub_desc' => __('', 'simple'),
                'desc' => __('', 'simple'),
                'options' => $options_pages
            ),
            array(
                'id' => 'home-note',
                'type' => 'textarea',
                'title' => __('Homepage text', 'simple'),
                'sub_desc' => __('', 'simple'),
                'desc' => __('', 'simple')
            ),
        )
    );
    $sections[] = array(
        'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_023_cogwheels.png',
        'title' => __('Post General Settings', 'simple'),
        'desc' => __('<p class="description">Show or hide all post meta information in a post.</p>', 'elite'),
        'fields' => array(
            array(
						      'id' => 'display_post_meta',
						      'type' => 'radio',
						      'title' => __('Display all post meta on/off', 'nhp-opts'), 
						      'sub_desc' => __('Show or hide all post meta information.', 'nhp-opts'),
						      'desc' => __('', 'nhp-opts'),
						      'options' => array('1' => 'Off','2' => 'On'),
						      'std' => '1'
						),
            array(
						      'id' => 'display_author_meta',
					 	      'type' => 'radio',
						      'title' => __('Display author meta on/off', 'nhp-opts'), 
						      'sub_desc' => __('', 'nhp-opts'),
						      'desc' => __('', 'nhp-opts'),
						      'options' => array('1' => 'Off','2' => 'On'),
						      'std' => '1'
						),
            array(
						      'id' => 'display_date_meta',
						      'type' => 'radio',
						      'title' => __('Display date meta on/off', 'nhp-opts'), 
						      'sub_desc' => __('', 'nhp-opts'),
						      'desc' => __('', 'nhp-opts'),
						      'options' => array('1' => 'Off','2' => 'On'),
						      'std' => '1'
						),
            array(
						      'id' => 'display_categories_meta',
						      'type' => 'radio',
						      'title' => __('Display categories meta on/off', 'nhp-opts'), 
						      'sub_desc' => __('', 'nhp-opts'),
						      'desc' => __('', 'nhp-opts'),
						      'options' => array('1' => 'Off','2' => 'On'),
						      'std' => '1'
						),
            array(
						      'id' => 'display_comments_meta',
						      'type' => 'radio',
						      'title' => __('Display comments meta on/off', 'nhp-opts'), 
						      'sub_desc' => __('', 'nhp-opts'),
						      'desc' => __('', 'nhp-opts'),
						      'options' => array('1' => 'Off','2' => 'On'),
						      'std' => '1'
						),
            array(
						      'id' => 'display_author_info',
						      'type' => 'radio',
						      'title' => __('Display author info on/off', 'nhp-opts'), 
						      'sub_desc' => __('', 'nhp-opts'),
						      'desc' => __('', 'nhp-opts'),
						      'options' => array('1' => 'Off','2' => 'On'),
						      'std' => '1'
						),
            array(
						      'id' => 'display_tags',
						      'type' => 'radio',
						      'title' => __('Display tags on/off', 'nhp-opts'), 
						      'sub_desc' => __('', 'nhp-opts'),
						      'desc' => __('', 'nhp-opts'),
						      'options' => array('1' => 'Off','2' => 'On'),
						      'std' => '1'
						)
        )
    );
    $sections[] = array(
        'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_019_cogwheel.png',
        'title' => __('Category General Settings', 'simple'),
        'desc' => __('<p class="description">Show or hide all post meta information in a category.</p>', 'elite'),
        'fields' => array(
            array(
						      'id' => 'display_category_meta',
						      'type' => 'radio',
						      'title' => __('Display all category post meta on/off', 'nhp-opts'), 
						      'sub_desc' => __('Show or hide all post meta information.', 'nhp-opts'),
						      'desc' => __('', 'nhp-opts'),
						      'options' => array('1' => 'Off','2' => 'On'),
						      'std' => '1'
						),
            array(
						      'id' => 'display_cat_author_meta',
					 	      'type' => 'radio',
						      'title' => __('Display author meta on/off', 'nhp-opts'), 
						      'sub_desc' => __('', 'nhp-opts'),
						      'desc' => __('', 'nhp-opts'),
						      'options' => array('1' => 'Off','2' => 'On'),
						      'std' => '1'
						),
            array(
						      'id' => 'display_cat_date_meta',
						      'type' => 'radio',
						      'title' => __('Display date meta on/off', 'nhp-opts'), 
						      'sub_desc' => __('', 'nhp-opts'),
						      'desc' => __('', 'nhp-opts'),
						      'options' => array('1' => 'Off','2' => 'On'),
						      'std' => '1'
						),
            array(
						      'id' => 'display_cat_categories_meta',
						      'type' => 'radio',
						      'title' => __('Display categories meta on/off', 'nhp-opts'), 
						      'sub_desc' => __('', 'nhp-opts'),
						      'desc' => __('', 'nhp-opts'),
						      'options' => array('1' => 'Off','2' => 'On'),
						      'std' => '1'
						),
            array(
						      'id' => 'display_cat_comments_meta',
						      'type' => 'radio',
						      'title' => __('Display comments meta on/off', 'nhp-opts'), 
						      'sub_desc' => __('', 'nhp-opts'),
						      'desc' => __('', 'nhp-opts'),
						      'options' => array('1' => 'Off','2' => 'On'),
						      'std' => '1'
						)
        )
    );
    $sections[] = array(
        'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_029_notes_2.png',
        'title' => __('Bottom Gallery', 'simple'),
        'desc' => __('<p class="description">Select the category of the gallery post that will be displayed on the bottom of the page. </p>', 'elite'),
        'fields' => array(
            array(
						'id' => 'bottom_gallery_display',
						'type' => 'radio',
						'title' => __('Turn the bottom gallery on/off', 'nhp-opts'), 
						'sub_desc' => __('', 'nhp-opts'),
						'desc' => __('', 'nhp-opts'),
						'options' => array('1' => 'Off','2' => 'On'),
						'std' => '1'
						),
            array(
                'id' => 'bottom_gallery',
                'type' => 'select',
                'title' => __('Select a Category', 'simple'),
                'sub_desc' => __('', 'simple'),
                'desc' => __('', 'simple'),
                'options' => $options_categories
            ),
            array(
                'id' => 'bottom_gallery_link',
                'type' => 'text',
						    'title' => __('Bottom gallery URL', 'nhp-opts'),
						    'sub_desc' => __('', 'nhp-opts'),
						    'desc' => __('', 'nhp-opts')
            )
        )
    );
    $sections[] = array(
        'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_159_picture.png',
        'title' => __('Image Thumbnail Settings', 'simple'),
        'desc' => __('<p class="description"></p>', 'elite'),
        'fields' => array(
            array(
						'id' => 'link_fancybox',
						'type' => 'radio',
						'title' => __('Choose a display link / a display link and a fancybox for Gallery', 'nhp-opts'), 
						'sub_desc' => __('', 'nhp-opts'),
						'desc' => __('', 'nhp-opts'),
						'options' => array('1' => 'Display fancybox only','2' => 'Display link and a fancybox'),
						'std' => '1'
						),
            array(
						'id' => 'port_fancybox',
						'type' => 'radio',
						'title' => __('Choose a display link / a display link and a fancybox for Portfolio', 'nhp-opts'), 
						'sub_desc' => __('', 'nhp-opts'),
						'desc' => __('', 'nhp-opts'),
						'options' => array('1' => 'Display fancybox only','2' => 'Display link and a fancybox'),
						'std' => '1'
						)
        )
    );
    $sections[] = array(
				'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_243_anchor.png',
				'title' => __('Contact Page Settings', 'nhp-opts'),
				'desc' => __('', 'nhp-opts'),
				'fields' => array(
				 array(
						'id' => 'contact-companyname',
						'type' => 'text',
						'title' => __('Company name', 'nhp-opts'),
						'sub_desc' => __('', 'nhp-opts'),
						'desc' => __('', 'nhp-opts')
						),
         array(
						'id' => 'contact-phone',
						'type' => 'multi_text',
						'title' => __('Telephone number', 'nhp-opts'),
						'sub_desc' => __('', 'nhp-opts'),
						'desc' => __('', 'nhp-opts')
						),
          array(
            'id' => 'contact-email',
            'type' => 'multi_text', 
						'title' => __('Email', 'nhp-opts'),
						'sub_desc' => __('', 'nhp-opts'),
						'desc' => __('', 'nhp-opts'),
            'std' => ''
            ),
          array(
            'id' => 'contact-skype',
            'type' => 'text', 
						'title' => __('Skype', 'nhp-opts'),
						'sub_desc' => __('', 'nhp-opts'),
						'desc' => __('', 'nhp-opts'),
            'std' => ''
            ),
          array(
            'id' => 'contact-adress',
            'type' => 'text', 
						'title' => __('Address', 'nhp-opts'),
						'sub_desc' => __('', 'nhp-opts'),
						'desc' => __('', 'nhp-opts'),
            'std' => ''
            ),  
          array(
            'id' => 'contact-city',
            'type' => 'text', 
						'title' => __('City', 'nhp-opts'),
						'sub_desc' => __('', 'nhp-opts'),
						'desc' => __('', 'nhp-opts'),
            'std' => ''
            ),
          array(
            'id' => 'contact-zip',
            'type' => 'text', 
						'title' => __('ZIP code', 'nhp-opts'),
						'sub_desc' => __('', 'nhp-opts'),
						'desc' => __('', 'nhp-opts'),
            'std' => ''
            ),
          array(
            'id' => 'contact-state',
            'type' => 'text', 
						'title' => __('State', 'nhp-opts'),
						'sub_desc' => __('', 'nhp-opts'),
						'desc' => __('', 'nhp-opts'),
            'std' => ''
            ),
          array(
            'id' => 'contact_form_email',
            'type' => 'text', 
						'title' => __('Contact form email', 'nhp-opts'),
						'sub_desc' => __('Enter an email address to send the contact form to.', 'nhp-opts'),
						'desc' => __('', 'nhp-opts'),
            'std' => ''
            ),
          array(
						'id' => 'g-map',
						'type' => 'textarea',
						'title' => __('Insert Google Maps Iframe', 'nhp-opts'), 
						'sub_desc' => __('', 'nhp-opts'),
						'desc' => __('You must set width="894" and height="450" px', 'nhp-opts'),
						'std' => ''
						)
       		)
				);        
        $sections[] = array(
        'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_030_pencil.png',
        'title' => __('Custom Styles Settings', 'simple'),
        'desc' => __('<p class="description"></p>', 'elite'),
        'fields' => array(
            array(
                  'id' => 'background_color',
                  'type' => 'text', 
						      'title' => __('Background colour', 'nhp-opts'),
						      'sub_desc' => __('If is empty - colour is a default', 'nhp-opts'),
						      'desc' => __('', 'nhp-opts'),
                  'std' => '',
                  'class' => 'colorpopup'
            ),
            array(
						      'id' => 'background_pattern',
						      'type' => 'select',
						      'title' => __('Background texture', 'nhp-opts'), 
						      'sub_desc' => __('', 'nhp-opts'),
						      'desc' => __('', 'nhp-opts'),
						      'options' => array(
                                      'none' => 'None',
                                      '45degreee_fabric' => '45degreee Fabric',
                                      'always_grey' => 'Always Grey',
                                      'argyle' => 'Argyle',
                                      'arches' => 'Arches',
                                      'black_denim' => 'Black Denim',
                                      'black_linen_v2' => 'Black Linen',
                                      'black_scales' => 'Black Scales',
                                      'black-Linen' => 'Black Linen',
                                      'bo_play_pattern' => 'Bo Play Pattern',
                                      'brushed_alu' => 'Brushed Alu',
                                      'brushed_alu_dark' => 'Brushed Alu Dark',
                                      'carbon_fibre' => 'Carbon Fibre',
                                      'cartographer' => 'Cartographer',
                                      'cross_scratches' => 'Cross Scratches',
                                      'crossed_stripes' => 'Crossed Stripes',
                                      'dark_brick_wall' => 'Dark Brick Wall',
                                      'darkdenim3' => 'Dark Denim 3',
                                      'denim' => 'Denim',
                                      'diagonal-noise' => 'Diagonal Noise',
                                      'diamond_upholstery' => 'Diamond Upholstery',
                                      'ecailles' => 'Ecailles',
                                      'fabric_plaid' => 'Fabric Plaid',
                                      'fake_brick' => 'Fake Brick',
                                      'flowertrail' => 'Flowertrail',
                                      'furley_bg' => 'Furley Bg',
                                      'green-fibers' => 'Green Fibers',
                                      'greyfloral' => 'Greyfloral',
                                      'gun_metal' => 'Gun Metal',
                                      'hixs_pattern_evolution' => 'Hixs Pattern Evolution',
                                      'knitted-netting' => 'Knitted\Netting',
                                      'lghtmesh' => 'Lghtmesh',
                                      'light_alu' => 'Light Alu',
                                      'light_grey_floral_motif' => 'Light Grey Floral Motif',
                                      'light_checkered_tiles' => 'Light Checkered Tiles',
                                      'lightpaperfibers' => 'Light Paper Fibers',
                                      'littleknobs' => 'Little Knobs',
                                      'low_contrast_linen' => 'Low Contrast Linen',
                                      'micro_carbon' => 'Micro Carbon',
                                      'nami' => 'Nami',
                                      'noise_pattern_with_crosslines' => 'Noise Pattern With Crosslines',
                                      'padded' => 'Padded',
                                      'paper' => 'Paper',
                                      'paven' => 'Paven',
                                      'purty_wood' => 'Purty Wood',
                                      'pw_maze_black' => 'Pw Maze Black',
                                      'pw_maze_white' => 'Pw Maze White',
                                      'ravenna' => 'Ravenna',
                                      'rockywall' => 'Rockywall',
                                      'rubber_grip' => 'Rubber Grip',
                                      'silver_scales' => 'Silver Scales',
                                      'subtle_stripes' => 'Subtle Stripes',
                                      'subtlenet2' => 'Subtlenet2',
                                      'tileable_wood_texture' => 'Tileable Wood Texture',
                                      'triangles' => 'Triangles',
                                      'triangles_pattern' => 'Triangles Pattern',
                                      'type' => 'Type',
                                      'vertical_cloth' => 'Vertical Cloth',
                                      'vichy' => 'Vichy',
                                      'white_brick_wall' => 'White Brick Wall',
                                      'white_carbon' => 'White Carbon',
                                      'white_carbonfiber' => 'White Carbonfiber',
                                      'white_tiles' => 'White Tiles',
                                      'whitey' => 'Whitey',
                                      'wood_1' => 'Wood 1',
                                      'wood_pattern' => 'Wood Pattern',
                                      'woven' => 'Woven'

                  ),
						      'std' => 'none'
						),
            array(
						      'id' => 'google_webfonts',
						      'type' => 'select',
						      'title' => __('Select body font', 'nhp-opts'), 
						      'sub_desc' => __('', 'nhp-opts'),
						      'desc' => __('', 'nhp-opts'),
						      'options' => $gw_fonts,
						      'std' => 'none'
						),
            array(
                  'id' => 'body_text_color',
                  'type' => 'text', 
						      'title' => __('Body text colour', 'nhp-opts'),
						      'sub_desc' => __('If is empty - colour is a default', 'nhp-opts'),
						      'desc' => __('', 'nhp-opts'),
                  'std' => '',
                  'class' => 'colorpopup'
            ),
            array(
						      'id' => 'titles_webfonts',
						      'type' => 'select',
						      'title' => __('Select titles font', 'nhp-opts'), 
						      'sub_desc' => __('H1, H2, H3, H4, H5, H6, entry title, page title', 'nhp-opts'),
						      'desc' => __('', 'nhp-opts'),
						      'options' => $gw_fonts,
						      'std' => 'none'
						),
            array(
                  'id' => 'titles_color',
                  'type' => 'text', 
						      'title' => __('Titles colour', 'nhp-opts'),
						      'sub_desc' => __('If is empty - colour is a default', 'nhp-opts'),
						      'desc' => __('', 'nhp-opts'),
                  'std' => '',
                  'class' => 'colorpopup'
            ),
            array(
                  'id' => 'anchors_color',
                  'type' => 'text', 
						      'title' => __('Anchors colour', 'nhp-opts'),
						      'sub_desc' => __('If is empty - colour is a default', 'nhp-opts'),
						      'desc' => __('', 'nhp-opts'),
                  'std' => '',
                  'class' => 'colorpopup'
            ),
        )
    );

				
	$tabs = array();
			
	if (function_exists('wp_get_theme')){
		$theme_data = wp_get_theme();
		$theme_uri = $theme_data->get('ThemeURI');
		$description = $theme_data->get('Description');
		$author = $theme_data->get('Author');
		$version = $theme_data->get('Version');
		$tags = $theme_data->get('Tags');
	}else{
		$theme_data = get_theme_data(trailingslashit(get_stylesheet_directory()).'style.css');
		$theme_uri = $theme_data['URI'];
		$description = $theme_data['Description'];
		$author = $theme_data['Author'];
		$version = $theme_data['Version'];
		$tags = $theme_data['Tags'];
	}	

	$theme_info = '<div class="nhp-opts-section-desc">';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-uri">'.__('<strong>Theme URL:</strong> ', 'nhp-opts').'<a href="'.$theme_uri.'" target="_blank">'.$theme_uri.'</a></p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-author">'.__('<strong>Author:</strong> ', 'nhp-opts').$author.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-version">'.__('<strong>Version:</strong> ', 'nhp-opts').$version.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-description">'.$description.'</p>';
	$theme_info .= '<p class="nhp-opts-theme-data description theme-tags">'.__('<strong>Tags:</strong> ', 'nhp-opts').implode(', ', $tags).'</p>';
	$theme_info .= '</div>';



	$tabs['theme_info'] = array(
					'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_195_circle_info.png',
					'title' => __('Theme Information', 'nhp-opts'),
					'content' => $theme_info
					);
	
	if(file_exists(trailingslashit(get_stylesheet_directory()).'README.html')){
		$tabs['theme_docs'] = array(
						'icon' => NHP_OPTIONS_URL.'img/glyphicons/glyphicons_071_book.png',
						'title' => __('Documentation', 'nhp-opts'),
						'content' => nl2br(file_get_contents(trailingslashit(get_stylesheet_directory()).'README.html'))
						);
	}//if

	global $NHP_Options;
	$NHP_Options = new NHP_Options($sections, $args, $tabs);

}//function
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value){
	print_r($field);
	print_r($value);

}//function

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value){
	
	$error = false;
	$value =  'just testing';
	/*
	do your validation
	
	if(something){
		$value = $value;
	}elseif(somthing else){
		$error = true;
		$value = $existing_value;
		$field['msg'] = 'your custom error message';
	}
	*/
	
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
	
}//function
?>