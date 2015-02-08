<?php


function my_style_load(){  
    wp_register_style( 'shortcodes', get_template_directory_uri() . '/includes/shortcodes/shortcodes.css' );  
    wp_enqueue_style( 'shortcodes' );  
}  
add_action( 'wp_enqueue_scripts', 'my_style_load' );  

function my_script_load(){
wp_register_script( 'shortcodes', get_template_directory_uri() . '//includes/shortcodes/shortcodes.js' );
    wp_enqueue_script('shortcodes');
}
add_action('wp_enqueue_scripts', 'my_script_load');

include 'button-shortcodes.php';
include 'column-shortcodes.php';
include 'boxes-shortcodes.php';

/*-----------------------------------------------------------------------------------*/
/*	Toggle Shortcodes
/*-----------------------------------------------------------------------------------*/
function mm_togglecontent($atts, $content = null) {
	global $themename;
	
	extract(shortcode_atts(array(
				"title" => 'Display more info',
				"show" => 'close',
				"id" => '',
				"class" => ''
			), $atts));

  if ($id==''){$id='';}else{$id=' id="'.$id.'"';}
  if ($class==''){$class='';}else{$class=' class="'.$class.'"';}
  if ($show=='close'){$stat='togglecontent';}else{$stat='togglecontent tg-open';}
  if ($show=='close'){$tit='toggletitle';}else{$tit='toggletitle open';}
	
  
	$output = '
    <div '.$id.' class="'.$stat.' '.$class.'">
		  <div class="'.$tit.'">
        <h3>'.$title.'</h3>
        <div class="toggle-plus"></div>
      </div>
			<div class="toggle-content">'.$content.'</div>
    </div>';
	return $output;
}

add_shortcode('togglecontent','mm_togglecontent');

/*-----------------------------------------------------------------------------------*/
/*	Tooltip Shortcodes
/*-----------------------------------------------------------------------------------*/

function mm_tooltip($atts, $content = null) {
	extract(shortcode_atts(array(
				"text" => 'Add a Tooltip Text',
				"id" => '',
				"class" => ''
			), $atts));
	if ( $id=='' ){ $id = ''; }else{ $id = ' id="'.$id.'"'; }
	$out = '<span "'.$id.'" class="mm-tooltip '.$class.'">'.$content.'<span class="mm-tooltip-box">'.$text.'<span class="mm-tooltip-arrow"></span></span></span>';
	
	return $out;
}

add_shortcode('tooltip', 'mm_tooltip');


/*-----------------------------------------------------------------------------------*/
/*	Author Box Shortcodes
/*-----------------------------------------------------------------------------------*/

function mm_author_box($atts, $content = null) { 	
  extract(shortcode_atts(array(
				'imglink' => get_template_directory_uri().'/includes/shortcodes/images/author-foto.png',
				'authorname' => 'Author name'
			), $atts));
      
$out = '<div class="authors-info">
        <div class="authors-inner">
          <div class="authors-image">
            <img src="'.$imglink.'" alt="'.$authorname.'" title="'.$authorname.'"/>
          </div>
          <div class="authors-bio"><h4>'.$authorname.'</h4><p>'.$content.'</p>
          </div>
        </div>
        </div>
        <div style="clear"></div>';

return $out;

}
add_shortcode('authorbox', 'mm_author_box');

/*-----------------------------------------------------------------------------------*/
/*	Custom list Shortcodes
/*-----------------------------------------------------------------------------------*/

function mm_customlist($atts, $content = null) {
	extract(shortcode_atts(array(
				"style" => 'check'
			), $atts));
	
	$out = '<div class="custom-list '.$style.'">'.$content.'</div>';
	
	return $out;
}

add_shortcode('customlist', 'mm_customlist');

/*-----------------------------------------------------------------------------------*/
/*	Testimonials Shortcodes
/*-----------------------------------------------------------------------------------*/

 function mm_testimonials($atts, $content = null) {
	extract(shortcode_atts(array(
				'imglink' => get_template_directory_uri().'/includes/shortcodes/images/testimonial-img.png',
        'name' => 'Your name',
        'company' => 'My company'
			), $atts));
	
	$out = '<div class="testimonials">
            <div class="t-top">
              <img src="'.$imglink.'" alt="Testimonials photo">
              <img class="quote" src="'.get_template_directory_uri().'/includes/shortcodes/images/ico-quote.png" alt="Quote">
            '.$content.'
            </div>
            <div class="t-down">
              <p class="t-name">'.$name.'</p>
              <p class="t-company">'.$company.'</p>
              <div class="t-arrow"></div>
            </div>
          </div>';
	
	return $out;
}

