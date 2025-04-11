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
            window.congratsConfetti();
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
  var overlay = $("#overlay");
  var close = $(".modal-close, #overlay");
  var modal = $(".modal-box");
  var success = $(".success");

  var modalConferenceCookies = [];
  jQuery('[data-conference]').each(function() {
    const conferenceModalId = $(this).data('conferenceId')
    modalConferenceCookies[ conferenceModalId ] = getCookie("modal-conference-" + conferenceModalId);
  })

  const head_user_ip_detected = $('input[name="head_user_ip_detected"]');

  //main menu
  $(".btco-hover-menu .dropdown-menu a.dropdown-toggle").on(
    "click",
    function (e) {
      var $el = $(this);

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
    }
  );

  $('a[id="5884"]').removeAttr("href");
  $('a[id="5885"]').removeAttr("href");
  $('a[id="5886"]').removeAttr("href");
  $('a[id="5883"]').removeAttr("href");
  $('a[id="5869"]').removeAttr("href");

  var indexTimeout = 0;
  jQuery('[data-conference]').each(function() {
    const conferenceModalId = $(this).data('conferenceId');
    if( ( modalConferenceCookies[ conferenceModalId ] === undefined ||
      modalConferenceCookies[ conferenceModalId ] === "" ||
      modalConferenceCookies[ conferenceModalId ] === null ) && 
      (
        $(this).data('forLang') === $(this).data('currentLang')
      ) && 
      (
        $(this).data('show') === "yes"
      )
    ) {
      indexTimeout++;
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
          $('[data-conference-id="'+conferenceModalId+'"]')
            .css({
              display: "block",
              transform: "translate(-50%, -50%)",
            })
            .animate({ opacity: 1, top: "50%" }, 200);
        });
      }, indexTimeout * 10000);
    }
  })

  var toastHelpCookie = getCookie("toast-help");
  if (
    toastHelpCookie === undefined ||
    toastHelpCookie === "" ||
    toastHelpCookie === null
  ) {
    setCookie("toast-help", 90);
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
    // event.preventDefault();

    const conferenceModalId = $(this).closest(".modal-conference").data('conferenceId');
    setCookie("modal-conference-" + conferenceModalId, "yes");
    $(this).closest(".modal-conference").find(".modal-close").trigger("click");
    // window.open($(this).attr("href"));
    var div = $(this).attr("data-modal");

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
        $(div)
          .css({
            display: "block",
            transform: "translate(-50%, -50%)",
          })
          .animate({ opacity: 1, top: "50%" }, 200);
      });
    }, 500);
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
    var initedFromBannerReviewBlock = 'no';
    if($(this).hasClass('is-banner-review-block')) {
      initedFromBannerReviewBlock = 'yes';
    }

    if( $(div).find('form').find('input[name="is-banner-review-block"]').length ) {
      $(div).find('form').find('input[name="is-banner-review-block"]').val(initedFromBannerReviewBlock);
    } else {
      $(div).find('form').append(`<input type="hidden" name="is-banner-review-block" value="${initedFromBannerReviewBlock}" />`);
    }

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
      const conferenceModalId = $(this).parent().data('conferenceId');
      setCookie("modal-conference-" + conferenceModalId, "yes");
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

  if (head_user_ip_detected.length) {
    const userIP = head_user_ip_detected[0].value;

    fetch(`https://icoda.io/wp-json/icoda/v1/get_ip_info`, {
      method: 'POST',
      body: JSON.stringify({
        ip: userIP,
      }),
      headers: {
        "Content-Type": "application/json",
      },
    }).then(function (data) {
      return data.json();
    }).then(function (data) {
      if (data && data.country) {
        $('input[name="head_user_country_ip_detected"]').val(data.country);
        setCookie("user_country_ip_detected", data.country);
      }
    })
  }
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

  //slider Featured in mobile
  var initSliderFeatured = function () {
    if (jQuery(".featured-in-slider").length > 0) {

      $(".featured-in-slider").slick({
        variableWidth: true,
        slidesToScroll: 2,
        rtl: $('body').hasClass('rtl') ? true : false,
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
    }
  };

  // services slider Home page
    var initServiceSlider = function () {
        if (jQuery(".service-slider").length > 0) {
            jQuery(".service-slider").slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                dots: true,
                infinite: true,
                speed: 500,
                swipeToSlide: true,
                rtl: $('body').hasClass('rtl') ? true : false,
                // variableWidth: true,
                responsive: [
                  {
                        breakpoint: 1441,
                        settings: {
                            slidesToShow: 3,
                        },
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                        },
                    },
                    {
                        breakpoint: 550,
                        settings: {
                            slidesToShow: 1,
                        },
                    },
                ],
            });
        }
    };

  //sleder media
  var initMediaSlider = function () {
    if (jQuery(".slider-media").length > 0) {

      jQuery(".slider-media").slick({
        slidesToShow: 2,
        variableWidth: true,
        slidesToScroll: 1,
        appendArrows: jQuery(".wr-control-media"),
        infinite: true,
        speed: 500,
      });
    }
  };


  //slider VCs & Launchpads
  let initSliderVcs = function () {
    if (jQuery('[data-action="vcs-slider"]').length > 0) {

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
    }
  };

  //slider youtube/twitter/press/tictok mobile
  $(window).on("load resize", function () {
    if ($(window).width() < 1200) {
      if (jQuery('[data-action="youtube-chanels-slider"]:not(.slick-initialized)').length > 0) {
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
      }

      if (jQuery('[data-action="twitter-chanels-slider"]:not(.slick-initialized)').length > 0) {
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
      }

      if (jQuery('[data-action="tik-tok-chanels-slider"]:not(.slick-initialized)').length > 0) {
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
      }

      if (jQuery('[data-action="press-slider"]:not(.slick-initialized)').length > 0) {
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
      }
    } else {
      if (jQuery('[data-action="youtube-chanels-slider"].slick-initialized').length > 0) {
        $('[data-action="youtube-chanels-slider"].slick-initialized').slick(
          "unslick"
        );
      }
      if (jQuery('[data-action="twitter-chanels-slider"].slick-initialized').length > 0) {
        $('[data-action="twitter-chanels-slider"].slick-initialized').slick(
          "unslick"
        );
      }
      if (jQuery('[data-action="tik-tok-chanels-slider"].slick-initialized').length > 0) {
        $('[data-action="tik-tok-chanels-slider"].slick-initialized').slick(
          "unslick"
        );
      }
      if (jQuery('[data-action="press-slider"].slick-initialized').length > 0) {
        $('[data-action="press-slider"].slick-initialized').slick("unslick");
      }
    }
  });

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
                    window.congratsConfetti();
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
                    window.congratsConfetti();
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

  //testimonials section
  $("body").on("click", ".testimonials-content", function (e) {
      $(".testimonials-content").each(function () {
          $(e.currentTarget).toggleClass("ellipsis");
      });
  })
  //section-services-slider
  $("body").on("click", ".service-box__description", function (e) {
      $(".service-box__description").each(function () {
          $(e.currentTarget).toggleClass("ellipsis");
      });
  })
  
  $("body").on("click", ".ellipsis-content", function (e) {
    $(".ellipsis-content").each(function () {
        $(e.currentTarget).toggleClass("ellipsis");
    });
})
  
  initSliderFeatured();
  initServiceSlider();
  initSliderVcs();
  initMediaSlider();
  formBlock();
  formValidate();
  formModalValidate();
  footerAccordionMenu();
  headerFixed();
  inputOnFocus();
  initMegaMenu();
  showMobileSubmenu();
  scrollVerticalMenu();
  initSliderListLeadership();
  initAccordionFaq();
  initSliderPathList();
  scrollToHeading();
  initSliderRelatedArticlesRtl();
});
var scrollToHeading = function () {
  $(".table-of-content").on("click", "a", function () {
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

let initAccordionFaq = () => {
  const check = $('.accordion-faq input[type="checkbox"]');
  const checkParent = check.parent();

  check.on("change", function () {
    let box = $(this);

    if (checkParent.hasClass("active")) {
      for (let i = 0; i < checkParent.length; i++) {
        checkParent[i].classList.remove("active");
      }
    }
    if (box.is(":checked")) {
      box.parent().addClass("active");
    } else {
      box.parent().removeClass("active");
    }
    check.not(box).prop("checked", false);
  });
};


/*  Preloader  */
jQuery("body").addClass("loading");
setTimeout(function () {
  jQuery(".preloader").fadeOut("slow");
  jQuery("body").removeClass("loading");
}, 1500);

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
  let header = $("[data-header]");

  if (header.length > 0) {
    let headerSpaceH = header.outerHeight(true);
    header.before('<div class="headerSpace d-none" style="height: ' + headerSpaceH + 'px;" ></div>');
  }
  $(window).scroll(function () {
    let headerSpaceH = header.outerHeight();

    if ($(this).scrollTop() > headerSpaceH ) {
        header.addClass("header_fixed");
        $('.headerSpace').removeClass("d-none");
    } else {
        header.removeClass("header_fixed");
        $(".headerSpace").addClass("d-none");
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
    if( menu.hasClass('opened') ) {
      jQuery('.cd-words-wrapper').addClass('icoda-hidden');
    } else {
      jQuery('.cd-words-wrapper').removeClass('icoda-hidden');
    }
    if (jQuery(this).hasClass("burger_active")) {
      text.text(icoda_main_params.menu_close_label);
      img.hide();
      body.addClass("no-scroll");
    } else {
      text.text(icoda_main_params.menu_open_label);
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
          `${jQuery(this).find("svg")[0].outerHTML}<span class="ml-3">${this.innerText
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

window.congratsConfetti = function() {
  const congratsContent = $(".modal-default.success");

  if (congratsContent.length === 0) {
    return;
  }

  const canvas = $("#congrats-confetti")[0];
  canvas.confetti = canvas.confetti || confetti.create(canvas, {resize: true});
  const defaults = {
    spread: 270,
    ticks: 300,
    gravity: 0.15,
    decay: 0.9,
    startVelocity: 22,
    colors: [
      "276894",
      "9A2525",
      "792398",
      "EEDF15",
      "BCAF11",
      "356C4F",
      "CC912E",
      "459B67",
      "A12FCA",
      "3C114B",
    ],
    zIndex: 0,
  };

  let celebrationTimeoutId;

  function celebrate() {
    const confettiPromise1 = confetti({
      ...defaults,
      particleCount: 25,
      scalar: 0.8,
      shapes: ["square"]
    })

    const confettiPromise2 = canvas.confetti({
      ...defaults,
      particleCount: 30,
      scalar: 1.2,
      shapes: ["square"],
    });

    const confettiPromise3 = confetti({
      ...defaults,
      particleCount: 25,
      scalar: 0.4,
      shapes: ["square"]
    });

    Promise.all([confettiPromise1, confettiPromise2, confettiPromise3]).then(() => {
      congratsContent.addClass("finished");
    });

    clearTimeout(celebrationTimeoutId);
  }

  celebrationTimeoutId = setTimeout(celebrate, 0);
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
            slidesToShow: 1,
          },
        },
      ],
    });
  } else {
    $(".case-new-slider.slick-initialized").slick("unslick");
  }

});

//leadership-slider mobile
var initSliderListLeadership = function () {
$('.page-about .leadership-slider ').slick({
    variableWidth: true,
    responsive: [
        {
            breakpoint: 991,
            settings: {
                appendArrows: jQuery(".wr-control-leadership"),
                slidesToShow: 3,
                slidesToScroll: 1,
            }
        },
        
        ]
    });
};

//animated title section-hero
$(window).on("load resize", function () {
  if ($(window).width() > 991) {
    const svgLineWave = $("#svg-line-wave").drawsvg({
    duration: 5000,
    easing: "swing",
    reverse: "true",
  });
  svgLineWave.drawsvg("animate");
  }
  initSliderHero(); 
  initSliderHeroServices();
  initSliderServicesList();
  initSliderServicesGrid();
  initSliderStories();
  initSliderRelatedArticles();

});

$(function () {
  //set animation timing
  let animationDelay = 5000;

  $(window).on("load", function () {
    if ($(window).width() > 991) {
      initHeadline();
    } 
  });

  function initHeadline() {
    //initialise headline animation
    animateHeadline($(".cd-headline"));
  }

  function animateHeadline($headlines) {
    var duration = animationDelay;
    $headlines.each(function () {
      var headline = $(this);

      //trigger animation
      setTimeout(function () {
        hideWord(headline.find(".is-visible").eq(0));
      }, duration);
    });
  }

  function hideWord($word) {
    var nextWord = takeNext($word);
    switchWord($word, nextWord);
    setTimeout(function () {
      hideWord(nextWord);
    }, animationDelay);
  }
  function takeNext($word) {
    return !$word.is(":last-child")
      ? $word.next()
      : $word.parent().children().eq(0);
  }

  function switchWord($oldWord, $newWord) {
    $oldWord.removeClass("is-visible").addClass("is-hidden");
    $newWord.removeClass("is-hidden").addClass("is-visible");
  }
});

const initSliderHero = () => {
  if ($(window).width() < 1024) {
    $(".hero-slider:not(.slick-initialized)").slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      swipeToSlide: true,
      infinite: true,
      variableWidth: true,
      speed: 500,
      responsive: [
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
      ],
    });
  } else {
    $(".hero-slider.slick-initialized").slick("unslick");
  }
};

const initSliderHeroServices = () => {
  if ($(window).width() < 1024) {
    $(".hero-slider-services:not(.slick-initialized)").slick({
      slidesToShow: 2,
      slidesToScroll: 1,
      swipeToSlide: true,
      infinite: true,
      variableWidth: true,
      speed: 500,
      responsive: [
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
  } else {
    $(".hero-slider-services.slick-initialized").slick("unslick");
  }
};

const initSliderRelatedArticles = () => {
  if (jQuery(".slider-related-articles").length > 0) {
    $(".slider-related-articles").slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      swipeToSlide: true,
      infinite: true,
      dots: true,
      appendArrows: $(".slider-control-related-articles"),
      speed: 500,
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
  }
};
const initSliderRelatedArticlesRtl = () => {
  if (jQuery(".slider-related-articles-rtl").length > 0) {
    $(".slider-related-articles-rtl").slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      swipeToSlide: true,
      infinite: true,
      rtl: true,
      dots: true,
      appendArrows: $(".slider-control-related-articles"),
      speed: 500,
      responsive: [
        {
          breakpoint: 992,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
  }
};

const initSliderServicesList = () => {
  if ($(window).width() < 991) {
    $(".slider-services-list:not(.slick-initialized)").slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      swipeToSlide: true,
      infinite: true,
      variableWidth: true,
      speed: 500,
      responsive: [
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
      ],
    });
  } else {
    $(".slider-services-list.slick-initialized").slick("unslick");
  }
};
const initSliderServicesGrid = () => {
  if ($(window).width() < 991) {
    $(".slider-services-grid:not(.slick-initialized)").slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      swipeToSlide: true,
      appendArrows: $(".arrow-control-service-grid"),
      infinite: true,
      variableWidth: true,
      speed: 500,
      responsive: [
        {
          breakpoint: 576,
          settings: {
            dots: true,
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
      ],
    });
  } else {
    $(".slider-services-grid.slick-initialized").slick("unslick");
  }
};

const initSliderPathList = () => {
  $(".slider-path-list").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    swipeToSlide: true,
    infinite: true,
    variableWidth: true,
    adaptiveHeight: true,
    appendArrows: $(".arrow-control-path"),
    speed: 500,
    responsive: [
      {
        breakpoint: 576,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
    ],
  });
};

// const initSliderStories = () => {
//   $(".slider-stories").slick({
//     slidesToShow: 6,
//     slidesToScroll: 1,
//     swipeToSlide: true,
//     infinite: true,
//     variableWidth: false,
//     appendArrows: $(".arrow-control-path"),
//     speed: 500,
//     responsive: [
//       {
//         breakpoint:1024,
//         settings: {
//           slidesToShow: 4,
//           variableWidth: true,
//           slidesToScroll: 1,
//         },
//       },
//       {
//         breakpoint: 991,
//         settings: {
//           slidesToShow: 3,
//           variableWidth: true,
//           slidesToScroll: 1,
//         },
//       },
//       {
//         breakpoint: 576,
//         settings: {
//           slidesToShow: 1,
//           variableWidth: true,
//           slidesToScroll: 1,
//         },
//       },
//     ],
//   });
// };

const initSliderStories = () => {
  if ($(window).width() < 1024) {
    $(".slider-stories:not(.slick-initialized)").slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      swipeToSlide: true,
      appendArrows: $(".arrow-control-stories"),
      dots: true,
      infinite: true,
      variableWidth: true,
      speed: 500,
      responsive: [
        {
          breakpoint: 991,
          settings: {
            
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
      ],
    });
  } else {
    $(".slider-stories.slick-initialized").slick("unslick");
  }
};
