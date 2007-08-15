<form id="searchform" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<div>
		<input id="s" name="s" type="text" value="<?php echo wp_specialchars($s, 1); ?>" tabindex="1" size="10" />
		<input id="searchsubmit" name="searchsubmit" type="submit" value="Find" tabindex="2" />
	</div>
</form> 