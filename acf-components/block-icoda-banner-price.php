<?php
$block_banner = get_field('block_banner');
$icoda_gb_book_info = get_field('icoda_gb_book_info', 'option');
?>
<div class="block-banner text-center py-lg-5 py-4">
    <div class="container">
        <p class="banner-title"><?php echo $block_banner['banner_title']; ?></p>
        <div class="d-flex justify-content-center mt-4 pt-lg-2">
            <?php get_template_part('template-parts/_partials/book-price'); ?>
        </div>
    </div>
</div>