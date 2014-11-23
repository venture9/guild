
<div class="" style="padding-left: 35%;">
	<h2>Key Result Page</h2>
	<?php
		if(isset($error)) {
	?>
		<h3><?php echo $message; ?></h3>
	<?php
		} else {
	?>
		<h3><?php echo $message; ?></h3>
		<h4><?php echo $pin?></h4>
	<?php
		}
	?>
</div>