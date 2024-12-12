let $ = jQuery;

var getCookie = function (cname) {
  let name = cname + "=";
  let ca = document.cookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
};

var setCookie = function (name, value, options = {}) {
  options = {
    path: "/",
    ...options,
  };
  if (options.expires instanceof Date) {
    options.expires = options.expires.toUTCString();
  }
  let updatedCookie =
    encodeURIComponent(name) + "=" + encodeURIComponent(value);
  for (let optionKey in options) {
    updatedCookie += "; " + optionKey;
    let optionValue = options[optionKey];
    if (optionValue !== true) {
      updatedCookie += "=" + optionValue;
    }
  }
  document.cookie = updatedCookie;
};

var icodaRecaptcha;
var onloadReCaptchaInvisible = function () {
  if (jQuery("#icoda-recaptcha").length) {
    icodaRecaptcha = grecaptcha.render("icoda-recaptcha", {
      sitekey: "6LciPqMZAAAAAGzlldXu7Hp8PWVOBpxFZ-LmapOM",
      callback: "onSubmitReCaptcha",
      size: "invisible",
    });
  }
};
var onSubmitReCaptcha = function (token) {
  var $form = jQuery("form.submitting-form");

  $form.find('button[type="submit"]').prop("disabled", true);
  var old_text = $form.find('button[type="submit"]').text();
  $form.find('button[type="submit"]').text("Sending ...");
  if ($form.hasClass("submitting-form")) {
    var utm_keys = [
      "utm_source",
      "utm_medium",
      "utm_campaign",
      "utm_content",
      "utm_term",
    ];
    utm_keys.forEach((utm_key) => {
      var selectorUtm = 'input[name="utm-' + utm_key + '"]';
      var inputUtm = $form.find(selectorUtm);
      if (inputUtm.length) {
        inputUtm.remove();
      }
      var utm_value = getCookie("utm-" + utm_key);

      if (
        (utm_value === undefined || utm_value === null || utm_value === "") &&
        jQuery('input[name="head-utm-' + utm_key + '"]').length
      ) {
        utm_value = jQuery('input[name="head-utm-' + utm_key + '"]').val();
        setCookie("utm-" + utm_key, utm_value);
      }

      if (utm_value !== undefined && utm_value !== "" && utm_value !== null) {
        $form.append(
          '<input type="hidden" name="utm-' +
            utm_key +
            '" value="' +
            decodeURIComponent(utm_value) +
            '" />'
        );
      }
    });

    var selectorCountry = 'input[name="user-country"]';
    var inputCountry = $form.find(selectorCountry);
    if (inputCountry.length) {
      inputCountry.remove();
    }
    var user_country_ip_detected = getCookie("user_country_ip_detected");
    if (
      (user_country_ip_detected === undefined ||
        user_country_ip_detected === null ||
        user_country_ip_detected === "") &&
      jQuery('input[name="head_user_country_ip_detected"]').length
    ) {
      user_country_ip_detected = jQuery(
        'input[name="head_user_country_ip_detected"]'
      ).val();
      setCookie("user_country_ip_detected", user_country_ip_detected);
    }
    if (
      user_country_ip_detected !== undefined &&
      user_country_ip_detected !== "" &&
      user_country_ip_detected !== null
    ) {
      $form.append(
        '<input type="hidden" name="user-country" value="' +
          decodeURIComponent(user_country_ip_detected) +
          '" />'
      );
    }

    jQuery.post(
      "/wp-content/themes/icoda/submit.php",
      $form.serialize(),
      function (data) {
        // console.log( data );
        if (data == 1) {
          window.dataLayer = window.dataLayer || [];
          dataLayer.push({ event: "form-successfuly-sent" });
          $form.find(".req").each(function () {
            jQuery(this).val("").next().detach();
          });
          $form.find("textarea").val("");
          setTimeout(function () {
            jQuery(".modal-box")
              .animate({ opacity: 0, top: "45%" }, 200)
              .css("display", "none");
            jQuery("body").find(".success").css("opacity", "1").fadeIn(500);
            $form.find('button[type="submit"]').prop("disabled", false);
            $form.find('button[type="submit"]').text(old_text);
          }, 200);
        }
      }
    );
    $form.data("submit", "no");
    $form.removeClass("submitting-form");
  }
};

