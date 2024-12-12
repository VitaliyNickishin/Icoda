<?php

use phpDocumentor\Reflection\DocBlock\Tags\Var_;

use function Pest\Laravel\delete;

$icoda_gb_youtube_chanels = icoda_get_global_option('icoda_gb_youtube_chanels');
$youtube_icon_svg = get_stylesheet_directory_uri() . '/assets/images/youtube-icon.svg';
$chanel_items = $icoda_gb_youtube_chanels;


// $icoda_gb_twitter_accounts = icoda_get_global_option('icoda_gb_twitter_accounts');
$icoda_gb_twitter_accounts = get_field('icoda_gb_twitter_accounts', 'option');
$twitter_icon_svg = get_stylesheet_directory_uri() . '/assets/images/twitter-icon.svg';
$twitter_items = $icoda_gb_twitter_accounts;

$icoda_gb_vcs_launchpads = icoda_get_global_option('icoda_gb_vcs_launchpads');
$vcs_items = $icoda_gb_vcs_launchpads;

$icoda_gb_tic_tok = get_field('icoda_gb_tik_tok', 'option');
$tik_tok_icon_svg = get_stylesheet_directory_uri() . '/assets/images/tik-tok-icon.svg';
$tik_tok_items = $icoda_gb_tic_tok;

$thousand_labels = [
    'en' => 'k',
    'de' => 'k',
    'es' => 'k',
    'ru' => ' тыс.',
    'zh-hans' => 'k',
];
?>

