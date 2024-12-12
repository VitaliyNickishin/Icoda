<?php
    $pbap_image = get_field('pbap_image');
?>
<section class="section-about-project indent">
    <div class="container">
        <div class="content-title <?php echo (!empty($pbap_image)) ? 'pb-5' : ''; ?>">
            <div class="row">
                <div class="col-12 col-40">
                    <p class="title"><?php the_field('pbap_title'); ?></p>
                </div>
                <div class="col-12 col-60">
                    <div class="content pl-lg-1">
                        <?php the_field('pbap_description'); ?>
                    </div>
                </div>
            </div>
        </div>
       
        <?php if (!empty($pbap_image)) : ?>
            <div class="row pt-lg-5 mt-3 mt-lg-5">
                <div class="col-12 px-0 px-md-3">
                    <div class="img-wrap">
                        <img src="<?php echo $pbap_image; ?>" alt="about-img">
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>