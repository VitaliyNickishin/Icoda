<?php
if ( !block_rows( 'item' ) ) {
    return;
}
?>

<div class="section section-grid-title-content my-3 my-md-5 pt-3 pt-md-5 border-top">
    <div class="container">
        <div class="row">

            <?php if ($title = block_field( 'block-title', false )) : ?>
                <div class="col-12 mb-3 mb-md-5">
                    <p class="h3"><?php echo $title; ?></p>
                </div>
            <?php endif; ?>


            <?php while ( block_rows( 'item' ) ) :
                block_row( 'item' ); ?>

                <div class="col-sm-6 col-lg-4">
                    <div class="project-card mb-3 mb-md-4">
                        <div class="project-card-header">
                            <?php block_sub_field( 'title' ); ?>
                        </div>
                        <div class="project-card-body mt-2 mt-mb-3">
                            <p><?php block_sub_field( 'content' ); ?></p>
                        </div>
                    </div>
                </div>

            <?php endwhile;

            reset_block_rows( 'item' );?>

        </div>

        <?php if ($link = block_field('link', false)) : ?>
            <div class="row justify-content-center align-items-center">
                <div class="col-sm-6 col-lg-4">
                    <a href="<?php echo $link; ?>" class="btn btn-light-1 w-100"><?php block_field('link-text'); ?></a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>