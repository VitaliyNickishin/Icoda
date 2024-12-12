<?php
if ( !block_rows( 'items' ) ) {
    return;
}
?>

<section class="section section-technologies">
    <div class="container">
        <div class="row">
            <?php if ($title = block_field( 'title', false )): ?>
                <div class="col-12 my-2 my-md-4">
                    <h4><strong><?php echo $title; ?></strong></h4>
                </div>
            <?php endif; ?>

            <div class="col-12 my-2 my-md-4">
                <ul class="technologies-items">

                    <?php while ( block_rows( 'items' ) ) : block_row( 'items' ); ?>

                        <li class="mb-3 mb-md-3">
                            <div class="technology-image">
                            <img src="<?php block_sub_field( 'image' ); ?>" alt="<?php block_sub_field( 'item' ); ?>">
                            </div>
                            <p><?php block_sub_field( 'item' ); ?></p> 
                        </li>

                    <?php endwhile;
                    reset_block_rows( 'items' ); ?>

                </ul>
            </div>

        </div>
    </div>
</section>