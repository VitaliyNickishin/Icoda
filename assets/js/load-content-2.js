setTimeout(function () {
  const homeBrands = $("#home-brands");

  if (homeBrands.length && homeBrands.data("needLoad")) {
    $.ajax({
      url: "/wp-admin/admin-ajax.php",
      type: "POST",
      data: {
        action: "load_front_page_part",
        part: "home-brands",
        post_id: homeBrands.data("postId"),
        lang: icoda_main_params.current_language,
      },
      success: function (result) {
        homeBrands.append(result.data);
        if ($(window).width() < 992) {
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
      },
    });
  }
}, 800);
