<?php
/**
 * The template for displaying the footer.
 */
?>		
			<!-- START FOOTER -->
			<footer id="footer">
				<?php get_sidebar( 'main' ); ?>
				<div id="copyright">
					<p><?php echo get_option("tee_footer"); ?></p>
				</div>
			</footer>
			<!-- END FOOTER -->
		</div>
		<!-- END #PAGE -->
		<?php wp_footer(); ?>
	</body>
	<!-- END BODY -->
</html>