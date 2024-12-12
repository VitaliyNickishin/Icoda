<?php
if ( !block_rows( 'items' ) ) {
    return;
}
?>

<section class="section section-benefits my-3 my-md-5 pt-3 pt-md-4 border-top">
    <div class="container">
        <div class="row">
            <?php if ($title = block_field( 'title', false )): ?>
                <div class="col-12 my-2 my-md-4">
                    <?php $title_tag = block_value( 'title-tag', false ); ?>
                    <?php if( !empty( $title_tag ) && $title_tag !== 'Default'  ) : ?>
                        <<?php echo $title_tag; ?>><?php echo $title; ?></<?php echo $title_tag; ?>>
                    <?php else : ?>
                        <h2 class="h3"><?php echo $title; ?></h2>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="col-12 my-2 my-md-4">
                <ul class="benefits-items">

                    <?php while ( block_rows( 'items' ) ) : block_row( 'items' ); ?>

                        <li class="mb-2 mb-md-3"><?php block_sub_field( 'item' ); ?></li>

                    <?php endwhile;
                    reset_block_rows( 'items' ); ?>

                </ul>
            </div>

        </div>
    </div>
</section>