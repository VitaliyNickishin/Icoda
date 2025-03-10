<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package icoda
 */
?>

<footer class="footer section section-9">
    <?php get_template_part('template-parts/footer/group-companies') ?>
    <div class="footer-body">

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wr-footer-list-row">
                        <div class="center-col wr-footer-list-col">
                            <div class="footer-list">
                                <?php the_view('menu__footer', ['location' => 'footer-left']); ?>
                            </div>
                        </div>
                        <div class="center-col wr-footer-list-col">
                            <?php if (false && ICL_LANGUAGE_CODE != 'zh-hans') : ?>
                                <div class="footer-list">
                                    <?php the_view('menu__footer', ['location' => 'footer-center']); ?>
                                </div>
                            <?php else : ?>
                                <div class="wr-footer-list-col">
                                    <div class="wr-footer-list">
                                        <div class="footer-list">
                                            <?php the_view('menu__footer', ['location' => 'footer-center']); ?>
                                        </div>

                                        <div class="footer-list">
                                            <?php the_view('menu__footer', ['location' => 'footer-two-two']); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="center-col wr-m-col">
                            <div class="wr-footer-list-col">
                                <div class="wr-footer-list">
                                    <?php /* ?>
                                    <div class="footer-list listing">
                                        <?php the_view('menu__footer', ['location' => 'footer-center-down']); ?>
                                    </div>
                                    <div class="footer-list">
                                        <?php the_view('menu__footer', ['location' => 'footer-right-up']); ?>
                                    </div>
                                    <?php */ ?>

                                    <div class="footer-list">
                                        <?php the_view('menu__footer', ['location' => 'footer-right-down']); ?>
                                    </div>

                                    <?php /* ?>
                                    <div class="footer-list">
                                        <?php the_view('menu__footer', ['location' => 'footer-right-down-2']); ?>
                                    </div>
                                    <?php */ ?>

                                </div>
                            </div>
                            <div class="media">
                                <div class="wr-media-list">
                                    <a href="<?php echo get_permalink(icl_object_id(2908, 'page', 1, ICL_LANGUAGE_CODE)); ?>" class="ttl"><?php _e('Contact Us', 'icoda'); ?></a>
                                    <p>POLSKA, WROCŁAW, 50-202, ul. <br/> KSIĘCIA WITOLDA, nr 49, lok. 15</p>
                                    <ul class="media-list">
                                        <li><a class="icon-ico-media-1" target="_blank" href="https://www.linkedin.com/company/icoda-ico-marketing-solutions/"></a></li>
                                        <li><a class="icon-ico-media-2" target="_blank" href="https://www.facebook.com/icodaagency/"></a></li>
                                        <li><a class="icon-ico-media-3" target="_blank" href="mailto:post@icoda.io"></a></li>
                                        <li><a class="icon-ico-media-4" target="_blank" href="https://t.me/icoda"></a></li>
                                        <li><a class="icon-ico-x" target="_blank" href="https://twitter.com/icoda_io"></a></li>
                                    </ul>
                                </div>

                                <div class="clutch-widget" data-nofollow="true" data-url="https://widget.clutch.co" data-widget-type="1" data-height="40" data-clutchcompany-id="695144"></div>

                                <?php  ?>
                                <div class="techreviewer-widget"><a href="https://techreviewer.co/companies/icoda" target="_blank"><img data-aload="/wp-content/uploads/2022/07/badge-white-nobackground-2.svg" alt="techreviewer"></a></div>
                                <?php  ?>

                                <div class="icoda-clutch-widget">
                                    <a href="https://clutch.co/profile/icoda-digital-agency" target="_blank">
                                    <iframe width="135" height="135" src="https://shareables.clutch.co/share/badges/695144/42033?utm_source=clutch_top_company_badge&utm_medium=image_embed" title="Top Clutch Crypto Marketing 2025"></iframe>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-line">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-line-inner">
                        <p>© 2017-<?php echo date('Y'); ?> All rights reserved.  —  icoda.io </p>
                        <ul class="footer-modal-link">
                            <li><a href="#" data-modal="#policy" class="open-modal"><?php _e('Privacy Policy', 'icoda'); ?></a></li>
                            <li><a href="#" data-modal="#terms" class="open-modal"><?php _e('Terms and Conditions', 'icoda'); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>

