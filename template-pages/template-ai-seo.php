<?php
/* 
Template Name: AI SEO page
Template Post Type: post, page
*/
get_header();
$front_page_id = get_option('page_on_front');
?>

<?php
$hero_section = get_field('hero_section');
?>

<main class="page-ai-seo">
	<div class="container">
		<div class="row">
			<div class="col-12 mb-2 mb-md-3">
					<?php the_breadcrumbs(); ?>
			</div>
		</div>
	</div>
	<section class="section section-hero-ai-seo pb-5">
		<div class="section-hero-ai-seo__inner position-relative with-gradient with-gradient-pink with-gradient-blue">
		
			<div class="container">
				<div class="row">
					<div class="col-12 col-lg-7 mt-4 pt-3 mt-lg-5 pt-lg-5">
						<p class="abovetitle mb-1 text-primary">
							<?php echo $hero_section['above_title']; ?>
						</p>
						<h1 class="h1 mb-4 title">
							<?php echo $hero_section['title']; ?>
						</h1>
						<p class="undertitle">
							<?php echo $hero_section['subtitle']; ?>
						</p>
						<div class="section-hero-new__btn d-flex flex-column flex-sm-row mt-4 mt-lg-4 pt-lg-2">
							<a href="#" data-modal="#callback" class="btn btn-blue open-modal">
								<?php echo __('Get AI Visibility Audit', 'icoda'); ?>
							</a>
							<a class="btn d-flex align-items-center justify-content-center btn-outline-blue" href="" onclick="Calendly.initPopupWidget({url: 'https://calendly.com/d/cqrf-wpr-bt6/talk-to-our-expert'});return false;">
								<?php echo __('Book Intro Call', 'icoda'); ?>
							</a>
						</div>
					</div>
                   
					<div class="col-12 col-lg-5 mt-5 mt-lg-0 d-flex align-items-center flex-column justify-content-center align-self-end">
						<div class="bg-wrap"></div>

						<?php if (!empty($hero_section['llm_list'])) : ?>
							<ul class="llm-list-icons">
								<?php foreach ($hero_section['llm_list'] as $key => $icon) : ?>
									<li class="serv-box">
										<picture>
											<img 
											data-src="<?php echo $icon['llm_icon']['url']; ?>" 
											alt="<?php echo $icon['llm_alt']; ?>" 
											src="<?php echo $icon['llm_icon']['url']; ?>" 
											class="lazyloaded"
											width="62" height="62">
										</picture>
									</li>
								<?php endforeach; ?>
								<li class="serv-box more-llms text-center">
									<p class="number"><?php _e('+ 3', 'icoda'); ?></p>
									<span class="text"><?php _e('more LLMs', 'icoda'); ?></span>
								</li>
							</ul>
						<?php endif; ?>
					</div>
					
				</div>
				<?php if (!empty($hero_section['media_list'])) : ?>

				<div class="row mt-lg-2">
					<div class="col-12 pr-0">
						<div class="mt-4 pt-lg-4">
							<div class="section-hero-ai-seo__slider hero-slider-ai-seo custom-slider">
								<?php foreach ($hero_section['media_list'] as $media) : ?>

									<div
										class="media-logo">
										<picture>
											<img src="<?php echo $media['image']['url']; ?>" alt="<?php echo $media['title']; ?>" />
										</picture>
										<span class="media-title">
											<?php echo $media['title']; ?>
										</span>
									</div>
								<?php endforeach; ?>

							</div>
						</div>
					</div>
				</div>
				 <?php endif; ?>
			</div>
		</div>
	</section>

	<?php the_content(); ?>

	<?php echo do_shortcode('[contact-form-new]'); ?>
</main>


<?php
get_footer(); ?>