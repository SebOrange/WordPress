jQuery(document).ready(function() {

jQuery("a.fancybox").fancybox();


/*
* resize obrázků  - start
*/

//***resize pro LOGO
function logoEdit(){
    var cointainerWidth = $('.container').width();
    var logo = $('.responziveLogo').find('img')
    if($('body').data('responziveLogo') > cointainerWidth){
        logo.width(cointainerWidth);
    } else {
        logo.width($('body').data('responziveLogo'));
    }
        logo.css('margin', 'auto')
        $('.logo3').width(logo.width());
        $('.logo3').css('margin', 'auto')
}

  var logo = $('.responziveLogo').find('img');
  var img = new Image();
      img.src = logo.attr('src');
      img.onload = function() {
        $('body').data('responziveLogo', this.width); 
        logoEdit()       
      }
      
$(window).resize(function() {
  logoEdit();
});


//***resize pro Footer title
function foottitleEdit(){
    var cointainerWidth = $('.container').width();
    var foot = $('.foot-title-w').find('.foot-title')
    if($('body').data('foot-title-w') > cointainerWidth){
        foot.width(cointainerWidth);
    } else {
        foot.width($('body').data('foot-title-w'));
    }
        //foot.css('margin', 'auto')
        $('.foot-title-wrap').width(foot.width());
        $('.foot-title-wrap').css('margin', 'auto')
}

$(document).ready(function() {
        //alert("document ready occurred!");
        foottitleEdit();       
});
      
$(window).resize(function() {
  foottitleEdit();
});



//***resize pro obrázky v enty-content a hentry
// získání velikosti obrázků
function imageSizes( i, $this, count ){ 
  var img = new Image();
      img.src = $this.attr('src');
      img.onload = function() {
        $('body').data('image'+i, this.width);
        var loads = ($('body').data('loads')*1);
        if(isNaN(loads)){ loads = 1;}
        $('body').data('loads', (loads+1));
        
        if(count==loads){
          imageEdit();
        }
      }
}
function imageSizes2( i, $this, count ){ 
  var img = new Image();
      img.src = $this.attr('src');
      img.onload = function() {
        $('body').data('image'+i, this.width);
        var loads = ($('body').data('loads2')*1);
        if(isNaN(loads)){ loads = 1;}
        $('body').data('loads2', (loads+1));
        
        if(count==loads){
          imageEdit();
        }
      }
}


var i = 0;
var imagesToLoad = $('.entry-content').not('#slider').find('img').not('.avatar');   
imagesToLoad.each(function(){
  imageSizes( i , $(this),imagesToLoad.length);      
  i++;
})

var i = 0;
var imagesToLoad = $('.hentry').find('img').not('.avatar');
imagesToLoad.each(function(){
  imageSizes2( i , $(this),imagesToLoad.length);      
  i++;
})


// funkce na responzive
function imageEdit(){
  var img = $('.entry-content').not('#slider').find('img').not('.avatar'),
      contentWidth = $('.entry-content').width(),
      i = 0; 
  img.each(function(){
    if($('body').data('image'+i) > contentWidth){
        $this = $(this);
        margins = parseInt($this.css('margin-left')) + parseInt($this.css('margin-right'));
        $(this).width(contentWidth-margins);
    } else {
        $this = $(this);
        margins = parseInt($this.css('margin-left')) + parseInt($this.css('margin-right'));
        $(this).width($('body').data('image'+i)-margins);
    }
  i++;
  })
  
  
  var img = $('.hentry').find('img').not('.avatar'),
      contentWidth = $('.hentry').width()-10,
      i = 0; 
  img.each(function(){
    if($('body').data('image'+i) > contentWidth){
        $this = $(this);
        margins = parseInt($this.css('margin-left')) + parseInt($this.css('margin-right'));
        $(this).width(contentWidth-margins);
    } else {
        $this = $(this);
        margins = parseInt($this.css('margin-left')) + parseInt($this.css('margin-right'));
        $(this).width($('body').data('image'+i)-margins);
    }
  i++;
  })
}

$(window).resize(function() {
  imageEdit();
});

/*
* resize obrázků  - end
*/


//Gallery ico
$mm_gall = $('.gallery-thumb');

$mm_gall.find('img').css('background-color','#000000');
jQuery('.gall-thumb-img, .gall-thumb-link, .gall-thumb-link-one').css({'opacity':'0','visibility':'visible'});

	$mm_gall.hover(function(){
		jQuery(this).find('img').stop(true, true).animate({opacity: 0.7},500);
		jQuery(this).find('.gall-thumb-img').stop(true, true).animate({opacity: 1},400);
		jQuery(this).find('.gall-thumb-link').stop(true, true).animate({opacity: 1},400);
    jQuery(this).find('.gall-thumb-link-one').stop(true, true).animate({opacity: 1},400);
	}, function(){
		jQuery(this).find('.gall-thumb-img').stop(true, true).animate({opacity: 0},400);
		jQuery(this).find('.gall-thumb-link').stop(true, true).animate({opacity: 0},400);
    jQuery(this).find('.gall-thumb-link-one').stop(true, true).animate({opacity: 0},400);
		jQuery(this).find('img').stop(true, true).animate({opacity: 1},500);
	});
  
//Homepage Gallery ico
$mm_gall = $('.page-gallery-thumb');

$mm_gall.find('img').css('background-color','#000000');
jQuery('.page-thumb-img, .page-thumb-link, .page-thumb-link-one').css({'opacity':'0','visibility':'visible'});

	$mm_gall.hover(function(){
		jQuery(this).find('.page-thumb-img').stop(true, true).animate({opacity: 1},400);
		jQuery(this).find('.page-thumb-link').stop(true, true).animate({opacity: 1},400);
    jQuery(this).find('.page-thumb-link-one').stop(true, true).animate({opacity: 1},400);
	}, function(){
		jQuery(this).find('.page-thumb-img').stop(true, true).animate({opacity: 0},400);
		jQuery(this).find('.page-thumb-link').stop(true, true).animate({opacity: 0},400);
    jQuery(this).find('.page-thumb-link-one').stop(true, true).animate({opacity: 0},400);
	});  
  
//Post thumb  
$mm_postthumb = $('.post-thumb');  		
$mm_postthumb.find('img').css('background-color','#000000');      
$mm_postthumb.hover(function(){
		jQuery(this).find('img').stop(true, true).animate({opacity: 0.7},500);
	}, function(){
		jQuery(this).find('img').stop(true, true).animate({opacity: 1},500);
	});        

//Contact form
$('form#contactForm').submit(function(){
    
    var hasError = false;
    
    $('#contactName').each(function() {
      if(jQuery.trim($(this).val()) == '') {
				$('.name_error').show();
        hasError = true; 
			}
    });
    $('#email').each(function() {
      if(jQuery.trim($(this).val()) == '') {
				$('.email_error').show();
        hasError = true;
			}
    });
    $('#your-message').each(function() {
      if(jQuery.trim($(this).val()) == '') {
				$('.message_error').show();
        hasError = true;
			}
    });
		
    
    if(!hasError) {
			 return true;
		}
		
		return false;
    
    
		
	});
  
  
 //Recent and popular post sidebar
 
 $("#id-tab-posts").click(function() {
  $('#tab-posts').show();
  $('#tab-popular').hide();
  $('#tab-comments').hide();
  $('#tab-tags').hide();
  $("#id-tab-posts").addClass("active");
  $("#id-tab-popular").removeClass("active");
  $("#id-tab-comments").removeClass("active");
  $("#id-tab-tags").removeClass("active");
  
});

$("#id-tab-popular").click(function() {
  $('#tab-posts').hide();
  $('#tab-popular').show();
  $('#tab-comments').hide();
  $('#tab-tags').hide();
  $("#id-tab-posts").removeClass("active");
  $("#id-tab-popular").addClass("active");
  $("#id-tab-comments").removeClass("active");
  $("#id-tab-tags").removeClass("active");
});

$("#id-tab-comments").click(function() {
  $('#tab-posts').hide();
  $('#tab-popular').hide();
  $('#tab-comments').show();
  $('#tab-tags').hide();
  $("#id-tab-posts").removeClass("active");
  $("#id-tab-popular").removeClass("active");
  $("#id-tab-comments").addClass("active");
  $("#id-tab-tags").removeClass("active");
});

$("#id-tab-tags").click(function() {
  $('#tab-posts').hide();
  $('#tab-popular').hide();
  $('#tab-comments').hide();
  $('#tab-tags').show();
  $("#id-tab-posts").removeClass("active");
  $("#id-tab-popular").removeClass("active");
  $("#id-tab-comments").removeClass("active");
  $("#id-tab-tags").addClass("active");
}); 
  
    
}); 
    