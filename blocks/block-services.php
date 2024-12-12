<?php
if ( !block_rows( 'item' ) ) {
    return;
}
$current_page_id = get_queried_object_id();
$icoda_gb_services = get_field('icoda_gb_services', 'option');
?>

<section class="section section-grid-title-content mb-3 mb-md-5">
    <div class="container">
        <div class="row">
            <h2 class="section-title" style="display: none;"><?php echo __('Services', 'icoda'); ?></h2>

            <?php if( ! empty( $_GET['new_services'] ) && !empty( $icoda_gb_services ) ) : ?>

                <?php foreach( $icoda_gb_services as $item_row_data ) : ?>

                    <?php
                        if( ! empty( $item_row_data['custom_url'] ) ) {
                            $link_val = $item_row_data['custom_url'];
                        } elseif( ! empty( $item_row_data['post_obj'] ) ) {
                            $link_val = get_the_permalink( $item_row_data['post_obj'] );
                        } else {
                            $link_val = '#';
                        }

                        if( ! empty( $item_row_data['custom_title'] ) ) {
                            $title_val = $item_row_data['custom_title'];
                        } elseif( ! empty( $item_row_data['post_obj'] ) ) {
                            $title_val = get_the_title( $item_row_data['post_obj'] );
                        } else {
                            $title_val = __('Service', 'icoda');
                        }

                        if( ! empty( $item_row_data['description'] ) ) {
                            $desc_val = $item_row_data['description'];
                        } else {
                            $desc_val = '';
                        }

                        if( ! empty( $item_row_data['custom_label'] ) ) {
                            $label_val = $item_row_data['custom_label'];
                        } elseif( ! empty( $item_row_data['is_hot'] ) ) {
                            $label_val = __('hot', 'icoda');
                        } else {
                            $label_val = '';
                        }
                    ?>

                    <div class="col-sm-6 col-lg-4">

                        <?php $item_post_id = $item_row_data['post_obj']; ?>
                        <?php $item = ! empty( $item_post_id ) ? get_post($item_post_id) : false;  ?>

                        <?php if ($link_val) : ?>
                            <a href="<?php echo $link_val; ?>" class="service-card hot">
                                <span class="h6"><?php echo $title_val; ?></span>
                                <div class="sub-text">
                                    <p><?php echo $desc_val; ?></p>
                                </div>
                                <span class="service-card-footer">
                                    <span class="link-arrow"><?php echo __('Learn more', 'icoda'); ?></span>

                                    <?php if( ! empty( $label_val ) ) : ?>
                                        <span class="label-hot"><?php echo $label_val; ?></span>
                                    <?php endif; ?>
                                    

                                </span>
                            </a>
                        <?php endif; ?>
                    </div>

                <?php endforeach; ?>

            <?php else : ?>

                <?php while ( block_rows( 'item' ) ) :
                    block_row( 'item' ); ?>

                    <div class="col-sm-6 col-lg-4">

                        <?php $item_post = block_sub_field('service', false); ?>
                        <?php $item_page = block_sub_field('service_page', false); ?>
                        <?php $item = ! empty( $item_post ) ? $item_post : ( ! empty( $item_page ) ? $item_page : false );  ?>
                        <?php
                            if( ! empty( $item_page ) && $item_page->ID !== $current_page_id ) {
                                $item = $item_page;
                            }
                        ?>
                        <?php if ($item) : ?>
                            <a href="<?php echo get_permalink($item->ID); ?>" class="service-card hot">
                                <span class="h6"><?php echo $item->post_title; ?></span>
                                <div class="sub-text">
                                    <?php block_sub_field( 'description' ); ?>
                                </div>
                                <span class="service-card-footer">
                                    <span class="link-arrow"><?php echo __('Learn more', 'icoda'); ?></span>

                                    <?php if( block_sub_value( 'is-hot', false ) == true ) : ?>
                                        <span class="label-hot"><?php echo __('hot', 'icoda'); ?></span>
                                    <?php endif; ?>
                                    

                                </span>
                            </a>
                        <?php endif; ?>
                    </div>

                <?php endwhile;

                reset_block_rows( 'item' ); ?>

            <?php endif; ?>

            <?php if ( block_field('show-button', false) ): ?>
                <div class="col-12 mt-4 pb-10 text-center">
                    <a href="/contact-us" class="btn btn-blue">Contact Us</a>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>