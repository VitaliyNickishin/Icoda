<header class="section first-section">
    <div class="container">
        <div class="row pt-row">
            <div class="col-sm-12 col-md-5">
                <div class="text">
                    <h1 class="ttl"><?php block_field('title'); ?></h1>

                    <?php $i = 1; ?>
                    <?php while (block_rows('sections')) :
                        block_row('sections'); ?>

                        <div class="t-section-<?php echo $i; ?>">
                            <p class="sub-ttl"><?php block_sub_field('subtitle'); ?></p>
                            <div class="sub-text">
                                <?php block_sub_field('content'); ?>
                            </div>
                        </div>

                        <?php $i++; ?>
                    <?php endwhile;
                    reset_block_rows('sections'); ?>

                    <?php if( ! empty( block_value('subheader') ) ) : ?>
                        <p class="h5"><?php block_field('subheader'); ?></p>
                    <?php endif; ?>

                    <?php if( ! empty( block_value('button_url') ) ) : ?>
                        <?php if( block_value('button_url') == '#contact-with-us' ) : ?>
                            <a href="#" data-modal="#callback" class="btn btn-blue open-modal"><?php block_field('button_name'); ?></a>
                        <?php else : ?>
                            <a href="<?php block_field('button_url'); ?>" class="btn btn-blue"><?php block_field('button_name'); ?></a>
                        <?php endif; ?>
                    <?php endif; ?>

                </div>
            </div>
            <div class="col-sm-12 col-md-7 mob-none">
                <div class="d-flex first-section-pic-1">
                    <img src="<?php block_field('image'); ?>" alt="pic">
                </div>
            </div>
        </div>
    </div>
</header>