add_shortcode('testimonials', 'mm_testimonials');

/*-----------------------------------------------------------------------------------*/
/*	Tabbed content Shortcodes
/*-----------------------------------------------------------------------------------*/

function jquery_tab_group( $atts, $content ){
$GLOBALS['tab_count'] = 0;

do_shortcode( $content );

if( is_array ( $GLOBALS['tabs'] ) ){
$int = '1';

foreach( $GLOBALS['tabs'] as $tab ){
if ($int==1){$act='class="act"';}else{$act='';}
$tabs[] = '<li><a '.$act.' id="t-'.$int.'">'.$tab['title'].'</a></li>';
$panes[] = '
<div '.$act.' id="tabbeds-t-'.$int.'">'.$tab['content'].'</div>
';
$int++;
}
$return = '<div class="tabbed">
            <ul class="tabbeds">'.implode ( "\n", $tabs ).'</ul>
            <div class="tabbeds-content">'.implode ( "\n", $panes ).'</div>
          </div>';
}
return $return;
}

add_shortcode( 'tabgroup', 'jquery_tab_group' );


function jquery_tab( $atts, $content ){
extract (shortcode_atts(array (
    'title' => 'Tab'
    ), $atts));

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array ( 'title' => sprintf ( $title, $GLOBALS['tab_count'] ), 'content' => $content );

$GLOBALS['tab_count']++;
}

add_shortcode( 'tab', 'jquery_tab' );

function my_tab_group( $atts, $content ){
$GLOBALS['tab_count'] = 0;

do_shortcode( $content );

if( is_array ( $GLOBALS['tabs'] ) ){
$int = '1';

foreach( $GLOBALS['tabs'] as $tab ){
if ($int==1){$act='class="acts"';}else{$act='';}
$tabs[] = '<li '.$act.' id="mt-'.$int.'"><a>'.$tab['title'].'</a></li>';
$panes[] = '
<div '.$act.' id="my_tabbeds-mt-'.$int.'">'.$tab['content'].'</div>
';
$int++;
}
$return = '<div class="my_tabbed">
            <ul class="my_tabbeds">'.implode ( "\n", $tabs ).'</ul>
            <div class="my_tabbeds-content">'.implode ( "\n", $panes ).'</div>
          </div>';
}
return $return;
}

add_shortcode( 'my_tabgroup', 'my_tab_group' );


function my_tab( $atts, $content ){
extract (shortcode_atts(array (
    'title' => 'Tab'
    ), $atts));

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array ( 'title' => sprintf ( $title, $GLOBALS['tab_count'] ), 'content' => $content );

$GLOBALS['tab_count']++;
}

add_shortcode( 'my_tab', 'my_tab' );

/*-----------------------------------------------------------------------------------*/
/*	Nivo Slider Shortcodes
/*-----------------------------------------------------------------------------------*/

function mm_nivo_slider($atts, $content = null){
		 extract(shortcode_atts(array(
				'effect' => 'slideInLeft',
        'speed' => 300,
        'pause' => 4000
			), $atts));
    
    $out = '
    <script>
$(window).load(function() {
$(\'#my-nivo-slider\').nivoSlider({
        effect: \''.$effect.'\',
        slices: 15,
        boxCols: 8,
        boxRows: 4,
        animSpeed: '.$speed.',
        pauseTime: '.$pause.',
        startSlide: 0,
        directionNav: true,
        controlNav: true,
        controlNavThumbs: true,
        pauseOnHover: true,
        manualAdvance: false,
        prevText: \'\',
        nextText: \'\',
        randomStart: false,
        beforeChange: function(){},
        afterChange: function(){},
        slideshowEnd: function(){},
        lastSlide: function(){},
        afterLoad: function(){}
    });
});    
</script>   
    <div class="short-slide-wrap">
    <div id="my-nivo-slider"  class="nivoSlider">
		        '.$content.'				
    </div>
    </div>';
	return $out;
}

