<?php
/* 
Template Name: Book 
Template Post Type: post, page
*/
get_header();
$front_page_id = get_option('page_on_front');
?>

<?php
$hero_section = get_field('hero_section');
$icoda_gb_book_info = get_field('icoda_gb_book_info', 'option');
?>

<main class="page-book">
	<div class="container">
		<div class="row">
			<div class="col-12 mb-2 mb-md-3">
					<?php the_breadcrumbs(); ?>
			</div>
		</div>
	</div>
	<section class="section section-hero-book">
		<div class="section-hero-book__inner position-relative with-gradient with-gradient-pink with-gradient-blue">
		
			<div class="container">
				<div class="row">
					<div class="col-12 col-lg-7 mt-lg-4 pt-lg-3">
						<p class="abovetitle mb-1 text-primary">
							<?php echo $hero_section['above_title']; ?>
						</p>
						<h1 class="h1 mb-4 title">
							<?php echo $hero_section['title']; ?>
						</h1>
						<p class="subtitle pr-lg-5 mr-lg-5 mb-5 pb-3">
							<span class="undertitle">
								<?php echo $hero_section['subtitle']; ?>
							</span>
							
						</p>
					</div>
                   
					<div class="col-12 col-lg-5">
						<?php get_template_part('template-parts/_partials/book-info'); ?>
					</div>
					
				</div>
				<div class="row mt-5 pt-3 mt-lg-0 pt-lg-0">
					<div class="col-12 mt-5 mt-lg-0">
						<ul class="llm-list-icons d-flex align-items-center">
							<?php foreach ($hero_section['llm_list'] as $key => $icon) : ?>
								<li>
									<picture>
										<img 
										data-src="<?php echo $icon['llm_icon']['url']; ?>" 
										alt="<?php echo $icon['llm_alt']; ?>" 
										src="<?php echo $icon['llm_icon']['url']; ?>" 
										class="lazyloaded"
										width="32" height="32">
									</picture>
								</li>
							<?php endforeach; ?>
							<li class="more-llms ml-3">
								<?php _e('+ 3 more LLMs', 'icoda'); ?>
							</li>
						</ul>
					</div>

					<div class="col-12 mt-3 pr-0 pr-lg-3">
						<div class="section-hero-book__slider hero-slider custom-slider">
							<?php foreach ($hero_section['benefits_list'] as $item_data) : ?>
								<div
									class="media-logo benefit-item">
									<p class="text-primary title-benefits">
										<?php echo $item_data['title']; ?>
									</p>
									<span class="subtitle-benefits">
										<?php echo $item_data['subtitle']; ?>
									</span>
								</div>
							<?php endforeach; ?>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

	

	<div class="wrap">
		<?php
			the_content();
		?>
	</div>

	<?php get_template_part('template-parts/related-articles', '', ['title' => __('AI SEO Knowledge Base', 'icoda')]); ?>

	<?php echo do_shortcode('[contact-form-new]'); ?>
</main>


<?php
get_footer(); ?>