<?php
/*-----------------------------------------------------------------------------------*/
/*	Column Shortcodes
/*-----------------------------------------------------------------------------------*/
////////////////////////////////////////////////////////////////////////////
//Full
function mm_one_full( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="one_full"><h3>'.$title.'</h3>'.do_shortcode($content).'</div>';
    return $out;
}
add_shortcode('one_full', 'mm_one_full');
////////////////////////////////////////////////////////////////////////////
//Half
function mm_one_half( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="one_half"><h3>'.$title.'</h3>'.do_shortcode($content).'</div>';
    return $out;
}
add_shortcode('one_half', 'mm_one_half');

function mm_one_half_last( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="one_half column-last"><h3>'.$title.'</h3>'.do_shortcode($content).'</div><div class="clear"></div>';
    return $out;
}
add_shortcode('one_half_last', 'mm_one_half_last');

///////////////////////////////////////////////////////////////////////////
//Third
function mm_one_third( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="one_third"><h3>'.$title.'</h3>'.do_shortcode($content).'</div>';
    return $out;
}
add_shortcode('one_third', 'mm_one_third');

function mm_one_third_last( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="one_third column-last"><h3>'.$title.'</h3>'.do_shortcode($content).'</div><div class="clear"></div>';
    return $out;
}
add_shortcode('one_third_last', 'mm_one_third_last');

function mm_two_third( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="two_third"><h3>'.$title.'</h3>'.do_shortcode($content).'</div>';
    return $out;
}
add_shortcode('two_third', 'mm_two_third');

function mm_two_third_last( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="two_third column-last"><h3>'.$title.'</h3>'.do_shortcode($content).'</div><div class="clear"></div>';
    return $out;
}
add_shortcode('two_third_last', 'mm_two_third_last');

////////////////////////////////////////////////////////////////////////////
//Fourth
function mm_one_fourth( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="one_fourth"><h3>'.$title.'</h3>'.do_shortcode($content).'</div>';
    return $out;
}
add_shortcode('one_fourth', 'mm_one_fourth');

function mm_one_fourth_last( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="one_fourth column-last"><h3>'.$title.'</h3>'.do_shortcode($content).'</div><div class="clear"></div>';
    return $out;
}
add_shortcode('one_fourth_last', 'mm_one_fourth_last');

function mm_three_fourth( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="three_fourth"><h3>'.$title.'</h3>'.do_shortcode($content).'</div>';
    return $out;
}
add_shortcode('three_fourth', 'mm_three_fourth');

function mm_three_fourth_last( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="three_fourth column-last"><h3>'.$title.'</h3>'.do_shortcode($content).'</div><div class="clear"></div>';
    return $out;
}
add_shortcode('three_fourth_last', 'mm_three_fourth_last');

////////////////////////////////////////////////////////////////////////////
//Fifth
function mm_one_fifth( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="one_fifth"><h3>'.$title.'</h3>'.do_shortcode($content).'</div>';
    return $out;
}
add_shortcode('one_fifth', 'mm_one_fifth');

function mm_one_fifth_last( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="one_fifth column-last"><h3>'.$title.'</h3>'.do_shortcode($content).'</div><div class="clear"></div>';
    return $out;
}
add_shortcode('one_fifth_last', 'mm_one_fifth_last');

function mm_two_fifth( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="two_fifth"><h3>'.$title.'</h3>'.do_shortcode($content).'</div>';
    return $out;
}
add_shortcode('two_fifth', 'mm_two_fifth');

function mm_two_fifth_last( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="two_fifth column-last"><h3>'.$title.'</h3>'.do_shortcode($content).'</div><div class="clear"></div>';
    return $out;
}
add_shortcode('two_fifth_last', 'mm_two_fifth_last');

function mm_three_fifth( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="three_fifth"><h3>'.$title.'</h3>'.do_shortcode($content).'</div>';
    return $out;
}
add_shortcode('three_fifth', 'mm_three_fifth');

function mm_three_fifth_last( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="three_fifth column-last"><h3>'.$title.'</h3>'.do_shortcode($content).'</div><div class="clear"></div>';
    return $out;
}
add_shortcode('three_fifth_last', 'mm_three_fifth_last');

function mm_fourth_fifth( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="fourth_fifth"><h3>'.$title.'</h3>'.do_shortcode($content).'</div>';
    return $out;
}
add_shortcode('fourth_fifth', 'mm_fourth_fifth');

function mm_fourth_fifth_last( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="fourth_fifth column-last"><h3>'.$title.'</h3>'.do_shortcode($content).'</div><div class="clear"></div>';
    return $out;
}
add_shortcode('fourth_fifth_last', 'mm_fourth_fifth_last');

//////////////////////////////////////////////////////////////////////////
//sixth
function mm_one_sixth( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="one_sixth"><h3>'.$title.'</h3>'.do_shortcode($content).'</div>';
    return $out;
}
add_shortcode('one_sixth', 'mm_one_sixth');

function mm_one_sixth_last( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="one_sixth column-last"><h3>'.$title.'</h3>'.do_shortcode($content).'</div><div class="clear"></div>';
    return $out;
}
add_shortcode('one_sixth_last', 'mm_one_sixth_last');

function mm_five_sixth( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="five_sixth"><h3>'.$title.'</h3>'.do_shortcode($content).'</div>';
    return $out;
}
add_shortcode('five_sixth', 'mm_five_sixth');

function mm_five_sixth_last( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => ''
		), $atts));
	$out = '<div class="five_sixth column-last"><h3>'.$title.'</h3>'.do_shortcode($content).'</div><div class="clear"></div>';
    return $out;
}
add_shortcode('five_sixth_last', 'mm_five_sixth_last');
?>