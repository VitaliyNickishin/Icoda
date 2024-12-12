<?php
/* Template Name: Partners */
get_header();
$front_page_id = get_option('page_on_front');
?>
<main class="page-partners">
	<div class="container">
			<div class="row">
					<div class="col-12 mb-2 mb-md-3">
							<?php the_breadcrumbs(); ?>
					</div>
			</div>
	</div>
	<section class="section-hero pt-lg-3 partners-hero">
		<div class="container">
			<div class="row flex-column-reverse flex-lg-row">
				<div class="col-12 col-lg-5">
					<div class="content">
						<h1 class="h4"><?php the_title(); ?></h1>
						<div class="description">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-7">
					<div class="img-hero mb-3 mb-lg-0">
						<img src="<?php the_post_thumbnail_url(); ?>" alt="partners-hero">
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php get_template_part('template-parts/sections/ready-be-partners', '', ['need_post_id' => get_the_ID()]); ?>

	<?php get_template_part('template-parts/sections/reward', '', ['need_post_id' => get_the_ID()]); ?>

	<?php get_template_part('template-parts/sections/meet-up', '', ['need_post_id' => $front_page_id]); ?>

	<?php get_template_part('template-parts/sections/contact-us', '', ['need_post_id' => $front_page_id]); ?>
</main>


<?php
get_footer(); ?>