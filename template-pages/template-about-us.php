<?php

/*
Template Name: About us (redisign)
Template Post Type: post, page
*/

get_header();
$front_page_id = get_option('page_on_front');
?>
<main class="page-about">
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
						<h1 class="h4"><?php the_title(); ?></h1>
						<div class="description">
							<?php the_field('about_us_content'); ?>
						</div>
						<div class="btn-wrap mt-4">
							<a href="#" data-modal="#callback" class="btn btn-blue open-modal"><?php echo __('Contact us', 'icoda'); ?></a>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-7">
					<div class="img-hero mb-3 mb-lg-0">
						<img src="<?php the_post_thumbnail_url(); ?>" alt="about-hero">
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php $about_us_icoda_team = get_field('about_us_icoda_team'); ?>
	<section class="section-team">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h2 class="h4"><?php echo $about_us_icoda_team['title']; ?></h2>
					<?php if (!empty($about_us_icoda_team['description'])) : ?>
						<p class="under-title"><?php echo $about_us_icoda_team['description']; ?></p>
					<?php endif; ?>
				</div>
			</div>

			<?php // get_template_part( 'template-parts/leadership-slider'); 
			?>
			<div class="list-leadership-desktop">
				<div class="row list-leadership">
					<?php foreach (get_field('section_7-new_list-en', $front_page_id) as $item) : $count++; ?>
						<div class="col-lg-3">
							<div class="list-leadership-item">

								<div class="leadership-item-avatar" data-bg="<?php echo $item['image']; ?>"></div>
								<div class="leadership-item-des">
									<div class="title-wrap d-flex justify-content-between w-100">
										<span class="h6"><?= $item['name']; ?></span>

										<span class="leadership-contact-icons m-0">
											<?php echo ($item['author_page'] ? '<a href="' . $item['author_page'] . '"><i class="fas fa-user"></i></a>' : ''); ?>
											<?php echo ($item['link'] ? '<a href="' . $item['link'] . '" target="_blank"><i class="fab fa-linkedin" aria-hidden="true"></i></a>' : ''); ?>
										</span>
									</div>
									<span class="leadership-des-position"><?= $item['position']; ?> </span>
									<span class="leadership-des-text"><?= $item['desc']; ?></span>
								</div>

							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="list-leadership-mobile">
				<div class="list-leadership">
					<div class="leadership-slider custom-slider">
						<?php foreach (get_field('section_7-new_list-en', $front_page_id) as $item) : $count++; ?>

							<div class="list-leadership-item">

								<div class="leadership-item-avatar" data-bg="<?php echo $item['image']; ?>"></div>
								<div class="leadership-item-des">
									<div class="title-wrap d-flex justify-content-between w-100">
										<span class="h6"><?= $item['name']; ?></span>

										<span class="leadership-contact-icons m-0">
											<?php echo ($item['author_page'] ? '<a href="' . $item['author_page'] . '"><i class="fas fa-user"></i></a>' : ''); ?>
											<?php echo ($item['link'] ? '<a href="' . $item['link'] . '" target="_blank"><i class="fab fa-linkedin" aria-hidden="true"></i></a>' : ''); ?>
										</span>
									</div>
									<span class="leadership-des-position"><?= $item['position']; ?> </span>
									<span class="leadership-des-text"><?= $item['desc']; ?></span>
								</div>

							</div>

						<?php endforeach; ?>
					</div>
					<div class="wr-control wr-control-leadership"></div>
				</div>
			</div>

		</div>
	</section>

	<?php $about_us_icoda_partners = get_field('about_us_icoda_partners'); ?>
	<section class="section-partners">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h2 class="h4"><?php echo $about_us_icoda_partners['title']; ?></h2>
				</div>
			</div>

			<?php if (get_field('section_3-en', $front_page_id)) : ?>

				<?php if (!empty($_GET['new_resources'])) : ?>
					<?php $partners_list = get_field('section_3-en', $front_page_id); ?>
					<?php get_template_part('template-parts/sections/reliable-resources', '', ['partners_list' => $partners_list]); ?>

				<?php else : ?>
					<div class="row">
						<?php if (get_field('section_3-en', $front_page_id)) : ?>
							<?php $partners_list = get_field('section_3-en', $front_page_id); ?>
							<div class="col-12 col-md-12 col-right">
								<div class="list-logo-desktop">
									<div class="list-logo">
										<?php foreach ($partners_list as $partner_item) : ?>
											<div class="list-logo-item">
												<div class="wr-img">
													<img data-src="<?php echo $partner_item['section_3_image-en']; ?>" src="<?php echo $partner_item['section_3_image-en']; ?>" alt="img-logo">
												</div>
											</div>
										<?php endforeach; ?>
										<div class="list-logo-item">
											<div class="wr-img">
												<div class="text">
													<p class="h2">+300</p>
													<p class="sub-text"><?php echo __('resources more', 'icoda'); ?></p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- slider -->
								<div class="list-logo-mobile">
									<div class="list-logo list-logo-slider custom-slider">
										<?php foreach ($partners_list as $partner_item) : ?>
											<div class="list-logo-item">
												<div class="wr-img">
													<img data-src="<?php echo $partner_item['section_3_image-en']; ?>" src="<?php echo $partner_item['section_3_image-en']; ?>" alt="img-logo">
												</div>
											</div>
										<?php endforeach; ?>
										<div class="list-logo-item">
											<div class="wr-img">
												<div class="text">
													<p class="h2">+300</p>
													<p class="sub-text"><?php echo __('resources more', 'icoda'); ?></p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
						<!-- @todo end -->
					</div>
				<?php endif; ?>

			<?php endif; ?>



		</div>
	</section>

	<?php $about_us_media_about_us = get_field('about_us_media_about_us'); ?>
	<section class="section-media">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h2 class="h4"><?php echo $about_us_media_about_us['title']; ?></h2>
				</div>
			</div>
			<div class="col-12 col-right">
				<div class="wr-slider">
					<div class="slider-media custom-slider">
						<?php foreach ($about_us_media_about_us['items'] as $about_us_media_about_us_item) : ?>
							<a href="<?php echo $about_us_media_about_us_item['link']; ?>" class="media-box" target="_blank">
								<div class="media-img">
									<img src="<?php echo $about_us_media_about_us_item['logo']; ?>" alt="">
								</div>
								<div class="media-description">
									<p><?php echo $about_us_media_about_us_item['description']; ?></p>
								</div>
							</a>
						<?php endforeach; ?>
					</div>
					<div class="wr-control wr-control-media"></div>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part('template-parts/sections/meet-up', '', ['need_post_id' => $front_page_id]); ?>

	<?php get_template_part('template-parts/sections/contact-us', '', ['need_post_id' => $front_page_id]); ?>

</main>


<?php
get_footer(); ?>