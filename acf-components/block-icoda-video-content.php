<?php
$video_set = get_field('video_set');
$content_set = get_field('content_set');
?>
<section class="block-video-content mx-lg-5 mx-sm-4 py-lg-5 py-4">
    <div class="block-video-content-inner">
        <div class="container">
            <div class="row flex-column-reverse flex-lg-row align-items-center">
                <div class="col-12 col-md-8 col-lg-4 mt-4 mt-lg-0">
                    <div class="block-video-content__iframe video">
                        <div id="player-1"></div>

                        <div
                            class="poster"
                            data-id="player-1"
                            data-video="<?php echo $video_set['video_code']; ?>"
                        >
                            <div class="poster-img">
                            <picture>
                                <source srcset="<?php echo $video_set['poster_mobile']['url']; ?>" media="(max-width: 600px)" />
                                <img 
                                    data-src="<?php echo $video_set['poster_desktop']['url']; ?>" 
                                    alt="<?php echo $video_set['poster_alt']; ?>" 
                                    src="<?php echo $video_set['poster_desktop']['url']; ?>" 
                                    class="lazyloaded poster-image"
                                    width="515" height="314"
                                    >
                            </picture>
                            </div>
                            
                            <div class="play-icon">
                            <picture>
                                <img src="<?php echo $video_set['icon_play']['url']; ?>" alt="Play" />
                            </picture>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8 pl-lg-5">
                    <div class="block-video-content__info ml-lg-4">
                        <h2 class="h2 mb-2 pb-1 section-title">
                            <?php echo $content_set['title']; ?>
                        </h2>
                        <p class="description mb-2 pb-1">
                            <?php echo $content_set['description']; ?>
                        </p>
                        <div class="d-flex align-items-center">
                            <div class="avatar">
                            <picture>
                                    <img src="<?php echo $content_set['avatar']['url']; ?>" alt="<?php echo $content_set['author']; ?>" width="60" height="60" />
                                </picture>
                            </div>
                            <div class="author-meta ml-3">
                                <p class="name fw-semibold"><?php echo $content_set['author']; ?></p>
                                <p class="position mt-1"><?php echo $content_set['position']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>