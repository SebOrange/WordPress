<?php
header("HTTP/1.1 404 Not Found");
header("Status: 404 Not Found");
?>
<?php get_header(); ?>
 <?php
 $options = get_option('basic'); 
?>
			<!--BEGIN #primary .hfeed-->
			<div class="span12" >	
      <div class="row-fluid">
          <div class="span12">
			 <?php if (isset($options['breadcrumb_display']) && $options['breadcrumb_display']=='1'){ ?>
      <div id="breadcrumb"><?php echo the_breadcrumb(); ?></div>
      <?php } ?>
				<!--BEGIN #post-0-->
				<div id="post-0" <?php post_class() ?>>
					
					<h1 class="title-404"><?php _e('Error 404 - Not Found', 'simple') ?></h1>
					
					
					<div class="content-404">
						The page you are looking for does not exist; it may have been moved, or removed altogether. You might want to try the search function. Alternatively, return to the <a href="/">front page</a>.
					</div>
          </div>
          </div>
          
          <div style="clear"></div>
					<div class="row-fluid">
          <div class="span12">
          <div class="container">
          <form method="get" id="searchform-404" action="<?php echo home_url(); ?>/">
	         <fieldset>
		        <input type="text" name="s" id="s" value="<?php _e('Search', 'simple') ?>" onfocus="if(this.value=='<?php _e('Search', 'simple') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('Search', 'simple') ?>';" />
            <input type="submit" name="submit" value="" id="s-submit">
	         </fieldset>
          </form>
          </div>
          </div>
          </div>
          <div style="clear"></div>
          <div class="row-fluid">
          <div class="span12">
          <div class="container ppaaggeess">
          <div id="pages-404">
            <h3>Pages</h3>
            <ul>
              <?php wp_list_pages('title_li='); ?>
            </ul>
           </div>
           </div>
          </div>
          </div>
				<!--END #post-0-->
				</div>
				
			<!--END #primary .hfeed-->
			</div>
 

<?php get_footer(); ?>