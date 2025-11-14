<?php
$block_banner = get_field('block_banner');
$icoda_gb_book_info = get_field('icoda_gb_book_info', 'option');
?>
<div class="block-banner text-center py-lg-5 py-4">
    <div class="container">
        <p class="banner-title"><?php echo $block_banner['banner_title']; ?></p>
        <div class="book-action d-flex justify-content-center mt-4 pt-lg-2">
            <span class="book-price fw-semibold">
                $<?php echo $icoda_gb_book_info['book_price']; ?>
            </span>
            <button data-get-book type="button" class="btn btn-blue"><?php echo $icoda_gb_book_info['button_text']; ?></button>
        </div>
    </div>
    

</div>