<?php
/* Template Name: Main page */
get_header();
?>
<script>
  window.intercomSettings = {
    app_id: "gdz549ih"
  };
</script>

<?php if(get_field('section_1_show')): ?>
<header class="section section-1">
	
	<div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-5">
                <div class="text">
                    <h1 class="section-title"><?php the_field('section_1_name_form_block-en'); ?></h1>
                    <div class="sub-text">
                        <?php the_field('section_1_subtitle_block-en'); ?>
                    </div>
                    <a href="#" data-modal="#callback" class="btn btn-blue open-modal"><?php echo __('Get Your Proposal', 'icoda'); ?></a>
                </div>
            </div>
            <div class="d-none d-md-block col-md-7">
                <div class="anim-box d-flex">
                    <div class="v-1"></div>
                    <div class="v-2"></div>
                    <div class="v-3"></div>
                    <div class="bg-computer"></div>
                    <div class="bg-phone"></div>
                </div>
            </div>
        </div>
    </div>
</header>
<?php endif; ?>

<?php if(get_field('section_2_show')): ?>
<section class="section section-2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text">
                    <h3 class="section-title"><?php the_field('section_2_title_block-en'); ?></h3>
                    <p class="sub-text"><?php the_field('section_2_subtitle_block-en'); ?></p>
                </div>
            </div>
        </div>
        <div id="id2" class="row grid-masonry">
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 grid-sizer"></div>
                <?php $count = 0; $class = ''; ?>
                <?php while( has_sub_field('section_2-en') ): $count++; ?>
                    <?php
                    $class = '';
                    if ($count===1)
                        $class = 'col-first ';
                    elseif($count===2)
                        $class = 'col-second ';
                    elseif($count===3)
                        $class ='col-third ';
                    ?>
                    <div class="<?=$class; ?>col-sm-6 col-md-6 col-lg-4 col-xl-4 grid-item<?=$count>9?' grid-item-hide':''?>">
                        <a href="<?php echo get_sub_field('section_2_link-en'); ?>" class="service-card hot">
                            <span class="h6"><?php the_sub_field('section_2_title-en'); ?></span>
                            <span class="sub-text">
                                <span class="p"><?php the_sub_field('section_2_desc-en'); ?></span>
                            </span>
                            <span class="service-card-footer">
                                <span class="link-arrow"><?php echo __('Learn more', 'icoda'); ?></span>
                                <?php if(get_sub_field('section_2_label-en')): ?>
                                    <span class="label-hot"><?php the_sub_field('section_2_label-en'); ?></span>
                                <?php endif ?>
                            </span>
                        </a>
                    </div>
                    <?php if(get_sub_field('section_2_check-en')): ?>
                        <?php while(has_sub_field('section_2_check-en')): ?>
                            <object type="lol/wut">
                                <p><a href="<?php the_sub_field('section_2_check_link-en'); ?>"><?php the_sub_field('section_2_check_name-en'); ?></a></p>
                            </object>
                        <?php endwhile; ?>
                    <?php endif; ?>

                <?php endwhile; ?>

        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="text-center wr-btn">
                    <a href="#id2" class="btn btn-default btn-show-el"><?php echo __('Show all services', 'icoda'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if(get_field('section_3_show')): ?>
<section class="section section-3">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-8">
                <div class="text-box">
                    <div class="text">
                        <h3 class="section-title"><?php the_field('section_3_title_block-new-en'); ?></h3>
                        <p class="sub-text"><?php the_field('section_3_text_block-en'); ?></p>
                    </div>
                    <div class="label-list">
                        <?php foreach (get_field('section_3_repeater_block-en') as $item): ?>
                        <div class="label-list-item"><?=$item['t'];?></div>
                        <?php endforeach; ?>
                    </div>
                    <div class="bg-section" data-bg="<?php echo get_template_directory_uri(); ?>/assets/images/bg-home-s3.jpg"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if(get_field('section_4_show')): ?>
<section class="section section-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h3 class="section-title text-center"><?php the_field('section_3_title_block-en'); ?></h3>
            </div>
            <?php if( get_field('section_3-en') ): ?>
            <div class="col-12 col-sm-10 col-md-12">
                <div class="list-logo">
                    <?php while( has_sub_field('section_3-en') ): ?>
                        <div class="list-logo-item">
                            <div class="wr-img">
                                <img data-src="<?php the_sub_field('section_3_image-en'); ?>" src="<?php the_sub_field('section_3_image-en'); ?>" alt="img-logo">
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <div class="list-logo-item">
                        <div class="wr-img">
                            <div class="text">
                                <p class="h2">+300</p>
                                <p class="sub-text"><?php echo __('resources more', 'icoda'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>


<?php if( get_field('section_5_isShow-en') == true ): ?>
<section id="id5" class="section section-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex line-box justify-content-center">
                    <h2 class="section-title"><?php the_field('section_5_title_block-en'); ?></h2>
                    <a href="<?php the_field('section_4_btn_link-en'); ?>" data-modal="#callback" class="btn btn-white open-modal"><?php the_field('section_5_btn_name-en'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if( get_field('section_6_isShow-en') == true ): ?>
    <section id="id6" class="section section-6">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title"><?php the_field('section_6_title-en'); ?></h2>
                    <p class="sub-title"><?php the_field('section_6_subtitle-en'); ?></p>
                </div>
            </div>
            <div class="row card-list">

            <?php if( get_field('section_6-en') ): ?>
            <?php while( has_sub_field('section_6-en') ): ?>
                <div class="col-6 col-lg-3">
                    <div class="team-card">
                        <div class="team-card-header">
                            <img data-src="<?php the_sub_field('section_6_photo-en'); ?>" src="<?php //the_sub_field('section_6_photo-en'); ?>" alt="pic">
                        </div>
                        <div class="team-card-body">
                            <p class="name"><?php the_sub_field('section_6_team_name-en'); ?></p>
                            <p class="des"><?php the_sub_field('section_6_team_desc-en'); ?></p>
                            <div class="bottom-links">
                                <?php if( get_sub_field('section_6_team-en') ): ?>
                                <?php while( has_sub_field('section_6_team-en') ): ?>
                                    <a href="<?php the_sub_field('section_6_team_social_link-en'); ?>"><i class="fab <?php the_sub_field('section_6_team_social_class-en'); ?>"></i></a>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php endif; ?>

            </div>
        </div>
    </section>
<?php endif; ?>

<?php if( get_field('section_7_isShow-en') == true ): ?>
<section id="id7" class="section section-7">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title"><?php the_field('section_7_block_name-en'); ?></h2>
            </div>
        </div>
        <div class="row">
            <?php if( get_field('section_7-en') ): ?>
            <?php while( has_sub_field('section_7-en') ): ?>
                <div class="col-12 col-lg-6">
                    <div class="case-item">
                        <p class="h3"><?php the_sub_field('section_7_block_name-en'); ?></p>
                        <p><?php the_sub_field('section_7_block_desc-en'); ?></p>
                        <a href="<?php the_sub_field('section_7_block_btn_link-en'); ?>"><?php the_sub_field('section_7_block_btn_name-en'); ?> »</a>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if( get_field('section_5_show') == true ): ?>
<section class="section section-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="text">
                    <h3 class="section-title"><?php the_field('section_8_title-en'); ?></h3>
                    <p class="sub-text"><?php the_field('section_8_subtitle-en'); ?></p>
                    <a data-toggle="collapse" href="#" class="link-arrow" role="button" data-target=".multi-collapse-project-card" aria-expanded="false"><?php echo __('Show all brands', 'icoda'); ?></a>
                </div>
            </div>

            <?php $count=0; ?>
            <?php while(has_sub_field('our_clients_repeat')): $count++; ?>
            <div class="col-sm-6 col-lg-4">

                <?php if ($count > 8) : ?>
                    <div class="collapse multi-collapse-project-card">
                <?php endif; ?>

                    <div class="project-card">
                        <div class="project-card-header">
                            <div class="project-card-logo">
                                <img data-src="<?php the_sub_field('our_clients_logo'); ?>" src="<?php the_sub_field('our_clients_logo'); ?>" alt="logo-project">
                            </div>
                            <div class="project-card-flag" data-bg="<?php the_sub_field('country'); ?>" style="background: url(<?php //the_sub_field('country'); ?>) center no-repeat;"></div>
                        </div>
                        <div class="project-card-body">
                            <p><?php the_sub_field('our_clients_desc'); ?></p>
                        </div>
                    </div>

                <?php if ($count > 8) : ?>
                    </div>
                <?php endif; ?>

            </div>
            <?php endwhile; ?>

        </div>
    </div>
</section>
<?php endif; ?>

<?php if( get_field('section_maus_show') == true ): ?>
    <style>
    .section-6,
    .section-7 {
        padding-top: 50px;
    }
    .section-partners {
        padding-top: 50px;
        border-top: 1px solid #e0e8ff;
        padding-bottom: 50px;
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
                        <h3 class="section-title"><?php echo get_field( 'section_maus_title' ); ?></h3>
                </div>
                <div class="col-12">
                    <div class="list-logo">

                        <?php $media_items = get_field('section_maus_Items'); ?>
                        <?php foreach( $media_items as $media_item ) : ?>

                            <a href="<?php echo $media_item['link']; ?>" target="_blank" rel="nofollow" class="list-logo-item">
                                <img src="<?php echo $media_item['icon']; ?>" alt="img-logo">
                            </a>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if( get_field('section_6_show') == true ): ?>
<section id="testimonials" class="section section-6">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="section-title"><?php the_field('section_9_title-en'); ?></h3>
                </div>
                <div class="col-12">
                    <div class="wr-slider">
                        <div class="slider-default">

                            <?php while(has_sub_field('testimonials_repeat')): ?>
                            <div class="wr-slider-default-item">
                                <div class="slider-default-item">
                                    <div class="slider-default-item-header">
                                        <div class="profile-box">
                                            <div class="profile-box-avatar">
                                                <img data-lazy="<?php the_sub_field('testimonials_image'); ?>" src="<?php the_sub_field('testimonials_image'); ?>" alt="avatar">
                                            </div>
                                            <div class="profile-box-des">
                                                <p class="h5"><?php the_sub_field('testimonials_firstname'); the_sub_field('testimonials_lastname')?></p>
                                                <a href="<?php the_sub_field('testimonials_linkedin'); ?>" class="profile-link" target="_blank"><?php echo __('LinkedIn Profile', 'icoda'); ?></a>
                                            </div>
                                        </div>
                                        <div class="slider-logo-box">
                                            <img data-lazy="<?php the_sub_field('logo'); ?>" src="<?php the_sub_field('logo'); ?>" alt="logo-project">
                                        </div>
                                    </div>
                                    <div class="slider-default-item-body">
                                        <p><?php the_sub_field('testimonials_desc'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                        <div class="wr-control"></div>
                    </div>
                </div>
            </div>
        </div>
</section>
<?php endif; ?>

<?php if( get_field('section_7_show') == true ): ?>
<section class="section section-7">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="section-title"><?php the_field('section_7_title_block-new-en'); ?></h3>
                </div>
            </div>

            <div class="row list-leadership">
                <?php foreach(get_field('section_7-new_list-en') as $item): $count++;?>
                <div class="col-sm-6 col-lg-3">
                    <div class="list-leadership-item">

                            <span class="leadership-item-avatar" data-bg="<?php echo $item['image']; ?>" style="background: center bottom no-repeat;background-size:contain"></span>
                            <span class="leadership-item-des">
                                <span class="h6"><?= $item['name']; ?></span>
                                <span class="leadership-des-position"><?= $item['position']; ?> </span>
                                <span class="leadership-contact-icons">
                                    <?php echo ($item['author_page'] ? '<a href="'.$item['author_page'].'"><i class="fas fa-user"></i></a>' : ''); ?>
                                    <?php echo ($item['link'] ? '<a href="'.$item['link'].'" target="_blank"><i class="fab fa-linkedin" aria-hidden="true"></i></a>' : ''); ?>
                                </span>
                                <span class="leadership-des-text"><?= $item['desc']; ?></span>
                            </span>

                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
</section>
<?php endif; ?>

<?php if( 0 ): ?>
<section class="section section-7">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="section-title"><?php echo __('Advisors', 'icoda'); ?></h3>
                </div>
            </div>
       <div class="row list-leadership">
                                                <div class="col-sm-6 col-lg-3">
                    <a href="https://www.linkedin.com/in/pivnevvladislav/" target="_blank" class="list-leadership-item">
                        <!-- leadership-item-avatar- -->
                        <span class="leadership-item-avatar" style="background:url(<?php echo get_template_directory_uri() ?>/assets/images/ic/Vlad.png) center bottom no-repeat;background-size:contain"></span>
                        <span class="leadership-item-des">
                            <span class="h6"><?php echo __('Vlad Pivnev', 'icoda'); ?></span>
                            <span class="leadership-des-position"><?php echo __('CEO', 'icoda'); ?></span>
                            <span class="leadership-des-text"> <?php echo __('Vlad applies his design thinking to align your users/clients to your business goals. His experience in a wide variety of business sectors always brings a fresh perspective on business.', 'icoda'); ?></span>
                        </span>
                    </a>
                </div>
                                <div class="col-sm-6 col-lg-3">
                    <a href="https://www.linkedin.com/in/ilya-dobrovitsky/" target="_blank" class="list-leadership-item">
                        <!-- leadership-item-avatar- -->
                        <span class="leadership-item-avatar" style="background:url(<?php echo get_template_directory_uri() ?>/assets/images/ic/Ilya.png) center bottom no-repeat;background-size:contain"></span>
                        <span class="leadership-item-des">
                            <span class="h6"><?php echo __('Ilya Dobrovitsky', 'icoda'); ?></span>
                            <span class="leadership-des-position"><?php echo __('DBD', 'icoda'); ?></span>
                            <span class="leadership-des-text"><?php echo __('With years of experience as BizDev Director Ilya brings to our team new ideas for improvement, as well as additional cooperation with many companies in the field of cryptocurrencies and blockchain.', 'icoda'); ?></span>
                        </span>
                    </a>
                </div>
                                <div class="col-sm-6 col-lg-3">
                    <a href="https://www.linkedin.com/in/ruslanpivnev/" target="_blank" class="list-leadership-item">
                        <!-- leadership-item-avatar- -->
                        <span class="leadership-item-avatar" style="background:url(<?php echo get_template_directory_uri() ?>/assets/images/ic/Ruslan.png) center bottom no-repeat;background-size:contain"></span>
                        <span class="leadership-item-des">
                            <span class="h6"><?php echo __('Ruslan Pivnev', 'icoda'); ?></span>
                            <span class="leadership-des-position"><?php echo __('CMO', 'icoda'); ?></span>
                            <span class="leadership-des-text"><?php echo __("Ruslan is the most understanding marketing specialist you're going to meet. From design, promotion, user or client perspective – he's there for you, fully aware of a project's background.", 'icoda'); ?></span>
                        </span>
                    </a>
                </div>
                                <div class="col-sm-6 col-lg-3">
                    <a href="https://www.linkedin.com/in/%D1%81%D0%B5%D1%80%D0%B3%D0%B5%D0%B9-%D0%BD%D0%B5%D0%BB%D1%8E%D0%B1%D0%B8%D0%BD-5a288b73/" target="_blank" class="list-leadership-item">
                        <!-- leadership-item-avatar- -->
                        <span class="leadership-item-avatar" style="background:url(<?php echo get_template_directory_uri() ?>/assets/images/ic/Sergei.png) center bottom no-repeat;background-size:contain"></span>
                        <span class="leadership-item-des">
                            <span class="h6"><?php echo __('Sergei Nelyubin', 'icoda'); ?></span>
                            <span class="leadership-des-position"><?php echo __('CFO', 'icoda'); ?></span>
                            <span class="leadership-des-text"><?php echo __('Professional financial expert since 2010. Sergey ensures the control and management of all finance related topics and leads our agency to achieve the highest goals.', 'icoda'); ?></span>
                        </span>
                    </a>
                </div>
                            </div>
        </div>
</section>
<?php endif; ?>

<?php get_template_part('/parts/map-address-parts'); ?>

<?php
get_footer();?>