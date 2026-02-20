<?php
global $post;

get_header();

?>
<script>
	window.intercomSettings = {
		app_id: "gdz549ih"
	};
</script>
<?php if ($post->post_parent == 3823 || $post->post_parent == 8397 || $post->post_parent == 9154 || $post->post_parent == 5720 || $post->post_parent == 22068) : ?>
	<nav class="wr-breadcrumb" aria-label="breadcrumb">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<?php the_breadcrumbs(); ?>
				</div>
			</div>
		</div>
	</nav>
<?php endif; ?>

<?php the_content(); ?>

<?php if ($post->post_parent == 3823 || $post->post_parent == 9154 || $post->post_parent == 5720 || $post->post_parent == 8397 || $post->post_parent == 22068) : ?>

	<?php

	if (get_the_ID() == '6598' || get_the_ID() == '6636' || get_the_ID() == '6640' || get_the_ID() == '6642' || get_field('load_new_styles') === true) {
		echo do_shortcode('[contact-form-new]');
	} else { ?>

		<div class="department-form" id="contact-with-us">
			<div class="callback-form">
				<div class="container">
					<div class="row">
						<div class="col-12 col-lg-8 col-xl-8">
							<div class="form-default-header">
								<h3 class="ttl"><?php _e('Send request', 'icoda'); ?></h3>
								<p><?php _e('to scale your business to the next level', 'icoda'); ?></p>
							</div>
							<?php get_template_part('template-parts/_partials/contact-form'); ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>


<?php endif; ?>

<?php
get_footer();
