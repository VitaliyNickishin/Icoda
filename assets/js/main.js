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
            '" />',
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
        'input[name="head_user_country_ip_detected"]',
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
          '" />',
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
          $form.find(".form-group").removeClass("focused");
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
      },
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
  jQuery("[data-conference]").each(function () {
    const conferenceModalId = $(this).data("conferenceId");
    modalConferenceCookies[conferenceModalId] = getCookie(
      "modal-conference-" + conferenceModalId,
    );
  });

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
    },
  );

  // $(".menu-item-has-children").on("mouseenter", (e) => {
  //   $(e.currentTarget).addClass("opened");
  // });

  // $(".menu-item-has-children").on("mouseleave", (e) => {
  //   $(e.currentTarget).removeClass("opened");
  // });

  $('a[id="5884"]').removeAttr("href");
  $('a[id="5885"]').removeAttr("href");
  $('a[id="5886"]').removeAttr("href");
  $('a[id="5883"]').removeAttr("href");
  $('a[id="5869"]').removeAttr("href");

  var indexTimeout = 0;
  jQuery("[data-conference]").each(function () {
    const conferenceModalId = $(this).data("conferenceId");
    if (
      (modalConferenceCookies[conferenceModalId] === undefined ||
        modalConferenceCookies[conferenceModalId] === "" ||
        modalConferenceCookies[conferenceModalId] === null) &&
      $(this).data("forLang") === $(this).data("currentLang") &&
      $(this).data("show") === "yes"
    ) {
      indexTimeout++;
      setTimeout(function () {
        $("body").css("overflow", "hidden");
        if (
          /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
            navigator.userAgent,
          )
        ) {
        } else {
          $("body").addClass("modal-open");
        }
        overlay.fadeIn(400, function () {
          $('[data-conference-id="' + conferenceModalId + '"]')
            .css({
              display: "block",
              transform: "translate(-50%, -50%)",
            })
            .animate({ opacity: 1, top: "50%" }, 200);
        });
      }, indexTimeout * 10000);
    }
  });

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
        navigator.userAgent,
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

    const conferenceModalId = $(this)
      .closest(".modal-conference")
      .data("conferenceId");
    setCookie("modal-conference-" + conferenceModalId, "yes");
    $(this).closest(".modal-conference").find(".modal-close").trigger("click");
    // window.open($(this).attr("href"));
    var div = $(this).attr("data-modal");

    setTimeout(function () {
      $("body").css("overflow", "hidden");
      if (
        /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
          navigator.userAgent,
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
        navigator.userAgent,
      )
    ) {
    } else {
      $("body").addClass("modal-open");
    }
    var div = $(this).attr("data-modal");
    var initedFromBannerReviewBlock = "no";
    if ($(this).hasClass("is-banner-review-block")) {
      initedFromBannerReviewBlock = "yes";
    }

    if (
      $(div).find("form").find('input[name="is-banner-review-block"]').length
    ) {
      $(div)
        .find("form")
        .find('input[name="is-banner-review-block"]')
        .val(initedFromBannerReviewBlock);
    } else {
      $(div)
        .find("form")
        .append(
          `<input type="hidden" name="is-banner-review-block" value="${initedFromBannerReviewBlock}" />`,
        );
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
        navigator.userAgent,
      )
    ) {
    } else {
      $("body").removeClass("modal-open");
    }

    if ($(this).parent().hasClass("modal-conference")) {
      const conferenceModalId = $(this).parent().data("conferenceId");
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
          "><!-- start -->",
        );
      }
      while (elem.innerHTML.search(">— wp:<!-- start -->") !== -1) {
        elem.innerHTML = elem.innerHTML.replace(
          ">— wp:<!-- start -->",
          "><!-- start -->",
        );
      }
    }
  });
  /* end for wordpress */

  if (head_user_ip_detected.length) {
    const userIP = head_user_ip_detected[0].value;

    fetch(`https://icoda.io/wp-json/icoda/v1/get_ip_info`, {
      // fetch(`https://staging.icoda.io/wp-json/icoda/v1/get_ip_info`, {
      method: "POST",
      body: JSON.stringify({
        ip: userIP,
      }),
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then(function (data) {
        return data.json();
      })
      .then(function (data) {
        if (data && data.country) {
          // console.log("data", data);
          $('input[name="head_user_country_ip_detected"]').val(data.country);
          setCookie("user_country_ip_detected", data.country);
        }
      });
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
        500,
      );
    });
  };

  //slider Featured in mobile
  var initSliderFeatured = function () {
    if (jQuery(".featured-in-slider").length > 0) {
      $(".featured-in-slider").slick({
        variableWidth: true,
        slidesToScroll: 2,
        rtl: $("body").hasClass("rtl") ? true : false,
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
        rtl: $("body").hasClass("rtl") ? true : false,
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
      if (
        jQuery('[data-action="youtube-chanels-slider"]:not(.slick-initialized)')
          .length > 0
      ) {
        $(
          '[data-action="youtube-chanels-slider"]:not(.slick-initialized)',
        ).slick({
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
        });
      }

      if (
        jQuery('[data-action="twitter-chanels-slider"]:not(.slick-initialized)')
          .length > 0
      ) {
        $(
          '[data-action="twitter-chanels-slider"]:not(.slick-initialized)',
        ).slick({
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
        });
      }

      if (
        jQuery('[data-action="tik-tok-chanels-slider"]:not(.slick-initialized)')
          .length > 0
      ) {
        $(
          '[data-action="tik-tok-chanels-slider"]:not(.slick-initialized)',
        ).slick({
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
        });
      }

      if (
        jQuery('[data-action="press-slider"]:not(.slick-initialized)').length >
        0
      ) {
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
      if (
        jQuery('[data-action="youtube-chanels-slider"].slick-initialized')
          .length > 0
      ) {
        $('[data-action="youtube-chanels-slider"].slick-initialized').slick(
          "unslick",
        );
      }
      if (
        jQuery('[data-action="twitter-chanels-slider"].slick-initialized')
          .length > 0
      ) {
        $('[data-action="twitter-chanels-slider"].slick-initialized').slick(
          "unslick",
        );
      }
      if (
        jQuery('[data-action="tik-tok-chanels-slider"].slick-initialized')
          .length > 0
      ) {
        $('[data-action="tik-tok-chanels-slider"].slick-initialized').slick(
          "unslick",
        );
      }
      if (jQuery('[data-action="press-slider"].slick-initialized').length > 0) {
        $('[data-action="press-slider"].slick-initialized').slick("unslick");
      }
    }
  });

  // initialise plugin
  const initIntlTel = () => {
    document.querySelectorAll(".intlTel").forEach((input) => {
      const itiInstance = window.intlTelInput(input, {
        initialCountry: "auto",
        geoIpLookup: detectCountry,
      });

      input._iti = itiInstance;
    });
  };

  const detectCountry = async (callback) => {
    try {
      const userIPInput = document.querySelector(
        'input[name="head_user_ip_detected"]',
      );

      const res = await fetch("/wp-json/icoda/v1/get_ip_info", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ ip: userIPInput?.value }),
      });

      const data = await res.json();

      callback(data.country_code?.toLowerCase() || "us");
    } catch (error) {
      callback("us");
    }
  };

  function validateIntlTel(value, element) {
    const itiInstance = element._iti;

    if (!value.trim()) return false;
    if (!itiInstance) return false;

    return itiInstance.isValidNumber();
  }

  function getIntlTelError(params, element) {
    const itiInstance = element._iti;

    if (!itiInstance) return "Invalid phone number";

    const errorCode = itiInstance.getValidationError();

    const errorMap = [
      "Invalid number",
      "Invalid country code",
      "Too short",
      "Too long",
      "Invalid number",
    ];

    return errorMap[errorCode] || "Invalid phone number";
  }

  $.validator.addMethod("intlTelNumber", validateIntlTel, getIntlTelError);

  // function for pages using form validation
  var formValidate = function () {
    document.querySelectorAll(".form-default-desctop").forEach((form) => {
      $(form).validate({
        rules: {
          "project-name": {
            required: true,
            minlength: 2,
            maxlength: 100,
          },
          name: {
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
          phone: {
            required: true,
            intlTelNumber: true,
          },
        },
        messages: {},
        submitHandler: function (form) {
          if ($(form).hasClass("form-with-captcha")) {
            grecaptcha.execute();
          } else {
            if ($(form).hasClass("block-banner-email__form")) {
              if ($(form).find('input[name="page_url"]').length) {
                $(form)
                  .find('input[name="page_url"]')
                  .val(window.location.href);
              } else {
                $(form).append(
                  '<input type="hidden" name="page_url" value="" />',
                );
                $(form)
                  .find('input[name="page_url"]')
                  .val(window.location.href);
              }

              const formName = $(form)
                .closest(".block-banner-email__content")
                .find(".banner-title")
                .text();
              if ($(form).find('input[name="form_name"]').length) {
                $(form).find('input[name="form_name"]').val(formName);
              } else {
                $(form).append(
                  '<input type="hidden" name="form_name" value="" />',
                );
                $(form).find('input[name="form_name"]').val(formName);
              }
            }

            $(form).find('button[type="submit"]').prop("disabled", true);
            var old_text = $(form).find('button[type="submit"]').text();
            $(form).find('button[type="submit"]').text("Sending ...");
            if ($(form).data("submit") == "yes") {
              const phoneInput = form.querySelector(".intlTel");

              if (phoneInput && phoneInput._iti) {
                if (phoneInput._iti.isValidNumber()) {
                  phoneInput.value = phoneInput._iti.getNumber();
                }
              }

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
                    'input[name="head-utm-' + utm_key + '"]',
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
                      '" />',
                  );
                }
              });

              var selectorCountry = 'input[name="user-country"]';
              var inputCountry = $(form).find(selectorCountry);
              if (inputCountry.length) {
                inputCountry.remove();
              }
              var user_country_ip_detected = getCookie(
                "user_country_ip_detected",
              );
              if (
                (user_country_ip_detected === undefined ||
                  user_country_ip_detected === null ||
                  user_country_ip_detected === "") &&
                jQuery('input[name="head_user_country_ip_detected"]').length
              ) {
                user_country_ip_detected = jQuery(
                  'input[name="head_user_country_ip_detected"]',
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
                    '" />',
                );
              }
              // console.log("form", $(form).serialize());

              $.post(
                "/wp-content/themes/icoda/submit.php",
                $(form).serialize(),
                function (data) {
                  if (data == 1) {
                    window.dataLayer = window.dataLayer || [];
                    dataLayer.push({ event: "form-successfuly-sent" });
                    // заявка (модалка #callback или форма на странице) ->
                    // следующим экраном Calendly в модалке
                    var calendlyLead = !$(form).is(
                      "#calculator-form, .block-banner-email__form",
                    )
                      ? {
                          name: $(form).find('input[name="name"]').val(),
                          email: $(form).find('input[name="email"]').val(),
                          lang: $(form).find('input[name="lang-source"]').val(),
                          source: $(form).closest("#callback").length
                            ? "callback_modal"
                            : "page_form",
                        }
                      : null;
                    $(form)
                      .find(".req")
                      .each(function () {
                        $(this).val("").next().detach();
                        $(this).closest(".form-group").removeClass("focused");
                      });
                    $(form).find("textarea").val("");

                    //clean number and update country code
                    if (phoneInput && phoneInput._iti) {
                      phoneInput._iti.setNumber("");
                      detectCountry((countryCode) => {
                        phoneInput._iti.setCountry(countryCode);
                      });
                    }

                    setTimeout(function () {
                      if (
                        !(
                          calendlyLead &&
                          window.icodaCalendlyStep &&
                          window.icodaCalendlyStep(
                            calendlyLead,
                            calendlyLead.source,
                          )
                        )
                      ) {
                        $(".modal-box")
                          .animate({ opacity: 0, top: "45%" }, 200)
                          .css("display", "none");
                        $("body")
                          .find(".success")
                          .css("opacity", "1")
                          .fadeIn(500);
                        window.congratsConfetti();
                      }
                      $(form)
                        .find('button[type="submit"]')
                        .prop("disabled", false);
                      $(form).find('button[type="submit"]').text(old_text);
                    }, 200);
                  } else {
                  }
                },
              );
              $(form).data("submit", "no");
              $(form).removeClass("submitting-form");
            }
          }
        },
      });
    });
  };

  // var formModalValidate = function () {
  //   jQuery(".js-validate-contact-form").validate({
  //     rules: {
  //       "project-name": {
  //         required: true,
  //         minlength: 2,
  //         maxlength: 100,
  //       },
  //       name: {
  //         required: true,
  //         minlength: 2,
  //         maxlength: 50,
  //       },

  //       email: {
  //         required: true,
  //         email: true,
  //       },
  //       message: {
  //         maxlength: 500,
  //       },
  //     },
  //     messages: {
  //       "project-name": {
  //         required: "Project name is required",
  //       },
  //       name: {
  //         required: "Please enter your name",
  //       },
  //       email: {
  //         required: "Please enter your email",
  //         email: "Please enter a valid email address",
  //       },
  //     },
  //     errorElement: "div",
  //     errorClass: "invalid-feedback",
  //     highlight: function (element) {
  //       $(element).addClass("is-invalid");
  //     },
  //     unhighlight: function (element) {
  //       $(element).removeClass("is-invalid");
  //     },
  //     errorPlacement: function (error, element) {
  //       error.insertAfter(element);
  //     },
  //     submitHandler: function (form) {
  //       if ($(form).hasClass("form-with-captcha")) {
  //         grecaptcha.execute();
  //       } else {
  //         $(form).find('button[type="submit"]').prop("disabled", true);
  //         var old_text = $(form).find('button[type="submit"]').text();
  //         $(form).find('button[type="submit"]').text("Sending ...");
  //         if ($(form).data("submit") == "yes") {
  //           var utm_keys = [
  //             "utm_source",
  //             "utm_medium",
  //             "utm_campaign",
  //             "utm_content",
  //             "utm_term",
  //           ];
  //           utm_keys.forEach((utm_key) => {
  //             var selectorUtm = 'input[name="utm-' + utm_key + '"]';
  //             var inputUtm = $(form).find(selectorUtm);
  //             if (inputUtm.length) {
  //               inputUtm.remove();
  //             }
  //             var utm_value = getCookie("utm-" + utm_key);

  //             if (
  //               (utm_value === undefined ||
  //                 utm_value === null ||
  //                 utm_value === "") &&
  //               jQuery('input[name="head-utm-' + utm_key + '"]').length
  //             ) {
  //               utm_value = jQuery(
  //                 'input[name="head-utm-' + utm_key + '"]',
  //               ).val();
  //               setCookie("utm-" + utm_key, utm_value);
  //             }

  //             if (
  //               utm_value !== undefined &&
  //               utm_value !== "" &&
  //               utm_value !== null
  //             ) {
  //               $(form).append(
  //                 '<input type="hidden" name="utm-' +
  //                   utm_key +
  //                   '" value="' +
  //                   decodeURIComponent(utm_value) +
  //                   '" />',
  //               );
  //             }
  //           });

  //           var selectorCountry = 'input[name="user-country"]';
  //           var inputCountry = $(form).find(selectorCountry);
  //           if (inputCountry.length) {
  //             inputCountry.remove();
  //           }
  //           var user_country_ip_detected = getCookie(
  //             "user_country_ip_detected",
  //           );
  //           if (
  //             (user_country_ip_detected === undefined ||
  //               user_country_ip_detected === null ||
  //               user_country_ip_detected === "") &&
  //             jQuery('input[name="head_user_country_ip_detected"]').length
  //           ) {
  //             user_country_ip_detected = jQuery(
  //               'input[name="head_user_country_ip_detected"]',
  //             ).val();
  //             setCookie("user_country_ip_detected", user_country_ip_detected);
  //           }
  //           if (
  //             user_country_ip_detected !== undefined &&
  //             user_country_ip_detected !== "" &&
  //             user_country_ip_detected !== null
  //           ) {
  //             $(form).append(
  //               '<input type="hidden" name="user-country" value="' +
  //                 decodeURIComponent(user_country_ip_detected) +
  //                 '" />',
  //             );
  //           }

  //           $(form).data("submit", "no");
  //           $(form).removeClass("submitting-form");
  //         }
  //       }
  //     },
  //   });
  // };

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
  //calculator pages
  // let ValidateFields = function () {
  //   jQuery(".validate-fields")
  //     .closest("form")
  //     .find('button[type="submit"]')
  //     .on("click", function (e) {
  //       var $form = $(this).closest("form");

  //       if (!$form.valid()) {
  //         e.preventDefault();
  //         return false;
  //       }

  //       $form.data("submit", "yes");
  //       $form.addClass("submitting-form");
  //     });
  // };

  //testimonials section
  $("body").on("click", ".testimonials-content", function (e) {
    $(".testimonials-content").each(function () {
      $(e.currentTarget).toggleClass("ellipsis");
    });
  });
  //section-services-slider
  $("body").on("click", ".service-box__description", function (e) {
    $(".service-box__description").each(function () {
      $(e.currentTarget).toggleClass("ellipsis");
    });
  });

  $("body").on("click", ".ellipsis-content", function (e) {
    $(".ellipsis-content").each(function () {
      $(e.currentTarget).toggleClass("ellipsis");
    });
  });

  /* copy referral code for overview table */
  let area = document.createElement("textarea");
  document.body.appendChild(area);
  area.style.display = "none";

  let content = document.querySelectorAll(".referral-code");
  let copy = document.querySelectorAll(".referral-copy");

  for (let i = 0; i < copy.length; i++) {
    copy[i].addEventListener("click", function () {
      area.style.display = "block";
      area.value = content[i].innerHTML.toUpperCase();
      area.select();
      document.execCommand("copy");
      area.style.display = "none";

      this.innerHTML = "Copied";
      setTimeout(() => (this.innerHTML = "Copy"), 2000);
    });
  }

  initSliderFeatured();
  initServiceSlider();
  initSliderVcs();
  initMediaSlider();
  formBlock();
  // ValidateFields();
  formValidate();
  // formModalValidate();
  footerAccordionMenu();
  headerFixed();
  inputOnFocus();
  initMegaMenu();
  scrollVerticalMenu();
  initSliderLeaderships();
  initSliderAuthors();
  initSliderCaseNew();
  initAccordionFaq();
  initSliderPathList();
  initSliderPathListFour();
  initSliderPathListSecond();
  scrollToHeading();
  initSliderHero();
  initBoxContentSlider();
  initSliderHeroServices();
  initSliderHeroAiSeo();
  initSliderServicesList();
  initSliderServicesGrid();
  initSliderStories();
  initSliderLogosInfinite();
  initSliderRelatedArticles();
  initSliderRelatedArticlesRtl();
  initSliderBlogArticles();
  initSliderTestimonials();
  initSlideLlm();
  initSliderEditBox();
  initSliderFourBox();
  initIntlTel();
  showMobileSubmenu();
  initSliderBoxContent();
  initRotatingWords();
  // initSliderTwoLogosFirst();
  // initSliderTwoLogosSecond();
});
var scrollToHeading = function () {
  $(".table-of-content").on("click", "a", function () {
    var elem = $(this).attr("href");
    var sectionPos = $(elem).offset().top - 140;
    $("html, body").animate(
      {
        scrollTop: sectionPos,
      },
      500,
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
    header.before(
      '<div class="headerSpace d-none" style="height: ' +
        headerSpaceH +
        'px;" ></div>',
    );
  }
  $(window).scroll(function () {
    let headerSpaceH = header.outerHeight();

    if ($(this).scrollTop() > headerSpaceH) {
      header.addClass("header_fixed");
      $(".headerSpace").removeClass("d-none");
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
    const body = jQuery("body");
    jQuery(this).toggleClass("burger_active");
    menu.toggleClass("opened");
    if (menu.hasClass("opened")) {
      jQuery(".cd-words-wrapper").addClass("icoda-hidden");
    } else {
      jQuery(".cd-words-wrapper").removeClass("icoda-hidden");
    }
    if (jQuery(this).hasClass("burger_active")) {
      text.text(icoda_main_params.menu_close_label);

      body.addClass("no-scroll");
    } else {
      text.text(icoda_main_params.menu_open_label);

      body.removeClass("no-scroll");
    }
  });
}

// show mobile submenu
function showMobileSubmenu() {
  jQuery('[data-action="arrow"]').on("click", function (e) {
    e.preventDefault();

    const parent = jQuery(this).closest(".menu-item");
    const subMenu = parent.children(".sub-menu"); // <ul>

    if (parent.hasClass("opened")) {
      parent.removeClass("opened");
      subMenu.removeClass("opened");
      return;
    }

    jQuery(".menu-item-has-children.opened")
      .not(parent)
      .removeClass("opened")
      .children(".sub-menu")
      .removeClass("opened");

    parent.addClass("opened");
    subMenu.addClass("opened");
  });
}
//form contact us
function inputOnFocus() {
  jQuery(".form-group .form-control").on("focus blur input", function (evt) {
    let parent = jQuery(this).closest(".form-group");

    if (evt.type === "focus" || jQuery(this).val().length > 0) {
      parent.addClass("focused");
    } else {
      parent.removeClass("focused");
    }
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
    "rotateY(" + trY + "deg) rotateX(" + trX + "deg) rotateZ(0deg) scale(1.05)",
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
    ".dropdown__input_hidden",
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
          }</span>`,
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

window.congratsConfetti = function () {
  const congratsContent = $(".modal-default.success");

  if (congratsContent.length === 0) {
    return;
  }

  const canvas = $("#congrats-confetti")[0];
  canvas.confetti =
    canvas.confetti || confetti.create(canvas, { resize: true });
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
      shapes: ["square"],
    });

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
      shapes: ["square"],
    });

    Promise.all([confettiPromise1, confettiPromise2, confettiPromise3]).then(
      () => {
        congratsContent.addClass("finished");
      },
    );

    clearTimeout(celebrationTimeoutId);
  }

  celebrationTimeoutId = setTimeout(celebrate, 0);
};

//sleder Resent cases new mobile
const initSliderCaseNew = () => {
  const isMobile = $(window).width() < 991;

  $(".case-new-slider").each(function () {
    const $slider = $(this);

    if (isMobile) {
      if (!$slider.hasClass("slick-initialized")) {
        $slider.slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          variableWidth: true,
          speed: 500,
          swipeToSlide: $("body").hasClass("rtl") ? false : true,
          rtl: $("body").hasClass("rtl") ? true : false,
          cssEase: "linear",
          arrows: false,
          responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
              },
            },
          ],
        });
      }
    } else {
      if ($slider.hasClass("slick-initialized")) {
        $slider.slick("unslick");
      }
    }
  });
};
// $(window).on("load resize", function () {
//   if ($(window).width() < 991) {
//     if (jQuery(".case-new-slider:not(.slick-initialized)").length > 0) {
//       $(".case-new-slider:not(.slick-initialized)").slick({
//         slidesToShow: 3,
//         slidesToScroll: 1,
//         infinite: true,
//         variableWidth: true,
//         speed: 500,
//         responsive: [
//           {
//             breakpoint: 768,
//             settings: {
//               slidesToShow: 2,
//             },
//           },
//         ],
//       });
//     }
//   } else {
//     if (jQuery(".case-new-slider.slick-initialized").length > 0) {
//       $(".case-new-slider.slick-initialized").slick("unslick");
//     }
//   }
// });

const initSliderLeaderships = () => {
  if ($(".leaderships-slider").length > 0) {
    $(".leaderships-slider").slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      swipeToSlide: $("body").hasClass("rtl") ? false : true,
      variableWidth: false,
      rtl: $("body").hasClass("rtl") ? true : false,
      appendArrows: $(".wr-control-leadership"),
      speed: 500,
      cssEase: "linear",
      infinite: true,
      responsive: [
        {
          breakpoint: 991,
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

const initSliderAuthors = () => {
  const isMobile = $(window).width() < 991;

  $(".authors-slider").each(function () {
    const $slider = $(this);

    if (isMobile) {
      if (!$slider.hasClass("slick-initialized")) {
        $slider.slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          swipeToSlide: $("body").hasClass("rtl") ? false : true,
          infinite: true,
          rtl: $("body").hasClass("rtl") ? true : false,
          cssEase: "linear",
          arrows: false,
          variableWidth: true,
          speed: 500,
          responsive: [
            {
              breakpoint: 576,
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
      if ($slider.hasClass("slick-initialized")) {
        $slider.slick("unslick");
      }
    }
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

  // https://icoda.io/events/   changed info with hover
  // if ($(window).width() > 991) {
  //   function hideAll() {
  //     $('.card-event__img, .card-event__footer').stop(true, true).fadeOut(200);
  //   }

  //   function showCard(index) {
  //     hideAll();
  //     const card = $('.card-event').eq(index);
  //     card.find('.card-event__img, .card-event__footer').stop(true, true).fadeIn(300);
  //   }

  //   showCard(0);

  //   $('.card-event').on('mouseenter', function() {
  //     const index = $(this).data('index');
  //     showCard(index);
  //   });

  //   $('.card-event-list').on('mouseleave', function() {
  //     showCard(0);
  //   });
  // }
});

window.addEventListener("DOMContentLoaded", () => {
  //switch images in featured events with timer
  if (window.innerWidth > 991) {
    const cards = document.querySelectorAll(".card-event");
    const cardsList = document.querySelector(".card-event-list");
    let currentIndex = 0;
    let autoSwitchInterval;

    if (cards && cardsList) {
      function showCard(index) {
        cards.forEach((card) => card.classList.remove("active"));
        cards[index].classList.add("active");
        currentIndex = index;
      }

      function showNextCard() {
        const nextIndex = (currentIndex + 1) % cards.length;
        showCard(nextIndex);
      }

      function startAutoSwitch() {
        autoSwitchInterval = setInterval(showNextCard, 10000);
      }

      function stopAutoSwitch() {
        clearInterval(autoSwitchInterval);
      }

      cards.forEach((card, index) => {
        card.addEventListener("mouseenter", () => {
          stopAutoSwitch();
          showCard(index);
        });
      });

      cardsList.addEventListener("mouseleave", () => {
        startAutoSwitch();
        showCard(0);
      });

      // Инициализация
      showCard(0);
      startAutoSwitch();
    }
  }

  //switch images in featured events without timer
  // const cards = document.querySelectorAll('.card-event');
  // const cardsList = document.querySelector('.card-event-list');
  // if(cards && cardsList) {
  //   cards.forEach((card, index) => {
  //     card.addEventListener('mouseenter', () => {
  //       cards.forEach(c => c.classList.remove('active'));
  //       card.classList.add('active');
  //     });
  //   });

  //   cardsList.addEventListener('mouseleave', () => {
  //     cards.forEach(c => c.classList.remove('active'));
  //     cards[0].classList.add('active');
  //   });
  // }

  //switch checkbox for event filters
  document
    .querySelector("#event-filters-form")
    ?.addEventListener("change", function (evt) {
      // evt.target.parentNode.parentNode.classList.remove('active');
      if (evt.target.classList.contains("checkbox") && evt.target.checked) {
        [].slice
          .call(document.querySelectorAll(".checkbox"))
          .forEach((c) => (c.checked = false));
        evt.target.checked = true;
        // evt.target.parentNode.parentNode.classList.add('active');
      }
    });

  //Read more / read less event-overview-table.php
  document.querySelectorAll(".undertitle-wrap").forEach(function (wrap) {
    wrap.addEventListener("change", function (evt) {
      console.log("undertitle-wrap - undertitle-wrap");
      if (evt.target.classList.contains("read-more")) {
        if (evt.target.checked) {
          wrap.classList.add("open");
        } else {
          wrap.classList.remove("open");
        }
      }
    });
  });

  //event page(btn mbile filters)
  let btnMobileFilter = document.querySelector(".button-mobile-filter");
  let eventFilters = document.querySelector(".event-filters");

  if (btnMobileFilter && eventFilters) {
    btnMobileFilter.addEventListener("click", function (evt) {
      evt.preventDefault();
      evt.target.parentNode.classList.toggle("active");
      eventFilters.classList.toggle("d-none");
      if (evt.target !== btnMobileFilter) {
        console.log("click outside");

        evt.target.parentNode.classList.toggle("active");
        eventFilters.classList.toggle("d-none");
      }
    });
  }
});

const initSliderHero = () => {
  if ($(window).width() < 1024) {
    $(".hero-slider:not(.slick-initialized)").slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      swipeToSlide: true,
      infinite: true,
      rtl: $("body").hasClass("rtl") ? true : false,
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
const initBoxContentSlider = () => {
  if ($(".box-content-slider").length > 0) {
    if ($(window).width() < 768) {
      $(".box-content-slider:not(.slick-initialized)").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        swipeToSlide: true,
        infinite: true,
        rtl: $("body").hasClass("rtl") ? true : false,
        variableWidth: true,
        cssEase: "linear",
        speed: 500,
      });
    } else {
      $(".box-content-slider.slick-initialized").slick("unslick");
    }
  }
};

const initSliderHeroServices = () => {
  if ($(window).width() < 1024) {
    $(".hero-slider-services:not(.slick-initialized)").slick({
      slidesToShow: 2,
      slidesToScroll: 1,
      swipeToSlide: true,
      arrows: false,
      infinite: true,
      variableWidth: true,
      cssEase: "linear",
      rtl: $("body").hasClass("rtl") ? true : false,
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

const initSliderTwoLogosFirst = () => {
  $(".slider-two-logos-first").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    swipeToSlide: true,
    infinite: true,
    variableWidth: true,
    autoplay: true,
    autoplaySpeed: 0,
    speed: 4000,
    cssEase: "linear",
    rtl: $("body").hasClass("rtl") ? true : false,
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
};

const initSliderTwoLogosSecond = () => {
  $(".slider-two-logos-second").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    swipeToSlide: true,
    infinite: true,
    variableWidth: true,
    autoplay: true,
    autoplaySpeed: 0,
    speed: 4000,
    cssEase: "linear",
    // rtl: false,
    // rtl: true,
    // rtl: $("body").hasClass("rtl") ? false : true,
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
};
$(window).on("load resize", function () {
  initSliderHeroAiSeo();
  initBoxContentSlider();
  initSliderFourBox();
  initSliderAuthors();
  initSliderCaseNew();
  initSliderHeroServices();
  initSliderServicesList();
  initSliderServicesGrid();
  initSliderStories();
});
const initSliderHeroAiSeo = () => {
  if ($(".hero-slider-ai-seo").length > 0) {
    if ($(window).width() < 1340) {
      $(".hero-slider-ai-seo:not(.slick-initialized)").slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        swipeToSlide: true,
        infinite: true,
        arrows: false,
        variableWidth: true,
        cssEase: "linear",
        rtl: $("body").hasClass("rtl") ? true : false,
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
      $(".hero-slider-ai-seo.slick-initialized").slick("unslick");
    }
  }
};

const initSliderBlogArticles = () => {
  const $sliders = $(".slider-blog-articles");

  if (!$sliders.length) return;

  $sliders.each(function () {
    const $slider = $(this);
    const $controls = $slider
      .closest(".section-blog-articles")
      .find(".slider-control-blog-articles");

    $slider.slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      swipeToSlide: $("body").hasClass("rtl") ? false : true,
      infinite: true,
      dots: false,
      rtl: $("body").hasClass("rtl") ? true : false,
      appendArrows: $controls,
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
  });
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
      swipeToSlide: $("body").hasClass("rtl") ? false : true,
      infinite: true,
      variableWidth: true,
      speed: 500,
      rtl: $("body").hasClass("rtl") ? true : false,
      cssEase: "linear",
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
const initSliderBoxContent = () => {
  if (jQuery(".slider-box-content").length > 0) {
    $(".slider-box-content").slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      swipeToSlide: $("body").hasClass("rtl") ? false : true,
      infinite: true,
      variableWidth: true,
      rtl: $("body").hasClass("rtl") ? true : false,
      appendArrows: $(".wr-control-box-content"),
      speed: 500,
      cssEase: "linear",
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
  }
};

const initSliderServicesGrid = () => {
  if ($(window).width() < 991) {
    $(".slider-services-grid:not(.slick-initialized)").slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      swipeToSlide: $("body").hasClass("rtl") ? false : true,
      appendArrows: $(".arrow-control-service-grid"),
      infinite: true,
      variableWidth: true,
      rtl: $("body").hasClass("rtl") ? true : false,
      cssEase: "linear",
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
  $(".slider-path-list").each(function () {
    $(this).slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      swipeToSlide: $("body").hasClass("rtl") ? false : true,
      infinite: true,
      variableWidth: true,
      rtl: $("body").hasClass("rtl") ? true : false,
      adaptiveHeight: true,
      appendArrows: $(this).closest("section").find(".arrow-control-path"),
      speed: 500,
      cssEase: "linear",
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
  });
};
//block-post-two-sliders-in-wrap (first)
const initSliderPathListFour = () => {
  $(".slider-path-list-four").each(function () {
    $(this).slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      swipeToSlide: $("body").hasClass("rtl") ? false : true,
      infinite: true,
      variableWidth: true,
      rtl: $("body").hasClass("rtl") ? true : false,
      adaptiveHeight: true,
      appendArrows: $(this).closest("section").find(".arrow-control-path"),
      speed: 500,
      cssEase: "linear",
      responsive: [
        {
          breakpoint: 1441,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
      ],
    });
  });
};
//block-post-two-sliders-in-wrap (second)
const initSliderPathListSecond = () => {
  if (jQuery(".slider-path-list-second").length > 0) {
    $(".slider-path-list-second").slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      swipeToSlide: $("body").hasClass("rtl") ? false : true,
      infinite: true,
      variableWidth: true,
      rtl: $("body").hasClass("rtl") ? true : false,
      adaptiveHeight: true,
      arrows: false,
      speed: 500,
      cssEase: "linear",
      responsive: [
        {
          breakpoint: 1440,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
      ],
    });
  }
};
const initSliderTestimonials = () => {
  if (jQuery(".slider-tesimonials").length > 0) {
    $(".slider-tesimonials").slick({
      lazyLoad: "ondemand",
      slidesToShow: 3,
      slidesToScroll: 1,
      arrows: true,
      dots: true,
      swipeToSlide: $("body").hasClass("rtl") ? false : true,
      infinite: true,
      variableWidth: true,
      rtl: $("body").hasClass("rtl") ? true : false,
      adaptiveHeight: true,
      appendArrows: $(".wr-control-testimonials"),
      speed: 500,
      cssEase: "linear",
      responsive: [
        {
          breakpoint: 991,
          settings: {
            adaptiveHeight: true,
            slidesToShow: 2,
            dots: true,
            arrows: true,
          },
        },
        {
          breakpoint: 550,
          settings: {
            dots: false,
            arrows: true,
          },
        },
      ],
    });
  }
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
      swipeToSlide: $("body").hasClass("rtl") ? false : true,
      appendArrows: $(".arrow-control-stories"),
      dots: true,
      infinite: true,
      variableWidth: true,
      rtl: $("body").hasClass("rtl") ? true : false,
      cssEase: "linear",
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
const initSliderLogosInfinite = () => {
  if (jQuery(".slider-logos-infinite").length > 0) {
    $(".slider-logos-infinite").slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      swipeToSlide: $("body").hasClass("rtl") ? false : true,
      variableWidth: true,
      rtl: $("body").hasClass("rtl") ? true : false,
      appendArrows: false,
      autoplay: true,
      autoplaySpeed: 0,
      speed: 8000,
      cssEase: "linear",
      infinite: true,
      pauseOnHover: true,
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
  }
};

const initSlideLlm = () => {
  if (jQuery(".slider-llm").length > 0) {
    $(".slider-llm:not(.slick-initialized)").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      swipeToSlide: $("body").hasClass("rtl") ? false : true,
      appendArrows: $(".arrow-control-llm"),
      dots: true,
      infinite: true,
      variableWidth: false,
      rtl: $("body").hasClass("rtl") ? true : false,
      cssEase: "linear",
      speed: 500,
    });
  }
};
const initSliderEditBox = () => {
  if ($(".slider-edit-box").length > 0) {
    $(".slider-edit-box").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      swipeToSlide: $("body").hasClass("rtl") ? false : true,
      appendArrows: false,
      dots: true,
      autoplay: true,
      autoplaySpeed: 6000,
      fade: true,
      infinite: true,
      variableWidth: false,
      rtl: $("body").hasClass("rtl") ? true : false,
      cssEase: "linear",
      speed: 500,
    });
  }
};

const initSliderFourBox = () => {
  if ($(window).width() < 1200) {
    $(".slider-four-box:not(.slick-initialized)").slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      swipeToSlide: $("body").hasClass("rtl") ? false : true,
      infinite: true,
      rtl: $("body").hasClass("rtl") ? true : false,
      cssEase: "linear",
      arrows: false,
      variableWidth: true,
      speed: 500,
      responsive: [
        {
          breakpoint: 576,
          settings: {
            slidesToShow: 2,
            variableWidth: true,
            slidesToScroll: 1,
          },
        },
      ],
    });
  } else {
    $(".slider-four-box.slick-initialized").slick("unslick");
  }
};
//page ai-seo (block-post-two-sliders-in-wrap)
document.addEventListener("DOMContentLoaded", function () {
  document
    .querySelectorAll(".dropdown-select-block")
    .forEach(function (dropdown) {
      const toggle = dropdown.querySelector(".dropdown-custom-toggle");
      const menu = dropdown.querySelector(".dropdown-custom-menu");
      const label = dropdown.querySelector(".dropdown-custom-label");
      const button = dropdown.querySelector(".btn-get-report");
      const hiddenInput = dropdown.querySelector(
        ".dropdown-custom-selected-value",
      );

      // open / close
      toggle.addEventListener("click", function (e) {
        e.stopPropagation();
        dropdown.classList.toggle("is-open");
      });

      // choose item
      menu.querySelectorAll("li").forEach(function (item) {
        item.addEventListener("click", function () {
          const value = this.dataset.value;
          const text = this.textContent;

          hiddenInput.value = value;
          label.textContent = text;
          button.disabled = false;

          dropdown.classList.remove("is-open");
        });
      });

      // download pdf
      button.addEventListener("click", function () {
        if (!hiddenInput.value) return;

        const link = document.createElement("a");
        link.href = hiddenInput.value;
        link.setAttribute("download", "");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      });
    });

  // close dropdown after click on body
  document.addEventListener("click", function () {
    document
      .querySelectorAll(".dropdown-select-block.is-open")
      .forEach(function (dropdown) {
        dropdown.classList.remove("is-open");
      });
  });
});

document.querySelectorAll(".stripe-pay-btn").forEach((btn) => {
  btn.addEventListener("click", function (e) {
    e.preventDefault();

    const stripeBtn = document.querySelector("#stripe-payment-hidden form a");

    if (stripeBtn) {
      stripeBtn.click();
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".logos-track").forEach((track) => {
    track.innerHTML += track.innerHTML + track.innerHTML;
    const items = track.children;
    let width = 0;
    // count half width of slider
    for (let i = 0; i < items.length / 2; i++) {
      width += items[i].offsetWidth;
    }
    track.style.setProperty("--track-width", `${width}px`);
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const banner = document.getElementById("pushBanner");
  const closeBtn = document.getElementById("pushBannerClose");
  const isMarketingPage = document.body.classList.contains(
    "is-ai-marketing-page",
  );
  // const isClosed = localStorage.getItem("pushBannerClosed") === "true";

  if (!banner || !closeBtn) return;

  if (isMarketingPage) {
    setTimeout(() => {
      if (banner) {
        banner.classList.add("show");
      }
    }, 5000);
  }
  closeBtn.addEventListener("click", () => {
    banner.classList.remove("show");
    // localStorage.setItem("pushBannerClosed", "true");
  });
});

function initRotatingWords() {
  const words = [
    "clone",
    "fake",
    "rogue affiliate",
    "typosquat",
    "phishing page",
    "parasite page",
    "mirror",
  ];

  const rw = document.getElementById("rw");

  if (!rw) return;

  const rot = rw.parentNode;
  const h1 = rot.closest("h1");

  if (!rot || !h1) return;

  const probe = document.createElement("span");

  probe.style.cssText = `
    position: absolute;
    visibility: hidden;
    white-space: nowrap;
    pointer-events: none;
  `;

  rot.appendChild(probe);

  const widths = {};

  function measure() {
    // Measure every word
    words.forEach(function (word) {
      probe.textContent = word;
      widths[word] = probe.getBoundingClientRect().width;
    });

    /*
     * Find the tallest possible layout across all words.
     * This prevents the content below the heading from jumping.
     */
    const currentWord = rw.textContent.trim();

    let maxHeight = 0;

    h1.style.minHeight = "";
    rot.style.transition = "none";

    words.forEach(function (word) {
      rw.textContent = word;
      rot.style.width = widths[word] + "px";

      maxHeight = Math.max(maxHeight, h1.offsetHeight);
    });

    // Restore current word
    rw.textContent = currentWord;
    rot.style.width = widths[currentWord] + "px";

    h1.style.minHeight = maxHeight + "px";

    // Force reflow
    void rot.offsetWidth;

    rot.style.transition = "";
  }

  // Wait until fonts are loaded
  const ready =
    document.fonts && document.fonts.ready
      ? document.fonts.ready
      : Promise.resolve();

  ready.then(function () {
    measure();

    // Recalculate dimensions on resize
    let resizeTimeout;

    window.addEventListener("resize", function () {
      clearTimeout(resizeTimeout);

      resizeTimeout = setTimeout(function () {
        measure();
      }, 150);
    });

    // Respect user's reduced-motion preference
    if (
      window.matchMedia &&
      window.matchMedia("(prefers-reduced-motion: reduce)").matches
    ) {
      return;
    }

    let index = 0;

    setInterval(function () {
      index = (index + 1) % words.length;

      const nextWord = words[index];

      rw.classList.remove("is-in");
      rw.classList.add("is-out");

      setTimeout(function () {
        rw.classList.remove("is-out");
        rw.classList.add("is-pre");

        rw.textContent = nextWord;
        rot.style.width = widths[nextWord] + "px";

        requestAnimationFrame(function () {
          requestAnimationFrame(function () {
            rw.classList.remove("is-pre");
            rw.classList.add("is-in");
          });
        });
      }, 280);
    }, 1820);
  });
}

/* Calendly после заявки: модалка #callback, формы на странице, калькулятор (11.2026) */
(function ($) {
  var CALENDLY_URL = "https://calendly.com/d/cqrf-wpr-bt6/talk-to-our-expert";
  var WIDGET_JS = "https://assets.calendly.com/assets/external/widget.js";
  var WIDGET_CSS = "https://assets.calendly.com/assets/external/widget.css";

  // [заголовок, текст, ссылка «пропустить», кнопка-запасной вариант, текст для калькулятора]
  var texts = {
    en: ["Thank you! Request received", "We'll reply within 24 hours. To talk sooner, pick a time for a 30-minute call with our team.", "No thanks, I'll wait for your reply", "Open the calendar", "To talk sooner, pick a time for a 30-minute call with our team."],
    ru: ["Спасибо! Заявка получена", "Мы ответим в течение 24 часов. Чтобы поговорить раньше, выберите время для 30-минутного звонка с нашей командой.", "Спасибо, дождусь ответа", "Открыть календарь", "Чтобы поговорить раньше, выберите время для 30-минутного звонка с нашей командой."],
    es: ["¡Gracias! Solicitud recibida", "Le responderemos en 24 horas. Para hablar antes, elija un horario para una llamada de 30 minutos con nuestro equipo.", "No, gracias, esperaré su respuesta", "Abrir el calendario", "Para hablar antes, elija un horario para una llamada de 30 minutos con nuestro equipo."],
    de: ["Vielen Dank! Anfrage erhalten", "Wir antworten innerhalb von 24 Stunden. Wenn Sie früher sprechen möchten, wählen Sie einen Termin für ein 30-minütiges Gespräch mit unserem Team.", "Nein danke, ich warte auf Ihre Antwort", "Kalender öffnen", "Wenn Sie früher sprechen möchten, wählen Sie einen Termin für ein 30-minütiges Gespräch mit unserem Team."],
    fr: ["Merci ! Demande reçue", "Nous vous répondrons sous 24 heures. Pour échanger plus tôt, choisissez un créneau pour un appel de 30 minutes avec notre équipe.", "Non merci, j'attends votre réponse", "Ouvrir le calendrier", "Pour échanger plus tôt, choisissez un créneau pour un appel de 30 minutes avec notre équipe."],
    it: ["Grazie! Richiesta ricevuta", "Le risponderemo entro 24 ore. Per parlarne prima, scelga un orario per una chiamata di 30 minuti con il nostro team.", "No grazie, attendo la vostra risposta", "Apri il calendario", "Per parlarne prima, scelga un orario per una chiamata di 30 minuti con il nostro team."],
    pt: ["Obrigado! Pedido recebido", "Responderemos no prazo de 24 horas. Para falar mais cedo, escolha um horário para uma chamada de 30 minutos com a nossa equipa.", "Não, obrigado, aguardo a vossa resposta", "Abrir o calendário", "Para falar mais cedo, escolha um horário para uma chamada de 30 minutos com a nossa equipa."],
    ar: ["شكرًا لك! تم استلام طلبك", "سنرد عليك خلال 24 ساعة. للتحدث في وقت أقرب، اختر موعدًا لمكالمة مدتها 30 دقيقة مع فريقنا.", "لا شكرًا، سأنتظر ردكم", "افتح التقويم", "للتحدث في وقت أقرب، اختر موعدًا لمكالمة مدتها 30 دقيقة مع فريقنا."],
    ja: ["ありがとうございます。お問い合わせを受け付けました", "24時間以内にご連絡します。お急ぎの場合は、ご都合のよい時間を選んで30分の通話をご予約ください。", "メールでの返信を待ちます", "カレンダーを開く", "お急ぎの場合は、ご都合のよい時間を選んで30分の通話をご予約ください。"],
    ko: ["감사합니다! 요청이 접수되었습니다", "24시간 이내에 답변드리겠습니다. 더 빨리 이야기하시려면 원하는 시간을 선택해 30분 통화를 예약하세요.", "괜찮습니다, 답변을 기다리겠습니다", "캘린더 열기", "더 빨리 이야기하시려면 원하는 시간을 선택해 30분 통화를 예약하세요."],
    zh: ["谢谢！已收到您的请求", "我们将在 24 小时内回复。如想更快沟通，请选择时间，与我们的团队进行 30 分钟通话。", "不用了，我等你们的回复", "打开日历", "如想更快沟通，请选择时间，与我们的团队进行 30 分钟通话。"],
  };

  // источник активного календаря — уходит параметром во все события
  var activeSource = null;

  var pickTexts = function (lang) {
    lang = (lang || document.documentElement.lang || "en").toLowerCase();
    return texts[lang] || texts[lang.split(/[-_]/)[0]] || texts.en;
  };

  var push = function (event) {
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({ event: event, calendly_source: activeSource });
  };

  var cookieVal = function (name) {
    var v = getCookie(name);
    try {
      return v ? decodeURIComponent(v) : undefined;
    } catch (e) {
      return v;
    }
  };

  // widget.js подключён не на всех шаблонах (нет на /blog/) — догружаем
  var loadCalendly = function (done, fail) {
    if (window.Calendly && window.Calendly.initInlineWidget) return done();
    if (!$('link[href="' + WIDGET_CSS + '"]').length) {
      $("head").append('<link rel="stylesheet" href="' + WIDGET_CSS + '">');
    }
    if (!document.querySelector('script[src="' + WIDGET_JS + '"]')) {
      var script = document.createElement("script");
      script.src = WIDGET_JS;
      script.async = true;
      document.body.appendChild(script);
    }
    var waited = 0;
    var timer = setInterval(function () {
      waited += 100;
      if (window.Calendly && window.Calendly.initInlineWidget) {
        clearInterval(timer);
        done();
      } else if (waited >= 6000) {
        clearInterval(timer);
        fail();
      }
    }, 100);
  };

  // showDetails: на широком блоке (калькулятор на десктопе) Calendly с деталями события
  // рисует две колонки вместо узкой карточки
  var mountWidget = function (widget, lead, t, showDetails) {
    loadCalendly(
      function () {
        // имя, email и UTM — параметрами URL: опции prefill/utm
        // текущий widget.js теряет (пустые utm превращаются в "undefined")
        var params = {
          hide_event_type_details: showDetails ? 0 : 1,
          hide_gdpr_banner: 1,
          primary_color: "3c61e2",
          name: lead.name,
          email: lead.email,
        };
        ["source", "medium", "campaign", "content", "term"].forEach(function (k) {
          params["utm_" + k] = cookieVal("utm-utm_" + k);
        });
        var query = Object.keys(params)
          .filter(function (k) {
            return params[k];
          })
          .map(function (k) {
            return k + "=" + encodeURIComponent(params[k]);
          })
          .join("&");
        $(widget).empty();
        window.Calendly.initInlineWidget({
          url: CALENDLY_URL + "?" + query,
          parentElement: widget,
        });
      },
      function () {
        // виджет не загрузился (блокировщик и т. п.) — ссылка на календарь
        $(widget)
          .addClass("is-fallback")
          .html('<a class="btn btn-blue" target="_blank" rel="noopener"></a>')
          .find("a")
          .attr("href", CALENDLY_URL)
          .text(t[3]);
      },
    );
  };

  var reset = function () {
    var $box = $("#callback");
    $box.removeClass("is-calendly-step").find(".calendly-step").remove();
    $box.children(".form-default-header, form").show();
  };

  // экран с календарём в модалке #callback; если модалка закрыта
  // (заявка из формы на странице) — открывает её
  window.icodaCalendlyStep = function (lead, source) {
    var $box = $("#callback");
    if (!$box.length) return false;
    var t = pickTexts(lead.lang);

    reset();
    var $step = $(
      '<div class="calendly-step">' +
        '<div class="calendly-step__head">' +
        '<div class="wr-ico-check"><i class="icon-ico-check"></i></div>' +
        '<p class="ttl"></p><p class="calendly-step__text"></p>' +
        "</div>" +
        '<div class="calendly-step__widget"><div class="calendly-step__loader"></div></div>' +
        '<a href="#" class="calendly-step__skip"></a>' +
        "</div>",
    );
    $step.find(".ttl").text(t[0]);
    $step.find(".calendly-step__text").text(t[1]);
    $step.find(".calendly-step__skip").text(t[2]);
    $box.children(".form-default-header, form").hide();
    $box.addClass("is-calendly-step").append($step);

    if (!$box.is(":visible")) {
      $("body").css("overflow", "hidden");
      if (
        !/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
          navigator.userAgent,
        )
      ) {
        $("body").addClass("modal-open");
      }
      $("#overlay").fadeIn(400, function () {
        $box
          .css({ display: "block", transform: "translate(-50%, -50%)" })
          .animate({ opacity: 1, top: "50%" }, 200);
      });
    }

    activeSource = source || "callback_modal";
    push("calendly_step_shown");
    mountWidget($step.find(".calendly-step__widget")[0], lead, t);
    return true;
  };

  // календарь внутри блока на странице (финальный шаг калькулятора)
  window.icodaCalendlyInline = function (container, lead, source) {
    var $container = $(container);
    if (!$container.length) return false;
    var t = pickTexts(lead.lang);

    $container.find(".calendly-step").remove();
    var $step = $(
      '<div class="calendly-step calendly-step--inline">' +
        '<p class="calendly-step__text"></p>' +
        '<div class="calendly-step__widget"><div class="calendly-step__loader"></div></div>' +
        "</div>",
    );
    $step.find(".calendly-step__text").text(t[4]);
    $container.append($step);

    activeSource = source || "inline";
    push("calendly_step_shown");
    mountWidget(
      $step.find(".calendly-step__widget")[0],
      lead,
      t,
      window.matchMedia("(min-width: 992px)").matches,
    );
    return true;
  };

  $(document).on("click", ".calendly-step__skip", function (e) {
    e.preventDefault();
    $("#callback .modal-close").trigger("click");
  });

  // после закрытия модалки вернуть форму
  $(document).on("click", "#callback .modal-close, #overlay", function () {
    if ($("#callback").hasClass("is-calendly-step")) setTimeout(reset, 400);
  });
  $(document).on("click", '.open-modal[data-modal="#callback"]', reset);

  window.addEventListener("message", function (e) {
    if (e.origin !== "https://calendly.com" || !e.data || !e.data.event) return;
    if (!activeSource || !$(".calendly-step").length) return;
    if (e.data.event === "calendly.date_and_time_selected") {
      push("calendly_time_selected");
    } else if (e.data.event === "calendly.event_scheduled") {
      push("calendly_event_scheduled");
    }
  });
})(jQuery);