jQuery(document).ready(function ($) {
  let tagsFiltersTimeout = null;

  $(document).on(
    "change",
    'input[type="checkbox"][name="tags"]',
    function (event) {
      event.preventDefault();
      maybeAutoSubmitTagsFilters();
    }
  );

  function runTagsFilter() {
    const queryParams = new URLSearchParams(window.location.search);
    queryParams.delete("tags");
    let tagsList = [];
    $(".tags-list li").each(function () {
      const $el = $(this).find('input[type="checkbox"][name="tags"]');
      if ($el.prop("checked")) {
        tagsList.push($el.val());
      }
    });
    if (tagsList.length) {
      queryParams.set("tags", tagsList);
    }
    window.location.href =
      window.location.origin +
      window.location.pathname +
      "?" +
      queryParams.toString();
  }
  function maybeAutoSubmitTagsFilters() {
    if (tagsFiltersTimeout) {
      clearTimeout(tagsFiltersTimeout);
      tagsFiltersTimeout = null;
    }
    tagsFiltersTimeout = setTimeout(function () {
      runTagsFilter();
    }, 2000);
  }

  //main menu
  $(".btco-hover-menu .dropdown-menu a.dropdown-toggle").on(
    "click",
    function (e) {
      var $el = $(this);
      // console.log($('#navbarNavDropdown').width());
      // if ($el.hasClass('link') && $('#navbarNavDropdown').width() > 992 ) {
      // return true;
      // }

      $el.toggleClass("active-dropdown");
      var $parent = $(this).offsetParent(".dropdown-menu");
      if (!$(this).next().hasClass("show")) {
        $(this)
          .parents(".dropdown-menu")
          .first()
          .find(".show")
          .removeClass("show");
      }
      var $subMenu = $(this).next(".dropdown-menu");
      $subMenu.toggleClass("show");

      $(this).parent("li").toggleClass("show");

      $(this)
        .parents("li.nav-item.dropdown.show")
        .on("hidden.bs.dropdown", function (e) {
          $(".dropdown-menu .show").removeClass("show");
          $el.removeClass("active-dropdown");
        });

      if (!$parent.parent().hasClass("navbar-nav")) {
        $el.next().css({ top: $el[0].offsetTop, left: $parent.outerWidth() });
      }

      // $(document).on('click', 'ul.navbar-nav > li > a.nav-link.dropdown-toggle', function(event) {
      // 	event.preventDefault();
      // 	$(this).parent().find('.dropdown-menu').addClass('show');
      // 	console.log('123');
      // });
      // return false;
    }
  );

  $('a[id="5884"]').removeAttr("href");
  $('a[id="5885"]').removeAttr("href");
  $('a[id="5886"]').removeAttr("href");
  $('a[id="5883"]').removeAttr("href");
  $('a[id="5869"]').removeAttr("href");

  var overlay = $("#overlay");
  var open_modal = $(".open-modal");
  var close = $(".modal-close, #overlay");
  var modal = $(".modal-box");
  var success = $(".success");

  var modalConferenceCookie = getCookie("modal-conference-002");
  if (
    false &&
    (modalConferenceCookie === undefined ||
      modalConferenceCookie === "" ||
      modalConferenceCookie === null)
  ) {
    setTimeout(function () {
      $("body").css("overflow", "hidden");
      if (
        /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
          navigator.userAgent
        )
      ) {
      } else {
        $("body").addClass("modal-open");
      }
      overlay.fadeIn(400, function () {
        $("[data-conference]")
          .css({
            display: "block",
            transform: "translate(-50%, -50%)",
          })
          .animate({ opacity: 1, top: "50%" }, 200);
      });
    }, 15000);
  }

  var toastHelpCookie = getCookie("toast-help");
  if (
    toastHelpCookie === undefined ||
    toastHelpCookie === "" ||
    toastHelpCookie === null
  ) {
    setCookie("toast-help", 90);
    // runCounterCookies();
  } else {
    // runCounterCookies();
  }

  function runCounterCookies() {
    setInterval(function () {
      var toastHelpCookie = getCookie("toast-help");
      if (
        toastHelpCookie === undefined ||
        toastHelpCookie === "" ||
        toastHelpCookie === null
      ) {
        toastHelpCookie = 90;
      } else {
        toastHelpCookie = parseInt(toastHelpCookie);
        toastHelpCookie -= 2;
      }
      if (toastHelpCookie <= 0) {
        $("#icoda-toast").addClass("show");
        setCookie("toast-help", 120);
        setTimeout(function () {
          $("#icoda-toast").removeClass("show");
        }, 20000);
      } else {
        setCookie("toast-help", toastHelpCookie);
      }
    }, 2000);
  }

  $("body").on("click", ".icoda-open-toaster", function (e) {
    e.preventDefault();
    $("#icoda-toast").removeClass("show");
    $("body").css("overflow", "hidden");
    if (
      /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
        navigator.userAgent
      )
    ) {
    } else {
      $("body").addClass("modal-open");
    }
    overlay.fadeIn(400, function () {
      $("#callback")
        .css({
          display: "block",
          transform: "translate(-50%, -50%)",
        })
        .animate({ opacity: 1, top: "50%" }, 200);
    });
  });

  $(".modal-conference-btn-cookie").on("click", function (event) {
    event.preventDefault();
    setCookie("modal-conference-002", "yes");
    $(this).closest(".modal-conference").find(".modal-close").trigger("click");
    window.open($(this).attr("href"));
  });

  $("body").on("click", ".open-modal", function (e) {
    e.preventDefault();
    $("body").css("overflow", "hidden");
    if (
      /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
        navigator.userAgent
      )
    ) {
    } else {
      $("body").addClass("modal-open");
    }
    var div = $(this).attr("data-modal");
    overlay.fadeIn(400, function () {
      $(div)
        .css({
          display: "block",
          transform: "translate(-50%, -50%)",
        })
        .animate({ opacity: 1, top: "50%" }, 200);
    });
  });
  close.click(function (e) {
    e.preventDefault();
    $("body").css("overflow", "inherit");
    if (
      /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
        navigator.userAgent
      )
    ) {
    } else {
      $("body").removeClass("modal-open");
    }

    if ($(this).parent().hasClass("modal-conference")) {
      setCookie("modal-conference-002", "yes");
    }

    if ($(this).parent().hasClass("modal-box")) {
      modal.find(".req").each(function () {
        $(this).val("");
      });
      modal.animate({ opacity: 0, top: "45%" }, 200, function () {
        $(this).css("display", "none");
        overlay.fadeOut(400);
      });
    } else if ($(this).parent().hasClass("success")) {
      success.animate({ opacity: 0, top: "45%" }, 200, function () {
        $(this).css("display", "none");
        overlay.fadeOut(400);
      });
    } else {
      modal.find(".req").each(function () {
        $(this).val("");
      });
      $(".modal-default").animate({ opacity: 0, top: "45%" }, 200, function () {
        $(this).css("display", "none");
        overlay.fadeOut(400);
      });
    }
  });
  /* start for wordpress */
  $(function () {
    $('a[href^="#"]').on("click", function (event) {
      // отменяем стандартное действие
      event.preventDefault();

      if ($(this).data("toggle") == "pill") {
        return true;
      }

      var sc = $(this).attr("href");
      if (sc.length == 1) {
        return true;
      }

      var dn = $(sc).offset().top - 100;

      /*
       * sc - в переменную заносим информацию о том, к какому блоку надо перейти
       * dn - определяем положение блока на странице
       */

      $("html, body").animate({ scrollTop: dn }, 1000);

      /*
       * 1000 скорость перехода в миллисекундах
       */
    });

    if (document.getElementsByClassName("wrap article-page").length > 0) {
      var elem = document.getElementsByClassName("wrap article-page")[0];

      while (elem.innerHTML.search(">wp<!-- start -->") !== -1) {
        elem.innerHTML = elem.innerHTML.replace(
          ">wp<!-- start -->",
          "><!-- start -->"
        );
      }
      while (elem.innerHTML.search(">— wp:<!-- start -->") !== -1) {
        elem.innerHTML = elem.innerHTML.replace(
          ">— wp:<!-- start -->",
          "><!-- start -->"
        );
      }
    }
  });
  /* end for wordpress */
});

