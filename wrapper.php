<?php get_header(); ?>

	<div id="content" class="<?php echo apply_atomic( 'content_class', 'hfeed content' ); ?>">

		<?php do_atomic( 'before_content' ); ?>

			<?php if ( have_posts() ) : ?>

			<?php include $hybrid_wing->main_template; ?>

		<?php else: ?>

			<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

		<?php endif; ?>

		<?php do_atomic( 'after_content' ); ?>

	</div>

<?php get_footer(); ?>