jQuery(document).ready(function ($) {
    const $onlineCheckbox = $('[name="online"]');
    const $withPromocodeCheckbox = $('[name="with_promocode"]');

    const appliedFilters = {};

    $onlineCheckbox.on("change", function (event) {
        appliedFilters["online"] = event.target.checked ? 1 : 0;
        filterRun();
    });

    $withPromocodeCheckbox.on("change", function (event) {
        appliedFilters["with_promocode"] = event.target.checked ? 1 : 0;
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
                $dropList
                    .find(".selected-default .event-filters-button-name")
                    .text()
            );
        const $key = $dropList.data("key");
        delete appliedFilters[$key];
        $dropList.find('input[type="checkbox"]').prop("checked", false);
        filterRun();
    });

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
        $.post("/wp-json/events/v1/filter", appliedFilters, function (data) {
            $("#events-container").html(data);
            showMore();
        });
    }

    function showMore() {
        let showed = 0;
        $('.overview-table--item:not(".showed")').each(function () {
            if (showed < 5) {
                $(this).removeClass("icoda-hidden");
                $(this).addClass("showed");
            }
            showed++;
        });
        updateShowMore();
    }

    showMore();
});
