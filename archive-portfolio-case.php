<?php
get_header();
$front_page_id = get_option('page_on_front');
?>
<main class="page-portfolio">
	<div class="container">
		<div class="row">
			<div class="col-12 mb-2 mb-md-3">
				<?php the_breadcrumbs(); ?>
			</div>
		</div>
	</div>

	<section class="section-hero pt-lg-3">
		<div class="container">
			<div class="row flex-column-reverse flex-lg-row">
				<div class="col-12 col-lg-5">
					<div class="content">
						<h1 class="h4"><?php echo __('Portfolio', 'icoda'); ?></h1>
						<?php if ($desc = get_field('portfolio_archive_description', 'option')) : ?>
							<div class="description">
								<?php echo $desc; ?>
							</div>
						<?php endif; ?>
						<?php if ($btn_text = get_field('portfolio_archive_btn_text', 'option')) : ?>
							<div class="btn-wrap mt-4">
								<a href="#" data-modal="#callback" class="btn btn-blue open-modal"><?php echo $btn_text; ?></a>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<?php if ($hero_image = get_field('portfolio_archive_hero_image', 'option')) : ?>
					<div class="col-12 col-lg-7">
						<div class="img-hero mb-3 mb-lg-0">
							<img src="<?php echo $hero_image; ?>" alt="portfolio-hero">
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<?php $index = 0; ?>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : ?>
			<?php the_post(); ?>
			<?php $case_cats = get_the_terms(get_the_ID(), 'portfolio_cat'); ?>
			<?php $case_cats = !empty($case_cats) ? wp_list_pluck($case_cats, 'term_id') : []; ?>
			<?php $section_class = $index % 2 == 0 ? 'odd' : 'even'; ?>
			<?php $slider_images = get_field('portfolio_slider', get_the_ID()); ?>
			<?php $services = get_field('portfolio_services_list', get_the_ID()); ?>
			<?php $portfolio_item_link = get_the_permalink(get_the_ID()); ?>
			<section class="section-portfolio section-portfolio-<?php echo $section_class; ?>" data-case-cat="<?php echo '{{' . implode('}}{{', $case_cats) . '}}'; ?>">
				<div class="container">
					<div class="row">
						<div class="col-12 col-lg-5">
							<div class="content">
								<h2 class="h4"><?php the_title(); ?></h2>
								<div class="description description-descktop">
									<?php the_excerpt(); ?>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-7">
							<div class="wr-slider">
								<div class="portfolio-slider-<?php echo ($index+1); ?> portfolio-slider-main custom-slider">
									<?php foreach ($slider_images as $slider_image_url) : ?>
										<a href="<?php echo $portfolio_item_link; ?>">
											<img src="<?php echo $slider_image_url; ?>" alt="slider-image">
										</a>
									<?php endforeach; ?>
								</div>
								<div class="slider-control wr-control-portfolio-slider-<?php echo ($index+1); ?>"></div>
							</div>
							<div class="description description-mobile">
								<?php the_excerpt(); ?>
							</div>
						</div>
					</div>

					<?php if (!empty($services)) : ?>
						<?php $services = explode("\n", $services); ?>
						<div class="row">
							<div class="col-12 col-lg-6 pr-0">
								<div class="portfolio-filters-slider-bottom-<?php echo ($index+1); ?> portfolio-filters-slider-bottom-category custom-slider">
									<a href="<?php echo $portfolio_item_link; ?>"><?php echo strtoupper(__('Project services', 'icoda')); ?></a>
									<?php foreach ($services as $service_name) : ?>
										<a href="<?php echo $portfolio_item_link; ?>"><?php echo $service_name; ?></a>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>

			</section>
			<?php $index++; ?>
		<?php endwhile; ?>
	<?php else : ?>
		<?php _e('Nothing found', 'icoda'); ?>
	<?php endif; ?>

	<?php get_template_part('template-parts/sections/contact-us', '', ['need_post_id' => $front_page_id]); ?>

</main>

<?php
get_footer(); ?>