jQuery(".section-5.show-part, .section-5.home-brands")
  .find(".row > div:nth-of-type(n + 10)")
  .addClass("hide");
jQuery(".section-5.show-part .link-arrow").click(function () {
  jQuery(this)
    .parents(".section-5.show-part")
    .find(".row > div:nth-of-type(n + 10)")
    .toggleClass("hide");
});

jQuery(document).ready(function ($) {
  let cet = $(".crypto_exchanges table");

  if (cet.length > 0) {
    cet.paginate({
      elemsPerPage: 20,
      maxButtons: 6,
    });
  }
});

/*  grid-masonry    */
jQuery(document).ready(function ($) {
  if ($(".grid-masonry").length) {
    document.querySelectorAll(".grid-masonry").forEach(function (container) {
      // var container = document.querySelector('.grid-masonry');
      var msnry = new Masonry(container, {
        // options
        itemSelector: ".grid-item",
        columnWidth: ".grid-sizer",
        percentPosition: true,
        horizontalOrder: true,
      });
      msnry.layout();
      var elemHidden = false;
      $(".btn-show-el").click(function (e) {
        e.preventDefault();
        elemHidden = !elemHidden;
        container.className = elemHidden
          ? "grid-masonry row show-elem"
          : "grid-masonry row";
        msnry.layout();

        if (!$(".grid-masonry").hasClass("show-elem")) {
          var elem = $(this).attr("href");
          var sectionPos = $(elem).offset().top;

          $("html, body").on(
            "scroll mousedown wheel DOMMouseScroll mousewheel keyup touchmove",
            function () {
              $("html, body").stop();
            }
          );

          $("html, body").animate({ scrollTop: sectionPos }, 800, function () {
            $("html, body").off(
              "scroll mousedown wheel DOMMouseScroll mousewheel keyup touchmove"
            );
          });

          return false;
        }
      });

      $(window).resize(function () {
        msnry.layout();
      });
    });
  }

  // function for block Goal and tasks
  var scrollVerticalMenu = function () {
    $(".vertical-nav").on("click", "a", function () {
      var elem = $(this).attr("href");
      var sectionPos = $(elem).offset().top - 140;
      $("html, body").animate(
        {
          scrollTop: sectionPos,
        },
        500
      );
    });
  };

  // function for Home page
  var initParallax = function () {
    if (
      /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
        navigator.userAgent
      )
    ) {
    } else {
      jQuery(".v-1").parallax({
        mouseport: jQuery(".section-1"),
        xparallax: "50px",
        yparallax: "50px",
        xorigin: 0,
        yorigin: 0,
      });

      jQuery(".v-2").parallax({
        mouseport: jQuery(".section-1"),
        xparallax: "140px",
        yparallax: "40px",
        xorigin: 0,
        yorigin: 0,
      });

      jQuery(".v-3").parallax({
        mouseport: jQuery(".section-1"),
        xparallax: "100px",
        yparallax: "20px",
        xorigin: 0,
        yorigin: 0,
      });

      jQuery(".bg-computer").parallax({
        mouseport: jQuery(".section-1"),
        xparallax: "60px",
        yparallax: "30px",
        xorigin: 0,
        yorigin: 0,
      });

      jQuery(".bg-service").parallax({
        mouseport: jQuery(".section-1"),
        xparallax: "30px",
        yparallax: "15px",
        xorigin: 0,
        yorigin: 0,
      });

      jQuery(".bg-phone").parallax({
        mouseport: jQuery(".section-1"),
        xparallax: "100px",
        yparallax: "50px",
        xorigin: 0,
        yorigin: 0,
      });
    }
  };

  // testimonials
  var initSlider = function () {
    jQuery(".slider-default").slick({
      lazyLoad: "ondemand",
      slidesToShow: 3,
      slidesToScroll: 1,
      arrows: true,
      dots: true,
      infinite: true,
      speed: 500,
      cssEase: "linear",
      appendArrows: jQuery(".wr-control-testimonials"),
      variableWidth: true,
      responsive: [
        {
          breakpoint: 991,
          settings: {
            adaptiveHeight: true,
            slidesToShow: 2,
          },
        },
        {
          breakpoint: 550,
          settings: {
            dots: false,
          },
        },
      ],
    });
  };
  //slider Featured in mobile
  var initSliderFeatured = function () {
    $(".featured-in-slider").slick({
      variableWidth: true,
      slidesToScroll: 2,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
      ],
    });
  };

  //sleder Portfolio filters in mobile
  var initSliderPortfolioFilters = function () {
    jQuery(".portfolio-filters-slider").slick({
      variableWidth: true,
      slidesToScroll: 2,
      responsive: [
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
      ],
    });
  };

  //sleder Portfolio archive
  var initSlidersPortfolio = function () {
    $(".section-portfolio").each(function (indexSection) {
      var selector1 = ".portfolio-slider-" + (indexSection + 1);
      var selector2 = ".wr-control-portfolio-slider-" + (indexSection + 1);
      var selector3 = ".portfolio-filters-slider-bottom-" + (indexSection + 1);

      jQuery(selector1).slick({
        variableWidth: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: true,
        appendArrows: jQuery(selector2),
        responsive: [
          {
            breakpoint: 1100,
            settings: {
              arrows: false,
              slidesToShow: 2,
              slidesToScroll: 1,
            },
          },
        ],
      });

      jQuery(selector3).slick({
        variableWidth: true,
        slidesToScroll: 1,
        infinite: false,
        responsive: [
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1,
            },
          },
        ],
      });
    });
  };

  //sleder Resent cases mobile
  var initCasesSlider = function () {
    jQuery(".cases-slider").slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      infinite: true,
      appendArrows: jQuery(".wr-control-cases"),
      speed: 500,
      responsive: [
        {
          breakpoint: 1100,
          settings: {
            adaptiveHeight: false,
            slidesToShow: 2,
            centerMode: true,
            centerPadding: "40px",
          },
        },
        {
          breakpoint: 768,
          settings: {
            adaptiveHeight: false,
            slidesToShow: 1,
            centerMode: true,
            centerPadding: "40px",
          },
        },
      ],
    });
  };

  //sleder Resent cases new mobile
  $(window).on("load resize", function () {
    if ($(window).width() < 991) {
      $(".case-new-slider:not(.slick-initialized)").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        variableWidth: true,
        speed: 500,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 2,
            },
          },
        ],
      });
    } else {
      $(".case-new-slider.slick-initialized").slick("unslick");
    }
  });

  //sleder blockchain
  var initBlockchainSlider = function () {
    jQuery(".slider-blockchain").slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      appendArrows: jQuery(".wr-control-blockchain"),
      infinite: true,
      variableWidth: true,
      speed: 500,
      responsive: [
        {
          breakpoint: 991,
          settings: {
            variableWidth: true,
            slidesToShow: 2,
          },
        },
        {
          breakpoint: 768,
          settings: {
            variableWidth: true,
            slidesToShow: 1,
          },
        },
      ],
    });
  };
  //sleder media
  var initMediaSlider = function () {
    jQuery(".slider-media").slick({
      slidesToShow: 2,
      variableWidth: true,
      slidesToScroll: 1,
      appendArrows: jQuery(".wr-control-media"),
      infinite: true,
      speed: 500,
    });
  };
  //slider label mobile
  var initSliderLabel = function () {
    $(".label-slider").slick({
      variableWidth: true,
      responsive: [
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 6,
            slidesToScroll: 2,
          },
        },
      ],
    });
  };
  //list-logo-slider mobile
  var initSliderListLogo = function () {
    $(".list-logo-slider").slick({
      variableWidth: true,
      responsive: [
        {
          breakpoint: 767,
          settings: {
            rows: 2,
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
      ],
    });
  };
  //slider reliable-resources
  var initSliderReliableResourses = function () {};
  //slider VCs & Launchpads
  let initSliderVcs = function () {
    $('[data-action="vcs-slider"]').slick({
      slidesToScroll: 1,
      slidesToShow: 4,
      appendArrows: jQuery(".wr-control-vcs"),
      infinite: true,
      swipeToSlide: true,
      speed: 500,
      responsive: [
        {
          breakpoint: 992,
          settings: {
            variableWidth: true,
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 650,
          settings: {
            variableWidth: true,
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
  };
  //slider youtube/twitter/press/tictok mobile
  $(window).on("load resize", function () {
    if ($(window).width() < 1200) {
      $('[data-action="youtube-chanels-slider"]:not(.slick-initialized)').slick(
        {
          variableWidth: true,
          // slidesToScroll: 1,
          slidesToShow: 2,
          arrows: false,
          infinite: true,
          swipeToSlide: true,
          speed: 500,
          responsive: [
            {
              breakpoint: 650,
              settings: {
                variableWidth: true,
                slidesToShow: 1,
                slidesToScroll: 1,
              },
            },
          ],
        }
      );
      $('[data-action="twitter-chanels-slider"]:not(.slick-initialized)').slick(
        {
          variableWidth: true,
          slidesToScroll: 1,
          slidesToShow: 2,
          arrows: false,
          infinite: true,
          swipeToSlide: true,
          speed: 500,
          responsive: [
            {
              breakpoint: 650,
              settings: {
                variableWidth: true,
                slidesToShow: 1,
                slidesToScroll: 1,
              },
            },
          ],
        }
      );
      $('[data-action="tik-tok-chanels-slider"]:not(.slick-initialized)').slick(
        {
          variableWidth: true,
          slidesToScroll: 1,
          slidesToShow: 2,
          arrows: false,
          infinite: true,
          swipeToSlide: true,
          speed: 500,
          responsive: [
            {
              breakpoint: 650,
              settings: {
                variableWidth: true,
                slidesToShow: 1,
                slidesToScroll: 1,
              },
            },
          ],
        }
      );
      $('[data-action="press-slider"]:not(.slick-initialized)').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        variableWidth: true,
        arrows: false,
        infinite: true,
        swipeToSlide: true,
        speed: 500,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 2,
              variableWidth: true,
              slidesToScroll: 1,
            },
          },
        ],
      });
    } else {
      $('[data-action="youtube-chanels-slider"].slick-initialized').slick(
        "unslick"
      );
      $('[data-action="twitter-chanels-slider"].slick-initialized').slick(
        "unslick"
      );
      $('[data-action="tik-tok-chanels-slider"].slick-initialized').slick(
        "unslick"
      );
      $('[data-action="press-slider"].slick-initialized').slick("unslick");
    }
  });

  //project-card-slider mobile
  var initSliderProjectCard = function () {
    $(".project-card-slider").slick({
      variableWidth: true,
      responsive: [
        {
          breakpoint: 991,
          settings: {
            rows: 3,
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
      ],
    });
  };
  var initSliderListLeadership = function () {
    $(".leadership-slider ").slick({
      variableWidth: true,
      responsive: [
        {
          breakpoint: 991,
          settings: {
            appendArrows: jQuery(".wr-control-leadership"),
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
      ],
    });
  };

  // function for init our projects block
  var initSliderProjects = function () {
    jQuery(".our-projects-list").slick({
      lazyLoad: "ondemand",
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true,
      fade: true,
      dots: false,
      infinite: true,
      speed: 500,
      cssEase: "linear",
      appendArrows: jQuery(".wr-control-projects"),
      responsive: [
        {
          breakpoint: 991,
          settings: {
            adaptiveHeight: true,
            slidesToShow: 1,
          },
        },
      ],
    });
  };

  /* single portfolio cases */
  //slider Solution
  var initSliderSolution = function () {
    jQuery(".solution-slider").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      centerMode: true,
      arrows: true,
      appendArrows: jQuery(".wr-control-solution-slider"),
      infinite: true,
      variableWidth: true,
      speed: 500,
      cssEase: "linear",
    });
  };

  $(window).on("load resize", function () {
    if ($(window).width() < 991) {
      //slider post templates (fb, instagram)
      $(".slider-post-templates:not(.slick-initialized)").slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        arrows: true,
        variableWidth: true,
        appendArrows: jQuery(".wr-control-post-templates"),
        speed: 500,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 1,
            },
          },
        ],
      });
      //sleder responsive design mobile
      $(".slider-responsive-design:not(.slick-initialized)").slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        arrows: true,
        variableWidth: true,
        appendArrows: jQuery(".wr-control-responsive-design"),
        speed: 500,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 1,
            },
          },
        ],
      });
      //slider many-function
      $(".slider-many-function:not(.slick-initialized)").slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        arrows: true,
        variableWidth: true,
        appendArrows: jQuery(".wr-control-many-function"),
        speed: 500,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 1,
            },
          },
        ],
      });
    } else {
      $(".slider-post-templates.slick-initialized").slick("unslick");
      $(".slider-responsive-design.slick-initialized").slick("unslick");
      $(".slider-many-function.slick-initialized").slick("unslick");
    }
  });

  /* stickykit.js to single post */
  if ($(window).width() > 991) {
    $("[data-sticky-single]").stick_in_parent({
      offset_top: 150,
    });
  }

  // function for pages using form validation
  var formValidate = function () {
    jQuery(".form-default-desctop").validate({
      rules: {
        name: {
          required: true,
          minlength: 2,
          maxlength: 50,
        },
        telegram: {
          required: true,
          minlength: 2,
          maxlength: 50,
        },
        email: {
          required: true,
          email: true,
          minlength: 3,
          maxlength: 50,
        },
      },
      messages: {},
      submitHandler: function (form) {
        if ($(form).hasClass("form-with-captcha")) {
          grecaptcha.execute();
        } else {
          $(form).find('button[type="submit"]').prop("disabled", true);
          var old_text = $(form).find('button[type="submit"]').text();
          $(form).find('button[type="submit"]').text("Sending ...");
          if ($(form).data("submit") == "yes") {
            var utm_keys = [
              "utm_source",
              "utm_medium",
              "utm_campaign",
              "utm_content",
              "utm_term",
            ];
            utm_keys.forEach((utm_key) => {
              var selectorUtm = 'input[name="utm-' + utm_key + '"]';
              var inputUtm = $(form).find(selectorUtm);
              if (inputUtm.length) {
                inputUtm.remove();
              }
              var utm_value = getCookie("utm-" + utm_key);

              if (
                (utm_value === undefined ||
                  utm_value === null ||
                  utm_value === "") &&
                jQuery('input[name="head-utm-' + utm_key + '"]').length
              ) {
                utm_value = jQuery(
                  'input[name="head-utm-' + utm_key + '"]'
                ).val();
                setCookie("utm-" + utm_key, utm_value);
              }

              if (
                utm_value !== undefined &&
                utm_value !== "" &&
                utm_value !== null
              ) {
                $(form).append(
                  '<input type="hidden" name="utm-' +
                    utm_key +
                    '" value="' +
                    decodeURIComponent(utm_value) +
                    '" />'
                );
              }
            });

            var selectorCountry = 'input[name="user-country"]';
            var inputCountry = $(form).find(selectorCountry);
            if (inputCountry.length) {
              inputCountry.remove();
            }
            var user_country_ip_detected = getCookie(
              "user_country_ip_detected"
            );
            if (
              (user_country_ip_detected === undefined ||
                user_country_ip_detected === null ||
                user_country_ip_detected === "") &&
              jQuery('input[name="head_user_country_ip_detected"]').length
            ) {
              user_country_ip_detected = jQuery(
                'input[name="head_user_country_ip_detected"]'
              ).val();
              setCookie("user_country_ip_detected", user_country_ip_detected);
            }
            if (
              user_country_ip_detected !== undefined &&
              user_country_ip_detected !== "" &&
              user_country_ip_detected !== null
            ) {
              $(form).append(
                '<input type="hidden" name="user-country" value="' +
                  decodeURIComponent(user_country_ip_detected) +
                  '" />'
              );
            }

            $.post(
              "/wp-content/themes/icoda/submit.php",
              $(form).serialize(),
              function (data) {
                if (data == 1) {
                  window.dataLayer = window.dataLayer || [];
                  dataLayer.push({ event: "form-successfuly-sent" });
                  $(form)
                    .find(".req")
                    .each(function () {
                      $(this).val("").next().detach();
                    });
                  $(form).find("textarea").val("");
                  setTimeout(function () {
                    $(".modal-box")
                      .animate({ opacity: 0, top: "45%" }, 200)
                      .css("display", "none");
                    $("body").find(".success").css("opacity", "1").fadeIn(500);
                    $(form)
                      .find('button[type="submit"]')
                      .prop("disabled", false);
                    $(form).find('button[type="submit"]').text(old_text);
                  }, 200);
                } else {
                }
              }
            );
            $(form).data("submit", "no");
            $(form).removeClass("submitting-form");
          }
        }
      },
    });
  };

  var formModalValidate = function () {
    jQuery(".form-default-modal").validate({
      rules: {
        name: {
          required: true,
          minlength: 2,
          maxlength: 50,
        },
        telegram: {
          required: true,
          minlength: 2,
          maxlength: 50,
        },
        email: {
          required: true,
          email: true,
          minlength: 3,
          maxlength: 50,
        },
      },
      messages: {},
      submitHandler: function (form) {
        if ($(form).hasClass("form-with-captcha")) {
          grecaptcha.execute();
        } else {
          $(form).find('button[type="submit"]').prop("disabled", true);
          var old_text = $(form).find('button[type="submit"]').text();
          $(form).find('button[type="submit"]').text("Sending ...");
          if ($(form).data("submit") == "yes") {
            var utm_keys = [
              "utm_source",
              "utm_medium",
              "utm_campaign",
              "utm_content",
              "utm_term",
            ];
            utm_keys.forEach((utm_key) => {
              var selectorUtm = 'input[name="utm-' + utm_key + '"]';
              var inputUtm = $(form).find(selectorUtm);
              if (inputUtm.length) {
                inputUtm.remove();
              }
              var utm_value = getCookie("utm-" + utm_key);

              if (
                (utm_value === undefined ||
                  utm_value === null ||
                  utm_value === "") &&
                jQuery('input[name="head-utm-' + utm_key + '"]').length
              ) {
                utm_value = jQuery(
                  'input[name="head-utm-' + utm_key + '"]'
                ).val();
                setCookie("utm-" + utm_key, utm_value);
              }

              if (
                utm_value !== undefined &&
                utm_value !== "" &&
                utm_value !== null
              ) {
                $(form).append(
                  '<input type="hidden" name="utm-' +
                    utm_key +
                    '" value="' +
                    decodeURIComponent(utm_value) +
                    '" />'
                );
              }
            });

            var selectorCountry = 'input[name="user-country"]';
            var inputCountry = $(form).find(selectorCountry);
            if (inputCountry.length) {
              inputCountry.remove();
            }
            var user_country_ip_detected = getCookie(
              "user_country_ip_detected"
            );
            if (
              (user_country_ip_detected === undefined ||
                user_country_ip_detected === null ||
                user_country_ip_detected === "") &&
              jQuery('input[name="head_user_country_ip_detected"]').length
            ) {
              user_country_ip_detected = jQuery(
                'input[name="head_user_country_ip_detected"]'
              ).val();
              setCookie("user_country_ip_detected", user_country_ip_detected);
            }
            if (
              user_country_ip_detected !== undefined &&
              user_country_ip_detected !== "" &&
              user_country_ip_detected !== null
            ) {
              $(form).append(
                '<input type="hidden" name="user-country" value="' +
                  decodeURIComponent(user_country_ip_detected) +
                  '" />'
              );
            }

            $.post(
              "/wp-content/themes/icoda/submit.php",
              $(form).serialize(),
              function (data) {
                if (data == 1) {
                  window.dataLayer = window.dataLayer || [];
                  dataLayer.push({ event: "form-successfuly-sent" });
                  $(form)
                    .find(".req")
                    .each(function () {
                      $(this).val("").next().detach();
                    });
                  $(form).find("textarea").val("");
                  setTimeout(function () {
                    $(".modal-box")
                      .animate({ opacity: 0, top: "45%" }, 200)
                      .css("display", "none");
                    $("body").find(".success").css("opacity", "1").fadeIn(500);
                    $(form)
                      .find('button[type="submit"]')
                      .prop("disabled", false);
                    $(form).find('button[type="submit"]').text(old_text);
                  }, 200);
                } else {
                }
              }
            );
            $(form).data("submit", "no");
            $(form).removeClass("submitting-form");
          }
        }
      },
    });
  };

  var formBlock = function () {
    jQuery(".form-default-desctop").each(function () {
      $(this)
        .find('button[type="submit"]')
        .on("click", function () {
          $(this).closest("form").data("submit", "yes");
          $(this).closest("form").addClass("submitting-form");
        });
    });
    jQuery(".form-default-modal").each(function () {
      $(this)
        .find('button[type="submit"]')
        .on("click", function () {
          $(this).closest("form").data("submit", "yes");
          $(this).closest("form").addClass("submitting-form");
        });
    });
  };

  //section-video-creation (single portfolio)
  // var videoPlay = function() {
  //     $(".block-video").click(function () {
  //         var mediaVideo = $(this).find("video").get(0);
  //         if (mediaVideo.paused) {
  //         mediaVideo.play();
  //         $(this).find(".overlay-video").removeClass("play");
  //         } else {
  //         mediaVideo.pause();
  //         $(this).find(".overlay-video").addClass("play");
  //         }
  //     });
  // }

  var initVideoPopup = function () {
    if ($(".link-video-modal").length) {
      var $videoSrc;
      $(".link-video-modal").click(function () {
        $videoSrc = $(this).attr("data-video");
      });

      $(".modal-video").on("show.bs.modal", function () {
        $(this)
          .find(".embed-responsive-item")
          .attr(
            "src",
            $videoSrc + "?amp;showinfo=0&amp;modestbranding=1&amp;autoplay=1"
          );
      });
      $(".modal-video").on("hide.bs.modal", function () {
        $(this).find(".embed-responsive-item").attr("src", null);
      });
    }
  };

  initParallax();
  initSlider();
  initSliderFeatured();
  initSliderPortfolioFilters();
  initSliderReliableResourses();
  initSliderVcs();
  // initSliderYoutubeChanels();
  // initSliderTwitterChanels();

  initSlidersPortfolio();
  initCasesSlider();
  initBlockchainSlider();
  initMediaSlider();
  initSliderProjects();
  formBlock();
  formValidate();
  formModalValidate();
  initVideoPopup();
  initSliderLabel();
  initSliderListLogo();
  initSliderListLeadership();
  initSliderProjectCard();
  footerAccordionMenu();
  headerFixed();
  inputOnFocus();
  initMegaMenu();
  showMobileSubmenu();
  initSliderSolution();
  scrollVerticalMenu();
  // stickySocialBox();
  // stickySidebarSingle();
});

