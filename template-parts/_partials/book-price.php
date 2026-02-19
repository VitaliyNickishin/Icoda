<?php
$icoda_gb_book_info = get_field('icoda_gb_book_info', 'option');
?>

<div class="book-action">
    <span class="book-price fw-semibold">
        $<?php echo $icoda_gb_book_info['book_price']; ?>
    </span>
    <!--<button data-get-book type="button" class="btn btn-blue"><?php //echo $icoda_gb_book_info['button_text']; ?></button>-->
	<?php echo do_shortcode( '[wpecpp id="209914"]' ); ?>
</div>