<?php

/*
Template Name: About us
Template Post Type: post, page
*/

get_header();
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

</main>


<?php
get_footer(); ?>