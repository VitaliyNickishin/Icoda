<?php
$content_val = block_value('content');
if( strpos( $content_val, '[icoda_list_of_exchanges]' ) !== false ) {
    $has_list_exchanges_shortcode = true;
} else {
    $has_list_exchanges_shortcode = false;
}
?>

<section class="section section-description <?php if( ! empty( block_value( 'add_top_padding' ) ) ) : ?> section-description_padding-top<?php endif; ?>  <?php if( $has_list_exchanges_shortcode ) : ?> list-of-exchanges<?php endif; ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
            <?php $title_tag = block_value('title-tag'); ?>
            <?php if( empty( $title_tag ) ) { $title_tag = 'h2'; } ?>
                <<?php echo $title_tag; ?> class="h3"><?php block_field('title'); ?></<?php echo $title_tag; ?>>
            </div>
        </div>
    </div>
    <div class="section-description-inner bg-color-light-white">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-7">
                    <div class="text">
                        <?php if( $has_list_exchanges_shortcode ) : ?>
                            <?php $content_val = str_replace( '[icoda_list_of_exchanges]', '', $content_val ); ?>
                            <?php echo do_shortcode('[icoda_list_of_exchanges]'); ?>
                        <?php endif; ?>
                        <?php $content_val = str_replace( '<ul>', '<ul class="marker-list">', $content_val ); ?>
                        <?php echo $content_val; ?>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-5 mob-none">
                    <div class="wr-img">
                        <img src="<?php block_field('image'); ?>" alt="pic">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>