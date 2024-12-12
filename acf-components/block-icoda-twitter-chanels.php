<?php
$icoda_gb_twitter_accounts = get_field('icoda_gb_twitter_accounts', 'option');

if (!empty($icoda_gb_twitter_accounts)) {
    $twitter_icon_svg = get_stylesheet_directory_uri() . '/assets/images/twitter-icon.svg';
?>
    <section class="youtube-chanels twitter-chanels">
        <div class="container">
            <div class="row">
                <?php
                foreach ($icoda_gb_twitter_accounts as $twitter_item) {
                ?>
                    <div class="col-12 col-md-6 col-xl-3 d-flex justify-content-center social-chanels px-md-2">
                        <div class="item mb-2">
                            <a class="img-wrap" href="<?php echo $twitter_item['link']; ?>" target="_blank">
                                <img src="<?php echo $twitter_item['icon']; ?>" alt="empty-img" />
                                <div class="icon">
                                    <img src="<?php echo $twitter_icon_svg; ?>" alt="twitter icon" />
                                </div>
                            </a>
                            <div class="content">
                                <a href="<?php echo $twitter_item['link']; ?>" class="h6 name mb-2 d-block" target="_blank">
                                    <?php echo $twitter_item['name']; ?>
                                </a>
                                <p class="pb-2">
                                    <?php printf(__('%s Followers', 'icoda'), $twitter_item['subscribers']); ?>
                                </p>

                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
<?php
}