/*  Preloader  */
jQuery("body").addClass("loading");
jQuery(document).ready(function ($) {
  jQuery(".preloader").fadeOut("slow");
  jQuery("body").removeClass("loading");
});

//Load more blog
jQuery(document).ready(function ($) {
  jQuery(document).on("click", ".load-more a", function (event) {
    event.preventDefault();

    var button = $(this),
      buttonContainer = $(this).closest(".load-more"),
      data = {
        action: "loadmore",
        query: icoda_loadmore_params.posts, // that's how we get params from wp_localize_script() function
        page: icoda_loadmore_params.current_page,
        lang: icoda_loadmore_params.current_language,
      };

    $.ajax({
      // you can also use $.post here
      url: icoda_loadmore_params.ajaxurl, // AJAX handler
      data: data,
      type: "POST",
      beforeSend: function (xhr) {
        button.text(icoda_loadmore_params.btn_text_loading); // change the button text, you can also add a preloader image
      },
      success: function (data) {
        if (data) {
          button.text(icoda_loadmore_params.btn_text);

          if (buttonContainer.hasClass("anchor-loader")) {
            buttonContainer.before($(data).hide().fadeIn(500));
          } else {
            // button.closest('.section-content').find('.blog-post_list .row').append(data);
            button
              .closest(".section-content")
              .find(".blog-post_list .row")
              .append($(data).hide().fadeIn(500));
          }

          icoda_loadmore_params.current_page++;

          // console.log(icoda_loadmore_params.current_page);
          // console.log(icoda_loadmore_params.max_page);

          if (
            icoda_loadmore_params.current_page == icoda_loadmore_params.max_page
          ) {
            button.remove(); // if last page, remove the button
          }

          // you can also fire the "post-load" event here if you use a plugin that requires it
          // $( document.body ).trigger( 'post-load' );
        } else {
          button.remove(); // if no data, remove the button as well
        }
      },
    });
  });

  //filter for archive portfolio case
  if ($(".portfolio-filters-slider").length) {
    $("body").on("click", ".portfolio-filter-item", function (e) {
      e.preventDefault();
      let $self = $(this);
      if ($self.data("filter") != "all") {
        $self.toggleClass("active");
      } else {
        $self.addClass("active");
      }

      let types = [];

      if ($self.hasClass("active") && $self.data("filter") == "all") {
        $(".portfolio-filter-item").each(function () {
          $(this).removeClass("active");
        });
        $self.addClass("active");
      }

      if ($self.hasClass("active") && $self.data("filter") != "all") {
        $('.portfolio-filter-item[data-filter="all"]').removeClass("active");
      }
      if ($(".portfolio-filter-item.active").length == 0) {
        $('.portfolio-filter-item[data-filter="all"]').addClass("active");
      }

      $(".portfolio-filter-item").each(function () {
        if ($(this).hasClass("active")) {
          types.push($(this).data("filter"));
        }
      });
      if (types.length) {
        $(".section-portfolio").hide();
      }
      types.forEach(function (element) {
        var selector =
          '.section-portfolio[data-case-cat*="{{' + element + '}}"]';
        if (element == "all") {
          selector = ".section-portfolio";
        }
        $(selector).show();
      });
      let index = 0;
      $(".section-portfolio").each(function () {
        if ($(this).is(":visible")) {
          $(this).removeClass("section-portfolio-odd section-portfolio-even");
          if (index % 2 == 0) {
            $(this).addClass("section-portfolio-odd");
          } else {
            $(this).addClass("section-portfolio-even");
          }
          index++;
        }
      });
    });
  }
});

