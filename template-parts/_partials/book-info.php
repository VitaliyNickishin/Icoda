<?php
$icoda_gb_book_info = get_field('icoda_gb_book_info', 'option');
?>
<div class="book-info position-relative">
							
    <div class="book-image position-relative">
        <picture>
            <!-- <source srcset="<?php echo $icoda_gb_book_info['book_info']['book_image_mobile']['url']; ?>" media="(max-width: 600px)" /> -->
            <img 
                data-src="<?php echo $icoda_gb_book_info['book_image_desktop']['url']; ?>" 
                alt="<?php echo $icoda_gb_book_info['book_image']['book_alt']; ?>" 
                src="<?php echo $icoda_gb_book_info['book_image_desktop']['url']; ?>" 
                class="lazyloaded"
                width="250" height="335"
                >
        </picture>
        
        
    </div>
    <div class="book-quote">
        <p class="quote position-relative"><?php echo $icoda_gb_book_info['book_quote']; ?></p>
        <?php get_template_part('template-parts/_partials/book-price'); ?>
    </div>

</div>