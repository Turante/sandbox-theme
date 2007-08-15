<?php header("HTTP/1.1 404 Not Found"); ?>
<?php get_header(); ?>
	
	<div id="container">
		<div id="content">
			<div id="post-404" class="post">
				<h2 class="post-title"><?php the_title(); ?></h2>
				<div class="post-entry">
					<p>There's been a problem finding the page you're looking for. Apologies. Perhaps . . .</p>
					<ul>
						<li>the page you're looking for was moved;</li>
						<li>a referring site gave you an incorrect address; or</li>
						<li>something just went terribly wrong.</li>
					</ul>
					<p>Use the search box and see if you can't find what you're looking for.</p>
					<form id="searchform-404" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<p>
							<label for="s-404">Search:</label>
							<input id="s-404" name="s" type="text" value="<?php echo wp_specialchars($s, 1); ?>" size="30" />
							<input id="searchsubmit-404" name="searchsubmit" type="submit" value="Find" />
						</p>
					</form>
				</div><!-- END POST-ENTRY -->
			</div><!-- END POST -->
		</div><!-- END CONTENT -->
	</div><!-- END CONTAINER  -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>