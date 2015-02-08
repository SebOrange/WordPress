<?php
/*
Template Name: Home
*/

$options = get_option('basic'); 

get_header(); 
?>

<div class="span12 home-box-wrap">
<div class="row-fluid">
<!-- Homepage three boxes -->
<!-- Homepage first box -->	
<?php  
if($options['basic_homebox1'] && $options['basic_homebox1'] != 2){ 
$args = array(
'page_id' =>$options['basic_homebox1'], 
);
$post_f = get_post($options['basic_homebox1']);
$title = $post_f->post_title;
$sjc_excerpt = explode( '<!--more-->', $post_f->post_content);
$permalink = get_permalink( $options['basic_homebox1'] ); 
?>
			<?php if (have_posts()) : ?>   
      <?php while (have_posts()) : the_post(); ?>
				<div class="span4">
        	<div class="home-threebox">
            <div class="row-fluid">			
              <div class="span3">
                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/<?php echo $options['homepage_first_ico']; ?>.png" alt="Ico" class="homepage-ico" />
              </div>
              <div class="span9">
                <h2 class="homepage-title"><?php echo $title; ?></h2>
                <div class="homepage-excerpt">
                  <?php echo wpautop( $sjc_excerpt[0] ); ?>
                </div>
              </div>
            </div>
          </div>
        </div>       
				<?php endwhile; ?>
        <?php 
        endif;
        }else{ ?>
        <div class="span4">
        	<div class="home-threebox">
            <div class="row-fluid">			
              <div class="span3">
                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/1.png" alt="Ico" class="homepage-ico" />
              </div>
              <div class="span9">
                <h2 class="homepage-title">First box</h2>
                <div class="homepage-excerpt">
                  Fusce aliquam vestibulum ipsum. Suspendisse nisl. Praesent id justo in neque elementum ultrices. Ut enim ad minim veniam, quis nostrud exercitation.
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>	


<?php  
if($options['basic_homebox2'] && $options['basic_homebox2'] != 2){ 
$args = array(
'page_id' =>$options['basic_homebox2'], 
);
$post_g = get_post($options['basic_homebox2']);
$title = $post_g->post_title;
$sjc_excerpt = explode( '<!--more-->', $post_g->post_content);
$permalink = get_permalink( $options['basic_homebox2'] ); 
?>
			<?php if (have_posts()) : ?>   
      <?php while (have_posts()) : the_post(); ?>
				<div class="span4">
        	<div class="home-threebox">
            <div class="row-fluid">			
              <div class="span3">
                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/<?php echo $options['homepage_second_ico']; ?>.png" alt="Ico" class="homepage-ico" />
              </div>
              <div class="span9">
                <h2 class="homepage-title"><?php echo $title; ?></h2>
                <div class="homepage-excerpt">
                  <?php echo wpautop( $sjc_excerpt[0] ); ?>
                </div>
              </div>
            </div>
          </div>
        </div>        
				<?php endwhile; ?>
        <?php 
        endif;
        }else{ ?>
        <div class="span4">
        	<div class="home-threebox">
            <div class="row-fluid">			
              <div class="span3">
                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/2.png" alt="Ico" class="homepage-ico" />
              </div>
              <div class="span9">
                <h2 class="homepage-title">Second box</h2>
                <div class="homepage-excerpt">
                  Aliquam erat volutpat. Suspendisse nisl. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Fusce aliquam vestibulum ipsum.
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>	

<?php  
if($options['basic_homebox3'] && $options['basic_homebox3'] != 2){ 
$args = array(
'page_id' =>$options['basic_homebox3'], 
);
$post_h = get_post($options['basic_homebox3']);
$title = $post_h->post_title;
$sjc_excerpt = explode( '<!--more-->', $post_h->post_content); 
$permalink = get_permalink( $options['basic_homebox3'] );
?>
			<?php if (have_posts()) : ?>   
      <?php while (have_posts()) : the_post(); ?>
					<div class="span4">
        	<div class="home-threebox lastbox">
            <div class="row-fluid">			
              <div class="span3">
                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/<?php echo $options['homepage_third_ico']; ?>.png" alt="Ico" class="homepage-ico" />
              </div>
              <div class="span9">
                <h2 class="homepage-title"><?php echo $title; ?></h2>
                <div class="homepage-excerpt">
                  <?php echo wpautop( $sjc_excerpt[0] ); ?>
                </div>
              </div>
            </div>
          </div>
        </div>        
				<?php endwhile; ?>
        <?php 
        endif;
        }else{ ?>
        <div class="span4">
        	<div class="home-threebox">
            <div class="row-fluid">			
              <div class="span3">
                <img src="<?php echo get_template_directory_uri(); ?>/images/icons/3.png" alt="Ico" class="homepage-ico" />
              </div>
              <div class="span9">
                <h2 class="homepage-title">Third box</h2>
                <div class="homepage-excerpt">
                  Suspendisse nisl. Praesent id justo in neque elementum ultrices. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut.
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>	
       
       </div> 
    </div>
  </div>
</div>

<div class="row-fluid video-wrap">
  <div class="container">
    <div class="row-fluid">
      <div class="span4">
        
        <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('First featured area') ) : ?>
          <h3 class="featured-title"><?php _e('First featured video', 'simple') ?></h3>
          <div class="featured-video-iframe">
            <iframe width="300" height="200" src="http://www.youtube.com/embed/wkmqDiDTcBY" frameborder="0" allowfullscreen></iframe>
          </div> 
        <?php  endif; ?>
      </div>
      <div class="span4">
        
        <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Second featured area') ) : ?>
          <h3 class="featured-title"><?php _e('Second featured video', 'simple') ?></h3>
          <div class="featured-video-iframe">
            <iframe width="300" height="200" src="http://www.youtube.com/embed/wkmqDiDTcBY" frameborder="0" allowfullscreen></iframe>
          </div>
        <?php endif; ?>
      </div>
      <div class="span4">
        
        <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Third featured area') ) : ?>
          <h3 class="featured-title"><?php _e('Third featured video', 'simple') ?></h3>
          <div class="featured-video-iframe">
            <iframe width="300" height="200" src="http://www.youtube.com/embed/wkmqDiDTcBY" frameborder="0" allowfullscreen></iframe>
          </div>
        <?php endif; ?>
      </div>
    </div>                    
  </div>
</div> 


<div class="row-fluid home-note-wrap">
  <div class="container">  
    <div class="row-fluid">
      <div class="span2">
        <img src="<?php echo get_template_directory_uri(); ?>/images/note-round.png" alt="note">
      </div>
      <div class="span8">
      <?php 
      if($options['home-note']){
      ?>
      <div class="home-note"><?php echo $options['home-note']; ?></div>
      <?php 
      }else{
      ?>
      <div class="home-note">Pellentesque quis magna ut elit tristique facilisis. Nulla placerat condimentum bibendum. Quisque et justo lectus. Praesent tristique nunc sit amet orci mattis pulvinar. Integer aliquet aliquam sagittis. Vestibulum in est quis elit pulvinar dapibus et eu risus. Praesent ac purus eget risus adipiscing pellentesque vulputate cursus turpis. Ut sem eros, consectetur vel mollis nec, laoreet sed ipsum. Vivamus at nunc id velit pharetra molestie sit amet vitae leo. Pellentesque tincidunt convallis lectus at blandit. Donec quam libero, rhoncus et mattis quis, malesuada sit amet mauris. Aenean sed neque felis. Sed accumsan ornare lobortis. Praesent sed quam mi, ac fringilla lectus. Fusce nisl urna, mollis sit amet eleifend eu, ornare nec purus. Sed leo augue, placerat et ultricies nec, pulvinar vel dolor. Praesent venenatis massa ut elit consequat eget dapibus tellus aliquet.</div>
      <?php } ?>  
      </div>
      <div class="span2">
        <img src="<?php echo get_template_directory_uri(); ?>/images/note-round.png" alt="note">
      </div>
    </div> 

<?php get_footer(); ?>