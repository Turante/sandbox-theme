	<div id="footer">
		<p>
			&copy; <?php echo(date('Y')); ?> <?php the_author('nickname'); ?>
			|
			A <a href="http://wordpress.org/" title="WordPress">WordPress</a> Blog
			|
			<a href="http://www.plaintxt.org/themes/minimalist-sandbox/" title="Minimalist Sandbox theme for WordPress" rel="follow">Minimalist Sandbox</a> theme by <a href="http://scottwallick.com/" title="scottwallick.com" rel="follow">Scott</a>
			|
			Valid <a href="http://validator.w3.org/check?uri=<?php echo get_settings('home'); ?>&amp;outline=1&amp;verbose=1" title="Valid XHTML 1.0 Strict" rel="nofollow">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/validator?uri=<?php bloginfo('stylesheet_url'); ?>&amp;profile=css2&amp;warning=no" title="Valid CSS" rel="nofollow">CSS</a>
		</p>
	</div><!-- END FOOTER -->

<?php wp_footer(); ?>

</div><!-- END WRAPPER -->

</body>
</html>