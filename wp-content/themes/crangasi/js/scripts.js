
//Open the social links in a new window
jQuery(function($) {
	
	$( '#menu-social a' ).attr( 'target','_blank' );
	
});

//Social menu display
jQuery(function($) {
	$('.social-toggle').click(function()
	{
		$('.menu-social-container').slideToggle();
	});
});

//Fit Vids
jQuery(function($) {
  
  $(document).ready(function(){
    $(".entry-content").fitVids();
  });
  
});

//Tooltips
jQuery(function($) {

width = $( window ).width();

if (width <= 1024) { 
	$('.tooltip-tags').click(function()
	{
		$('.tooltip-tags .tags-links').slideToggle();
	});
	$('.tooltip-cats').click(function()
	{
		$('.tooltip-cats .cat-links').slideToggle();
	});
	$('.tooltip-comments').click(function()
	{
		$('.tooltip-comments .comments-link').slideToggle();
	});
	$('.tooltip-author').click(function()
	{
		$('.tooltip-author .author-link').slideToggle();
	});
	}
});