// footer akkordion menu mobile
function footerAccordionMenu() {
  jQuery(".mobile .footer-body .ttl").on("click", function () {
    const menuWidget = jQuery(this).parent(".footer-list").find("ul");
    menuWidget.toggle();
  });
}

(function ($) {
  var $window = $(window),
    $html = $("html");

  $window
    .resize(function resize() {
      if ($window.width() < 576) {
        return $html.addClass("mobile");
      }

      $html.removeClass("mobile");
    })
    .trigger("resize");
})(jQuery);

/* decoration-section */
if (jQuery("#waves").length) {
  var waves = new SineWaves({
    el: document.getElementById("waves"),
    speed: 4,
    ease: "Linear",
    wavesWidth: "110%",
    waves: [
      {
        timeModifier: 0.25,
        lineWidth: 1,
        amplitude: -240,
        wavelength: 800,
        strokeStyle: "#3C61E2",
      },
      {
        timeModifier: 0.35,
        lineWidth: 1,
        amplitude: -240,
        wavelength: 750,
        strokeStyle: "#3C61E2",
      },
      {
        timeModifier: 0.75,
        lineWidth: 0.3,
        amplitude: -150,
        wavelength: 850,
        strokeStyle: "#3C61E2",
      },
      {
        timeModifier: 0.5,
        lineWidth: 0.5,
        amplitude: -200,
        wavelength: 700,
        strokeStyle: "#3C61E2",
      },
      {
        timeModifier: 0.1,
        lineWidth: 1,
        amplitude: 150,
        wavelength: 750,
        strokeStyle: "#3C61E2",
      },
    ],
  });
}
if (jQuery("#waves-second").length) {
  var waves = new SineWaves({
    el: document.getElementById("waves-second"),
    speed: 4,
    ease: "Linear",
    wavesWidth: "110%",
    waves: [
      {
        timeModifier: 0.25,
        lineWidth: 1,
        amplitude: -240,
        wavelength: 800,
        strokeStyle: "#3C61E2",
      },
      {
        timeModifier: 0.35,
        lineWidth: 1,
        amplitude: -240,
        wavelength: 750,
        strokeStyle: "#3C61E2",
      },
      {
        timeModifier: 0.75,
        lineWidth: 0.3,
        amplitude: -150,
        wavelength: 850,
        strokeStyle: "#3C61E2",
      },
      {
        timeModifier: 0.5,
        lineWidth: 0.5,
        amplitude: -200,
        wavelength: 700,
        strokeStyle: "#3C61E2",
      },
      {
        timeModifier: 0.1,
        lineWidth: 1,
        amplitude: 150,
        wavelength: 750,
        strokeStyle: "#3C61E2",
      },
    ],
  });
}