<div id="overlay"></div>
<div id="policy" class="modal-default modal-default-full-size policy-box">
    <a href="#" class="modal-close"><i class="icon-ico-close"></i></a>
    <div class="modal-default-content">
        <div class="form-default-header">
            <p class="ttl"><?php _e('Website Privacy Policy', 'icoda'); ?></p>
        </div>
        <div class="modal-default-body">
            <div class="section-text">
                <p class="ttl2"><?php _e('Generic privacy policy template', 'icoda'); ?></p>
                <p><?php _e('This privacy policy ("policy") will help you understand how Global Digital Consulting LLC uses and protects the data you provide to us when you visit and use https://icoda.io ("website", "service").', 'icoda'); ?></p>
                <p><?php _e('We reserve the right to change this policy at any given time, of which you will be promptly updated. If you want to make sure that you are up to date with the latest changes, we advise you to frequently visit this page.', 'icoda'); ?></p>
            </div>

            <div class="section-text">
                <p class="ttl2"><?php _e('What User Data We Collect', 'icoda'); ?></p>
                <p class="bold"><?php _e('When you visit the website, we may collect the following data:', 'icoda'); ?></p>
                <ul>
                    <li><?php _e('Your IP address.', 'icoda'); ?></li>
                    <li><?php _e('Your contact information and email address.', 'icoda'); ?></li>
                    <li><?php _e('Other information such as interests and preferences.', 'icoda'); ?></li>
                    <li><?php _e('Data profile regarding your online behavior on our website.', 'icoda'); ?></li>
                </ul>
            </div>

            <div class="section-text">
                <p class="ttl2"><?php _e('Why We Collect Your Data', 'icoda'); ?></p>
                <p class="bold"><?php _e('We are collecting your data for several reasons:', 'icoda'); ?></p>
                <ul>
                    <li><?php _e('To better understand your needs.', 'icoda'); ?></li>
                    <li><?php _e('To improve our services and products.', 'icoda'); ?></li>
                    <li><?php _e('To send you promotional emails containing the information we think you will find interesting.', 'icoda'); ?></li>
                    <li><?php _e('To contact you to fill out surveys and participate in other types of market research.', 'icoda'); ?></li>
                    <li><?php _e('To customize our website according to your online behavior and personal preferences.', 'icoda'); ?></li>
                </ul>
            </div>

            <div class="section-text">
                <p class="ttl2"><?php _e('Safeguarding and Securing the Data', 'icoda'); ?></p>
                <p><?php _e('Global Digital Consulting LLC is committed to securing your data and keeping it confidential. Global Digital Consulting LLC has done all in its power to prevent data theft, unauthorized access, and disclosure by implementing the latest technologies and software, which help us safeguard all the information we collect online.', 'icoda'); ?></p>
            </div>

            <div class="section-text">
                <p class="ttl2"><?php _e('Our Cookie Policy', 'icoda'); ?></p>
                <p><?php _e('Once you agree to allow our website to use cookies, you also agree to use the data it collects regarding your online behavior (analyze web traffic, web pages you spend the most time on, and websites you visit).', 'icoda'); ?></p>
                <p><?php _e('The data we collect by using cookies is used to customize our website to your needs. After we use the data for statistical analysis, the data is completely removed from our systems.', 'icoda'); ?></p>
                <p><?php _e("Please note that cookies don't allow us to gain control of your computer in any way. They are strictly used to monitor which pages you find useful and which you do not so that we can provide a better experience for you.", 'icoda'); ?></p>
            </div>

            <div class="section-text">
                <p class="ttl2"><?php _e('Restricting the Collection of your Personal Data', 'icoda'); ?></p>
                <p class="bold"><?php _e('At some point, you might wish to restrict the use and collection of your personal data. You can achieve this by doing the following:', 'icoda'); ?></p>
                <ul>
                    <li><?php _e("When you are filling the forms on the website, make sure to check if there is a box which you can leave unchecked, if you don't want to disclose your personal information.", 'icoda'); ?></li>
                    <li><?php _e("If you have already agreed to share your information with us, feel free to contact us via email and we will be more than happy to change this for you.", 'icoda'); ?></li>
                </ul>
                <p><?php _e("Global Digital Consulting LLC will not lease, sell or distribute your personal information to any third parties, unless we have your permission. We might do so if the law forces us. Your personal information will be used when we need to send you promotional materials if you agree to this privacy policy.", 'icoda'); ?></p>
            </div>
        </div>
    </div>
</div>

