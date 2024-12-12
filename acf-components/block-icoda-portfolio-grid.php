<section class="section-grid indent">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content-title">
                    <p class="title"><?php the_field('pbgr_title'); ?></p>
                </div>
            </div>
        </div>
        <div class="row d-none d-lg-flex">
            <div class="col-12 col-lg-8">
                <div class="grid-desktop">
                    <div class="img-wrap">
                        <img src="<?php echo get_template_directory_uri() ?>/images/single-portfolio/grid-desktop.png" alt="grid-desktop">
                    </div>
                    <div class="info info-desktop">
                        <p class="title">Columns desctop</p>
                        <div class="info-inner">
                            <div class="info-item">
                                <p>Count</p>
                                <p>12</p>
                            </div>
                            <div class="info-item">
                                <p>Width</p>
                                <p>Auto</p>
                            </div>
                            <div class="info-item">
                                <p>Type</p>
                                <p>Streetch</p>
                            </div>
                            <div class="info-item">
                                <p>Margin</p>
                                <p>248</p>
                            </div>
                            <div class="info-item">
                                <p>Gutter</p>
                                <p>16</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 offset-1 col-lg-3">
                <div class="grid-mobile">
                    <div class="img-wrap">
                        <!-- need one general img instead both-->
                        <img src="<?php echo get_template_directory_uri() ?>/images/single-portfolio/grid-mob-mob.png" alt="grid-mob">
                        <img src="<?php echo get_template_directory_uri() ?>/images/single-portfolio/grid-mob-mob.png" alt="grid-mob">
                    </div>
                    <div class="info info-desktop">
                        <p class="title">Columns mobile</p>
                        <div class="info-inner">
                            <div class="info-item">
                                <p>Count</p>
                                <p>6</p>
                            </div>
                            <div class="info-item">
                                <p>Width</p>
                                <p>Auto</p>
                            </div>
                            <div class="info-item">
                                <p>Type</p>
                                <p>Streetch</p>
                            </div>
                            <div class="info-item">
                                <p>Margin</p>
                                <p>8</p>
                            </div>
                            <div class="info-item">
                                <p>Gutter</p>
                                <p>12</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="row d-block d-lg-none">
            <div class="col-12">
                <div class="tabs">
                    <input type="radio" name="tab-btn" id="tab-btn-1" value="" checked>
                    <label for="tab-btn-1">Descktop</label>
                    <input type="radio" name="tab-btn" id="tab-btn-2" value="">
                    <label for="tab-btn-2">Mobile</label>

                    <div id="desktop" class="grid-desktop">
                        <div class="img-wrap">
                            <img src="<?php echo get_template_directory_uri() ?>/images/single-portfolio/grid-desk-mob.png" alt="grid-desk-mob">
                        </div>
                        <div class="info mt-3">
                            <div class="info-inner">
                                <div class="info-item">
                                    <p>Count</p>
                                    <p>12</p>
                                </div>
                                <div class="info-item">
                                    <p>Width</p>
                                    <p>Auto</p>
                                </div>
                                <div class="info-item">
                                    <p>Gutter</p>
                                    <p>16</p>
                                </div>
                                <div class="info-item">
                                    <p>Type</p>
                                    <p>Streetch</p>
                                </div>
                                <div class="info-item">
                                    <p>Margin</p>
                                    <p>248</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="mobile" class="grid-mob">
                        <div class="img-wrap">
                            <img src="<?php echo get_template_directory_uri() ?>/images/single-portfolio/grid-mob-mob.png" alt="grid-mob-mob">
                        </div>
                        <div class="info mt-3">
                            <div class="info-inner">
                                <div class="info-item">
                                    <p>Count</p>
                                    <p>6</p>
                                </div>
                                <div class="info-item">
                                    <p>Width</p>
                                    <p>Auto</p>
                                </div>
                                <div class="info-item">
                                    <p>Gutter</p>
                                    <p>8</p>
                                </div>
                                <div class="info-item">
                                    <p>Type</p>
                                    <p>Streetch</p>
                                </div>
                                <div class="info-item">
                                    <p>Margin</p>
                                    <p>12</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>