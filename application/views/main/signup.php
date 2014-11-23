<div class="container">
	<div class="reg_form">
	 	<?php echo validation_errors('<p class="error">'); ?>
	 	<?php echo form_open_multipart('main/registration'); ?>
		<p>
			<label for="user_name">User Name:</label>
			<input type="text" id="user_name" name="user_name" value="<?php echo set_value('user_name'); ?>" />
		</p>
		<p>
			<label for="email_address">Your Email:</label>
			<input type="text" id="email_address" name="email_address" value="<?php echo set_value('email_address'); ?>" />
		</p>
		<p>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" />
		</p>
		<p>
			<label for="con_password">Confirm Password:</label>
			<input type="password" id="con_password" name="con_password" value="<?php echo set_value('con_password'); ?>" />
		</p>
		<p>
			<label for="user-key">Key(<a href="">what is this?</a>)</label>
			<input type="text" id="user-key" name="user_key" value="<?php echo set_value('user_key'); ?>" size="50" />
		</p>
		<p>
			<input type="submit" class="btn btn-primary" value="Submit" />
		</p>
		<?php echo form_close(); ?>
	</div><!--<div class="reg_form">-->
</div><!--<div id="content">-->
