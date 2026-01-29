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

  <script type="text/javascript">
      (function(c,l,a,r,i,t,y){
          c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
          t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
          y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
      })(window, document, "clarity", "script", "mff6asghqs");
  </script>

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

  <script async src="https://app.popkit.club/pixel-webhook/1da4d441703fbf313f40238f43b0e044"></script>

  
  <?php get_template_part('template-parts/schemas/general'); ?>
  <?php get_template_part('template-parts/schemas/faq'); ?>
  <?php
    $queried_id = get_queried_object_id(  );
    if(file_exists(get_stylesheet_directory(  ) . '/template-parts/schemas/' . $queried_id . '.php')) {
      get_template_part('template-parts/schemas/' . $queried_id);
    } else {
      if(is_single( 51760 )) {
        get_template_part('template-parts/schemas/51760');
      }
      if(is_single( 101038 )) {
        get_template_part('template-parts/schemas/101038');
      }
      if(is_single( 81394 )) {
        get_template_part('template-parts/schemas/81394');
      }
      if(is_single( 123218 )) {
        get_template_part('template-parts/schemas/123218');
      }
      if(is_single( 126333 )) {
        get_template_part('template-parts/schemas/126333');
      }
      if(is_single( 135081 )) {
        get_template_part('template-parts/schemas/135081');
      }
      if(is_single( 135466 )) {
        get_template_part('template-parts/schemas/135466');
      }
      if(is_single( 136034 )) {
        get_template_part('template-parts/schemas/136034');
      }
      if(is_single( 136254 )) {
        get_template_part('template-parts/schemas/136254');
      }
      if(is_single( 136605 )) {
        get_template_part('template-parts/schemas/136605');
      }
    }
    
    
    if(is_front_page(  )) {
      get_template_part('template-parts/schemas/front_page', ICL_LANGUAGE_CODE);
    }
    
  ?>


  <?php if(is_front_page() || is_singular('post') || is_page_template('template-pages/template-calculator.php') || is_page_template('template-parts/tpl-events.php')) : ?>
    <link href="https://assets.calendly.com/assets/external/widget.css" rel="stylesheet">
  <?php endif; ?>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@26.0.6/build/css/intlTelInput.css">

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
      <a href="#" target="_blank" class="link-wechat-fix pulse"><img loading="lazy" src="/wp-content/uploads/2021/03/qr.png"></a>
    <?php else : ?>
      <a href="<?php the_field('telegram_link-all_lang', 'option'); ?>" target="_blank" class="link-telegram-fix pulse"><i class="icon-ico-media-4"></i></a>
    <?php endif; ?>

    <header data-header class="header navbar navbar-light btco-hover-menu">
      <div class="container">
        <div class="row">
          <div class="col-12 position-static">
            <div class="top-line">
              <a href="<?php echo !is_front_page() ? home_url() : '#'; ?>" class="logo">
                <img loading="lazy" src="/wp-content/uploads/2024/06/logo-icoda.svg" width="108" height="28" alt="Icoda">
              </a>
              <div class="mega-menu" data-action="mega-menu">
                <?php get_template_part('template-parts/menu/mega-menu-new'); ?>
              </div>
              <div class="r-bar">
                <div class="wr-btn d-none d-lg-flex">
                  <a href="<?php echo home_url('/contact-us/'); ?>" class="btn btn-blue"><?php _e('Contact Us', 'icoda'); ?></a>
                </div>
                <div class="lang-select">
                  <?php do_action('wpml_add_language_selector'); ?>
                </div>
                <button class="navbar-toggler burger d-lg-none" type="button">
                  <span class="line"></span>
                  <span class="text-menu" data-text="menu"><?php _e('Menu', 'icoda'); ?></span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>