/* sticky header */
function headerFixed() {
  let nav = jQuery("[data-header]");

  jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() > 50) {
      nav.addClass("header_fixed");
    } else {
      nav.removeClass("header_fixed");
    }
  });
}

/* Mega menu */
function initMegaMenu() {
  jQuery(".burger").on("click", function () {
    const text = jQuery(this).parent().find('[data-text="menu"]');
    const menu = jQuery('[data-action="mega-menu"]');
    const img = jQuery("[data-main-img]");
    const body = jQuery("body");
    jQuery(this).toggleClass("burger_active");
    menu.toggleClass("opened");
    if (jQuery(this).hasClass("burger_active")) {
      text.text(icoda_loadmore_params.menu_close_label);
      img.hide();
      body.addClass("no-scroll");
    } else {
      text.text(icoda_loadmore_params.menu_open_label);
      img.show();
      body.removeClass("no-scroll");
    }
  });
}
// show mobile submenu
function showMobileSubmenu() {
  jQuery('[data-action="arrow"]').on("click", function () {
    const parent = jQuery(this).parent();
    const subMenu = jQuery(this).parent().children(".sub-menu");
    parent.toggleClass("opened");
    subMenu.toggleClass("opened");
  });
}

//form contact us
function inputOnFocus() {
  jQuery(".form-group input").on("focus blur", function (evt) {
    let parent = jQuery(this).parent(".form-group");
    parent.toggleClass("focused", evt.type === "focus");
  });
}

