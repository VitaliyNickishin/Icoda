<?php
$list = get_field('icoda_gb_list_of_exchanges', 'option');
if( empty( $list ) ) {
    $list = icoda_get_global_option( 'icoda_gb_list_of_exchanges' );
}
?>
<?php if (!empty($list)) : ?>
    <?php foreach ($list as $image_url) : ?>

        <img class="skip-lazy" src="<?php echo $image_url; ?>" alt="" />

    <?php endforeach; ?>
<?php endif; ?>