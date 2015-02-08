jQuery(document).ready(function($){
  //Toggle content
	$tog_cont = $('.togglecontent .toggletitle');
  $tog_cont.on('click', function() {
		if ( $(this).hasClass('open') ) 
			$(this).removeClass('open');
		else 
			$(this).addClass('open');
		$(this).parent('.togglecontent').find('.toggle-content').animate({ opacity: 'toggle', height: 'toggle' }, 300);
  });
	
	$('.togglecontent').not('.tg-open').find('.toggle-content').css( { 'visibility' : 'visible', 'display' : 'none' } );
  
  //Tooltip
  $mm_tooltip = $('.mm-tooltip');
	$mm_tooltip.on('mouseover mouseout', function(event){
		if (event.type == 'mouseover') {
			$(this).find('.mm-tooltip-box').animate({ opacity: 'show', bottom: '25px' }, 300);
		} else {
			$(this).find('.mm-tooltip-box').animate({ opacity: 'hide', bottom: '35px' }, 300);
		}
	});  
 
  //Tabbed content
  $mm_tabbed = $('.tabbeds li a');
	$mm_tabbed.on('click', function(){
		var currentId = $(this).attr('id');
    var curentClass = $(this).attr('class');
    if (curentClass!='act'){
    $('a.act').removeClass('act');
    $(this).addClass('act');
    $('div.act').removeClass('act');
    $('#tabbeds-'+currentId).addClass('act');
    }
	});
  //My Tabbed content
  $mm_tabbed = $('.my_tabbeds li');
	$mm_tabbed.on('click', function(){
		var currentId = $(this).attr('id');
    var curentClass = $(this).attr('class');
    if (curentClass!='acts'){
    $('li.acts').removeClass('acts');
    $(this).addClass('acts');
    $('div.acts').removeClass('acts');
    $('#my_tabbeds-'+currentId).addClass('acts');
    }
	}); 
  
});               