<div class="reliable-resources">
    <div class="social-chanels social-chanels-vcs">
        <div class="social-chanels-title d-flex justify-content-between position-relative">
            <p class="title"><?php echo __('VCs & Launchpads', 'icoda'); ?></p>
            <div class="wr-control wr-control-vcs t-0 d-none d-lg-block"></div>
        </div>

        <div data-action="vcs-slider" class="vcs-slider custom-slider">
            <?php foreach ($vcs_items as $vcs_item) : ?>
                <div class="item pb-3 mt-0">
                    <img src="<?php echo $vcs_item['image']; ?>" alt="<?php echo $vcs_item['label']; ?>">
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="row mt-5 pt-4">
        <div class="social-chanels col-xl-3">
            <div class="social-chanels-title">
                <div class="icon">
                    <img src="<?php echo $youtube_icon_svg; ?>" alt="youtube icon" />
                </div>
                <p class="title">
                    <?php echo __('Youtube', 'icoda'); ?>
                </p>
            </div>

            <div data-action="youtube-chanels-slider" class="">
                <?php
                foreach ($chanel_items as $chanel_item) {
                    $video_count = $subscription_count = 0;
                    if (!empty($chanel_item['chanel_id'])) {
                        $transient_chanel_key = 'icoda_youtube_chanel_' . $chanel_item['chanel_id'];
                        // delete_transient($transient_chanel_key);
                        $transient_chanel_data = get_transient($transient_chanel_key);
                        if (false === $transient_chanel_data) {
                            $api_youtube_key = 'AIzaSyDucwGwTvT_g5U0_GtOVWsKJEWSLYbF4q4';

                            $chanel_id = $chanel_item['chanel_id'];
                            $url2 = 'https://www.googleapis.com/youtube/v3/channels?part=statistics,snippet&id=' . $chanel_id . '&key=' . $api_youtube_key;
                            $res2 = wp_remote_get($url2, ['blocking' => true]);
                            $body2 = json_decode(wp_remote_retrieve_body($res2), TRUE);
                            if (wp_remote_retrieve_response_code($res2) == 200) {
                                $subscription_count = $body2['items']['0']['statistics']['subscriberCount'];
                                $video_count = $body2['items']['0']['statistics']['videoCount'];
                                $chanel_title = $body2['items']['0']['snippet']['title'];
                                $chanel_img = $body2['items']['0']['snippet']['thumbnails']['default']['url'];
                                $new_transient_chanel_data = [
                                    'videoCount' => $video_count,
                                    'subscriberCount' => $subscription_count,
                                    'chanel_title' => $chanel_title,
                                    'chanel_img' => $chanel_img
                                ];

                                $subscription_count_label = $subscription_count;
                                try {
                                    $millions = intdiv($subscription_count, 1000000);
                                    if ($subscription_count > 1000000) {
                                        $thousands = intdiv($subscription_count % 1000000, 1000);
                                    } else {
                                        $thousands = intdiv($subscription_count, 1000);
                                    }

                                    if ($millions > 0) {
                                        $subscription_count_label = $millions . '.' . $thousands . 'm';
                                    } elseif ($thousands > 0) {
                                        $hundreds = intdiv((($subscription_count % 1000000) % 1000), 100);
                                        $subscription_count_label = $thousands . $thousand_labels[ICL_LANGUAGE_CODE];
                                    }
                                    $new_transient_chanel_data['subscriberCount'] = $subscription_count;
                                } catch (Exception $e) {
                                }

                                set_transient($transient_chanel_key, $new_transient_chanel_data, DAY_IN_SECONDS);
                            }
                        } else {
                            $subscription_count = $transient_chanel_data['subscriberCount'];
                            $video_count = $transient_chanel_data['videoCount'];
                            $chanel_title = $transient_chanel_data['chanel_title'];
                            $chanel_img = $transient_chanel_data['chanel_img'];
                            $subscription_count_label = $subscription_count;

                            try {
                                $subscription_count = intval($subscription_count);
                                $millions = intdiv($subscription_count, 1000000);
                                if( $subscription_count > 1000000) {
                                    $thousands = intdiv($subscription_count % 1000000, 1000);
                                } else {
                                    $thousands = intdiv($subscription_count, 1000);
                                }
                                if( $millions > 0 ) {
                                    $subscription_count_label = $millions . '.' . $thousands . 'm';
                                } elseif( $thousands > 0 ) {
                                    $hundreds = intdiv( ( ( $subscription_count % 1000000 ) % 1000 ), 100 );
                                    $subscription_count_label = $thousands . $thousand_labels[ ICL_LANGUAGE_CODE ];
                                }
                            }  catch( Exception $e ) {

                            }
                        }
                    }

                    if (!empty($chanel_item['icon'])) {
                        $chanel_img = $chanel_item['icon'];
                    }
                    if (!empty($chanel_item['name'])) {
                        $chanel_title = $chanel_item['name'];
                    }
                ?>
                    <div class="item wrap-items">
                        <a class="img-wrap" href="<?php echo 'https://www.youtube.com/channel/' . $chanel_item['chanel_id']; ?>" target="_blank">
                            <img src="<?php echo $chanel_img; ?>" alt="<?php echo $chanel_title; ?>" />

                        </a>
                        <div class="content">
                            <a href="<?php echo 'https://www.youtube.com/channel/' . $chanel_item['chanel_id']; ?>" class="h6 name mb-2 d-block" target="_blank">
                                <?php echo $chanel_title; ?>
                            </a>
                            <?php if (!empty($subscription_count_label)) : ?>
                                <p class="pb-1">
                                    <?php printf(__('%s subscribers', 'icoda'), $subscription_count_label); ?>
                                </p>
                            <?php endif; ?>
                            <?php if (!empty($video_count)) : ?>
                                <p>
                                    <?php printf(__('%s videos', 'icoda'), $video_count); ?>
                                </p>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="social-chanels twitter-chanel col-xl-3">
            <div class="social-chanels-title">
                <div class="icon">
                    <img src="<?php echo $twitter_icon_svg; ?>" alt="twitter icon" />
                </div>
                <p class="title"><?php echo __('Twitter', 'icoda'); ?></p>
            </div>


            <div data-action="twitter-chanels-slider">

                <?php
                foreach ($twitter_items as $twitter_item) {
                ?>
                    <div class="item wrap-items">
                        <a class="img-wrap" href="<?php echo $twitter_item['link']; ?>" target="_blank">
                            <img src="<?php echo $twitter_item['icon']; ?>" alt="<?php echo $twitter_item['name']; ?>" />

                        </a>
                        <div class="content">
                            <a href="<?php echo $twitter_item['link']; ?>" class="h6 name mb-2 d-block" target="_blank">
                                <?php echo $twitter_item['name']; ?>
                            </a>
                            <p class="pb-1">
                                <?php printf(__('%s Followers', 'icoda'), $twitter_item['subscribers']); ?>
                            </p>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>

        <div class="social-chanels tik-tok-chanel col-xl-3">
            <div class="social-chanels-title">
                <div class="icon">
                    <img src="<?php echo $tik_tok_icon_svg; ?>" alt="Tik Tok icon" />
                </div>
                <p class="title"><?php echo __('Tik Tok', 'icoda'); ?></p>
            </div>


            <div data-action="tik-tok-chanels-slider">

                <?php
                foreach ($tik_tok_items as $tik_tok_item) {
                ?>
                    <div class="item wrap-items">
                        <a class="img-wrap" href="<?php echo $tik_tok_item['link']; ?>" target="_blank">
                            <img src="<?php echo $tik_tok_item['icon']; ?>" alt="<?php echo $tik_tok_item['name']; ?>" />

                        </a>
                        <div class="content">
                            <a href="<?php echo $tik_tok_item['link']; ?>" class="h6 name mb-2 d-block" target="_blank">
                                <?php echo $tik_tok_item['name']; ?>
                            </a>
                            <p class="pb-1">
                                <?php printf(__('%s Followers', 'icoda'), $tik_tok_item['subscribers']); ?>
                            </p>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>

        <div class="social-chanels press-chanels col-xl-3">
            <div class="social-chanels-title">
                <p class="title"><?php echo __('Press (with monthly average users)', 'icoda'); ?></p>
            </div>

            <div data-action="press-slider" class="press-slider">
                <?php foreach ($args['partners_list'] as $partner_data) : ?>
                    <div class="item wrap-items d-flex justify-content-between flex-column pb-3">
                        <img src="<?php echo $partner_data['section_3_image-en']; ?>" class="w-auto m-auto" alt="coin-market-cap">

                        <div class="content text-center ml-0 mt-3">
                            <?php if (!empty($partner_data['label'])) : ?>
                                <p>
                                    <?php echo $partner_data['label']; ?>
                                </p>
                            <?php endif; ?>

                        </div>


                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

</div>