<!--BEGIN #searchform-->
<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
	<fieldset>
		<input type="text" name="s" id="s" value="<?php _e('search', 'simple') ?>" onfocus="if(this.value=='<?php _e('search', 'simple') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('search', 'simple') ?>';" />
    <input type="submit" name="submit" value="" id="s-submit">
	</fieldset>
<!--END #searchform-->
</form>