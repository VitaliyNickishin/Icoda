<?php
$show = get_field('section_solutions_show');
?>
<?php if ($show) : ?>

    <?php
    $left = get_field('section_solutions_left_block');
    $center = get_field('section_solutions_center_block');
    $right = get_field('section_solutions_right_block');
    ?>

    <section class="section section-solutions">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4 px-lg-0">
                    <div class="block block-one">
                        <h3 class="mb-lg-5 mb-3 title text-capitalize">
                            <?php echo $left['title']; ?></h3>
                        <div class="block-content">
                            <?php echo  $left['description']; ?>
                        </div>

                        <?php if(!empty($left['link']) && !empty($left['link']['url'])) : ?>
                        <div class="wr-btn mt-3 pt-3 pt-lg-4 mt-lg-5">
                            <a href="<?php echo $left['link']['url']; ?>" <?php echo !empty($left['link']['target']) ? ' target="_blank" ' : ''; ?> class="btn btn-blue"><?php echo $left['link']['title']; ?></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-12 col-lg-4 px-lg-0">
                    <div class="block block-two d-flex flex-column justify-content-between">
                        <div class="block-img">
                            <picture>
                                <source srcset="<?php echo  $center['image_mobile']; ?>" media="(max-width: 991px)" />
                                <img src="<?php echo  $center['image_desktop']; ?>" alt="">
                            </picture>
                        </div>
                        <div class="mt-3 pt-lg-3 mt-lg-4">
                            <?php if(!empty($center['top_link']) && !empty($center['top_link']['url'])) : ?>
                                <a href="<?php echo  $center['top_link']['url']; ?>" <?php echo !empty($center['top_link']['target']) ? ' target="_blank" ' : ''; ?> class="btn-link">
                                    <span>
                                        <?php echo  $center['top_link']['title']; ?>
                                    </span>
                                    <svg width="67" height="67" viewBox="0 0 67 67" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_53_10841)">
                                            <path d="M16.3542 50.5105L51.363 15.5017M51.363 15.5017L51.363 48.5655M51.363 15.5017L18.2991 15.5017" stroke="currentColor" stroke-width="4.47757" stroke-linecap="round" stroke-linejoin="round" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_53_10841">
                                                <rect width="66.0133" height="66.0133" fill="currentColor" transform="translate(66.8652) rotate(90)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </div>
                        <ul class="tag-list">
                            <?php if(!empty($center['links'])) : ?>
                                <?php foreach ($center['links'] as $link_item) : ?>
                                    <li>
                                        <a href="<?php echo  $link_item['link']['url']; ?>" <?php echo !empty($link_item['link']['target']) ? ' target="_blank" ' : ''; ?> class="d-inline-block">
                                            <?php echo  $link_item['link']['title']; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>

                </div>

                <div class="col-12 col-lg-4 px-lg-0">
                    <div class="block block-three d-flex flex-column justify-content-between">
                        <div class="block-img">
                            <picture>
                                <source srcset="<?php echo  $right['image_mobile']; ?>" media="(max-width: 991px)" />
                                <img src="<?php echo  $right['image_desktop']; ?>" alt="">
                            </picture>
                        </div>
                        <div class="mt-3 pt-lg-3 mt-lg-4">

                            <?php if(!empty($right['top_link']) && !empty($right['top_link']['url'])) : ?>
                                <a href="<?php echo  $right['top_link']['url']; ?>" <?php echo !empty($right['top_link']['target']) ? ' target="_blank" ' : ''; ?> class="btn-link">
                                    <span>
                                        <?php echo  $right['top_link']['title']; ?>
                                    </span>
                                    <svg width="67" height="67" viewBox="0 0 67 67" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_53_10841)">
                                            <path d="M16.3542 50.5105L51.363 15.5017M51.363 15.5017L51.363 48.5655M51.363 15.5017L18.2991 15.5017" stroke="currentColor" stroke-width="4.47757" stroke-linecap="round" stroke-linejoin="round" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_53_10841">
                                                <rect width="66.0133" height="66.0133" fill="currentColor" transform="translate(66.8652) rotate(90)" />
                                            </clipPath>
                                        </defs>
                                    </svg>

                                </a>
                            <?php endif; ?>

                        </div>
                        <ul class="tag-list">
                            <?php if(!empty($right['links'])) : ?>
                                <?php foreach ($right['links'] as $link_item) : ?>
                                    <li>
                                        <a href="<?php echo  $link_item['link']['url']; ?>" <?php echo !empty($link_item['link']['target']) ? ' target="_blank" ' : ''; ?> class="d-inline-block">
                                            <?php echo  $link_item['link']['title']; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </section>

<?php endif; ?>