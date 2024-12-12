<?php
$icoda_gb_youtube_chanels = icoda_get_global_option('icoda_gb_youtube_chanels');
$chanel_items = $icoda_gb_youtube_chanels;

$icoda_gb_twitter_accounts = get_field('icoda_gb_twitter_accounts', 'option');
$twitter_items = $icoda_gb_twitter_accounts;

$icoda_gb_vcs_launchpads = icoda_get_global_option('icoda_gb_vcs_launchpads');
$vcs_items = $icoda_gb_vcs_launchpads;

$icoda_gb_tic_tok = get_field('icoda_gb_tik_tok', 'option');
$tik_tok_items = $icoda_gb_tic_tok;

$icoda_gb_media_partners = get_field('icoda_gb_media_partners', 'option');
$partners_media_items = $icoda_gb_media_partners;

$thousand_labels = [
    'en' => 'k',
    'de' => 'k',
    'es' => 'k',
    'ru' => ' тыс.',
    'zh-hans' => 'k',
    'it' => 'k',
    'fr' => 'k',
    'ko' => 'k',
    'pt-pt' => 'k',
];
?>
<div class="reliable-resources">
    <div class="resources-tabs mt-4 mt-lg-2 pt-lg-1">

        <ul class="nav w-100 d-flex justify-content-lg-center pr-3 pr-lg-0" role="tablist">
            <li class="nav-item">
                <a class="nav-link d-block active" id="tech-tabs-vcs" data-toggle="pill" href="#vcs-tab" role="tab" aria-controls="vcs-tab" aria-selected="true">
                    <p class="title"><?php echo __('VCs & Launchpads', 'icoda'); ?></p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-block" id="tech-tabs-youtube" data-toggle="pill" href="#youtube-tab" role="tab" aria-controls="youtube-tab" aria-selected="false">
                    <p class="title"><?php echo __('Youtube', 'icoda'); ?></p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-block" id="tech-tabs-tik-tok" data-toggle="pill" href="#tik-tok-tab" role="tab" aria-controls="tik-tok-tab" aria-selected="false">
                    <p class="title"><?php echo __('TikTok', 'icoda'); ?></p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-block" id="tech-tabs-x" data-toggle="pill" href="#twitter-tab" role="tab" aria-controls="twitter-tab" aria-selected="false">
                    <p class="title"><?php echo __('X', 'icoda'); ?></p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-block" id="tech-tabs-press" data-toggle="pill" href="#press-tab" role="tab" aria-controls="press-tab" aria-selected="false">
                    <p class="title"><?php echo __('Press', 'icoda'); ?></p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-block" id="tech-tabs-media" data-toggle="pill" href="#media-partners-tab" role="tab" aria-controls="media-partners-tab" aria-selected="false">
                    <p class="title"><?php echo __('Media partners', 'icoda'); ?></p>
                </a>
            </li>
        </ul>



        <div class="tab-content mt-4">


            <div class="tab-panel fade show active" id="vcs-tab" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="social-chanels social-chanels-vcs">

                    <div class="d-flex align-items-center flex-column flex-lg-row flex-wrap justify-content-between">
                        <?php if (!empty($vcs_items)) : ?>

                            <?php foreach ($vcs_items as $vcs_item) : ?>
                                <div class="box">
                                    <img src="<?php echo $vcs_item['image']; ?>" alt="<?php echo $vcs_item['label']; ?>">
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <div class="tab-panel fade" id="youtube-tab" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="social-chanels d-flex align-items-center flex-column flex-lg-row flex-wrap justify-content-between">
                    <?php if (!empty($chanel_items)) : ?>

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
                                    } catch (Exception $e) {
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
                            <div class="box wrap-items">
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
                    <?php endif; ?>

                </div>
            </div>

            <div class="tab-panel fade" id="tik-tok-tab" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="social-chanels">
                    <div class="social-chanels tik-tok-chanel d-flex align-items-center flex-column flex-lg-row flex-wrap justify-content-between">
                        <?php if (!empty($tik_tok_items)) : ?>

                            <?php
                            foreach ($tik_tok_items as $tik_tok_item) {
                            ?>
                                <div class="box wrap-items">
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
                        <?php endif; ?>

                    </div>

                </div>
            </div>

            <div class="tab-panel fade" id="twitter-tab" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="social-chanels">
                    <div class="social-chanels twitter-chanel d-flex align-items-center flex-column flex-lg-row flex-wrap justify-content-between">
                        <?php if (!empty($twitter_items)) : ?>

                            <?php
                            foreach ($twitter_items as $twitter_item) {
                            ?>
                                <div class="box wrap-items">
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
                        <?php endif; ?>



                    </div>

                </div>
            </div>

            <div class="tab-panel fade" id="press-tab" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="social-chanels press-chanels d-flex align-items-center flex-column flex-lg-row flex-wrap justify-content-between">
                    <?php if (!empty($args['partners_list'])) : ?>

                        <?php foreach ($args['partners_list'] as $partner_data) : ?>
                            <div class="box wrap-items d-flex justify-content-between flex-column pb-3">
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
                    <?php endif; ?>

                </div>
            </div>

            <?php if (!empty($partners_media_items)) : ?>
                <div class="tab-panel fade" id="media-partners-tab" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="d-flex align-items-center flex-column flex-lg-row flex-wrap justify-content-between">
                        <?php foreach ($partners_media_items as $partners_media_item) : ?>
                            <a href="<?php echo $partners_media_item['link']; ?>" class="box box-media" target="_blank">
                                <img src="<?php echo $partners_media_item['logo']; ?>" alt="<?php echo $partners_media_item['label']; ?>">
                            </a>
                        <?php endforeach; ?>
                        <a href="/events" class="btn btn-blue mt-4 mt-lg-0"><?php echo __('Upcoming Events', 'icoda'); ?></a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>