<?php
/**
 * Crangasi Theme Customizer
 *
 * @package Crangasi
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function crangasi_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	/////General Settings/////
    $wp_customize->add_section(
        'crangasi_general_settings',
        array(
            'title' => __('General Settings', 'crangasi' ),
            'priority' => 35,
        )
    );
	//Logo Upload
	$wp_customize->add_setting(
		'crangasi_logo',
		array(
			'default-image' => '',
		)
	);
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'crangasi_logo',
            array(
               'label'          => __( 'Upload a logo', 'crangasi' ),
			   'type' 			=> 'image',
               'section'        => 'crangasi_general_settings',
               'settings'       => 'crangasi_logo',
            )
        )
    );
	//Date format
	$wp_customize->add_setting(
		'crangasi_date_format',
		array(
			'default' => 'm-js',
		)
	);
	 
	$wp_customize->add_control(
		'crangasi_date_format',
		array(
			'type' => 'select',
			'label' => __('Choose the date format for the index posts.', 'crangasi'),
			'section' => 'crangasi_general_settings',
			'choices' => array(
				'm-js' => 'Month-Day',
				'js-m' => 'Day-Month'
			),
		)
	);
	/////Single posts/pages/////
    $wp_customize->add_section(
        'crangasi_singles',
        array(
            'title' => __('Single posts/pages', 'crangasi'),
            'priority' => 36,
        )
    );
	//Single posts
	$wp_customize->add_setting(
		'crangasi_post_img',
		array(
			'sanitize_callback' => 'crangasi_sanitize_checkbox',
		)		
	);
	$wp_customize->add_control(
		'crangasi_post_img',
		array(
			'type' => 'checkbox',
			'label' => __('Check this box to show featured images on single posts', 'crangasi'),
			'section' => 'crangasi_singles',
		)
	);
	//Pages
	$wp_customize->add_setting(
		'crangasi_page_img',
		array(
			'sanitize_callback' => 'crangasi_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'crangasi_page_img',
		array(
			'type' => 'checkbox',
			'label' => __('Check this box to show featured images on pages', 'crangasi'),
			'section' => 'crangasi_singles',
		)
	);
	//Author bio
	$wp_customize->add_setting(
		'crangasi_bio',
		array(
			'sanitize_callback' => 'crangasi_sanitize_checkbox',
		)		
	);
	$wp_customize->add_control(
		'crangasi_bio',
		array(
			'type' => 'checkbox',
			'label' => __('Check this box to display the author bio on single posts. You can add your author bio and social links on the Users screen in the Your Profile section.', 'crangasi'),
			'section' => 'crangasi_singles',
		)
	);
	/////Colors/////
	//Site title
	$wp_customize->add_setting(
		'crangasi_sitetitle',
		array(
			'default' => '#fff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'crangasi_sitetitle',
			array(
				'label' => __('Site title color', 'crangasi'),
				'section' => 'colors',
				'settings' => 'crangasi_sitetitle',
				'priority' => 11
			)
		)
	);
	//Site description
	$wp_customize->add_setting(
		'crangasi_sitedesc',
		array(
			'default' => '#969696',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'crangasi_sitedesc',
			array(
				'label' => __('Site description color', 'crangasi'),
				'section' => 'colors',
				'settings' => 'crangasi_sitedesc',
				'priority' => 12
			)
		)
	);
	//Menu links
	$wp_customize->add_setting(
		'crangasi_menu_links',
		array(
			'default' => '#fff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'crangasi_menu_links',
			array(
				'label' => __('Menu links', 'crangasi'),
				'section' => 'colors',
				'settings' => 'crangasi_menu_links',
				'priority' => 13
			)
		)
	);	
	//Color Scheme
	$wp_customize->add_setting(
		'crangasi_colorschemeno0',
		array(
			'default' => '#EC4040',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'crangasi_colorschemeno0',
			array(
				'label' => __('Color scheme: first color', 'crangasi'),
				'section' => 'colors',
				'settings' => 'crangasi_colorschemeno0',
				'priority' => 14
			)
		)
	);
	$wp_customize->add_setting(
		'crangasi_colorschemeno1',
		array(
			'default' => '#3BD893',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'crangasi_colorschemeno1',
			array(
				'label' => __('Color scheme: second color', 'crangasi'),
				'section' => 'colors',
				'settings' => 'crangasi_colorschemeno1',
				'priority' => 15
			)
		)
	);
	$wp_customize->add_setting(
		'crangasi_colorschemeno2',
		array(
			'default' => '#D8603B',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'crangasi_colorschemeno2',
			array(
				'label' => __('Color scheme: third color', 'crangasi'),
				'section' => 'colors',
				'settings' => 'crangasi_colorschemeno2',
				'priority' => 16
			)
		)
	);
	$wp_customize->add_setting(
		'crangasi_colorschemeno3',
		array(
			'default' => '#459EE4',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'crangasi_colorschemeno3',
			array(
				'label' => __('Color scheme: fourth color', 'crangasi'),
				'section' => 'colors',
				'settings' => 'crangasi_colorschemeno3',
				'priority' => 17
			)
		)
	);
	$wp_customize->add_setting(
		'crangasi_colorschemeno4',
		array(
			'default' => '#F3C200',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'crangasi_colorschemeno4',
			array(
				'label' => __('Color scheme: fifth color', 'crangasi'),
				'section' => 'colors',
				'settings' => 'crangasi_colorschemeno4',
				'priority' => 18
			)
		)
	);
	$wp_customize->add_setting(
		'crangasi_colorschemeno5',
		array(
			'default' => '#39D3E0',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'crangasi_colorschemeno5',
			array(
				'label' => __('Color scheme: sixth color', 'crangasi'),
				'section' => 'colors',
				'settings' => 'crangasi_colorschemeno5',
				'priority' => 19
			)
		)
	);
	/////Social/////
    class Crangasi_Social extends WP_Customize_Control {
        public $type = 'social';
        public $desc = '';
        public function render_content() {
        ?>
			<span><?php echo esc_html( $this->desc ); ?></span>
        <?php
        }
    }
    $wp_customize->add_section('crangasi_social', array(
            'title'=>__('Social','crangasi'),
			'priority' => 99
        )
    );     
    $wp_customize->add_setting('crangasi_options[social]', array(
            'default' => '',
            'type' => 'social_control',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
        )
    );
    $wp_customize->add_control( new Crangasi_Social( $wp_customize, 'customtext_control', array(
        'section' => 'crangasi_social',
        'settings' => 'crangasi_options[social]',
        'desc' =>'Setting up social links for your site is easy. All you need to do is go to the Menus section and define a new menu. Fill the new menu with links to your social profiles and assign your new menu to the Social position. For more help on this visit http://flyfreemedia.com/themes/crangasi-wordpress-theme/', 'crangasi')
        ) 
    );
}
add_action( 'customize_register', 'crangasi_customize_register' );


/**
 * Sanitization
 */
	function crangasi_sanitize_checkbox( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}
	function crangasi_sanitize_date_format( $input ) {
		$valid = array(
			'm-js' => 'Month-Day',
			'j-ms' => 'Day-Month',
		);
	 
		if ( array_key_exists( $input, $valid ) ) {
			return $input;
		} else {
			return '';
		}
	}	

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function crangasi_customize_preview_js() {
	wp_enqueue_script( 'crangasi_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'crangasi_customize_preview_js' );