<div id="terms" class="modal-default modal-default-full-size terms-box">
    <a href="#" class="modal-close"><i class="icon-ico-close"></i></a>
    <div class="modal-default-content">
        <div class="form-default-header">
            <p class="ttl"><?php _e('Terms and Conditions', 'icoda'); ?></p>
        </div>
        <div class="modal-default-body">
            <div class="section-text">
                <p><?php _e('Please read these Terms and Conditions ("Terms", "Terms and Conditions") carefully before using the https://icoda.io website (the "Service") operated by Global Digital Consulting LLC.', 'icoda'); ?></p>
                <p><?php _e('Your access to and use of the Service is conditioned on your acceptance of and compliance with these Terms. These Terms apply to all visitors, users and others who access or use the Service.', 'icoda'); ?></p>
            </div>
            <div class="section-text">
                <p class="ttl2"><?php _e('Links To Other Web Sites', 'icoda'); ?></p>
                <p><?php _e('Our Service may contain links to third-party web sites or services that are not owned or controlled by Global Digital Consulting LLC.', 'icoda'); ?></p>
                <p><?php _e('Global Digital Consulting LLC has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third party web sites or services. You further acknowledge and agree that Global Digital Consulting LLC shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with use of or reliance on any such content, goods or services available on or through any such web sites or services.', 'icoda'); ?></p>
            </div>
            <div class="section-text">
                <p class="ttl2"><?php _e('Changes', 'icoda'); ?></p>
                <p><?php _e("We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material we will try to provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.", 'icoda'); ?></p>
            </div>
            <div class="section-text">
                <p class="ttl2"><?php _e('Contact Us', 'icoda'); ?></p>
                <p><?php _e('If you have any questions about these Terms, please contact us.', 'icoda'); ?></p>
            </div>
        </div>
    </div>
</div>

<div id="callback" class="modal-default modal-box">
    <a href="#" class="modal-close"><i class="icon-ico-close"></i></a>
    <form class="form-default form-default-modal" method="post">
        <input type="hidden" name="lang-source" value="<?php echo ICL_LANGUAGE_CODE; ?>" />
        <div class="form-default-header">
            <p class="ttl"><?php _e('Send request', 'icoda'); ?></p>
            <p><?php _e('to scale your business to the next level', 'icoda'); ?></p>
        </div>
        <div class="form-row">
            <div class="col-12 col-md-6">
                <input type="text" name="name" class="form-control req" placeholder="<?php _e('Your name', 'icoda'); ?>" required>
            </div>
            <div class="col-12 col-md-6">
                <input type="text" name="telegram" class="form-control req" placeholder="<?php _e('WhatsApp / Telegram / Skype', 'icoda'); ?>" required>
            </div>
            <div class="col-12">
                <input type="email" name="email" class="form-control req" placeholder="<?php _e('Email', 'icoda'); ?>" required>
            </div>
            <div class="col-12">
                <textarea name="message" class="form-control" rows="5" placeholder="<?php _e('Text message', 'icoda'); ?>"></textarea>
            </div>
            <?php
            do_action('anr_captcha_form_field');
            ?>
            <div class="col-12">
                <div class="wr-btn text-right">
                    <button type="submit" class="btn btn-blue"><?php _e('Apply Now', 'icoda'); ?></button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php get_template_part('template-parts/modals'); ?>

<div id="success" class="modal-default success">
    <a href="#" class="modal-close"><i class="icon-ico-close"></i></a>
    <div class="text-center">
        <div class="wr-ico-check">
            <i class="icon-ico-check"></i>
        </div>
        <p class="ttl"><?php _e('Thank you!', 'icoda'); ?></p>
        <p><?php _e('Your request has been sent successfully!', 'icoda'); ?></p>
    </div>
    <canvas id="congrats-confetti" width="300" height="150"></canvas>
</div>

<!-- Modal Video-->
<div class="modal fade bd-example-modal-xl modal-video modal-normal" id="videoModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" id="video" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>

<?php get_template_part( 'template-parts/footer/help' ); ?>

<?php wp_footer(); ?>

<?php get_template_part('template-parts/inline-css'); ?>

<script src="https://widget.clutch.co/static/js/widget.js"></script>
<script>
  function aload(t){"use strict";var e="data-aload";return t=t||window.document.querySelectorAll("["+e+"]"),void 0===t.length&&(t=[t]),[].forEach.call(t,function(t){t["LINK"!==t.tagName?"src":"href"]=t.getAttribute(e),t.removeAttribute(e)}),t}
  // Onload
window.onload = function () {
  aload();
};
</script>

<?php if(is_front_page() || is_singular('post') || is_page_template('template-pages/template-calculator.php')) : ?>
    <script src="https://assets.calendly.com/assets/external/widget.js" type="text/javascript" async></script>
<?php endif; ?>

</body>

</html>