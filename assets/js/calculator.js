jQuery(document).ready(function ($) {
  checkCheckbox();

  let currentStep = 1;
  const circles = document.querySelectorAll(".step-circle");
  const lines = document.querySelectorAll(".step-line");

  $("body").on("click", ".btn-apply", function () {
    console.log("Send Data");
    if (
      $('input[name="project-name"]').val().length < 1 ||
      $('input[name="name"]').val().length < 1 ||
      $('input[name="email"]').val().length < 1 ||
      $('input[name="telegram"]').val().length < 1
    ) {
      return;
    }
    $("[data-step]").addClass("d-none");
    $('[data-step="done"]').removeClass("d-none");
    $(".steps-count").text("Done");
    $(".btn-prew, .btn-next, .btn-apply, .steps-nav").addClass("d-none");
    $(".steps-box__footer").removeClass("border-top");
    currentStep = "finish";
  });

  $("body").on("click", ".btn-prew", function () {
    if (currentStep === 1) {
      return false;
    }

    if (currentStep === 6) {
      $(".btn-apply").addClass("d-none");
      $(".btn-next").removeClass("d-none");
    }

    currentStep--;
    $("[data-step]").addClass("d-none");
    $('[data-step="' + currentStep + '"]').removeClass("d-none");
    updateStepsCounter();
    if (currentStep === 1) {
      $(".btn-prew").addClass("d-none");
    }
    circles.forEach((c, i) => {
      c.classList.remove("active", "done");
      if (i < currentStep - 1) {
        c.classList.add("done");
      }
      if (i === currentStep - 1) {
        c.classList.add("active");
      }
    });

    lines.forEach((line, i) => {
      line.classList.remove("done");
      if (i < currentStep - 1) {
        line.classList.add("done");
      }
    });
  });

  $("body").on("click", ".btn-next", function () {
    if (currentStep === 6) {
      return false;
    } else {
      if (currentStep === 1) {
        $(".btn-prew").removeClass("d-none");
      }
      currentStep++;
      $("[data-step]").addClass("d-none");
      $('[data-step="' + currentStep + '"]').removeClass("d-none");
      updateStepsCounter();
      if (currentStep === 6) {
        $(".btn-next").addClass("d-none");
        $(".btn-apply").removeClass("d-none");
      }

      circles.forEach((c, i) => {
        c.classList.remove("active", "done");
        if (i < currentStep - 1) {
          c.classList.add("done");
        }
        if (i === currentStep - 1) {
          c.classList.add("active");
        }
      });

      lines.forEach((line, i) => {
        line.classList.remove("done");
        if (i < currentStep - 1) {
          line.classList.add("done");
        }
      });
    }
  });

  function updateStepsCounter() {
    $(".current-step-number").text(currentStep);
  }

  function checkCheckbox() {
    const check = $(".checkbox");
    check.change(function () {
      let box = $(this);

      let boxWrapper = $(box).closest("[data-step]");
      boxWrapper
        .find(".checkbox")
        .not(box)
        .not(".multi-choise")
        .prop({ checked: false });

      const checkParent = boxWrapper
        .find(".checkbox")
        .not(".multi-choise")
        .parent();

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
    });
  }

  $("#calculator-form").on("submit", function (event) {
    event.preventDefault();

    const $form = $(this);

    $form.find('button[type="submit"]').prop("disabled", true);
    var old_text = $form.find('button[type="submit"]').text();
    $form.find('button[type="submit"]').text("Sending ...");
    if ($form.data("submit") == "yes") {
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

      $.post(
        "/wp-content/themes/icoda/submit-calculator.php",
        $form.serialize(),
        function (data) {
          if (data == 1) {
            window.dataLayer = window.dataLayer || [];
            dataLayer.push({ event: "form-calculator-successfuly-sent" });
            setTimeout(function () {
              $("[data-step]").addClass("d-none");
              $('[data-step="done"]').removeClass("d-none");
              $form.find('button[type="submit"]').text(old_text);
            }, 200);
          }
        }
      );
      $form.data("submit", "no");
      $form.removeClass("submitting-form");
    }
  });
});
