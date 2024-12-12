<?php

$chanel_items = get_field('icoda_youtube_chanels');

$icoda_gb_youtube_chanels = icoda_get_global_option('icoda_gb_youtube_chanels');

$thousand_labels = [
    'en' => 'k',
    'de' => 'k',
    'es' => 'k',
    'ru' => ' тыс.',
    'zh-hans' => 'k',
];

if (!empty($chanel_items) || !empty($icoda_gb_youtube_chanels)) {
    $youtube_icon_svg = get_stylesheet_directory_uri() . '/assets/images/youtube-icon.svg';

    if (!empty($icoda_gb_youtube_chanels)) {
        $chanel_items = $icoda_gb_youtube_chanels;
    }
?>

    <section class="youtube-chanels">
        <div class="container">
            <div class="row">

                <?php
                foreach ($chanel_items as $chanel_item) {
                    $video_count = $subscription_count = 0;
                    if (!empty($chanel_item['chanel_id'])) {
                        $transient_chanel_key = 'icoda_youtube_chanel_' . $chanel_item['chanel_id'];
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
                    <div class="col-12 col-md-6 col-xl-3 d-flex justify-content-center social-chanels px-md-2">
                        <div class="item mb-2">
                            <a class="img-wrap" href="<?php echo 'https://www.youtube.com/channel/' . $chanel_item['chanel_id']; ?>" target="_blank">
                                <img class="skip-lazy" src="<?php echo $chanel_img; ?>" alt="<?php echo $chanel_title; ?>" />
                                <div class="icon">
                                    <img class="skip-lazy" src="<?php echo $youtube_icon_svg; ?>" alt="youtube icon" />
                                </div>
                            </a>
                            <div class="content">
                                <a href="<?php echo 'https://www.youtube.com/channel/' . $chanel_item['chanel_id']; ?>" class="h6 name mb-2 d-block" target="_blank">
                                    <?php echo $chanel_title; ?>
                                </a>
                                <?php if (!empty($subscription_count_label)) : ?>
                                    <p class="pb-2">
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
                    </div>
                <?php
                }
                ?>


            </div>
        </div>
    </section>

<?php
}
