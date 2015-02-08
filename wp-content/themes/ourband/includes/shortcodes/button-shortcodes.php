<?php
/*-----------------------------------------------------------------------------------*/
/*	Buttons Shortcodes
/*-----------------------------------------------------------------------------------*/
//Big buttons
function mm_bigbutton( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'url'     	 => '#',
    'color'      => 'grey',
		'target'     => '_self'
    ), $atts));
    
    if($color=='grey'){$class='grey_big_button';}
    elseif($color=='blue'){$class='blue_big_button';}
    elseif($color=='red'){$class='red_big_button';}
    elseif($color=='green'){$class='green_big_button';}
    elseif($color=='black'){$class='black_big_button';}
    elseif($color=='yellow'){$class='yellow_big_button';}
    elseif($color=='brown'){$class='brown_big_button';}
    elseif($color=='pink'){$class='pink_big_button';}
    
	$out = '<a href="'.$url.'" target="'.$target.'" class="big_button '.$class.'">'.do_shortcode($content).'</a>';
    return $out;
}
add_shortcode('bigbutton','mm_bigbutton');

//Small buttons
function mm_smallbutton( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'url'     	 => '#',
    'color'      => 'grey',
		'target'     => '_self'
    ), $atts));
    
    if($color=='grey'){$class='grey_small_button';}
    elseif($color=='blue'){$class='blue_small_button';}
    elseif($color=='red'){$class='red_small_button';}
    elseif($color=='green'){$class='green_small_button';}
    elseif($color=='black'){$class='black_small_button';}
    elseif($color=='pink'){$class='pink_small_button';}
    elseif($color=='brown'){$class='brown_small_button';}
    elseif($color=='aqua'){$class='aqua_small_button';}
    elseif($color=='yellow'){$class='yellow_small_button';}
    elseif($color=='orange'){$class='orange_small_button';}
    elseif($color=='softblue'){$class='softblue_small_button';}
    elseif($color=='darkblue'){$class='darkblue_small_button';}
    
	$out = '<a href="'.$url.'" target="'.$target.'" class="small_button '.$class.'">'.do_shortcode($content).'</a>';
    return $out;
}
add_shortcode('smallbutton','mm_smallbutton');