//parallax for cases
let $img = jQuery(".card");

function move(x, y) {
  // обертка с доп свойствами
  $img.addClass("card-active");
  // центр карточки
  let xser = $img.offset().left + $img.width() / 2;
  let yser = $img.offset().top + $img.height() / 2;
  // координаты мыши относительно центра карточки
  let otnX = x - xser;
  let otnY = y - yser;
  // вычисляем % - на каком расстоянии мышь от середины до края, центр = 0%
  let raznX = (otnX / $img.width()) * 100 * 2;
  let raznY = (otnY / $img.height()) * 100 * 2;
  // на сколько градусов нужно повернуть (100% = 6deg)
  let trX = (raznY / 100) * 6 * -1;
  let trY = (raznX / 100) * 6;
  // окруление
  trX = Math.round(trX * 1000) / 1000;
  trY = Math.round(trY * 1000) / 1000;
  // в css
  $img.css(
    "transform",
    "rotateY(" + trY + "deg) rotateX(" + trX + "deg) rotateZ(0deg) scale(1.05)"
  );
}

function resetTransform() {
  $img.removeClass("card-active");
  $img.css("transform", "rotateY(0deg) rotateX(0deg) rotateZ(0deg) scale(1)");
}

$img
  .mousemove(function (e) {
    move(e.pageX, e.pageY);
  })
  .mouseout(function (e) {
    resetTransform();
  });

