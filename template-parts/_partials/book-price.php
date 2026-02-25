<?php
$icoda_gb_book_info = get_field('icoda_gb_book_info', 'option');
?>

<div class="book-action">
    <span class="book-price fw-semibold">
        $<?php echo $icoda_gb_book_info['book_price']; ?>
    </span>
    <button type="button" class="stripe-pay-btn btn btn-blue"><?php echo $icoda_gb_book_info['button_text']; ?></button>
	<div id="stripe-payment-hidden" style="display:none;">
        <?php echo do_shortcode('[wpecpp id="209914"]'); ?>
    </div>
</div>