//Small buttons
function mm_icobutton( $atts, $content = null ) {
    extract(shortcode_atts(array(
		'url'     	 => '#',
    'ico'      => '1'
    ), $atts));
    
    if($ico=='1'){$class='ico_button_1';}
    elseif($ico=='2'){$class='ico_button_2';}
    elseif($ico=='3'){$class='ico_button_3';}
    elseif($ico=='4'){$class='ico_button_4';}
    elseif($ico=='5'){$class='ico_button_5';}
    elseif($ico=='6'){$class='ico_button_6';}
    elseif($ico=='7'){$class='ico_button_7';}
    elseif($ico=='8'){$class='ico_button_8';}
    elseif($ico=='9'){$class='ico_button_9';}
    elseif($ico=='10'){$class='ico_button_10';}
    elseif($ico=='11'){$class='ico_button_11';}
    elseif($ico=='12'){$class='ico_button_12';}
    elseif($ico=='13'){$class='ico_button_13';}
    elseif($ico=='14'){$class='ico_button_14';}
    elseif($ico=='15'){$class='ico_button_15';}
    elseif($ico=='16'){$class='ico_button_16';}
    elseif($ico=='17'){$class='ico_button_17';}
    elseif($ico=='18'){$class='ico_button_18';}
    elseif($ico=='19'){$class='ico_button_19';}
    elseif($ico=='20'){$class='ico_button_20';}
    elseif($ico=='21'){$class='ico_button_21';}
    elseif($ico=='22'){$class='ico_button_22';}
    elseif($ico=='23'){$class='ico_button_23';}
    elseif($ico=='24'){$class='ico_button_24';}
    elseif($ico=='25'){$class='ico_button_25';}
    elseif($ico=='26'){$class='ico_button_26';}
    elseif($ico=='27'){$class='ico_button_27';}
    elseif($ico=='28'){$class='ico_button_28';}
    elseif($ico=='29'){$class='ico_button_29';}
    elseif($ico=='30'){$class='ico_button_30';}
    elseif($ico=='31'){$class='ico_button_31';}
    elseif($ico=='32'){$class='ico_button_32';}
    elseif($ico=='33'){$class='ico_button_33';}
    elseif($ico=='34'){$class='ico_button_34';}
    elseif($ico=='35'){$class='ico_button_35';}
    elseif($ico=='36'){$class='ico_button_36';}
    elseif($ico=='37'){$class='ico_button_37';}
    elseif($ico=='38'){$class='ico_button_38';}
    elseif($ico=='39'){$class='ico_button_39';}
    elseif($ico=='40'){$class='ico_button_40';}
    elseif($ico=='41'){$class='ico_button_41';}
    elseif($ico=='42'){$class='ico_button_42';}
    elseif($ico=='43'){$class='ico_button_43';}
    elseif($ico=='44'){$class='ico_button_44';}
    elseif($ico=='45'){$class='ico_button_45';}
    elseif($ico=='46'){$class='ico_button_46';}
    elseif($ico=='47'){$class='ico_button_47';}
    elseif($ico=='48'){$class='ico_button_48';}
    elseif($ico=='49'){$class='ico_button_49';}
    elseif($ico=='50'){$class='ico_button_50';}
    elseif($ico=='51'){$class='ico_button_51';}
    elseif($ico=='52'){$class='ico_button_52';}
    elseif($ico=='53'){$class='ico_button_53';}
    elseif($ico=='54'){$class='ico_button_54';}
    elseif($ico=='55'){$class='ico_button_55';}
    elseif($ico=='56'){$class='ico_button_56';}
    elseif($ico=='57'){$class='ico_button_57';}
    elseif($ico=='58'){$class='ico_button_58';}
    elseif($ico=='59'){$class='ico_button_59';}
    elseif($ico=='60'){$class='ico_button_60';}
    elseif($ico=='61'){$class='ico_button_61';}
    elseif($ico=='62'){$class='ico_button_62';}
    elseif($ico=='63'){$class='ico_button_63';}
    elseif($ico=='64'){$class='ico_button_64';}
    elseif($ico=='65'){$class='ico_button_65';}
    elseif($ico=='66'){$class='ico_button_66';}
    elseif($ico=='67'){$class='ico_button_67';}
    elseif($ico=='68'){$class='ico_button_68';}
    elseif($ico=='69'){$class='ico_button_69';}
    elseif($ico=='70'){$class='ico_button_70';}
    elseif($ico=='71'){$class='ico_button_71';}
    elseif($ico=='72'){$class='ico_button_72';}
    elseif($ico=='73'){$class='ico_button_73';}
    elseif($ico=='74'){$class='ico_button_74';}
    elseif($ico=='75'){$class='ico_button_75';}
    elseif($ico=='76'){$class='ico_button_76';}
    elseif($ico=='77'){$class='ico_button_77';}
    elseif($ico=='78'){$class='ico_button_78';}
    elseif($ico=='79'){$class='ico_button_79';}
    elseif($ico=='80'){$class='ico_button_80';}
    elseif($ico=='81'){$class='ico_button_81';}
    elseif($ico=='82'){$class='ico_button_82';}
    elseif($ico=='83'){$class='ico_button_83';}
    elseif($ico=='84'){$class='ico_button_84';}
    elseif($ico=='85'){$class='ico_button_85';}
    elseif($ico=='86'){$class='ico_button_86';}
    elseif($ico=='87'){$class='ico_button_87';}
    elseif($ico=='88'){$class='ico_button_88';}
    elseif($ico=='89'){$class='ico_button_89';}
    elseif($ico=='90'){$class='ico_button_90';}
    elseif($ico=='91'){$class='ico_button_91';}
    elseif($ico=='92'){$class='ico_button_92';}
    elseif($ico=='93'){$class='ico_button_93';}
    elseif($ico=='94'){$class='ico_button_94';}
    elseif($ico=='95'){$class='ico_button_95';}
    elseif($ico=='96'){$class='ico_button_96';}
    elseif($ico=='97'){$class='ico_button_97';}
    elseif($ico=='98'){$class='ico_button_98';}
    elseif($ico=='99'){$class='ico_button_99';}
    elseif($ico=='100'){$class='ico_button_100';}
    elseif($ico=='101'){$class='ico_button_101';}
    elseif($ico=='102'){$class='ico_button_102';}
    elseif($ico=='103'){$class='ico_button_103';}
    elseif($ico=='104'){$class='ico_button_104';}
    elseif($ico=='105'){$class='ico_button_105';}
    elseif($ico=='106'){$class='ico_button_106';}
    elseif($ico=='107'){$class='ico_button_107';}
    elseif($ico=='108'){$class='ico_button_108';}
    elseif($ico=='109'){$class='ico_button_109';}
    elseif($ico=='110'){$class='ico_button_110';}
    elseif($ico=='111'){$class='ico_button_111';}
    elseif($ico=='112'){$class='ico_button_112';}
    elseif($ico=='113'){$class='ico_button_113';}
    elseif($ico=='114'){$class='ico_button_114';}
    elseif($ico=='115'){$class='ico_button_115';}
    elseif($ico=='116'){$class='ico_button_116';}
    elseif($ico=='117'){$class='ico_button_117';}
    elseif($ico=='118'){$class='ico_button_118';}
    elseif($ico=='119'){$class='ico_button_119';}
    elseif($ico=='120'){$class='ico_button_120';}
    elseif($ico=='121'){$class='ico_button_121';}
    elseif($ico=='122'){$class='ico_button_122';}
    elseif($ico=='123'){$class='ico_button_123';}
    elseif($ico=='124'){$class='ico_button_124';}
    elseif($ico=='125'){$class='ico_button_125';}
    elseif($ico=='126'){$class='ico_button_126';}
    elseif($ico=='127'){$class='ico_button_127';}
    elseif($ico=='128'){$class='ico_button_128';}
    elseif($ico=='129'){$class='ico_button_129';}
    elseif($ico=='130'){$class='ico_button_130';}
    elseif($ico=='131'){$class='ico_button_131';}
    elseif($ico=='132'){$class='ico_button_132';}
    elseif($ico=='133'){$class='ico_button_133';}
    elseif($ico=='134'){$class='ico_button_134';}
    elseif($ico=='135'){$class='ico_button_135';}
    elseif($ico=='136'){$class='ico_button_136';}
    elseif($ico=='137'){$class='ico_button_137';}
    elseif($ico=='138'){$class='ico_button_138';}
    elseif($ico=='139'){$class='ico_button_139';}
    elseif($ico=='140'){$class='ico_button_140';}
    elseif($ico=='141'){$class='ico_button_141';}
    elseif($ico=='142'){$class='ico_button_142';}
    elseif($ico=='143'){$class='ico_button_143';}
    elseif($ico=='144'){$class='ico_button_144';}
    elseif($ico=='145'){$class='ico_button_145';}
    elseif($ico=='146'){$class='ico_button_146';}
    elseif($ico=='147'){$class='ico_button_147';}
    elseif($ico=='148'){$class='ico_button_148';}
    elseif($ico=='149'){$class='ico_button_149';}
    elseif($ico=='150'){$class='ico_button_150';}
    elseif($ico=='151'){$class='ico_button_151';}
    elseif($ico=='152'){$class='ico_button_152';}
    elseif($ico=='153'){$class='ico_button_153';}
    elseif($ico=='154'){$class='ico_button_154';}
    elseif($ico=='155'){$class='ico_button_155';}
    elseif($ico=='156'){$class='ico_button_156';}
    elseif($ico=='157'){$class='ico_button_157';}
    elseif($ico=='158'){$class='ico_button_158';}
    elseif($ico=='159'){$class='ico_button_159';}
    elseif($ico=='160'){$class='ico_button_160';}
    
    
	$out = '<a href="'.$url.'" class="ico_button '.$class.'"><span></span>'.do_shortcode($content).'</a>';
    return $out;
}
add_shortcode('icobutton','mm_icobutton');


?>