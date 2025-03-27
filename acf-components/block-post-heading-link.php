<?php
$className = 'wp-block-heading d-flex align-items-center';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
?>

<h2 class="<?php echo $className; ?>">
    <?php the_field('post_heading_link_title'); ?>
    <a class="copy-link-to-heading" target="_blank" href="<?php the_field('post_heading_link_url'); ?>"></a>
</h2>