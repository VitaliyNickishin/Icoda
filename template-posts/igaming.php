<?php
/* Template Name: iGaming Marketing 
Template Post Type: post
*/

global $post;

get_header();

?>
<script>
    window.intercomSettings = {
        app_id: "gdz549ih"
    };
</script>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <nav class="wr-breadcrumb" aria-label="breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?php the_breadcrumbs(); ?>
                    </div>
                </div>
            </div>
        </nav>

        <?php
        if (empty($_GET['post-redesign'])) :
            the_content();
        else :
        ?>

            <section class="section section-hero-new section-hero-new-service">
                <div class="section-hero-new__inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-lg-7 pr-lg-0">
                                <h1 class="h1 mb-3 mb-lg-4 title">
                                    <span class="title-gradient">
                                        <?php echo _e('iGaming Marketing Service', 'icoda') ?>
                                    </span>
                            
                                </h1>
                                <p class="subtitle">
                                    <?php echo _e('We delve into the heart of your crypto casino, pinpointing strengths and opportunities for improvement to devise a promotion strategy uniquely suited to your needs.', 'icoda') ?>
                                </p>
                                <div class="mt-lg-4 mt-3 pt-3 pt-lg-0">
                                    <?php get_template_part('template-parts/_partials/btn-hero'); ?>
                                </div>       
                                
                            </div>
                            
                            <div class="col-12 col-lg-5">
                                <div class="bg-wrap position-relative d-flex flex-column align-items-center mt-5 pt-4 mt-lg-0 pt-lg-0">
                                    <picture>
                                        <!-- <source
                                            srcset="<?php echo get_template_directory_uri(); ?>/assets/images/gradient-hero-mob.png"
                                            media="(max-width: 575px)"
                                        /> -->
                                        <img class="bg-image-1" src="<?php echo get_template_directory_uri(); ?>/assets/images/hero_img_1.png" alt="casinos" />
                                    </picture>
                                
                                    <div class="serv-box">
                                        <span class="number"><?php _e('5x', 'icoda'); ?></span>
                                        <p><?php _e('FTDs increase', 'icoda'); ?></p>
                                    </div>
                                    <div class="serv-box">
                                        <span class="number"><?php _e('10+', 'icoda'); ?></span>
                                        <p><?php _e('casinos turst us', 'icoda'); ?></p>
                                    </div>
                                    <div class="serv-box">
                                        <span class="number"><?php _e('9+', 'icoda'); ?></span>
                                        <p><?php _e('effctive channels to attract FTD', 'icoda'); ?></p>
                                    </div>
                                    <picture>
                                    <!-- <source
                                        srcset="<?php echo get_template_directory_uri(); ?>/assets/images/gradient-hero-mob.png"
                                        media="(max-width: 575px)"
                                    /> -->
                                    <img class="bg-image-2" src="<?php echo get_template_directory_uri(); ?>/assets/images/hero_img_2.png" alt="casinos-2" />
                                </picture>
                                </div>
                            </div>
                            

                            <div class="col-12 pr-0">
                                <div class="mt-5 pt-4">
                                    <div class="hero-slider-services custom-slider">
                                        <div
                                            class="media-logo">
                                            <picture>
                                                <img src="/wp-content/uploads/2024/11/clutch-logo.svg" alt="Clutch" />
                                            </picture>
                                            <span class="media-title">
                                                <?php echo _e('Top Digital Strategy Company', 'icoda') ?>
                                            </span>
                                        </div>
                                        <div
                                            class="media-logo">
                                            <picture>
                                                <img src="/wp-content/uploads/2024/11/trustpilot-logo.svg" alt="Trustpilot" />
                                            </picture>
                                            <span class="media-title">
                                                <?php echo _e('Top Rated Trustpilot Agency', 'icoda') ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="has-gradient">
                        <picture>
                            <source
                                srcset="<?php echo get_template_directory_uri(); ?>/assets/images/gradient-hero-mob.png"
                                media="(max-width: 575px)"
                            />
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/gradient-hero-desk.png" alt="gradient" />
                        </picture>
                    </div>
                </div>
                
            </section>

            <section class="section section-services-cases my-3 py-4 my-lg-5 py-lg-2">
                
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <h3 class="section-title mb-3 mb-lg-4">
                                    <?php echo _e('Our iGaming Background', 'icoda') ?>
                                </h3>
                                <p class="subtitle mb-3 pb-3 mb-lg-4 pr-lg-5 mr-lg-4">
                                    <?php echo _e('We delve into the heart of your crypto casino, pinpointing strengths and opportunities for improvement to devise a promotion strategy uniquely suited to your needs.', 'icoda') ?>
                                </p>
                            
                            </div>
                            
                            <div class="col-12 pr-0">
                                <div class="slider-services-list custom-slider d-flex">
                                    <a href="#" class="services-card card-cases card-has-rotate-arrow">
                                        <div class="services-card-img">
                                            <img src="/wp-content/uploads/2025/01/slide-service-1.png" alt="Slide-1">
                                        </div>
                                        <div class="services-card-body">
                                            <span class="h6 title pr-3"><?php echo _e('Become #1 Crypto Casino in Google', 'icoda') ?></span>
                                            <img class="btn-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-circle.svg" alt="Read more" />
                                        </div>
                                    </a> 
                                    <a href="#" class="services-card card-cases card-has-rotate-arrow">
                                        <div class="services-card-img">
                                            <img src="/wp-content/uploads/2025/01/slide-service-1.png" alt="Slide-1">
                                        </div>
                                        <div class="services-card-body">
                                            <span class="h6 title pr-3"><?php echo _e('Become #1 Crypto Casino in Google', 'icoda') ?></span>
                                            <img class="btn-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-circle.svg" alt="Read more" />
                                        </div>
                                    </a> 
                                    <a href="#" class="services-card card-cases card-has-rotate-arrow">
                                        <div class="services-card-img">
                                            <img src="/wp-content/uploads/2025/01/slide-service-1.png" alt="Slide-1">
                                        </div>
                                        <div class="services-card-body">
                                            <span class="h6 title pr-3"><?php echo _e('Become #1 Crypto Casino in Google', 'icoda') ?></span>
                                            <img class="btn-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-circle.svg" alt="Read more" />
                                        </div>
                                    </a> 
                                    <a href="#" class="services-card card-cases card-has-rotate-arrow">
                                        <div class="services-card-img">
                                            <img src="/wp-content/uploads/2025/01/slide-service-1.png" alt="Slide-1">
                                        </div>
                                        <div class="services-card-body">
                                            <span class="h6 title pr-3"><?php echo _e('Become #1 Crypto Casino in Google', 'icoda') ?></span>
                                            <img class="btn-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-circle.svg" alt="Read more" />
                                        </div>
                                    </a> 
                                </div>

                                <div class="mt-3 pt-3 pt-lg-4 text-center text-lg-left">
                                    <a href="#" class="btn btn-blue"><?php echo _e('See All Cases', 'icoda') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                
            </section>

            <section class="section section-services-list py-3 my-4 py-lg-5 my-lg-2">
                
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <h3 class="section-title mb-4">
                                    <?php echo _e('Our iGaming Services', 'icoda') ?>
                                </h3>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4 py-lg-3 my-lg-0 py-2 my-1">
                                <a href="#" class="services-card card-has-rotate-arrow">
                                    <div class="services-card-header">
                                        <span class="h4 title pr-3">
                                            <?php echo _e('Marketing Strategy', 'icoda') ?>
                                        </span>
                                        <img class="btn-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-circle.svg" alt="Read more" />
                                    </div>
                                    <div class="services-card-body">
                                        <?php echo _e('Unlock your success with a thoughtfully crafted strategy that blends structure and creativity, tailored perfectly to your brand and audience.', 'icoda') ?>
                                    </div>
                                </a> 
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 py-lg-3 my-lg-0 py-2 my-1">
                                <a href="#" class="services-card card-has-rotate-arrow">
                                    <div class="services-card-header">
                                        <span class="h4 title pr-3">
                                            <?php echo _e('Web Design', 'icoda') ?>
                                        </span>
                                        <img class="btn-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-circle.svg" alt="Read more" />
                                    </div>
                                    <div class="services-card-body">
                                        <?php echo _e('Elevate your online casino with stunning visuals and intuitive design. We craft user-friendly interfaces that keep players engaged and coming back for more.', 'icoda') ?>
                                    </div>
                                </a> 
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 py-lg-3 my-lg-0 py-2 my-1">
                                <a href="#" class="services-card card-has-rotate-arrow">
                                    <div class="services-card-header">
                                        <span class="h4 title pr-3">
                                            <?php echo _e('Website Development', 'icoda') ?>
                                        </span>
                                        <img class="btn-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-circle.svg" alt="Read more" />
                                    </div>
                                    <div class="services-card-body">
                                        <?php echo _e('Draw in potential users and deliver a dynamic, immersive experience with a gambling website tailored specifically to your needs.', 'icoda') ?>
                                    </div>
                                </a> 
                            </div>

                            <div class="col-12 col-md-6 col-lg-4 py-lg-3 my-lg-0 py-2 my-1">
                                <a href="#" class="services-card card-has-rotate-arrow">
                                    <div class="services-card-header">
                                        <span class="h4 title pr-3">
                                            <?php echo _e('SEO', 'icoda') ?>
                                        </span>
                                        <img class="btn-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-circle.svg" alt="Read more" />
                                    </div>
                                    <div class="services-card-body">
                                        <?php echo _e('Climb the search engine ladder and dominate organic traffic. Our SEO experts will optimize your online casino website to attract high-value players.', 'icoda') ?>
                                    </div>
                                </a> 
                            </div>

                            <div class="col-12 col-md-6 col-lg-4 py-lg-3 my-lg-0 py-2 my-1">
                                <a href="#" class="services-card card-has-rotate-arrow">
                                    <div class="services-card-header">
                                        <span class="h4 title pr-3">
                                            <?php echo _e('Public Relations (PR)', 'icoda') ?>
                                        </span>
                                        <img class="btn-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-circle.svg" alt="Read more" />
                                    </div>
                                    <div class="services-card-body">
                                        <?php echo _e('Get noticed by the right players. We craft strategic PR campaigns that generate positive buzz and build brand awareness for your online casino.', 'icoda') ?>
                                    </div>
                                </a> 
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 py-lg-3 my-lg-0 py-2 my-1">
                                <a href="#" class="services-card card-has-rotate-arrow">
                                    <div class="services-card-header">
                                        <span class="h4 title pr-3">
                                            <?php echo _e('Influencer Marketing', 'icoda') ?>
                                        </span>
                                        <img class="btn-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-circle.svg" alt="Read more" />
                                    </div>
                                    <div class="services-card-body">
                                        <?php echo _e('The online gambling industry is dynamic and fiercely competitive, making it essential for your business to distinguish itself from the crowd to capitalize on this profitable market.', 'icoda') ?>
                                    </div>
                                </a> 
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 py-lg-3 my-lg-0 py-2 my-1">
                                <a href="#" class="services-card card-has-rotate-arrow">
                                    <div class="services-card-header">
                                        <span class="h4 title pr-3">
                                            <?php echo _e('PPC Marketing', 'icoda') ?>
                                        </span>
                                        <img class="btn-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-circle.svg" alt="Read more" />
                                    </div>
                                    <div class="services-card-body">
                                        <?php echo _e('To succeed in the competitive iGaming industry, your business must stand out. With over 65% of SMBs using PPC, why should iGaming lag behind?', 'icoda') ?>
                                    </div>
                                </a> 
                            </div>

                            <div class="col-12 col-md-6 col-lg-4 py-lg-3 my-lg-0 py-2 my-1">
                                <a href="#" class="services-card card-has-rotate-arrow">
                                    <div class="services-card-header">
                                        <span class="h4 title pr-3">
                                            <?php echo _e('Social Media Marketing', 'icoda') ?>
                                        </span>
                                        <img class="btn-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-circle.svg" alt="Read more" />
                                    </div>
                                    <div class="services-card-body">
                                        <?php echo _e('Connect with gaming enthusiasts on social media and expand your audience by crafting content that speaks their language.', 'icoda') ?>
                                    </div>
                                </a> 
                            </div>

                            <div class="col-12 col-md-6 col-lg-4 py-lg-3 my-lg-0 py-2 my-1">
                                <a href="#" class="services-card card-has-rotate-arrow">
                                    <div class="services-card-header">
                                        <span class="h4 title pr-3">
                                            <?php echo _e('Online Reputation Management', 'icoda') ?>
                                        </span>
                                        <img class="btn-arrow" src="<?php echo get_template_directory_uri(); ?>/assets/images/btn-circle.svg" alt="Read more" />
                                    </div>
                                    <div class="services-card-body">
                                        <?php echo _e('Enhance brand credibility by monitoring, analyzing, and improving your digital image. Mitigate negative content, amplify positive feedback, and build trust within the iGaming audience.', 'icoda') ?>
                                    </div>
                                </a> 
                            </div>

                        </div>
                        <div class="row mt-5 pt-4">
                            <div class="col-12 text-center">
                                <h4 class="h4 mb-0 title">
                                    <?php echo _e('Let us help you win big!', 'icoda') ?>
                                </h4>
                                <span class="d-md-block undertitle">
                                    <?php echo _e('Don’t gamble with your iGaming marketing success.', 'icoda') ?>
                                </span>
                                <div class="pt-lg-2 m-auto">
                                    <a href="#" class="btn btn-blue mt-4"><?php echo _e('Contact us', 'icoda') ?></a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                
            </section>

            <section class="section section-path my-3 py-4 my-lg-5 py-lg-2">
                <div class="section-path-inner mx-lg-5 mx-sm-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="section-title mb-3 mb-lg-4">
                                    <?php echo _e('Your Path to iGaming Market Success 🥇️', 'icoda') ?>
                                </h3>
                            </div>
                            
                            <div class="col-12 pr-0">
                                <div class="slider-path-list custom-slider d-flex">
                                    <div class="services-card">
                                        <div class="services-card-header">
                                            <span class="h4 title pr-3">
                                                <?php echo _e('Connect with Us', 'icoda') ?>
                                            </span>
                                            <div class="number-step">1</div>
                                        </div>
                                        <div class="services-card-body">
                                            <?php echo _e('Schedule a call with our expert or reach out directly to discuss your goals.', 'icoda') ?>
                                        </div>
                                    </div>
                                    <div class="services-card">
                                        <div class="services-card-header">
                                            <span class="h4 title pr-3">
                                                <?php echo _e('Fill Out a Quick Brief', 'icoda') ?>
                                            </span>
                                            <div class="number-step">2</div>
                                        </div>
                                        <div class="services-card-body">
                                            <?php echo _e('Share key details about your project, target geo, and objectives to help us tailor our approach.', 'icoda') ?>
                                        </div>
                                    </div>  
                                    <div class="services-card">
                                        <div class="services-card-header">
                                            <span class="h4 title pr-3">
                                                <?php echo _e('Review Our Customized Offer', 'icoda') ?>
                                            </span>
                                            <div class="number-step">3</div>
                                        </div>
                                        <div class="services-card-body">
                                            <?php echo _e('Receive a well-researched proposal crafted to align with your goals and audience.', 'icoda') ?>
                                        </div>
                                    </div> 
                                    <div class="services-card">
                                        <div class="services-card-header">
                                            <span class="h4 title pr-3">
                                                <?php echo _e('Optimize and Finalize Together', 'icoda') ?>
                                            </span>
                                            <div class="number-step">4</div>
                                        </div>
                                        <div class="services-card-body">
                                            <?php echo _e('Collaborate with our team to adjust the strategy for maximum impact in your desired geo.', 'icoda') ?>
                                        </div>
                                    </div> 
                                    <div class="services-card">
                                        <div class="services-card-header">
                                            <span class="h4 title pr-3">
                                                <?php echo _e('Launch a Winning Marketing Solution', 'icoda') ?>
                                            </span>
                                            <div class="number-step">5</div>
                                        </div>
                                        <div class="services-card-body">
                                            <?php echo _e('Leverage ICODA’s expertise to implement the best channels and strategies to attract First-Time Depositors (FTD) and achieve your goals.', 'icoda') ?>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="arrow-control arrow-control-path"></div>
                            </div>
                           
                            <div class="col-12">
                                <div class="section-path-bottom text-center">
                                    <h4 class="h4 mb-0 title fw-semibold">
                                        <?php echo _e('⚡️ Let’s Work Together', 'icoda') ?>
                                    </h4>
                                    <div class="pt-1 m-auto">
                                        <a href="#" class="btn btn-pink mt-3"><?php echo _e('Talk to Us', 'icoda') ?></a>
                                    </div>
                                </div>
                                
                            </div>
                            
                        
                        </div>
                    </div>
                    
                </div>
            </section>

            <section class="section-stories my-lg-2 py-lg-5 py-4 my-3">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <h3 class="section-title mb-4 pb-3">
                                <?php echo _e('Join the Success Stories', 'icoda') ?>
                            </h3>
                            
                        </div>
                        <div class="col-12 pr-0">
                                
                            <div class="slider-stories custom-slider">
                                <div
                                    class="media-logo">
                                    <picture>
                                        <img src="/wp-content/uploads/2025/01/bc-game-logo.png" alt="bc game" />
                                    </picture>
                                </div>
                                <div
                                    class="media-logo">
                                    <picture>
                                        <img src="/wp-content/uploads/2025/01/bitcasino-logo.png" alt="bitcasino" />
                                    </picture>
                                </div>
                                <div
                                    class="media-logo">
                                    <picture>
                                        <img src="/wp-content/uploads/2025/01/cp-logo.png" alt="Coin Poker" />
                                    </picture>
                                </div>
                                <div
                                    class="media-logo">
                                    <picture>
                                        <img src="/wp-content/uploads/2025/01/playbet.png" alt="Playbet" />
                                    </picture>
                                </div>
                                <div
                                    class="media-logo">
                                    <picture>
                                        <img src="/wp-content/uploads/2025/01/bombastic-dark-logo.svg" alt="Boombastic" />
                                    </picture>
                                </div>
                                <div
                                    class="media-logo">
                                    <picture>
                                        <img src="/wp-content/uploads/2025/01/huge.png" alt="Huge" />
                                    </picture>
                                </div>
                                
                            </div>
                                
                        </div>
                        <div class="col-12">
                                <div class="arrow-control arrow-control-stories"></div>
                            </div>
                    </div>
                </div>
            </section>

            <section class="section section-businesses my-5 py-5">
                <div class="section-businesses-inner mx-lg-5 mx-sm-4 position-relative">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="section-title mb-3 mb-lg-4">
                                    <?php echo _e('Challenges We Solve for iGaming Businesses ⚡', 'icoda') ?>
                                </h3>
                                <p class="subtitle mb-3 mb-lg-4">
                                    <?php echo _e('At ICODA, we understand the unique hurdles faced by iGaming projects. Here\'s how we help tackle them with tailored solutions.', 'icoda') ?>
                                </p>
                            </div>
                        </div>
                        <div class="row position-relative z-1">
                            <div class="col-12 col-md-6 col-lg-4 py-lg-3 my-lg-0 py-2 my-1">
                                <div class="services-card">
                                    <div class="services-card-header">
                                        <span class="h4 title">
                                            <?php echo _e('Low FTD Engagement', 'icoda') ?>
                                        </span>
                                    </div>
                                    <div class="services-card-body d-none d-lg-block">
                                        <?php echo _e('Attracting new depositors can be challenging. We employ 9+ proven channels specifically designed to drive FTD engagement and ensure sustainable growth.', 'icoda') ?>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 py-lg-3 my-lg-0 py-2 my-1">
                                <div class="services-card">
                                    <div class="services-card-header">
                                        <span class="h4 title">
                                            <?php echo _e('Poor Online Reputation', 'icoda') ?>
                                        </span>
                                    </div>
                                    <div class="services-card-body d-none d-lg-block">
                                        <?php echo _e('A negative online image can hinder your success. Our Online Reputation Management (ORM) strategies rebuild trust and enhance your brand’s credibility in the market.', 'icoda') ?>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 py-lg-3 my-lg-0 py-2 my-1">
                                <div class="services-card">
                                    <div class="services-card-header">
                                        <span class="h4 title">
                                            <?php echo _e('Outdated or Underperforming Website', 'icoda') ?>
                                        </span>
                                    </div>
                                    <div class="services-card-body d-none d-lg-block">
                                        <?php echo _e('An ineffective website limits growth. We provide cutting-edge website development and design to improve user experience, functionality, and conversion rates.', 'icoda') ?>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 py-lg-3 my-lg-0 py-2 my-1">
                                <div class="services-card">
                                    <div class="services-card-header">
                                        <span class="h4 title">
                                            <?php echo _e('Low Visibility in Search Engines', 'icoda') ?>
                                        </span>
                                    </div>
                                    <div class="services-card-body d-none d-lg-block">
                                        <?php echo _e('Limited search engine visibility affects organic traffic. Our SEO strategies enhance your rankings, boost visibility, and attract the right audience.', 'icoda') ?>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 py-lg-3 my-lg-0 py-2 my-1">
                                <div class="services-card">
                                    <div class="services-card-header">
                                        <span class="h4 title">
                                            <?php echo _e('Limited Reach with Paid Advertising', 'icoda') ?>
                                        </span>
                                    </div>
                                    <div class="services-card-body d-none d-lg-block">
                                        <?php echo _e('Maximizing returns from PPC campaigns requires precision. We optimize PPC campaigns with targeted strategies and compelling creative for the best ROI.', 'icoda') ?>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 py-lg-3 my-lg-0 py-2 my-1">
                                <div class="services-card">
                                    <div class="services-card-header">
                                        <span class="h4 title">
                                            <?php echo _e('Weak Social Media Presence', 'icoda') ?>
                                        </span>
                                    </div>
                                    <div class="services-card-body d-none d-lg-block">
                                        <?php echo _e('A strong connection with your audience is essential. Our Social Media Marketing (SMM) solutions build engagement, foster loyalty, and grow brand awareness effectively.', 'icoda') ?>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    
                </div>
            </section>

            <!-- @todo section testimonials with button All cases -->
            <?php if (get_field('section_6_show') == true) : ?>
                <section id="testimonials" class="section section-testimonials" data-need-load="1" data-post-id="<?php echo get_the_ID(); ?>">
                </section>
            <?php endif; ?>

            <section class="section section-faq-service">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <h3 class="section-title mb-3 mb-lg-4">
                                <?php echo _e('Frequently Asked Questions', 'icoda') ?>
                            </h3>
                            <p class="subtitle mb-3 mb-lg-4">
                                <?php echo _e('Can’t find what you’re looking for? Check out our common questions, please contact us at post@icoda.io or telegram.', 'icoda') ?>
                            </p>
                        </div>
                        <div class="col-12 offset-lg-1 col-lg-7">
                            
                            <div
                            class="accordion accordion-faq accordion-faq-service"
                            data-action="accordion-faq"
                            >
                                <div class="tab active">
                                    <input
                                        id="tabfaq-1"
                                        type="checkbox"
                                        name="faq[1][]"
                                        value=""
                                        checked
                                    />
                                    <label for="tabfaq-1">
                                        <?php echo _e('What makes iGaming marketing different from traditional digital marketing?', 'icoda') ?>
                                    </label>
                                    <div class="tab-content">
                                        <p>
                                            <?php echo _e('iGaming marketing requires a deep understanding of the gaming industry, player behavior, and regulatory compliance. Unlike traditional digital marketing, iGaming strategies focus on user acquisition, retention, and engagement through personalized promotions, gamification, and platform-specific tactics.', 'icoda') ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="tab">
                                    <input
                                        id="tabfaq-2"
                                        type="checkbox"
                                        name="faq[1][]"
                                        value=""
                                    />
                                    <label for="tabfaq-2">
                                        <?php echo _e('How do you attract high-value players to an iGaming platform?', 'icoda') ?>
                                    </label>
                                    <div class="tab-content">
                                        <p>
                                            <?php echo _e('We attract high-value players through targeted campaigns, loyalty programs, and VIP incentives. By leveraging data analytics and personalized content, we ensure campaigns resonate with high-rollers and create a tailored experience that keeps them engaged', 'icoda') ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="tab">
                                    <input
                                        id="tabfaq-3"
                                        type="checkbox"
                                        name="faq[1][]"
                                        value=""
                                    />
                                    <label for="tabfaq-3">
                                        <?php echo _e('What are the best channels for promoting iGaming platforms?', 'icoda') ?>
                                    </label>
                                    <div class="tab-content">
                                        <p>
                                            <?php echo _e('The most effective channels include social media, paid ads, SEO, influencer collaborations and email campaigns. Combining these ensures wide exposure, player acquisition, and retention across multiple touchpoints.', 'icoda') ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="tab">
                                    <input
                                        id="tabfaq-4"
                                        type="checkbox"
                                        name="faq[1][]"
                                        value=""
                                    />
                                    <label for="tabfaq-4">
                                        <?php echo _e('How do you ensure compliance in iGaming marketing campaigns?', 'icoda') ?>
                                    </label>
                                    <div class="tab-content">
                                        <p>
                                            <?php echo _e('We follow region-specific regulations and industry standards to ensure all marketing campaigns remain compliant. This includes adhering to responsible gaming guidelines, age restrictions, and advertising policies specific to different jurisdictions.', 'icoda') ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="tab">
                                    <input
                                        id="tabfaq-5"
                                        type="checkbox"
                                        name="faq[1][]"
                                        value=""
                                    />
                                    <label for="tabfaq-5">
                                        <?php echo _e('How can gamification improve player engagement on my platform?', 'icoda') ?>
                                    </label>
                                    <div class="tab-content">
                                        <p>
                                            <?php echo _e('Gamification adds excitement and loyalty to your platform. By incorporating leaderboards, tournaments, rewards, and achievements, we motivate players to return regularly, increasing retention rates and lifetime value.', 'icoda') ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="tab">
                                    <input
                                        id="tabfaq-6"
                                        type="checkbox"
                                        name="faq[1][]"
                                        value=""
                                    />
                                    <label for="tabfaq-6">
                                        <?php echo _e('How do you measure the success of iGaming marketing campaigns?', 'icoda') ?>
                                    </label>
                                    <div class="tab-content">
                                        <p>
                                            <?php echo _e('We use key performance indicators (KPIs) like first time deposit (FTD), player acquisition cost (PAC), customer lifetime value (CLV), retention rates, and ROI. Tools like Google Analytics, CRM systems, and in-depth performance reports help us optimize campaigns for measurable success.', 'icoda') ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="tab">
                                    <input
                                        id="tabfaq-7"
                                        type="checkbox"
                                        name="faq[1][]"
                                        value=""
                                    />
                                    <label for="tabfaq-7">
                                        <?php echo _e('What role does content play in iGaming marketing?', 'icoda') ?>
                                    </label>
                                    <div class="tab-content">
                                        <p>
                                            <?php echo _e('Content is key to engaging audiences and building trust. Informative blogs, video guides, game reviews, and social content educate players, showcase your platform’s value, and enhance SEO for greater visibility.', 'icoda') ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="tab">
                                    <input
                                        id="tabfaq-8"
                                        type="checkbox"
                                        name="faq[1][]"
                                        value=""
                                    />
                                    <label for="tabfaq-8">
                                        <?php echo _e('How can SEO strategies benefit iGaming businesses?', 'icoda') ?>
                                    </label>
                                    <div class="tab-content">
                                        <p>
                                            <?php echo _e('SEO strategies improve your platform\'s visibility on search engines, attracting organic traffic. Through keyword optimization, link-building, and technical SEO, we position your brand in front of players actively searching for iGaming opportunities.', 'icoda') ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="tab">
                                    <input
                                        id="tabfaq-9"
                                        type="checkbox"
                                        name="faq[1][]"
                                        value=""
                                    />
                                    <label for="tabfaq-9">
                                        <?php echo _e('How can SEO strategies benefit iGaming businesses?', 'icoda') ?>
                                    </label>
                                    <div class="tab-content">
                                        <p>
                                            <?php echo _e('SEO strategies improve your platform\'s visibility on search engines, attracting organic traffic. Through keyword optimization, link-building, and technical SEO, we position your brand in front of players actively searching for iGaming opportunities.', 'icoda') ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="tab">
                                    <input
                                        id="tabfaq-10"
                                        type="checkbox"
                                        name="faq[1][]"
                                        value=""
                                    />
                                    <label for="tabfaq-10">
                                        <?php echo _e('How do you retain players in such a competitive iGaming market?', 'icoda') ?>
                                    </label>
                                    <div class="tab-content">
                                        <p>
                                            <?php echo _e('Retention is achieved through personalized player journeys, loyalty programs, bonuses, and regular engagement campaigns. By understanding player preferences and providing incentives, we keep users connected to your platform long-term.', 'icoda') ?>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>	
                </section>


        <?php endif; ?>

    <?php endwhile; ?>

    <?php
    echo do_shortcode('[contact-form-new]');
    ?>

<?php endif; ?>

<?php
get_footer();
