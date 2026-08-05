<?php

/*
Template Name: About us redisign (new)
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

	<?php the_content(); ?>

	<!-- <div class="section">
		<div class="container">
			
		</div>
	</div> -->
	

</main>


<?php
get_footer(); ?>