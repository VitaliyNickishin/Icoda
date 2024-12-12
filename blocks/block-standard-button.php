<?php
if ( !block_field('link-text', false) ) {
    return;
}
?>
<div class="section my-3 my-md-5">
    <div class="container">
        <?php if ($link = block_field('link', false)) : ?>
            <div class="row justify-content-center align-items-center">
                <div class="col-12 text-center">
                    <a href="<?php echo $link; ?>" <?php echo ( block_field('open-in-new-tab', false) == 1 ) ? 'target="_blank"' : ' '; ?> class="btn btn-light-1"><?php block_field('link-text'); ?></a>
                </div>
            </div>
        <?php endif; ?>
    </div> 
</div>