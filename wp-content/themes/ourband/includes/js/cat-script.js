jQuery(document).ready(function() {	
	var $temp_select = jQuery('select#page_template'),
		$temp_box = jQuery('#gallery_meta_box');
		
	  $temp_select.live('change',function(){
   	var this_value = jQuery(this).val();
		$temp_box.find('.inside > div').css('display','none');
		
		switch ( this_value ) {
			case 'page-gallery.php':
				$temp_box.find('.set_gallery').css('display','block')
				break;
      case 'page-portfolio.php':
				$temp_box.find('.set_portfolio').css('display','block')
				break;
      case 'page-blog.php':
				$temp_box.find('.set_blog').css('display','block')
				break;
			default:
                //$ptemplate_box.find('.set_info').css('display','block');
		}
	});
	
	$temp_select.trigger('change');
});
