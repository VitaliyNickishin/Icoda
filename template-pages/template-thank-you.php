<?php
/* Template Name: Thank you page */
get_header();
$icoda_gb_thank_you_page = get_field('icoda_gb_thank_you_page', 'option');
?>
<main class="page-thank-you">
	<div class="container">
		<?php get_template_part('template-parts/_partials/thank-you-content'); ?>
		<div class="d-flex flex-column justify-content-center align-items-center my-lg-5 py-5">
			<div class="h6 mb-3 pb-lg-3 text-done text-center">
				<?php echo $icoda_gb_thank_you_page['thank_you_message']; ?>
			</div>
			<?php if (!empty($icoda_gb_thank_you_page['image'])) : ?>
				<picture>
					<img class="image-ty" src="<?php echo $icoda_gb_thank_you_page['image']['url']; ?>" alt="<?php echo $icoda_gb_thank_you_page['image_alt']; ?>" width="160" height="160">
				</picture>
			<?php endif; ?>
			
			<a download href="<?php echo $icoda_gb_thank_you_page['file_resource']['url']; ?>" class="btn btn-blue btn-get-book mt-4">
				<?php echo $icoda_gb_thank_you_page['button_text_resource']; ?>
			</a>
		</div>
	</div>
</main>


<?php
get_footer(); ?>