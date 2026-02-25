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
				<h1 class="h1 display-1 mb-lg-4 mb-2">Is <span class="entered-url text-primary">amivisibleonai.com</span> visible on AI?</h1>
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


			<div class="report-box-wrapper btn-report-wrapper d-flex flex-column flex-lg-row justify-content-center align-items-center">
				<a download href="#" class="btn btn-report btn-download">
					<span><?php _e('Download PDF', 'icoda'); ?></span>
				</a>
				<button class="btn btn-report btn-share">
					<span><?php _e('Share Results', 'icoda'); ?></span>
				</button>
				<button class="btn btn-report btn-email">
					<span><?php _e('Email Report', 'icoda'); ?></span>
				</button>
				<button class="btn btn-report btn-analyze">
					<span><?php _e('Analyze Another URL', 'icoda'); ?></span>
				</button>
			</div>



		</div>
	</section>
		
	
	

	<?php the_content(); ?>

</main>


<?php
get_footer(); ?>