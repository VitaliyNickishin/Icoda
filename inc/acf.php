<?php

add_action('acf/init', function () {
    if (!function_exists('acf_register_block')) {
        return;
    }

    acf_register_block(array(
        'name'              => 'icoda-youtube-chanels',
        'title'             => __('Youtube Chanels'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
    ));

    acf_register_block(array(
        'name'              => 'icoda-twitter-chanels',
        'title'             => __('Twitter Chanels'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
    ));


    // Portfolio Blocks
    acf_register_block(array(
        'name'              => 'icoda-portfolio-peculiarities',
        'title'             => __('Peculiarities'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-solution',
        'title'             => __('Solution'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-about-project',
        'title'             => __('About Project'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-fonts',
        'title'             => __('Fonts'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-fonts-multiple',
        'title'             => __('Fonts Multiple'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-color-styles',
        'title'             => __('Color Styles'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-color-styles-newscrypto',
        'title'             => __('Color Styles News Crypto'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-color-styles-banxe',
        'title'             => __('Color Styles Banxe'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-logotypes',
        'title'             => __('Logotypes'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-logotype-grid',
        'title'             => __('Logotype with grid'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-logotypes-banxe',
        'title'             => __('Logotypes Banxe'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-google-form',
        'title'             => __('Google Form'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-media-design',
        'title'             => __('Media Design'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-facebook-post',
        'title'             => __('Facebook Post'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-instagram-post',
        'title'             => __('Instagram Post'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-twitter-post',
        'title'             => __('Twitter Post'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-title-img-desk-mob',
        'title'             => __('Only title and img for desk and mob'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-large-design-system',
        'title'             => __('Large Design System'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-banners',
        'title'             => __('Banners'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-landing-page',
        'title'             => __('Landing Page'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-grid',
        'title'             => __('Grid'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-analysis',
        'title'             => __('Analysis'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-testing',
        'title'             => __('Testing'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-project-design',
        'title'             => __('Project design'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-landing-design',
        'title'             => __('Landing Design'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-responsive-design',
        'title'             => __('Responsive Design'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-speed-optimization',
        'title'             => __('Speed Optimization'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-adaptive-layout',
        'title'             => __('Adaptive Layout'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-many-function',
        'title'             => __('Many Function'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-video-creation',
        'title'             => __('Video Creation'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-results',
        'title'             => __('Results'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-author',
        'title'             => __('Author'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-portfolio-related-posts',
        'title'             => __('Related Posts'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('portfolio', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-bc-block',
        'title'             => __('BC Block'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-portfolio',
        'keywords'            => array('bc', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'icoda-perelinks',
        'title'             => __('Post Perelinks'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-posts',
        'keywords'            => array('perelinks', 'links', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'post-logos-grid',
        'title'             => __('Post Logos Grid'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-posts',
        'keywords'            => array('grid', 'logos', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'post-faq',
        'title'             => __('Post FAQ'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-posts',
        'keywords'            => array('faq', 'question', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'post-header-v2',
        'title'             => __('Post Header V2'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-posts',
        'keywords'            => array('header', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));

    acf_register_block(array(
        'name'              => 'post-background-cases',
        'title'             => __('Post Background with Cases'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-posts',
        'keywords'            => array('background', 'cases', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));
    acf_register_block(array(
        'name'              => 'post-services',
        'title'             => __('Post Services'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-posts',
        'keywords'            => array('service', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));
    acf_register_block(array(
        'name'              => 'post-success-path',
        'title'             => __('Post Success Path'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-posts',
        'keywords'            => array('path', 'success', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));
    acf_register_block(array(
        'name'              => 'post-success-stories',
        'title'             => __('Post Success Stories'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-posts',
        'keywords'            => array('story', 'success', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));
    acf_register_block(array(
        'name'              => 'post-challenge',
        'title'             => __('Post Challenge'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-posts',
        'keywords'            => array('challenge', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));



    acf_register_block(array(
        'name'              => 'post-case-project-goals',
        'title'             => __('Case project goals'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-posts',
        'keywords'            => array('case', 'goals', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));
    acf_register_block(array(
        'name'              => 'post-case-results',
        'title'             => __('Case results'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-posts',
        'keywords'            => array('case', 'result', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));
    acf_register_block(array(
        'name'              => 'post-case-cta',
        'title'             => __('Case CTA'),
        'description'       => __(''),
        'render_callback' => 'icoda_acf_block_render_callback',
        'category'            => 'icoda-posts',
        'keywords'            => array('case', 'cta', 'icoda'),
        'align'             => 'full',
        'supports'          => array(
            'align' => array('full', 'wide', 'center')
        ),
    ));
});

function icoda_acf_block_render_callback($block)
{
    $name = str_replace('acf/', '', $block['name']);

    if (file_exists(get_theme_file_path("/acf-components/block-{$name}.php"))) {
        include(get_theme_file_path("/acf-components/block-{$name}.php"));
    }
}

add_action('after_setup_theme', 'icoda_acf_add_options_page');
if (!function_exists('icoda_acf_add_options_page')) {
    function icoda_acf_add_options_page()
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page(array(
                'page_title' => 'Icoda General Blocks',
                'menu_title' => 'Icoda General Blocks',
                'menu_slug'  => 'theme-icoda-gb-settings',
                'capability' => 'edit_posts',
                'redirect'   => false,
                'position'   => 2
            ));
        }
    }
}


function  icoda_custom_add_block_categories($categories, $post)
{
    return array_merge(
        array(
            array(
                'slug'  => 'icoda-posts',
                'title' => esc_html__('Icoda Posts Blocks'),
            ),
            array(
                'slug'  => 'icoda-portfolio',
                'title' => esc_html__('Icoda Portfolio Blocks'),
            ),
        ),
        $categories
    );
}
add_filter('block_categories_all', 'icoda_custom_add_block_categories', 10, 2);