/* custom selector for blog */
document.querySelectorAll(".dropdown").forEach(function (dropdownWrapper) {
  const dropdownBtn = dropdownWrapper.querySelector(".dropdown__button");
  const blogList = dropdownWrapper
    .closest(".section-content")
    .querySelector(".blog-post_list");
  const dropdownList = dropdownWrapper.querySelector(".dropdown__list");
  const dropdownItems = dropdownList.querySelectorAll(".dropdown__list-item");
  const dropdownInput = dropdownWrapper.querySelector(
    ".dropdown__input_hidden"
  );

  dropdownBtn.addEventListener("click", function () {
    dropdownList.classList.toggle("dropdown__list_visible");
    blogList.classList.toggle("has-blur");
    this.classList.toggle("dropdown__button_active");
  });

  dropdownItems.forEach(function (listItem) {
    listItem.addEventListener("click", function (e) {
      dropdownItems.forEach(function (el) {
        el.classList.remove("dropdown__list-item_active");
        blogList.classList.remove("has-blur");
      });
      this.classList.add("dropdown__list-item_active");
      jQuery(dropdownBtn)
        .empty()
        .append(
          `${jQuery(this).find("svg")[0].outerHTML}<span class="ml-3">${
            this.innerText
          }</span>`
        );
      // dropdownBtn.innerText = this.innerText;
      dropdownInput.value = this.dataset.value;
      dropdownList.classList.remove("dropdown__list_visible");
    });
  });

  document.addEventListener("click", function (e) {
    if (e.target !== dropdownBtn) {
      dropdownBtn.classList.remove("dropdown__button_active");
      dropdownList.classList.remove("dropdown__list_visible");
      blogList.classList.remove("has-blur");
    }
  });

  document.addEventListener("keydown", function (e) {
    if (e.key === "Tab" || e.key === "Escape") {
      dropdownBtn.classList.remove("dropdown__button_active");
      dropdownList.classList.remove("dropdown__list_visible");
      blogList.classList.remove("has-blur");
    }
  });
});
