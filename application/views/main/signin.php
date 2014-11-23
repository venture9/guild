<div class="signin_form">
	<?php echo form_open_multipart("main/login"); ?>
	<label for="email">Email:</label>
	<input type="text" id="email" name="email" value="" />
	<label for="password">Password:</label>
	<input type="password" id="pass" name="pass" value="" />
	<input type="submit" class="" value="Sign in" />
	<?php echo form_close(); ?>
</div>