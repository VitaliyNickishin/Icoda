<section class="section-video-creation indent">
    <div class="container">
        <div class="content-title pb-5">
            <div class="row">
                <div class="col-12 col-20">
                    <p class="title"><?php the_field('pbvid_title'); ?></p>
                </div>
                <div class="col-12 col-80">
                    <div class="content pl-lg-2">
                        <?php the_field('pbvid_description'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 mt-lg-5 pt-lg-5">
            <div class="col-12">
                <div class="block-video text-center">
                    <div class="bg-grey"></div>

                    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php the_field('pbvid_video_id'); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                </div>
            </div>
        </div>
    </div>
</section>