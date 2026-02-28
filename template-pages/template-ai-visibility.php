<?php
/* 
Template Name: AI Visibility page
Template Post Type: post, page
*/
get_header();
$front_page_id = get_option('page_on_front');
?>


<main class="page-ai-visibility">
	<?php get_template_part('template-parts/ai/section-analyzer'); ?>

	<!-- work with .d-none -->
	<section class="section-reports position-relative has-circle-gradient analyzer-step-2 d-none">
		<div class="container">
			<div class="text-center">
				<!-- @todo url should be dynamic -->
				<h1 class="h1 title-hero mb-lg-4 mb-2">Is <span class="entered-url text-primary">amivisibleonai.com</span> visible on AI?</h1>
				<p class="undertitle mb-4">Comprehensive AI discoverability analysis</p>
			</div>

			<?php get_template_part('template-parts/ai/report-overall-score'); ?>

			<?php get_template_part('template-parts/ai/report-ai-visibility-score'); ?>

			<?php get_template_part('template-parts/ai/report-key-insights'); ?>

			<?php get_template_part('template-parts/ai/report-category-breakdown'); ?>

			<?php get_template_part('template-parts/ai/report-ai-bot-access'); ?>

			<?php get_template_part('template-parts/ai/report-technical-checklist'); ?>

			<?php get_template_part('template-parts/ai/report-structured-data'); ?>

			<?php get_template_part('template-parts/ai/report-gaps'); ?>

			<?php get_template_part('template-parts/ai/report-recommendation'); ?>

			<?php get_template_part('template-parts/ai/report-buttons'); ?>

		</div>
	</section>
		
	<div class="share-sticky" id="shareSticky">
		<div class="container">
			<div class="share-sticky__inner">
				<input 
					type="text"
					class="share-link"
					value=""
					readonly
				>
				<button class="btn-copy btn btn-blue">
					<span class="ci ci-copy d-md-none"></span>
					<span class="d-none d-md-block">
						<?php _e('Copy (Link expires in 30 days)', 'icoda'); ?>
					</span>
				</button>
			</div>
			<div class="d-md-none text-muted mt-2 text-center">
				<?php _e('Link expires in 30 days', 'icoda'); ?>
			</div>
		</div>
		
	</div>
	

	<?php the_content(); ?>

</main>


<?php
get_footer(); ?>