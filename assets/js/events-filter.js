jQuery(document).ready(function ($) {
  const appliedFilters = {};

  $(".nav-link").on("click", function () {
    let topics = $(this).attr("data-topics").trim();

    if (topics === "all" || topics === '"all"') {
      delete appliedFilters["topic"];
    } else {
      try {
        topics = JSON.parse(topics.trim());
        appliedFilters["topic"] = topics;
      } catch (e) {
        console.error("JSON parse error:", topics);
      }
    }

    filterRun();
  });

  $("body").on("click", ".select-item", function (event) {
    const $dropList = $(this).closest(".dropdown-list");
    $dropList.addClass("active");
    $dropList
      .find(".event-filters-selected .event-filters-button-name")
      .text($(this).data("name"));
    const $key = $dropList.data("key");
    appliedFilters[$key] = $(this).data("value");
    $dropList.find('input[type="checkbox"]').prop("checked", false);
    filterRun();
  });

  $("body").on("click", ".reset-events-dropdown", function (event) {
    const $dropList = $(this).closest(".dropdown-list");
    $dropList.removeClass("active");
    $dropList
      .find(".event-filters-selected .event-filters-button-name")
      .text(
        $dropList.find(".selected-default .event-filters-button-name").text(),
      );
    const $key = $dropList.data("key");
    delete appliedFilters[$key];
    $dropList.find('input[type="checkbox"]').prop("checked", false);
    filterRun();
  });
  //button show more
  $("body").on("click", ".section-all-events__show-more", function (event) {
    showMore();
  });

  function updateShowMore() {
    if ($('.overview-table--item:not(".showed")').length > 0) {
      $(".section-all-events__show-more").show();
    } else {
      $(".section-all-events__show-more").hide();
    }
  }

  function filterRun() {
    const data = { ...appliedFilters };
    // console.log("Applied filters: data", data);

    if (Array.isArray(data.topic)) {
      data.topic = JSON.stringify(data.topic);
      // console.log("data.topic json", data.topic);
    }
    $.post("/wp-json/events/v1/filter", data, function (data) {
      $("#events-container").html(data);
      showMore();
      initReadMore();
    });
  }

  function initReadMore() {
    document.querySelectorAll(".undertitle-wrap").forEach(function (wrap) {
      wrap.addEventListener("change", function (evt) {
        if (evt.target.classList.contains("read-more")) {
          if (evt.target.checked) {
            wrap.classList.add("open");
          } else {
            wrap.classList.remove("open");
          }
        }
      });
    });
  }

  function showMore() {
    let showed = 0;
    $('#events-container .overview-table--item:not(".showed")').each(
      function () {
        if (showed < 3) {
          $(this).removeClass("d-none");
          $(this).addClass("showed");
        }
        showed++;
      },
    );
    updateShowMore();
  }

  showMore();
});
