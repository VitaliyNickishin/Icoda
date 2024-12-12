    <style>
        .article-page .section-partners {
            border-top: 1px solid #e0e8ff;
            padding-bottom: 50px;
            padding-top: 50px;
            border-bottom: 1px solid #e0e8ff;
        }

        .section-partners .list-logo {
            padding: 0;
            background: 0 0;
        }

        .section-partners .list-logo .list-logo-item {
            -ms-flex: 1 0 33.33%;
            flex: 1 0 33.33%;
            width: 33.33%;
            border: none;
            display: -ms-flexbox;
            display: flex;
            margin-top: 50px;
            padding: 0 40px;
            flex-wrap: wrap;
            align-content: space-around;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }

        .section-partners .list-logo .list-logo-item img {
            margin: auto;
            width: auto;
            max-width: 100%;
            height: auto;
        }

        @media (max-width: 767.98px) {
            .section-partners .list-logo .list-logo-item {
                width: 50%;
                -ms-flex: 1 0 50%;
                flex: 1 0 50%
            }
        }
    </style>
    <section class="section section-partners">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="vert-box">
                        <p class="h3"><?php block_field('section_maus_title'); ?></p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="list-logo">

                        <?php while (block_rows('section_maus_Items')) :
                            block_row('section_maus_Items'); ?>

                            <a href="<?php block_sub_field('link'); ?>" target="_blank" rel="nofollow" class="list-logo-item">
                                <img src="<?php block_sub_field('icon'); ?>" alt="img-logo">
                            </a>

                        <?php endwhile;
                        reset_block_rows('section_maus_Items'); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>