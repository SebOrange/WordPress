$(function(){
  $('#primary-nav ul li').hover(function(){
    var children = $(this).children().children(); 
    children.stop(true, true).hide();
    children.slideDown(500);        
  });    
  
  $('#primary-nav ul li ul').hover(function(){
    var childrenLink = $(this).prev();
    childrenLink.addClass('active');        
  },function(){
    var childrenLink = $(this).prev();
    childrenLink.removeClass('active');
    }
  );    
});