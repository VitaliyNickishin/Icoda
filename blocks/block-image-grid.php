<?php
if ( !block_rows( 'list' ) ) {
    return;
}
?>

<section class="section section-image-grid">
    <div class="container">
        <div class="row">
        	<ul class="block-image-grid">
				<?php while ( block_rows( 'list' ) ) :
					block_row( 'list' ); ?>

					<li class="image-item"><img src="<?php block_sub_field('logotype'); ?>" alt="<?php echo get_post_meta(block_sub_field('logotype', false), '_wp_attachment_image_alt', true); ?>"></li>

				<?php endwhile;
				reset_block_rows( 'list' );?>
			</ul>
        </div>
    </div>
</section>