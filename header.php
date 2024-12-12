<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package icoda
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <!-- Required meta tags -->
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php bloginfo('name'); ?></title>

  <?php $icoda_custom_canonical = icoda_get_custom_canonical(); ?>
  <?php if (!empty($icoda_custom_canonical)) : ?>
    <link rel="canonical" href="<?php echo $icoda_custom_canonical; ?>">
  <?php endif; ?>

  <link rel="icon" href="https://icoda.io/wp-content/uploads/2020/02/cropped-favicon-icoda-1-32x32.png" sizes="32x32">
  <link rel="icon" href="https://icoda.io/wp-content/uploads/2020/02/cropped-favicon-icoda-1-192x192.png" sizes="192x192">
  <link rel="apple-touch-icon" href="https://icoda.io/wp-content/uploads/2020/02/cropped-favicon-icoda-1-180x180.png">
  <meta name="msapplication-TileImage" content="https://icoda.io/wp-content/uploads/2020/02/cropped-favicon-icoda-1-270x270.png">

  <meta name="facebook-domain-verification" content="9ascuxt148fka6xc7fx1z724eplezq" />

  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-NS5G57R');
  </script>
  <!-- End Google Tag Manager -->


  <!-- Yandex.Metrika counter -->
  <script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
    m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(52276351, "init", {
          clickmap:true,
          trackLinks:true,
          accurateTrackBounce:true,
          webvisor:true
    });
  </script>
  <!-- /Yandex.Metrika counter -->


  <?php if (is_page(17)) { ?>
    <script type="application/ld+json">
      {
        "@context": "http://schema.org",
        "@type": "Service",
        "serviceType": "Delivering Qualified Leads for Crypto Businesses",
        "provider": {
          "@type": "Organization",
          "name": "ICODA AGENCY"
        },

        "hasOfferCatalog": {
          "@type": "OfferCatalog",
          "name": "12+ REASONS WHY US",
          "itemListElement": [{
              "@type": "OfferCatalog",
              "name": "Cryptocurrency exchange promotion",
              "description": "We will provide marketing for your cryptocurrency exchange."
            },

            {
              "@type": "OfferCatalog",
              "name": "Blockchain Development",
              "description": "We will give you the consultation about the solution or services that your project is built around. Reaching the crowdfund goals is not the end but the real start of your business."
            },
            {
              "@type": "OfferCatalog",
              "name": "PR",
              "description": "Let the world hear you. Our PR professionals will build trust and present your project just the right way."
            },
            {
              "@type": "OfferCatalog",
              "name": "PPC Ads under Restriction",
              "description": "We will target ads with Google Adwords, Facebook, Bing, Yahoo, Twitter, Reddit etc."
            },
            {
              "@type": "OfferCatalog",
              "name": "Chinese Marketing",
              "description": "We will assist to attract tokenholders via Chinese blockchain media, WeChat groups, Chinese opinion leaders, the pool of investors and more."
            },
            {
              "@type": "OfferCatalog",
              "name": "YouTube Influencers",
              "description": "Get a loyal audience for your project from the leaders of the YouTube blockchain community."
            },
            {
              "@type": "OfferCatalog",
              "name": "Smart Contracts",
              "description": "We will help you create a highly detailed White Paper for potential investors in which we will describe all of the significant and appealing features of your project or idea."
            },
            {
              "@type": "OfferCatalog",
              "name": "Cryptocurrency/Blockchain Website Creation",
              "description": "ICODA Agency helps you to simplify the process of business model development, commercialize and scale up competitive advantages within the crypto market."

            },
            {
              "@type": "OfferCatalog",
              "name": "White Paper Development",
              "description": "We will help you create a highly detailed White Paper for potential investors in which we will describe all of the significant and appealing features of your project or idea."

            },
            {
              "@type": "OfferCatalog",
              "name": "Telegram Promotion",
              "description": "Your business should be social. Our social media professionals will take care of your image on all social channels, especially on Telegram. You will get Q&A support, social profiles support etc."

            },
            {
              "@type": "OfferCatalog",
              "name": "Opinion Leaders",
              "description": "You will get reviews from top-rated media blockchain bloggers and blockchain experts."

            },
            {
              "@type": "OfferCatalog",
              "name": "IEO on Exchanges",
              "description": "We can launch your token as IEO on the right exchanges in the right way."

            }


          ]
        }
      }
    </script>
  <?php } ?>

  <script async src="https://app.popkit.club/pixel-webhook/1da4d441703fbf313f40238f43b0e044"></script>

  <?php if (ICL_LANGUAGE_CODE == 'zh-hans') : ?>
    <style>
      .link-telegram-fix,
      .link-wechat-fix {
        position: fixed;
        right: 60px;
        bottom: 60px;
        width: 60px;
        height: 60px;
        background: #f1f4ff;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: center;
        justify-content: center;
        -ms-flex-align: center;
        align-items: center;
        overflow: hidden;
        border-radius: 50%;
        color: #3c61e2;
        z-index: 10;
        box-shadow: 0 0 0 rgba(60, 97, 226, .4);
        animation: pulse 2s infinite
      }

      .link-wechat-fix {
        border-radius: 5px;
        width: 80px;
        height: 80px;
      }

      @media (max-width: 767.98px) {

        .link-telegram-fix,
        .link-wechat-fix {
          display: none
        }

      }

      @media (min-width: 1200px) {

        .link-telegram-fix,
        .link-wechat-fix {
          right: 10%
        }
      }

      @media only screen and (max-width: 1470px) {

        .link-telegram-fix,
        .link-wechat-fix {
          right: 60px
        }
      }

      @media only screen and (max-width: 1600px) {

        .link-telegram-fix,
        .link-wechat-fix {
          right: 6%
        }
      }
    </style>
  <?php endif; ?>

  <?php if (ICL_LANGUAGE_CODE == 'ru') : ?>
    <style>
      body .btn {
        text-transform: none;
      }
    </style>
  <?php endif; ?>

  <?php if (ICL_LANGUAGE_CODE == 'es') : ?>
    <style>
      body .btn.btn-blue.open-modal,
      form.form-default .btn-blue {
        text-transform: none;
      }
    </style>
  <?php endif; ?>
  <?php get_template_part('template-parts/inline-css'); ?>
  <?php get_template_part('template-parts/schemas/faq'); ?>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe class="skip-lazy" src="https://www.googletagmanager.com/ns.html?id=GTM-NS5G57R" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <!-- Yandex.Metrika counter (noscript) -->
  <noscript><div><img class="skip-lazy" src="https://mc.yandex.ru/watch/52276351" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
  <!-- End Yandex.Metrika counter (noscript) -->
  <?php if (is_front_page()) : ?>
    <div id="preloader" class="preloader">
      <div class="loader-text">
        <p>icoda.io</p>
      </div>
    </div>
  <?php endif; ?>
  <?php do_action('icoda_body_open'); ?>


  <?php if(is_singular('post')) : ?>
    <input type="hidden" value="<?php the_permalink(); ?>" name="share_article_url" id="share_article_url" />
    <input type="hidden" value="<?php the_ID(); ?>" name="share_article_id" id="share_article_id" />
    <?php icoda_count_views(); ?>
  <?php endif; ?>

  <div class="<?php get_class_wrap('wrap'); ?>">

    <?php if (ICL_LANGUAGE_CODE == 'zh-hans') : ?>
      <a href="#" target="_blank" class="link-wechat-fix pulse"><img src="/wp-content/uploads/2021/03/qr.png"></a>
    <?php else : ?>
      <a href="<?php the_field('telegram_link-all_lang', 'option'); ?>" target="_blank" class="link-telegram-fix pulse"><i class="icon-ico-media-4"></i></a>
    <?php endif; ?>

    <header data-header class="header navbar navbar-light btco-hover-menu">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="top-line">
              <a href="<?php echo !is_front_page() ? home_url() : '#'; ?>" class="logo">
                <svg width="108" height="28" viewBox="0 0 108 28" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <rect width="108" height="28" fill="url(#pattern0)" />
                  <defs>
                    <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                      <use xlink:href="#image0" transform="translate(-0.269841 -2.5) scale(0.00468303 0.0184394)" />
                    </pattern>
                    <image id="image0" width="322" height="322" xlink:href="data:image/png;base64,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" />
                  </defs>
                </svg>
              </a>
              <div class="r-bar">
                <div class="mega-menu" data-action="mega-menu">
                  <?php get_template_part('template-parts/menu/mega-menu'); ?>
                </div>
                <?php if (is_front_page()) : ?>
                  <div class="img-desktop">
                    <img class="skip-lazy" src="<?php the_field('section_1_background_desctop'); ?>" alt="bg-home">
                  </div>
                <?php endif; ?>
                <div class="lang-select">
                  <?php do_action('wpml_add_language_selector'); ?>
                </div>
                <div class="wr-btn">
                  <a href="<?php echo home_url('/contact-us/'); ?>" class="btn btn-blue"><?php _e('Contact Us', 'icoda'); ?></a>
                  <a href="<?php echo home_url('/contact-us/'); ?>" class="mobile-icon email-icon">
                    <svg width="20" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M2 0H20C20.2652 0 20.5196 0.105357 20.7071 0.292893C20.8946 0.48043 21 0.734784 21 1V15C21 15.2652 20.8946 15.5196 20.7071 15.7071C20.5196 15.8946 20.2652 16 20 16H2C1.73478 16 1.48043 15.8946 1.29289 15.7071C1.10536 15.5196 1 15.2652 1 15V1C1 0.734784 1.10536 0.48043 1.29289 0.292893C1.48043 0.105357 1.73478 0 2 0ZM19 4.238L11.072 11.338L3 4.216V14H19V4.238ZM3.511 2L11.061 8.662L18.502 2H3.511Z" fill="#333333" stroke="white" stroke-width="0.7" />
                    </svg>
                  </a>
                </div>
                <button class="navbar-toggler burger" type="button">
                  <span class="line"></span>
                  <span class="text-menu" data-text="menu"><?php _e('Menu', 'icoda'); ?></span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>