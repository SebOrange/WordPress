<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'simple') ?></p>
	<?php
		return;
	}

/*-----------------------------------------------------------------------------------*/
/*	Display the comments + Pings
/*-----------------------------------------------------------------------------------*/

		if ( have_comments() ) : // if there are comments ?>
        
                
        <div id="comment-wrap">
        
        <?php if ( ! empty($comments_by_type['comment']) ) : // if there are normal comments ?>
        
        <h3 id="comments">
		<?php comments_number(__('No Comments', 'simple'), __('One Comment', 'simple'), __('% Comments', 'simple'));?> <?php _e('on', 'simple');  ?> "<?php the_title(); ?>"</h3>
        
		<ol class="commentlist">
        <?php wp_list_comments('type=comment&avatar_size=66&callback=mm_comment'); ?>
        </ol>

        <?php endif; ?>

        <?php if ( ! empty($comments_by_type['pings']) ) : // if there are pings ?>
		
		<h3 id="pings"><?php _e('Trackbacks for this post', 'simple') ?></h3>
		
		<ol class="pinglist">
        <?php wp_list_comments('type=pings&callback=tz_list_pings'); ?>
        </ol>
        
        <?php endif; ?>
		
		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link(); ?></div>
			<div class="alignright"><?php next_comments_link(); ?></div>
		</div>
		</div>
		<?php
		
		
/*-----------------------------------------------------------------------------------*/
/*	Post with no comments or closed comments
/*-----------------------------------------------------------------------------------*/
		
		if ('closed' == $post->comment_status ) : // if the post has comments but comments are now closed ?>
		
		<p class="nocomments"><?php _e('Comments are now closed for this article.', 'simple') ?></p>
		
		<?php endif; ?>

 		<?php else :  ?>
		
        <?php if ('open' == $post->comment_status) : // if comments are open but no comments so far ?>

        <?php else : // if comments are closed ?>
		
		<?php if (is_single()) { ?><p class="nocomments"><?php _e('Comments are closed.', 'simple') ?></p><?php } ?>

        <?php endif; ?>
        
<?php endif;


/*-----------------------------------------------------------------------------------*/
/*	Comment Form
/*-----------------------------------------------------------------------------------*/

	if ( comments_open() ) : ?>
    
    <div id="respond-wrap">

	     <div id="respond">
    
    	     <h3 class="respond-title"><?php comment_form_title( __('Leave a Comment', 'simple'), __('Leave a Comment to %s', 'simple') ); ?></h3>
           <?php if ( !is_user_logged_in() ) : ?>
           <p class="respond-nonpublished-email">Your email is never published nor shared. Required fields are marked <span>*</span></p>
           <?php endif; ?>
		          <div class="cancel-comment-reply">
			           <?php cancel_comment_reply_link(); ?>
		          </div>
	
		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		
    <p><?php esc_html_e('You must be %1$slogged in%2$s to post a comment.', 'simple'); echo '<a href="'.get_option('siteurl').'/wp-login.php?redirect_to='.urlencode(get_permalink()).'">', '</a>' ?></p>
		
    <?php else : //comment form  ?>
	
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
	
			<?php if ( is_user_logged_in() ) : ?>
		
			<p><?php printf(__('Logged in as %1$s. %2$sLog out &raquo;%3$s', 'simple'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log out of this account', 'simple').'">', '</a>') ?></p>
		
			<?php else : ?>
		
			<p>
      <label for="author"><?php _e('Name', 'simple') ?> <span><?php if ($req) _e("*", 'simple'); ?></span></label>
      <input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" />
			</p>
		
			<p>
      <label for="email"><?php _e('Email', 'simple') ?><span> <?php if ($req) _e("*", 'simple'); ?></span></label>
      <input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" />
			</p>
		
			<p>
      <label for="url"><?php _e('Website', 'simple') ?></label>
      <input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
			</p>
		
			<?php endif; ?>
		
			<p>
      <label for="comment"><?php _e('Comment', 'simple') ?></label>
      <textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea>
      </p>
			
			
		
			<p>
            	<button class="com_button" type="submit" name="submit">
                    <?php _e('SEND', 'simple'); ?>
                </button>
				<?php comment_id_fields(); ?>
			</p>
			<?php do_action('comment_form', $post->ID); ?>
	
		</form>

	<?php endif; // If registration required and not logged in ?>
	</div>
	</div>
	<?php endif; // ?>
