<?php 
/*
Template Name: Blog Page
*/
?>
<?php
 $options = get_option('basic'); 
 $i=1;
?>
<?php get_header(); ?>

<?php 
      
 $gall_set = array();
      $gall_set = maybe_unserialize( get_post_meta($post->ID,'gallery_page_settings',true) );     
      if (isset($gall_set['blog_sidebar'])){
          if ($gall_set['blog_sidebar']==1){
            get_template_part('/includes/templates/blog-fullwith');
          }elseif($gall_set['blog_sidebar']==2){
            get_template_part('/includes/templates/blog-sidebar');
          }
      }else{
          get_template_part('/includes/templates/blog-sidebar');
      }
      
      
?>    


<?php get_footer(); ?>