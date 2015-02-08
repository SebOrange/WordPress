<?php
/*-----------------------------------------------------------------------------------*/
/*	Content Boxes Shortcodes
/*-----------------------------------------------------------------------------------*/

function mm_contbox_third( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => '',
    'color'     	 => ''
		), $atts));
    
    if($color == 'red'){$ico='cb-red-ico';}
    elseif($color == 'green'){$ico='cb-green-ico';}
    elseif($color == 'blue'){$ico='cb-blue-ico';}
    elseif($color == 'black'){$ico='cb-black-ico';}
    elseif($color == 'normal'){$ico='cb-normal-ico';}
    elseif($color == ''){$ico='cb-normal-ico';}      
    
	$out = '<div class="content_box one_third '.$color.'"><h3><span class="'.$ico.'"></span>'.$title.'</h3><div class="cb-content">'.do_shortcode($content).'</div></div>';
    return $out;
}
add_shortcode('contbox_third', 'mm_contbox_third');

function mm_contbox_third_last( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => '',
    'color'     	 => ''
		), $atts));
    if ($color == 'red'){$ico='cb-red-ico';}
    elseif($color == 'green'){$ico='cb-green-ico';}
    elseif($color == 'blue'){$ico='cb-blue-ico';}
    elseif($color == 'black'){$ico='cb-black-ico';}
    elseif($color == 'normal'){$ico='cb-normal-ico';}
    elseif($color == ''){$ico='cb-normal-ico';}     
    
	$out = '<div class="content_box one_third column-last '.$color.'"><h3><span class="'.$ico.'"></span>'.$title.'</h3><div class="cb-content">'.do_shortcode($content).'</div></div><div class="clear"></div>';
    return $out;
}
add_shortcode('contbox_third_last', 'mm_contbox_third_last');

function mm_contbox_half( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => '',
    'color'     	 => ''
		), $atts));
    
    if($color == 'red'){$ico='cb-red-ico';}
    elseif($color == 'green'){$ico='cb-green-ico';}
    elseif($color == 'blue'){$ico='cb-blue-ico';}
    elseif($color == 'black'){$ico='cb-black-ico';}
    elseif($color == 'normal'){$ico='cb-normal-ico';}
    elseif($color == ''){$ico='cb-normal-ico';}      
    
	$out = '<div class="content_box one_half '.$color.'"><h3><span class="'.$ico.'"></span>'.$title.'</h3><div class="cb-content">'.do_shortcode($content).'</div></div>';
    return $out;
}
add_shortcode('contbox_half', 'mm_contbox_half');

function mm_contbox_half_last( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => '',
    'color'     	 => ''
		), $atts));
    if ($color == 'red'){$ico='cb-red-ico';}
    elseif($color == 'green'){$ico='cb-green-ico';}
    elseif($color == 'blue'){$ico='cb-blue-ico';}
    elseif($color == 'black'){$ico='cb-black-ico';}
    elseif($color == 'normal'){$ico='cb-normal-ico';}
    elseif($color == ''){$ico='cb-normal-ico';}     
    
	$out = '<div class="content_box one_half column-last '.$color.'"><h3><span class="'.$ico.'"></span>'.$title.'</h3><div class="cb-content">'.do_shortcode($content).'</div></div><div class="clear"></div>';
    return $out;
}
add_shortcode('contbox_half_last', 'mm_contbox_half_last');

function mm_contbox_full( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'title'     	 => '',
    'color'     	 => ''
		), $atts));
    
    if($color == 'red'){$ico='cb-red-ico';}
    elseif($color == 'green'){$ico='cb-green-ico';}
    elseif($color == 'blue'){$ico='cb-blue-ico';}
    elseif($color == 'black'){$ico='cb-black-ico';}
    elseif($color == 'normal'){$ico='cb-normal-ico';}
    elseif($color == ''){$ico='cb-normal-ico';}      
    
	$out = '<div class="content_box one_full '.$color.'"><h3><span class="'.$ico.'"></span>'.$title.'</h3><div class="cb-content">'.do_shortcode($content).'</div></div>';
    return $out;
}
add_shortcode('contbox_full', 'mm_contbox_full');

/*-----------------------------------------------------------------------------------*/
/*	Small Boxes Shortcodes
/*-----------------------------------------------------------------------------------*/

function mm_smallbox_third( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'color'     	 => ''
		), $atts));
    
    if($color == 'red'){$ico='sb-red-ico';}
    elseif($color == 'green'){$ico='sb-green-ico';}
    elseif($color == 'blue'){$ico='sb-blue-ico';}
    elseif($color == 'yellow'){$ico='sb-yellow-ico';}
    elseif($color == ''){$ico='sb-red-ico';}      
    
	$out = '<div class="small_box one_third '.$color.'"><span class="'.$ico.'"></span>'.do_shortcode($content).'</div><div class="clear"></div>';
    return $out;
}
add_shortcode('smallbox_third', 'mm_smallbox_third');

function mm_smallbox_half( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'color'     	 => ''
		), $atts));
    
    if($color == 'red'){$ico='sb-red-ico';}
    elseif($color == 'green'){$ico='sb-green-ico';}
    elseif($color == 'blue'){$ico='sb-blue-ico';}
    elseif($color == 'yellow'){$ico='sb-yellow-ico';}
    elseif($color == ''){$ico='sb-red-ico';}      
    
	$out = '<div class="small_box one_half '.$color.'"><span class="'.$ico.'"></span>'.do_shortcode($content).'</div><div class="clear"></div>';
    return $out;
}
add_shortcode('smallbox_half', 'mm_smallbox_half');

function mm_smallbox_full( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'color'     	 => ''
		), $atts));
    
    if($color == 'red'){$ico='sb-red-ico';}
    elseif($color == 'green'){$ico='sb-green-ico';}
    elseif($color == 'blue'){$ico='sb-blue-ico';}
    elseif($color == 'yellow'){$ico='sb-yellow-ico';}
    elseif($color == ''){$ico='sb-red-ico';}      
    
	$out = '<div class="small_box one_full '.$color.'"><span class="'.$ico.'"></span>'.do_shortcode($content).'</div><div class="clear"></div>';
    return $out;
}
add_shortcode('smallbox_full', 'mm_smallbox_full');
?>