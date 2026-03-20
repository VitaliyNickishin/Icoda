<?php
$icoda_gb_book_info = get_field('icoda_gb_book_info', 'option');
$is_mega_menu = $args['is_mega_menu'] ?? false;
$button_url = empty($icoda_gb_book_info['link_to_book_page']) ? '#' : $icoda_gb_book_info['link_to_book_page'];
?>
<div class="book-info position-relative">
							
    <div class="book-image position-relative">
        <picture>
            <!-- <source srcset="<?php //echo $icoda_gb_book_info['book_info']['book_image_mobile']['url']; ?>" media="(max-width: 600px)" /> -->
            <img 
                data-src="<?php if (!empty($icoda_gb_book_info['book_image_desktop']['url'])) { echo $icoda_gb_book_info['book_image_desktop']['url']; } ?>" 
                alt="<?php if (!empty($icoda_gb_book_info['book_image']['book_alt'])){ echo $icoda_gb_book_info['book_image']['book_alt']; } ?>" 
                src="<?php if (!empty($icoda_gb_book_info['book_image_desktop']['url'])) { echo $icoda_gb_book_info['book_image_desktop']['url']; } ?>" 
                class="lazyloaded"
                width="250" height="335"
                >
        </picture>
        
        
    </div>
    <div class="book-quote">
        <p class="quote position-relative"><?php echo $icoda_gb_book_info['book_quote']; ?></p>
        <?php if ($is_mega_menu): ?>
            <a href="<?php echo $button_url; ?>" class="btn btn-blue mt-2">
                <?php echo $icoda_gb_book_info['button_text']; ?>
            </a>
        <?php else: ?>
            <?php get_template_part('template-parts/_partials/book-price'); ?>
        <?php endif; ?>
    </div>

</div>