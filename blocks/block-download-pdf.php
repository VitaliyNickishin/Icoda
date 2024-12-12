<section class="section section-1 download-hide">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="text">
                    <p class="h2"><?php block_field('title'); ?></p>
                    <div class="sub-text">
                        <?php block_field('description'); ?>
                    </div>
                </div>
                <div class="wr-btn <?php echo ( block_field('file',false) ) ? 'file-locked' : ''; ?>">
                    <?php 
                        if (block_field('social-locker', false)) {
                    ?>
                        <a href="#content-locker" data-modal="#content-locker" class="btn btn-blue ico-btn ico-download open-modal"><span></span><?php block_field('btn_name'); ?></a>
                    <?php
                        } else {
                    ?>
                            <a href="<?php block_field('file'); ?>" class="btn btn-blue ico-btn ico-download" download><span></span><?php block_field('btn_name'); ?></a>
                    <?php
                        }
                    ?>
                    <div class="des-text-btn">
                        <p><?php block_field('btn_desc'); ?></p>
                    </div>
                </div>
            </div>
            <div class="d-none d-md-block col-md-6">
                <div class="wr-img">
                    <div class="bg-book"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
    if (block_field('social-locker', false)) {
?>
<div id="content-locker" class="modal-default">
    <a href="#" class="modal-close"><i class="icon-ico-close"></i></a>
    <div class="modal-default-content">
        <div class="form-default-header">
            <p class="ttl"></p>
        </div>
        <div class="modal-default-body text-center">
            <?php
            $html = '<a href="'.block_field("file",false).'" class="download-pdf btn btn-blue ico-btn ico-download" download><span></span>Download</a>';
            echo do_shortcode('[sociallocker id="'.block_field("social-locker",false).'"]'.$html.'[/sociallocker]'); ?>
        </div>
    </div>
</div>
<?php
    }
?>