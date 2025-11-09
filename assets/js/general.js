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

  function maybeAutoSubmitTagsFilters() {
    if (tagsFiltersTimeout) {
      clearTimeout(tagsFiltersTimeout);
      tagsFiltersTimeout = null;
    }
    tagsFiltersTimeout = setTimeout(function () {
      runTagsFilter();
    }, 2000);
  }

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
  var initTestimonialsSlider = function () {
    if (jQuery(".slider-default").length > 0) {
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
          // {
          //     breakpoint: 550,
          //     settings: {
          //         dots: false,
          //     },
          // },
        ],
      });
    }
  };

  //sleder Portfolio filters in mobile
  var initSliderPortfolioFilters = function () {
    if (jQuery(".portfolio-filters-slider").length > 0) {
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
    }
  };

  //sleder Portfolio archive
  var initSlidersPortfolio = function () {
    $(".section-portfolio").each(function (indexSection) {
      var selector1 = ".portfolio-slider-" + (indexSection + 1);
      var selector2 = ".wr-control-portfolio-slider-" + (indexSection + 1);
      var selector3 = ".portfolio-filters-slider-bottom-" + (indexSection + 1);

      if (jQuery(selector1).length > 0) {
        jQuery(selector1).slick({
          variableWidth: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: true,
          touchThreshold: 100,
          swipeToSlide: true,
          swipe: true,
          appendArrows: jQuery(selector2),
          responsive: [
            {
              breakpoint: 1100,
              settings: {
                arrows: false,
                slidesToShow: 1,
                slidesToScroll: 1,
              },
            },
          ],
        });
      }
      if (jQuery(selector3).length > 0) {
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
      }
    });
  };

  //sleder Resent cases mobile
  var initCasesSlider = function () {
    if (jQuery(".cases-slider").length > 0) {
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
    }
  };

  //sleder blockchain
  var initBlockchainSlider = function () {
    if (jQuery(".slider-blockchain").length > 0) {
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
    }
  };

  //slider label mobile
  var initSliderLabel = function () {
    if (jQuery(".label-slider").length > 0) {
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
    }
  };

  //list-logo-slider mobile
  var initSliderListLogo = function () {
    if (jQuery(".list-logo-slider").length > 0) {
      $(".list-logo-slider").slick({
        variableWidth: true,
        responsive: [
          {
            breakpoint: 767,
            settings: {
              rows: 2,
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
        ],
      });
    }
  };

  //project-card-slider mobile
  var initSliderProjectCard = function () {
    if (jQuery(".project-card-slider").length > 0 && $(window).width() < 992) {
      $(".project-card-slider:not(.slick-initialized)").slick({
        variableWidth: true,
        infinite: true,
        cssEase: "linear",
        speed: 500,
        swipeToSlide: true,
        responsive: [
          {
            breakpoint: 991,
            settings: {
              rows: 3,
              slidesToShow: 1,
              slidesToScroll: 1,
            },
          },
        ],
      });
    } else {
      $(".project-card-slider.slick-initialized").slick("unslick");
    }
  };

  // function for init our projects block
  var initSliderProjects = function () {
    if (jQuery(".our-projects-list").length > 0) {
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
    }
  };

  /* single portfolio cases */
  //slider Solution
  var initSliderSolution = function () {
    if (jQuery(".solution-slider").length > 0) {
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
    }
  };

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
          if (
            icoda_loadmore_params.current_page == icoda_loadmore_params.max_page
          ) {
            button.remove(); // if last page, remove the button
          }
        } else {
          button.remove(); // if no data, remove the button as well
        }
      },
    });
  });

  //sleder Resent cases new mobile
  $(window).on("load resize", function () {
    if ($(window).width() < 991) {
      if (jQuery(".case-new-slider:not(.slick-initialized)").length > 0) {
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
      }
    } else {
      if (jQuery(".case-new-slider.slick-initialized").length > 0) {
        $(".case-new-slider.slick-initialized").slick("unslick");
      }
    }
  });

  $(window).on("load resize", function () {
    if ($(window).width() < 991) {
      //slider post templates (fb, instagram)
      if (jQuery(".slider-post-templates:not(.slick-initialized)").length > 0) {
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
      }
      //sleder responsive design mobile
      if (
        jQuery(".slider-responsive-design:not(.slick-initialized)").length > 0
      ) {
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
      }
      //slider many-function
      if (jQuery(".slider-many-function:not(.slick-initialized)").length > 0) {
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
      }
    } else {
      if (jQuery(".slider-post-templates.slick-initialized").length > 0) {
        $(".slider-post-templates.slick-initialized").slick("unslick");
      }
      if (jQuery(".slider-responsive-design.slick-initialized").length > 0) {
        $(".slider-responsive-design.slick-initialized").slick("unslick");
      }
      if (jQuery(".slider-many-function.slick-initialized").length > 0) {
        $(".slider-many-function.slick-initialized").slick("unslick");
      }
    }
  });

  /* stickykit.js to single post */
  if ($(window).width() > 991) {
    $("[data-sticky-single]").stick_in_parent({
      offset_top: 150,
    });
  }

  function make_sticky() {
    $("[data-sticky-sidebar-case]").stick_in_parent({
      offset_top: 240,
    });
  }

  $(window).on("load resize", function () {
    if ($(window).width() < 991) {
      $("[data-sticky-sidebar-case]").trigger("sticky_kit:detach");
      $("[data-sticky-sidebar-case]").trigger("sticky_kit:detach");
    } else {
      make_sticky();
    }
  });

  // if ($(window).width() > 991) {

  // }

  initParallax();
  initTestimonialsSlider();
  initSliderPortfolioFilters();
  initSlidersPortfolio();
  initCasesSlider();
  initVideoPopup();
  initSliderSolution();
  initSliderProjects();
  initSliderProjectCard();
  initSliderListLogo();
  initSliderLabel();
  initBlockchainSlider();
});
