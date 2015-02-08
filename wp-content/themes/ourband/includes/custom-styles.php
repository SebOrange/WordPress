<?php 

//Body font
add_action( 'wp_head', 'custom_font_styles' );
function custom_font_styles(){

  $options = get_option('basic');
  
  if ($options['google_webfonts'] && $options['google_webfonts']!='None'){
  
  $font_style = '';
  $font_style .= "<link href='".$GLOBALS['gfonts'][$options['google_webfonts']]['url']."' rel='stylesheet' type='text/css'>
  ";
  $font_style .= "<style type='text/css'>
      body { font-family:".$GLOBALS['gfonts'][$options['google_webfonts']]['family'].",".$GLOBALS['gfonts'][$options['google_webfonts']]['type'].";  }
      </style>
      ";
  echo $font_style;
  }
}



//Titles font
add_action( 'wp_head', 'custom_titles_fonts' );
function custom_titles_fonts(){

  $options = get_option('basic');
  
  if ($options['titles_webfonts'] && $options['titles_webfonts']!='None'){
  
  $font_style = '';
  $font_style .= "<link href='".$GLOBALS['gfonts'][$options['titles_webfonts']]['url']."' rel='stylesheet' type='text/css'>
  ";
  $font_style .= "<style type='text/css'>
      h1,h2,h3,h4,h5,h6,.page-title,.entry-title { font-family:".$GLOBALS['gfonts'][$options['titles_webfonts']]['family'].",".$GLOBALS['gfonts'][$options['titles_webfonts']]['type'].";  }
      </style>
      ";
  echo $font_style;
  }
 } 



//Body text color
add_action( 'wp_head', 'body_text_color' );
function body_text_color(){
  $options = get_option('basic');
  
  if ($options['body_text_color']){
  $color_style = '';
  $color_style .= "<style type='text/css'>
      body { color:#".$options['body_text_color'].";  }
      </style>
      ";
  echo $color_style;
  }
}



//Titles text color
add_action( 'wp_head', 'titles_color' );
function titles_color(){
  $options = get_option('basic');
  
  if ($options['titles_color']){
  $color_style = '';
  $color_style .= "<style type='text/css'>
      h1,h2,h3,h4,h5,h6,.page-title,.entry-title {color:#".$options['titles_color'].";  }
      </style>
      ";
  echo $color_style;
  }
}  



//Anchor text color
add_action( 'wp_head', 'anchors_color' );
function anchors_color(){
  $options = get_option('basic');
  
  if ($options['anchors_color']){
  $color_style = '';
  $color_style .= "<style type='text/css'>
      a {color:#".$options['anchors_color'].";  }
      </style>
      ";
  echo $color_style;
  } 
}  



//Body background color
add_action( 'wp_head', 'body_background_color' );
function body_background_color(){
  $options = get_option('basic');
  
  if ($options['background_color']){
  $color_style = '';
  $color_style .= "<style type='text/css'>
      body {background-color:#".$options['background_color'].";  }
      </style>
      ";
  echo $color_style;
  }    
}






?>