add_shortcode('my_nivo_slider','mm_nivo_slider');

/*-----------------------------------------------------------------------------------*/
/*	Password Protected Shortcodes
/*-----------------------------------------------------------------------------------*/

function mm_protected($atts, $content = null){
	global $themename, $user_login;
	
		$out = '<div class="form-protected">
						<form action="'.site_url('wp-login.php').'" method="post">
							<p>
                <label>Username:</label>
                <input type="text" name="log" id="log" value="'.$user_login.'" onfocus="if(this.value==\''.$user_login.'\')this.value=\'\';" onblur="if(this.value==\'\')this.value=\''.$user_login.'\';" size="20" />
              </p>
							<p>
                <label>Password:</label>
                <input type="password" name="pwd" id="pwd" size="20" /><span class="et_protected_icon et_protected_password">
              </p>
							<input type="submit" name="submit" value="Login" class="login-button" />
							<input type="hidden" name="redirect_to" value="'.get_permalink().'">
						</form> 
				    <p class="form-member">Not a member?<a href="'.get_site_url() .'/wp-login.php?action=register">Register today!</a></p>
            </div>';

	
	return $out;
}

add_shortcode('protected','mm_protected');

/*-----------------------------------------------------------------------------------*/
/*	Price Tabs Shortcodes
/*-----------------------------------------------------------------------------------*/

 function mm_price_tables($atts, $content = null) {
	extract(shortcode_atts(array(
				'title' => 'The name',
        'currency' => '$',
        'price' => '19',
        'time' => 'MO',
        'style' => 'b-color',
        'carturl' => '#',
        'button' => 'ADD TO CART'
     	), $atts));
	
	$out = '<div class="price-wrap">
            <div class="price-tabs">
              <div class="price-top">              
                <h3>'.$title.'</h3>
              </div>
              <div class="price-n-wrap">
                <div class="price-n '.$style.'">'.$currency.' <span>'.$price.'</span>/'.$time.'</div>
              </div>
            '.do_shortcode($content).'
              <div class="price-cart '.$style.'">
                <a class="'.$style.'" href="'.$carturl.'">'.$button.'</a>
              </div>  
            </div>
            <div class="price-shadow"></div>
          </div>
          ';
	
	return $out;
}

add_shortcode('price_table', 'mm_price_tables');

function mm_ok_item($atts, $content = null) {
	$out = '<p class="ok_item">'.$content.'</p>';
	return $out;
}

add_shortcode('ok_item', 'mm_ok_item');

function mm_er_item($atts, $content = null) {
	$out = '<p class="er_item">'.$content.'</p>';
	return $out;
}

add_shortcode('er_item', 'mm_er_item');

/*-----------------------------------------------------------------------------------*/
/*	Quote Shortcodes
/*-----------------------------------------------------------------------------------*/

function mm_quote($atts, $content = null) {
	extract(shortcode_atts(array(
				'title' => 'The name',
        'currency' => '$',
        'price' => '19',
        'time' => 'MO',
        'style' => 'b-color',
        'carturl' => '#',
        'button' => 'ADD TO CART'
     	), $atts));
	
	$out = '<div class="quote-box">
            <img class="quote-big" src="'.get_template_directory_uri().'/includes/shortcodes/images/ico-quote-big.png" alt="Quote">  
            '.$content.'
          </div>
          ';
	
	return $out;
}

add_shortcode('quote', 'mm_quote');

/*-----------------------------------------------------------------------------------*/
/*	Simple table Shortcodes
/*-----------------------------------------------------------------------------------*/

function simple_table( $atts ) {
    extract( shortcode_atts( array(
        'cols' => 'none',
        'data' => 'none',
    ), $atts ) );
    $cols = explode(',',$cols);
    $data = explode(',',$data);
    $total = count($cols);
    $output .= '<table class="shortcode-simple-table"><tr class="th">';
    foreach($cols as $col):
        $output .= '<td>'.$col.'</td>';
    endforeach;
    $output .= '</tr><tr>';
    $counter = 1;
    foreach($data as $datum):
        $output .= '<td>'.$datum.'</td>';
        if($counter%$total==0):
            $output .= '</tr>';
        endif;
        $counter++;
    endforeach;
        $output .= '</table>';
    return $output;
}
add_shortcode( 'table', 'simple_table' );
    
    
?>