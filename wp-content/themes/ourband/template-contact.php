<?php
/*
Template Name: Contact
*/
?>
<?php 
$options = get_option('basic');



//If the form is submitted
if(isset($_POST['submitted'])) {

	//Check to see if the honeypot captcha field was filled in
	if(trim($_POST['checking']) !== '') {
		$captchaError = true;
	} else {
	
		//Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError = 'Enter your name.';
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$emailError = 'Enter your email.';
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'Invalid email.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		//Check to make sure comments were entered	
		if(trim($_POST['your-message']) === '') {
			$commentError = 'Enter your comments.';
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['your-message']));
			} else {
				$comments = trim($_POST['your-message']);
			}
		}
			
		//If there is no error, send the email
		if(!isset($hasError)) {

			$emailTo = $options['contact_form_email'];
			$subject = 'Contact Form Submission from '.$name;
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);

			$emailSent = true;

		}
	}
} ?>



<?php 
get_header();
wp_reset_query();  
?>
			
			<div class="span12" >		
			<?php if (isset($options['breadcrumb_display']) && $options['breadcrumb_display']=='1'){ ?>
      <div id="breadcrumb"><?php echo the_breadcrumb(); ?></div>
      <?php } ?>
      <h1 class="page-title"><?php the_title(); ?></h1>
      
      <?php if(isset($emailSent) && $emailSent == true) { ?>

	     <div class="contact-thanks">
		    <p>Your email was successfully sent. I will be in touch soon.</p>
	     </div>

      <?php } ?>
      
      
      <div class="entry-content">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php the_content(); ?>
			<?php endwhile; ?>
      </div>
      <?php 
      wp_reset_query();
      endif; ?>
			
      <?php if ($options['contact-text-top']){ ?>
      <div class="contact-content">
      <?php echo $options['contact-text-top']; ?>    
      </div>  
      <?php } ?>
      
      <div class="row-fluid">
      <div class="span4">
      <div id="contacts">
        <?php if ($options['contact-companyname']){ ?>
        <h3><?php echo $options['contact-companyname']; ?></h3>
        <?php } ?>
          <p class="cont-l">Tel:</p>
            <?php 
              foreach($options['contact-phone'] as $k){ 
              echo '<p class="cont-r">'.$k.'</p>'; 
              }
            ?>
          <div class="clear"></div>
          <p class="cont-l">Email:</p>
            <?php 
              foreach($options['contact-email'] as $k){ 
              echo '<p class="cont-r">'.$k.'</p>'; 
              }
            ?>
          <div class="clear"></div>
          <p class="cont-l">Skype:</p>
          <p class="cont-r"><?php echo $options['contact-skype']; ?></p>
          <p class="cont-l">Adress:</p>
          <p class="cont-r"><?php echo $options['contact-adress']; ?></p>
          <p class="cont-r"><?php echo $options['contact-city']; ?></p>
          <p class="cont-r"><?php echo $options['contact-zip']; ?></p>
          <p class="cont-r"><?php echo $options['contact-state']; ?></p>
          
      </div> 
      </div>
      <div class="span8">      
      <form action="<?php the_permalink(); ?>" method="post" id="contactForm">

      <div class="row-fluid">
      <div class="cf-left span6">
        
        <label class="first-label" for="contactName">Your Name</label>
        
        <?php if($nameError != '') { ?>
						<span class="error"><?=$nameError;?></span> 
					<?php } ?>
            <p class="name_error">Enter your name.</p>
        
        
        <input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="requiredField" size="40">
        
        <label for="email">Your Email</label>
        <?php if($emailError != '') { ?>
						<p class="error"><?=$emailError;?></p>
					<?php } ?>
        <p class="email_error">Enter your email.</p>
        <input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="requiredField email" size="40">

        <label for="your-subject">Subject</label>
        <input type="text" name="your-subject" id="your-subject" value="<?php if(isset($_POST['your-subject']))  echo $_POST['your-subject'];?>" size="40">
      </div>
      <div class="cf-right span6">

        <label class="first-label" for="your-message">Your Message</label>
        <p class="message_error">Enter your message.</p>
        
        <?php if($commentError != '') { ?>
						<span class="error"><?=$commentError;?></span> 
				<?php } ?>
        
        <textarea name="your-message" id="your-message" class="requiredField" cols="40" rows="10"><?php if(isset($_POST['your-message'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['your-message']); } else { echo $_POST['your-message']; } } ?></textarea>
        
        <div class="screenReader"><label for="checking" class="screenReader">If you want to submit this form, do not enter anything in this field</label><input type="text" name="checking" id="checking" class="screenReader" value="<?php if(isset($_POST['checking']))  echo $_POST['checking'];?>" /></div>
          
          
        <input type="hidden" name="submitted" id="submitted" value="true" />
        <input type="submit" value="Send" name="submiting">
      </div>
      </div>
      </form>      
      </div>
      </div>
      
      <div class="row-fluid">
      <div class="span12">
      <div id="g-map"> 
      <?php if (isset($options['g-map'])){ echo $options['g-map']; } else { ?>
      <iframe width="894" height="444" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=40.687926,17.549062&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=36.231745,70.136719&amp;ie=UTF8&amp;ll=40.687173,17.550865&amp;spn=1.085161,2.191772&amp;z=9&amp;output=embed"></iframe>
      <?php } ?>   
      </div>
      </div>
      </div>
      
			</div>      

<?php get_footer(); ?>