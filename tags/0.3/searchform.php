<form id="searchform" method="get" action="<?php bloginfo('home') ?>">
	<div>
		<input id="s" name="s" type="text" value="<?php echo wp_specialchars($s, 1); ?>" tabindex="1" size="40" />
		<input id="searchsubmit" name="searchsubmit" type="submit" value="<?php _e('Search &raquo;', 'sandbox') ?>" tabindex="2" />
	</div>
</form>