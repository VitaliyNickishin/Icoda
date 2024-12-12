<section class="section section-icons my-3 my-md-5 pt-3 pt-md-4 border-top">
    <div class="container">
        <div class="row">
            <?php if ($title = block_field( 'title', false )): ?>
                <div class="col-12 my-2 my-md-4">
                    <h2 class="h3"><?php echo $title; ?></h2>
                </div>
            <?php endif; ?>

            <?php if ( block_rows( 'stack-icons' ) || block_rows( 'blockchains-icons' )  ) : ?>

                <div class="col-12 my-2 my-md-4">

                    <ul class="nav nav-pills mb-3 mb-md-5" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#stack-list" role="tab" aria-selected="true"><?php echo __('Stack', 'icoda'); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#blockchains-list" role="tab" aria-selected="false"><?php echo __('Blockchains', 'icoda'); ?></a>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">

                        <?php if ( block_rows( 'stack-icons' ) ) : ?>
                            <div class="tab-pane fade show active" id="stack-list" role="tabpanel">

                            <?php while ( block_rows( 'stack-icons' ) ) : block_row( 'stack-icons' ); ?>
                                <img class="mb-3 stack-icons__img" src="<?php echo wp_get_attachment_image_src(block_sub_field( 'icon' )) ?>" alt="<?php echo get_post_meta(block_sub_field( 'icon', false ), '_wp_attachment_image_alt', true); ?>">
                            <?php endwhile;
                            reset_block_rows( 'stack-icons' ); ?>

                            </div>
                        <?php endif;?>

                        <?php if ( block_rows( 'blockchains-icons' ) ) : ?>
                            <div class="tab-pane fade" id="blockchains-list" role="tabpanel">

                            <?php while ( block_rows( 'blockchains-icons' ) ) : block_row( 'blockchains-icons' ); ?>

                                <img class="mb-3 stack-icons__img" src="<?php echo wp_get_attachment_image_src(block_sub_field( 'icon' )) ?>" alt="<?php echo get_post_meta(block_sub_field( 'icon', false ), '_wp_attachment_image_alt', true); ?>">

                            <?php endwhile;
                            reset_block_rows( 'blockchains-icons' ); ?>

                            </div>
                        <?php endif;?>
                    </div>

                </div>
            <?php endif;?>

        </div>
    </div>
</section>