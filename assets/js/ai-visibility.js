document.addEventListener("DOMContentLoaded", () => {
  const forms = document.querySelectorAll(".form-check-url");

  const steps = [
    "Checking robots.txt",
    "Analyzing AI bot access",
    "Scanning structured data",
    "Evaluating content structure",
    "Generating AI visibility score",
    "Running technical checks",
    "Generating recommendations",
  ];

  const isValidUrl = (value) => {
    const pattern = /^(https?:\/\/)?([a-z0-9-]+\.)+[a-z]{2,}$/i;
    // try {
    //   const url = value.startsWith("http") ? value : "https://" + value;

    //   const parsed = new URL(url);

    //   return parsed;
    // } catch {
    //   return false;
    // }
    // console.log("isValidUrl", pattern.test(value.trim()));
    return pattern.test(value.trim());
  };

  forms.forEach((form) => {
    const input = form.querySelector(".site-url");
    const button = form.querySelector("button[type='submit']");
    const feedback = form.querySelector(".invalid-feedback");
    const step1 = document.querySelector(".analyzer-step-1");
    const step2 = document.querySelector(".analyzer-step-2");

    const container = document.querySelector(".progress-analyzing-container");
    const fill = container.querySelector(".progress-fill");
    const dotsWrapper = container.querySelector(".progress-dots");

    const stepText = container.querySelector(".progress-analyzing-step");

    if (!input || !button || !feedback) return;

    const showError = () => {
      input.classList.add("error");
      feedback.style.display = "block";
      button.disabled = true;
      button.classList.add("disabled");
    };

    const hideError = () => {
      input.classList.remove("error");
      feedback.style.display = "none";
    };

    input.addEventListener("input", () => {
      const value = input.value.trim();

      if (isValidUrl(value) || value.length > 1) {
        button.disabled = false;
        button.classList.remove("disabled");
        hideError();
      } else {
        button.disabled = true;
        button.classList.add("disabled");
      }
    });

    input.addEventListener("blur", () => {
      const value = input.value.trim();

      if (value !== "" && !isValidUrl(value)) {
        showError();
      }
    });

    form.addEventListener("submit", (e) => {
      e.preventDefault();

      const value = input.value.trim();

      if (!isValidUrl(value)) {
        e.preventDefault();
        showError();
      }

      button.disabled = true;
      container.classList.remove("d-none");
      container.classList.add("section-visible");

      updateEnteredUrl();

      let currentStep = 0;

      // create dots dynamically based on steps length
      function initDots() {
        dotsWrapper.innerHTML = "";

        steps.forEach((_, index) => {
          const dot = document.createElement("div");
          dot.classList.add("progress-dot");
          if (index === 0) {
            dot.classList.add("active");
          }
          dotsWrapper.appendChild(dot);
        });
      }
      // steps.forEach((_, index) => {
      //   const dot = document.createElement("div");
      //   dot.classList.add("progress-dot");
      //   if (index === 0) dot.classList.add("active");
      //   dotsWrapper.appendChild(dot);
      // });

      function updateProgress(stepIndex) {
        const dots = container.querySelectorAll(".progress-dot");
        const percent = (stepIndex / (steps.length - 1)) * 100;

        fill.style.width = percent + "%";
        stepText.textContent = steps[stepIndex];

        dots.forEach((dot, index) => {
          if (index <= stepIndex) {
            dot.classList.add("active");
          } else {
            dot.classList.remove("active");
          }
        });
      }

      function startProgress() {
        initDots();
        container.classList.remove("d-none");

        const interval = setInterval(() => {
          currentStep++;

          if (currentStep < steps.length) {
            updateProgress(currentStep);
          } else {
            clearInterval(interval);
            // smooth hide step1 and show step2
            step1.classList.add("section-hidden");

            setTimeout(() => {
              console.log("Done analyzing");
              step1.classList.add("d-none");

              step2.classList.remove("d-none");
              step2.classList.add("section-visible");

              // smoot scroll to step2
              step2.scrollIntoView({ behavior: "smooth" });
            }, 600);
          }
        }, 500);
      }

      // For testing purposes, you can call startProgress() directly to see the animation without submitting the form
      //   window.startFakeAnalyze = startProgress;
      startProgress();

      runAnalyzeURL();
    });
  });

  // document.addEventListener("DOMContentLoaded", () => {
  //   const input = document.querySelector(".site-url");
  //   const output = document.querySelector(".entered-url");

  //   if (input && output) {
  //     input.addEventListener("input", () => {
  //       output.textContent = input.value || "yourwebsite.com";
  //     });
  //   }
  // });

  function updateEnteredUrl() {
    const input = document.querySelector(".site-url");
    if (!input) return;

    let url = input.value.trim();

    if (!url) return;

    url = url.replace(/^https?:\/\//, "");
    url = url.replace(/^www\./, "");

    // keep only domen
    url = url.split("/")[0];

    document.querySelectorAll(".entered-url").forEach((el) => {
      el.textContent = url;
    });
  }

  const COLOR_SCALE = [
    { max: 50, color: "#F31212" }, // red
    { max: 70, color: "#FE8C3A" }, // orange
    { max: 85, color: "#F2D516" }, // yellow
    { max: 100, color: "#07BD47" }, // green
  ];

  function getColor(value) {
    return COLOR_SCALE.find((level) => value < level.max).color;
  }

  //1.score-card(overall score)
  function initGauge(gauge) {
    const value = parseInt(gauge.dataset.score);
    const color = getColor(value);

    const fill = gauge.querySelector(".gauge-fill");
    const dot = gauge.querySelector(".gauge-dot");
    const pointer = gauge.querySelector(".gauge-pointer");
    const valueEl = gauge.querySelector(".gauge-value");

    const totalLength = fill.getTotalLength();

    fill.style.stroke = color;
    fill.style.strokeDasharray = totalLength;
    fill.style.strokeDashoffset = totalLength;

    requestAnimationFrame(() => {
      fill.style.strokeDashoffset = totalLength * (1 - value / 100);
    });

    const progressLength = totalLength * (value / 100);
    const point = fill.getPointAtLength(progressLength);

    dot.setAttribute("cx", point.x);
    dot.setAttribute("cy", point.y);

    const delta = 0.01;
    const prev = fill.getPointAtLength(Math.max(progressLength - delta, 0));

    const angle = Math.atan2(point.y - prev.y, point.x - prev.x);
    const percent = Math.max(0, Math.min(100, value));
    const isEdge = percent <= 0 || percent >= 100;

    pointer.setAttribute("x", point.x);
    pointer.setAttribute("y", point.y);
    pointer.style.fill = color;
    pointer.setAttribute(
      "transform",
      `rotate(${(angle * 180) / Math.PI} ${point.x} ${point.y})`,
    );

    // arrow
    pointer.style.opacity = isEdge ? "0" : "1";

    valueEl.textContent = value;
  }

  function updateGaugesFromApi(apiData) {
    document.querySelectorAll(".gauge").forEach((gauge) => {
      const key = gauge.dataset.key;

      if (!apiData.categories[key]) return;

      const score = Math.round(apiData.categories[key].score);
      gauge.dataset.score = score;

      initGauge(gauge, score);
    });
  }

  // function lazyInit(apiData) {
  //   const observer = new IntersectionObserver(
  //     (entries) => {
  //       entries.forEach((entry) => {
  //         if (entry.isIntersecting) {
  //           updateGaugesFromApi(apiData);
  //           observer.disconnect();
  //         }
  //       });
  //     },
  //     { threshold: 0.4 },
  //   );

  //   const section = document.querySelector(".overall-score");
  //   if (section) observer.observe(section);
  // }

  // Overall AI Visibility Score
  function setProgress(value) {
    const fill = document.querySelector(".score-fill");
    const dot = document.querySelector(".score-dot");
    const label = document.querySelector(".score-value");

    if (!fill) return;

    const percent = Math.max(0, Math.min(value, 100));

    fill.style.width = percent + "%";
    label.textContent = percent;

    fill.classList.remove(
      "status-poor",
      "status-fair",
      "status-good",
      "status-excellent",
    );
    dot.classList.remove(
      "status-poor",
      "status-fair",
      "status-good",
      "status-excellent",
      "is-max",
    );

    // define color class based on percentage
    let colorClass;

    if (percent < 50) {
      colorClass = "status-poor";
    } else if (percent < 70) {
      colorClass = "status-fair";
    } else if (percent < 80) {
      colorClass = "status-good";
    } else {
      colorClass = "status-excellent";
    }

    fill.classList.add(colorClass);
    dot.classList.add(colorClass);

    if (percent === 100) {
      label.classList.add("is-max");
    }
  }

  // fetch('/api/score')
  // .then(res => res.json())
  // .then(data => {
  //   setProgress(data.score);
  // });

  //modal get-detailed-report and report requested
  function initDetailedReportModal() {
    const form = $(".form-detailed-report");
    const emailInput = $(".input-email");
    const sendBtn = $(".send-report");
    const outputEmail = $(".output-email");

    const modal1 = $("#get-detailed-report");
    const modal2 = $("#report-requested");

    if (!form.length) return;

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

    initEmailValidation(emailInput, sendBtn, emailRegex);

    initFormSubmit(form, emailInput, outputEmail, modal1);

    initModalSwitch(modal1, modal2);

    initResetOnClose(modal2, form, emailInput, sendBtn);
  }
  //validate email
  function initEmailValidation(input, button, regex) {
    input.on("input", function () {
      const email = input.val().trim();

      const valid = regex.test(email);

      button.prop("disabled", !valid);

      button.toggleClass("disabled", !valid);
    });
  }
  //submit email
  function initFormSubmit(form, input, outputEmail, modal1) {
    form.on("submit", function (e) {
      e.preventDefault();
      const email = input.val().trim();
      outputEmail.text(email);
      modal1.modal("hide");
    });
  }
  // open modal report-requested
  function initModalSwitch(modal1, modal2) {
    modal1.on("hidden.bs.modal", function () {
      modal2.modal("show");
    });
  }

  function initResetOnClose(modal2, form, input, button) {
    modal2.on("hidden.bs.modal", function () {
      form[0].reset();
      input.val("");
      button.prop("disabled", true);
      button.addClass("disabled");
    });
  }

  // add/remove active for btn (share,download with ountline bg)
  document.querySelectorAll(".btn-report").forEach((btn) => {
    btn.addEventListener("click", function () {
      document
        .querySelectorAll(".btn-report")
        .forEach((b) => b.classList.remove("active"));
      this.classList.add("active");
    });
    document.addEventListener("click", function (e) {
      if (!btn.contains(e.target)) {
        btn.classList.remove("active");
      }
    });
    btn.addEventListener("blur", function () {
      this.classList.remove("active");
    });
  });

  initDetailedReportModal();
  initShareSticky();

  //share-sticky
  function initShareSticky() {
    const sticky = document.getElementById("shareSticky");
    const shareBtn = document.querySelector(".btn-share");
    const copyBtn = sticky.querySelector(".btn-copy");
    const input = sticky.querySelector(".share-link");

    function setShareUrl() {
      input.value = window.location.href;
    }

    function toggleShareSticky() {
      setShareUrl();
      sticky.classList.toggle("active");
    }

    function closeShareSticky() {
      sticky.classList.remove("active");
    }

    function copyShareLink() {
      navigator.clipboard.writeText(input.value);

      closeShareSticky();
    }

    function handleOutsideClick(e) {
      if (!sticky.contains(e.target) && !shareBtn.contains(e.target)) {
        closeShareSticky();
      }
    }

    shareBtn.addEventListener("click", function (e) {
      e.stopPropagation();
      toggleShareSticky();
    });

    copyBtn.addEventListener("click", copyShareLink);

    document.addEventListener("click", handleOutsideClick);
  }

  //analyze another url
  function resetAnalyze() {
    const step1 = document.querySelector(".analyzer-step-1");
    const step2 = document.querySelector(".analyzer-step-2");

    const container = document.querySelector(".progress-analyzing-container");
    const fill = container.querySelector(".progress-fill");
    const dots = container.querySelectorAll(".progress-dot");

    const input = document.querySelector(".site-url");
    const button = document.querySelector(".form-check-url button");

    // section return
    step2.classList.remove("section-visible");
    step2.classList.add("d-none");

    step1.classList.remove("d-none");
    step1.classList.remove("section-hidden");

    // smoot scroll to step1
    step1.scrollIntoView({ behavior: "smooth" });

    // reset progress
    fill.style.width = "0%";

    dots.forEach((dot) => {
      dot.classList.remove("active");
    });

    if (dots[0]) {
      dots[0].classList.add("active");
    }
    // reset step
    currentStep = 0;
    // reset current step text
    document.querySelector(".progress-analyzing-step").textContent =
      "Checking robots.txt";

    // hide progress
    container.classList.add("d-none");
    container.classList.remove("section-hidden");

    // clear input site url
    input.value = "";

    // disabled btn analyze
    button.disabled = true;
    button.classList.add("disabled");
  }

  document
    .querySelector(".btn-analyze")
    .addEventListener("click", resetAnalyze);

  const API_URL = "https://tools.icoda.io";
  let currentData = null,
    currentShareId = null,
    allRecs = [];

  async function runAnalyzeURL() {
    const url = document.getElementById("urlInput").value.trim();
    if (!url) return alert("Please enter a URL");
    // showLoading();
    try {
      const res = await fetch(`${API_URL}/analyze`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          url,
        }),
      });
      if (!res.ok) throw new Error(`Error: ${res.status}`);
      currentData = await res.json();
      console.log(currentData);
      renderResults(currentData);
    } catch (err) {
      showError(err.message);
    }
  }

  function renderResults(data) {
    //1.score-card(overall score)
    updateGaugesFromApi(data);
    // lazyInit(data);

    //2.Overall AI Visibility Score
    setProgress(data.overall_score);

    //3.Key insights
    const icons = {
      good: `<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M3 17.9989C3 9.7204 9.72 2.9989 18 2.9989C26.295 2.9989 33 9.7204 33 17.9989C33 26.2804 26.295 32.9989 18 32.9989C9.72 32.9989 3 26.2804 3 17.9989ZM17.1451 22.4847L24.2701 15.3597C24.7801 14.8497 24.7801 14.0247 24.2701 13.4997C23.7601 12.9897 22.9201 12.9897 22.4101 13.4997L16.2151 19.6947L13.5901 17.0697C13.0801 16.5597 12.2401 16.5597 11.7301 17.0697C11.2201 17.5797 11.2201 18.4047 11.7301 18.9297L15.3001 22.4847C15.5551 22.7397 15.8851 22.8597 16.2151 22.8597C16.5601 22.8597 16.8901 22.7397 17.1451 22.4847Z" fill="#07BD47"/>
              </svg>`,
      warning: `<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3 17.9989C3 9.7204 9.72 2.9989 18 2.9989C26.295 2.9989 33 9.7204 33 17.9989C33 26.2804 26.295 32.9989 18 32.9989C9.72 32.9989 3 26.2804 3 17.9989ZM16.6801 12.3138C16.6801 11.5953 17.2801 10.9938 18.0001 10.9938C18.7201 10.9938 19.3051 11.5953 19.3051 12.3138V18.9438C19.3051 19.6653 18.7201 20.2488 18.0001 20.2488C17.2801 20.2488 16.6801 19.6653 16.6801 18.9438V12.3138ZM18.015 25.0203C17.28 25.0203 16.695 24.4203 16.695 23.7003C16.695 22.9803 17.28 22.3953 18 22.3953C18.735 22.3953 19.32 22.9803 19.32 23.7003C19.32 24.4203 18.735 25.0203 18.015 25.0203Z" fill="#F2D516"/>
                        </svg>`,
      bad: `<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3 17.9989C3 9.7204 9.72 2.9989 18 2.9989C26.295 2.9989 33 9.7204 33 17.9989C33 26.2804 26.295 32.9989 18 32.9989C9.72 32.9989 3 26.2804 3 17.9989ZM21.3789 21.4075C21.8096 20.9725 21.8096 20.2675 21.3789 19.8325L19.5671 18.0025L21.3789 16.1725C21.8096 15.7375 21.8096 15.0325 21.3789 14.5975C20.9482 14.1475 20.2354 14.1475 19.8047 14.5975L17.9928 16.4275L16.1809 14.5975C15.7502 14.1475 15.0522 14.1475 14.6215 14.5975C14.1908 15.0325 14.1908 15.7375 14.6215 16.1725L16.4334 18.0025L14.6215 19.8325C14.1908 20.2675 14.1908 20.9725 14.6215 21.4075C14.8294 21.6325 15.1116 21.7375 15.3938 21.7375C15.676 21.7375 15.973 21.6325 16.1809 21.4075L17.9928 19.5775L19.8047 21.4075C20.0274 21.6325 20.3096 21.7375 20.5918 21.7375C20.874 21.7375 21.1562 21.6325 21.3789 21.4075Z" fill="#F31212"/>
                        </svg>`,
    };
    const insights = [
      {
        icon: data.categories.ai_access.score >= 70 ? "good" : "warning",
        desc:
          data.categories.ai_access.score >= 90
            ? "Well configured"
            : "Minor restrictions",
      },
      {
        icon: data.categories.structured_data.score >= 70 ? "good" : "warning",
        desc:
          data.categories.structured_data.score >= 70
            ? "Schema markup detected"
            : "Missing schema markup",
      },
      {
        icon: data.categories.technical.score >= 70 ? "good" : "warning",
        desc:
          data.categories.technical.score >= 70
            ? "Strong foundation"
            : "Improvements needed",
      },
    ];

    jQuery('[data-map="insights-ai-access"]')
      .find(".icon")
      .empty()
      .append(icons[insights[0].icon]);
    jQuery('[data-map="insights-ai-access"]')
      .find(".content p")
      .text(insights[0].desc);
    jQuery('[data-map="insights-structured-data"]')
      .find(".icon")
      .empty()
      .append(icons[insights[1].icon]);
    jQuery('[data-map="insights-structured-data"]')
      .find(".content p")
      .text(insights[1].desc);
    jQuery('[data-map="insights-technic"]')
      .find(".icon")
      .empty()
      .append(icons[insights[2].icon]);
    jQuery('[data-map="insights-technic"]')
      .find(".content p")
      .text(insights[2].desc);

    jQuery('[data-map="cat-breakdown-ai-access"]')
      .find(".percent")
      .text(`${data.categories.ai_access.score}%`);
    jQuery('[data-map="cat-breakdown-content-structure"]')
      .find(".percent")
      .text(`${data.categories.content_structure.score}%`);
    jQuery('[data-map="cat-breakdown-structured-data"]')
      .find(".percent")
      .text(`${data.categories.structured_data.score}%`);
    jQuery('[data-map="cat-breakdown-technical"]')
      .find(".percent")
      .text(`${data.categories.technical.score}%`);

    jQuery('[data-map="bot-access-gpt"]')
      .find(".badge-status")
      .text(data.ai_access.bots[0].status);
    jQuery('[data-map="bot-access-gpt"]')
      .find(".score span")
      .text(data.ai_access.bots[0].access_score);
    jQuery('[data-map="bot-access-claude"]')
      .find(".badge-status")
      .text(data.ai_access.bots[1].status);
    jQuery('[data-map="bot-access-claude"]')
      .find(".score span")
      .text(data.ai_access.bots[1].access_score);
    jQuery('[data-map="bot-access-perplexity"]')
      .find(".badge-status")
      .text(data.ai_access.bots[2].status);
    jQuery('[data-map="bot-access-perplexity"]')
      .find(".score span")
      .text(data.ai_access.bots[2].access_score);
    jQuery('[data-map="bot-access-google"]')
      .find(".badge-status")
      .text(data.ai_access.bots[3].status);
    jQuery('[data-map="bot-access-google"]')
      .find(".score span")
      .text(data.ai_access.bots[3].access_score);
    jQuery(
      '[data-map="bot-access-gpt"], [data-map="bot-access-claude"], [data-map="bot-access-perplexity"], [data-map="bot-access-google"]',
    )
      .find(".badge-status")
      .removeClass(
        "badge-status_fair badge-status_poor badge-status_excellent",
      );
    jQuery(
      '[data-map="bot-access-gpt"], [data-map="bot-access-claude"], [data-map="bot-access-perplexity"], [data-map="bot-access-google"]',
    )
      .find(".result")
      .removeClass("status-fair status-poor status-excellent");
    let resultGptClass = "excellent";
    if (data.ai_access.bots[0].access_score < 60) {
      resultGptClass = "fair";
    } else if (
      data.ai_access.bots[0].access_score >= 60 &&
      data.ai_access.bots[0].access_score < 90
    ) {
      resultGptClass = "poor";
    }
    jQuery('[data-map="bot-access-gpt"]')
      .find(".result")
      .addClass(`status-${resultGptClass}`);
    jQuery('[data-map="bot-access-gpt"]')
      .find(".badge-status")
      .addClass(`badge-status_${resultGptClass}`);
    let resultClaudeClass = "excellent";
    if (data.ai_access.bots[1].access_score < 60) {
      resultClaudeClass = "fair";
    } else if (
      data.ai_access.bots[1].access_score >= 60 &&
      data.ai_access.bots[1].access_score < 90
    ) {
      resultClaudeClass = "poor";
    }
    jQuery('[data-map="bot-access-claude"]')
      .find(".result")
      .addClass(`status-${resultClaudeClass}`);
    jQuery('[data-map="bot-access-claude"]')
      .find(".badge-status")
      .addClass(`badge-status_${resultClaudeClass}`);
    let resultPerplexityClass = "excellent";
    if (data.ai_access.bots[2].access_score < 60) {
      resultPerplexityClass = "fair";
    } else if (
      data.ai_access.bots[2].access_score >= 60 &&
      data.ai_access.bots[2].access_score < 90
    ) {
      resultPerplexityClass = "poor";
    }
    jQuery('[data-map="bot-access-perplexity"]')
      .find(".result")
      .addClass(`status-${resultPerplexityClass}`);
    jQuery('[data-map="bot-access-perplexity"]')
      .find(".badge-status")
      .addClass(`badge-status_${resultPerplexityClass}`);
    let resultGoogleClass = "excellent";
    if (data.ai_access.bots[3].access_score < 60) {
      resultGoogleClass = "fair";
    } else if (
      data.ai_access.bots[3].access_score >= 60 &&
      data.ai_access.bots[3].access_score < 90
    ) {
      resultGoogleClass = "poor";
    }
    jQuery('[data-map="bot-access-google"]')
      .find(".result")
      .addClass(`status-${resultGoogleClass}`);
    jQuery('[data-map="bot-access-google"]')
      .find(".badge-status")
      .addClass(`badge-status_${resultGoogleClass}`);

    if (data.technical_checklist) {
      jQuery(".technical-box-wrapper").empty();
      data.technical_checklist.forEach(function (element) {
        jQuery(".technical-box-wrapper")
          .append(`<div class="technical-box surface p-3 d-flex justify-content-between align-items-center">
                <p class="text-muted">${element.item}</p>
                <p class="technical-status">${element.value}</p>
            </div>`);
      });
    }

    if (data.structured_data.schemas_found.length) {
      jQuery(".structured-data-wrapper").find(".found-data-list").empty();
      data.structured_data.schemas_found.forEach(function (element) {
        jQuery(".structured-data-wrapper")
          .find(".found-data-list")
          .append(
            `<li class="badge-status badge-status_primary">${element.type}</li>`,
          );
      });
    } else {
      jQuery(".structured-data-wrapper").find(".found-data-list").remove();
      jQuery(
        `<p class="text-muted surface p-3">No structured data found</p>`,
      ).insertBefore(
        jQuery(".structured-data-wrapper").find(".structured-data-recommended"),
      );
    }
    if (data.structured_data.recommended_missing.length) {
      jQuery(".structured-data-wrapper")
        .find(".structured-data-recommended .structured-data-list")
        .empty();
      data.structured_data.recommended_missing.forEach(function (element) {
        jQuery(".structured-data-wrapper")
          .find(".structured-data-recommended .structured-data-list")
          .append(`<li class="badge-status badge-status_fair">${element}</li>`);
      });
    } else {
      jQuery(".structured-data-wrapper")
        .find(".structured-data-recommended")
        .remove();
    }

    if (!data.content_gaps.length) {
      jQuery(".report-gaps").hide();
    } else {
      jQuery(".report-gaps").show();
      jQuery(".report-gaps").find(".report-card").remove();
      data.content_gaps.forEach(function (element) {
        let impactClass = "excellent";
        if (element.impact === "high") {
          impactClass = "poor";
        } else if (element.impact === "medium") {
          impactClass = "fair";
        }
        jQuery(`
          <div class="report-card surface p-3 d-flex flex-column status-${impactClass}">
                    <div class="report-card-header d-flex flex-lg-row flex-column-reverse justify-content-lg-between align-items-lg-center">
                        <h3 class="title">${element.title}</h3>
                        <div>
                            <span class="badge-status">${element.impact}</span>
                        </div>
                    </div>
                    <div class="text-muted">
                        ${element.description}
                    </div>
                    <div class="text-default mb-0">
                        ${element.action}
                    </div>

                </div>
          `).insertBefore(jQuery(".report-gaps").find(".content-gaps-btn"));
      });
    }

    if (!data.recommendations.length) {
      jQuery('[data-map="recommendations"]').replaceWith(
        `
          <div class="report-box-wrapper">
              <div class="report-box report-recommendation">
                  <h2 class="title mb-lg-4 mb-2 has-border">
                      Recommendations
                  </h2>
                  <div class="report-recommendation-wrapper d-flex flex-column">
                      <div class="report-card surface p-3 d-flex flex-column status-primary">
                          <div class="report-card-header d-flex flex-lg-row flex-column-reverse justify-content-lg-between align-items-lg-center">
                              <h3 class="title">Great Job!</h3>
                          </div>
                          <div class="text-muted">
                              <div>No specific recommendations at this time. Your site is performing well!</div>
                          </div>
                          
                      </div>
                  </div>
              </div>
          </div>
        `,
      );
    } else {
      jQuery(".nav-tabs").empty();
      const highRecomends = data.recommendations.filter(
        (r) => r.priority === "high",
      );
      const mediumRecomends = data.recommendations.filter(
        (r) => r.priority === "medium",
      );
      const lowRecomends = data.recommendations.filter(
        (r) => r.priority === "low",
      );
      let tabIndex = 0;
      jQuery(".nav-tabs").append(`
          <button class="nav-link badge-status badge-status_primary active" id="nav-${tabIndex}-tab" data-toggle="tab" data-target="#nav-${tabIndex}" type="button" role="tab" aria-controls="nav-${tabIndex}" aria-selected="true">
              ${data.recommendations.length} ALL
          </button>
        `);
      tabIndex++;
      if (highRecomends.length) {
        jQuery(".nav-tabs").append(`
            <button class="nav-link badge-status badge-status_primary" id="nav-${tabIndex}-tab" data-toggle="tab" data-target="#nav-${tabIndex}" type="button" role="tab" aria-controls="nav-${tabIndex}" aria-selected="true">
                ${highRecomends.length} High Impact
            </button>
          `);
        tabIndex++;
      }
      if (mediumRecomends.length) {
        jQuery(".nav-tabs").append(`
            <button class="nav-link badge-status badge-status_primary" id="nav-${tabIndex}-tab" data-toggle="tab" data-target="#nav-${tabIndex}" type="button" role="tab" aria-controls="nav-${tabIndex}" aria-selected="true">
                ${mediumRecomends.length} Medium Impact
            </button>
          `);
        tabIndex++;
      }
      if (lowRecomends.length) {
        jQuery(".nav-tabs").append(`
            <button class="nav-link badge-status badge-status_primary" id="nav-${tabIndex}-tab" data-toggle="tab" data-target="#nav-${tabIndex}" type="button" role="tab" aria-controls="nav-${tabIndex}" aria-selected="true">
                ${lowRecomends.length} Quick Wins
            </button>
          `);
        tabIndex++;
      }

      tabIndex = 0;
      jQuery("#nav-tabContent").empty();
      jQuery("#nav-tabContent").append(`
        <div class="tab-pane fade show active all-recommendations"
                    id="nav-${tabIndex}"
                    role="tabpanel"
                    aria-labelledby="nav-${tabIndex}-tab">
                    <div class="report-recommendation-wrapper d-flex flex-column">
                    </div>
                </div>
        `);
      data.recommendations.forEach(function (element) {
        jQuery(".all-recommendations").append(generateRecommendCard(element));
      });
      tabIndex++;
      if (highRecomends.length) {
        jQuery("#nav-tabContent").append(`
        <div class="tab-pane fade high-recommendations"
                    id="nav-${tabIndex}"
                    role="tabpanel"
                    aria-labelledby="nav-${tabIndex}-tab">
                    <div class="report-recommendation-wrapper d-flex flex-column">
                    </div>
                </div>
        `);
        highRecomends.forEach(function (element) {
          jQuery(".high-recommendations").append(
            generateRecommendCard(element),
          );
        });
        tabIndex++;
      }
      if (mediumRecomends.length) {
        jQuery("#nav-tabContent").append(`
        <div class="tab-pane fade medium-recommendations"
                    id="nav-${tabIndex}"
                    role="tabpanel"
                    aria-labelledby="nav-${tabIndex}-tab">
                    <div class="report-recommendation-wrapper d-flex flex-column">
                    </div>
                </div>
        `);
        mediumRecomends.forEach(function (element) {
          jQuery(".medium-recommendations").append(
            generateRecommendCard(element),
          );
        });
        tabIndex++;
      }
      if (lowRecomends.length) {
        jQuery("#nav-tabContent").append(`
        <div class="tab-pane fade low-recommendations"
                    id="nav-${tabIndex}"
                    role="tabpanel"
                    aria-labelledby="nav-${tabIndex}-tab">
                    <div class="report-recommendation-wrapper d-flex flex-column">
                    </div>
                </div>
        `);
        lowRecomends.forEach(function (element) {
          jQuery(".low-recommendations").append(generateRecommendCard(element));
        });
        tabIndex++;
      }
    }

    // hideLoading();
    // document.getElementById('heroSection').classList.add('hidden');
    // document.getElementById('resultsSection').classList.add('show');
    // const domain = new URL(data.analyzed_url).hostname;
    // document.getElementById('resultDomain').textContent = domain;
    // document.getElementById('analyzedUrl').textContent = data.analyzed_url;
    // setScore('overallScore', data.overall_score);
    // setScore('aiAccessScore', data.categories.ai_access.score);
    // setScore('contentScore', data.categories.content_structure.score);
    // setScore('technicalScore', data.categories.technical.score);
    // const mainCard = document.getElementById('mainScoreCard');
    // mainCard.className = 'score-card main' + (data.overall_score < 65 ? ' medium' : '') + (data.overall_score < 45 ? ' poor' : '');
    // renderInsights(data);
    // renderBreakdown(data);
    // renderBotAccess(data.ai_access);
    // renderChecklist(data.technical_checklist || []);
    // renderStructuredData(data.structured_data);
    // renderContentGaps(data.content_gaps || []);
    // renderRecommendations(data.recommendations || []);
  }

  function generateRecommendCard(element) {
    let impactClass = "excellent";
    if (element.priority === "high") {
      impactClass = "poor";
    } else if (element.priority === "medium") {
      impactClass = "fair";
    }
    return `
    <div class="report-card surface p-3 d-flex flex-column status-${impactClass}">
            <div class="report-card-header d-flex flex-lg-row flex-column-reverse justify-content-lg-between align-items-lg-center">
                <h3 class="title">${element.title}</h3>
                <div>
                    <span class="badge-status">${element.difficulty}</span>
                </div>
            </div>
            <div class="text-muted">
                <div>
                    ID
                    <span>${element.category}</span>
                </div>
                <div>
                    ${element.description}
                </div>
            </div>

            <div class="recommendation-info d-flex align-items-lg-center flex-column flex-lg-row">
                <div class="slot-info ci ci-clock">
                    <span>${element.time_estimate}</span>
                </div>
                <div class="slot-info ci ci-roi">
                    <span>ROI:</span>
                    <span>${element.roi_score}/10</span>
                </div>
                <div class="slot-info ci ci-impact">
                    <span>Impact:</span>
                    <span>${element.impact}/20</span>
                </div>

            </div>

        </div>
    `;
  }

  function setScore(id, score) {
    const el = document.getElementById(id);
    el.textContent = score;
    el.className =
      "score-value " + (score >= 80 ? "green" : score >= 65 ? "yellow" : "red");
  }

  function renderInsights(data) {
    const insights = [
      {
        icon: data.categories.ai_access.score >= 70 ? "good" : "warning",
        title: "AI Access Control",
        desc:
          data.categories.ai_access.score >= 90
            ? "Well configured"
            : "Minor restrictions",
      },
      {
        icon: data.categories.structured_data.score >= 70 ? "good" : "warning",
        title: "Structured Data",
        desc:
          data.categories.structured_data.score >= 70
            ? "Schema markup detected"
            : "Missing schema markup",
      },
      {
        icon: data.categories.technical.score >= 70 ? "good" : "warning",
        title: "Technical",
        desc:
          data.categories.technical.score >= 70
            ? "Strong foundation"
            : "Improvements needed",
      },
    ];
    document.getElementById("insightsGrid").innerHTML = insights
      .map(
        (i) =>
          `<div class="insight-item"><div class="insight-icon ${i.icon}">${i.icon === "good" ? "✓" : "!"}</div><div class="insight-text"><h4>${i.title}</h4><p>${i.desc}</p></div></div>`,
      )
      .join("");
  }

  function renderBreakdown(data) {
    const cats = [
      {
        name: "AI Access Control",
        score: data.categories.ai_access.score,
      },
      {
        name: "Content Structure",
        score: data.categories.content_structure.score,
      },
      {
        name: "Structured Data",
        score: data.categories.structured_data.score,
      },
      {
        name: "Technical",
        score: data.categories.technical.score,
      },
    ];
    document.getElementById("breakdownList").innerHTML = cats
      .map(
        (c) =>
          `<li class="breakdown-item"><span class="breakdown-name">${c.name}</span><span class="breakdown-score" style="color:${getColor(c.score)}">${c.score}/100</span></li>`,
      )
      .join("");
  }

  function renderBotAccess(ai) {
    document.getElementById("botTableBody").innerHTML = ai.bots
      .slice(0, 4)
      .map(
        (b) =>
          `<tr><td><div class="bot-name">${b.bot_name}</div><div class="bot-desc">${b.description}</div></td><td><span class="status-badge ${b.status}">${b.status}</span></td><td style="font-weight:700;color:${getColor(b.access_score)}">${b.access_score}/100</td></tr>`,
      )
      .join("");
  }

  function renderChecklist(list) {
    if (!list.length)
      list = [
        {
          item: "HTTPS",
          status: "pass",
          value: "Yes",
        },
        {
          item: "Sitemap",
          status: "pass",
          value: "Found",
        },
        {
          item: "llms.txt",
          status: "info",
          value: "Not found",
        },
      ];
    document.getElementById("checklistItems").innerHTML = list
      .map(
        (c) =>
          `<li class="checklist-item"><div class="checklist-left"><div class="check-icon ${c.status}">${c.status === "pass" ? "✓" : c.status === "fail" ? "✗" : "i"}</div><span>${c.item}</span></div><span class="checklist-value">${c.value}</span></li>`,
      )
      .join("");
  }

  function renderStructuredData(sd) {
    document.getElementById("schemaTags").innerHTML = (sd.schemas_found || [])
      .length
      ? sd.schemas_found
          .map((s) => `<span class="schema-tag">${s.type}</span>`)
          .join("")
      : '<span style="color:var(--grey)">No structured data</span>';
    document.getElementById("schemaMissing").innerHTML = (
      sd.recommended_missing || []
    ).length
      ? '<span style="font-size:13px;color:var(--grey);margin-right:8px">Recommended:</span>' +
        sd.recommended_missing
          .map((m) => `<span class="schema-missing-tag">+ ${m}</span>`)
          .join("")
      : "";
  }

  function renderContentGaps(gaps) {
    const card = document.getElementById("contentGapsCard");
    if (!gaps.length) {
      card.classList.add("hidden");
      return;
    }
    card.classList.remove("hidden");
    document.getElementById("contentGaps").innerHTML = gaps
      .map(
        (g) =>
          `<div class="gap-item"><div class="gap-header"><span class="gap-title">${g.title}</span><span class="gap-impact ${g.impact}">${g.impact}</span></div><div class="gap-desc">${g.description}</div><div class="gap-action">→ ${g.action}</div></div>`,
      )
      .join("");
  }

  function renderRecommendations(recs) {
    allRecs = recs;
    document.getElementById("recHighCount").textContent = recs.filter(
      (r) => r.priority === "high",
    ).length;
    document.getElementById("recQuickCount").textContent = recs.filter(
      (r) => r.difficulty === "easy",
    ).length;
    document.getElementById("recTotalCount").textContent = recs.length;
    renderRecList(recs);
  }

  function renderRecList(recs) {
    if (!recs.length) {
      document.getElementById("recList").innerHTML =
        '<div style="text-align:center;padding:40px;color:var(--grey)"><div style="font-size:48px">🎉</div><h3 style="color:var(--dark)">Great Job!</h3><p>No recommendations needed.</p></div>';
      return;
    }
    document.getElementById("recList").innerHTML = recs
      .map(
        (r) =>
          `<div class="rec-item"><div class="rec-item-header"><span class="rec-item-title">${r.title}</span><div class="rec-item-tags"><span class="rec-tag ${r.priority}">${r.priority}</span>${r.difficulty === "easy" ? '<span class="rec-tag easy">Quick</span>' : ""}</div></div><div class="rec-item-desc">${r.description}</div><div class="rec-item-meta"><span>⏱ ${r.time_estimate}</span><span>📈 Impact: ${r.impact}/20</span><span>💰 ROI: ${r.roi_score}/10</span></div></div>`,
      )
      .join("");
  }

  function filterRecs(type, btn) {
    document
      .querySelectorAll(".rec-filter")
      .forEach((b) => b.classList.remove("active"));
    btn.classList.add("active");
    renderRecList(
      type === "all"
        ? allRecs
        : type === "high"
          ? allRecs.filter((r) => r.priority === "high")
          : allRecs.filter((r) => r.difficulty === "easy"),
    );
  }

  async function shareReport() {
    if (!currentData) return;
    try {
      const res = await fetch(`${API_URL}/share`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          url: currentData.url,
          report_data: currentData,
        }),
      });
      const data = await res.json();
      currentShareId = data.id;
      document.getElementById("shareLink").value =
        `${location.origin}${location.pathname}?report=${data.id}`;
      document.getElementById("shareResult").classList.remove("hidden");
    } catch (err) {
      alert("Failed: " + err.message);
    }
  }

  function copyShareLink() {
    document.getElementById("shareLink").select();
    document.execCommand("copy");
    alert("Copied!");
  }

  function openEmailModal() {
    document.getElementById("emailModal").classList.remove("hidden");
  }

  function closeModal(id, e) {
    if (e && e.target !== e.currentTarget) return;
    document.getElementById(id).classList.add("hidden");
  }

  async function submitEmail() {
    const email = document.getElementById("emailInput").value.trim();
    if (!email || !email.includes("@")) return alert("Enter valid email");
    const btn = document.getElementById("emailSubmitBtn");
    btn.disabled = true;
    btn.textContent = "Sending...";
    try {
      await fetch(`${API_URL}/email-report`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          email,
          url: currentData?.url,
          report_id: currentShareId,
        }),
      });
      document.getElementById("confirmedEmail").textContent = email;
      document.getElementById("emailModal").classList.add("hidden");
      document.getElementById("emailSuccessModal").classList.remove("hidden");
      document.getElementById("emailInput").value = "";
    } catch (err) {
      alert("Failed");
    } finally {
      btn.disabled = false;
      btn.textContent = "Send Report";
    }
  }

  async function loadSharedReport() {
    const id = new URLSearchParams(location.search).get("report");
    if (!id) return;
    showLoading();
    document.getElementById("heroSection").classList.add("hidden");
    try {
      const res = await fetch(`${API_URL}/report/${id}`);
      if (!res.ok) throw new Error("Not found or expired");
      const data = await res.json();
      currentData = data.report;
      currentShareId = id;
      renderResults(data.report);
      const d = new Date(data.shared_at).toLocaleDateString("en-US", {
        month: "long",
        day: "numeric",
        year: "numeric",
        hour: "2-digit",
        minute: "2-digit",
      });
      const days = Math.ceil(
        (new Date(data.expires_at) - new Date()) / 86400000,
      );
      document.getElementById("sharedBannerText").textContent =
        `Shared ${d} • Expires in ${days} days • ${data.view_count} views`;
      document.getElementById("sharedBanner").classList.remove("hidden");
    } catch (err) {
      showError(err.message);
    }
  }

  let loadingInterval = null;
  let currentStage = 0;

  function showLoading() {
    document.getElementById("loadingSection").classList.remove("hidden");
    document.getElementById("errorSection").classList.add("hidden");
    document.getElementById("resultsSection").classList.remove("show");

    // Reset stages
    currentStage = 0;
    document.querySelectorAll(".stage").forEach((s) => {
      s.classList.remove("active", "done");
      s.querySelector(".stage-icon").textContent = "○";
    });

    // Start stage animation
    updateStage();
    loadingInterval = setInterval(() => {
      if (currentStage < 5) {
        document
          .querySelector(`.stage[data-stage="${currentStage}"]`)
          .classList.remove("active");
        document
          .querySelector(`.stage[data-stage="${currentStage}"]`)
          .classList.add("done");
        document.querySelector(
          `.stage[data-stage="${currentStage}"] .stage-icon`,
        ).textContent = "";
        currentStage++;
        updateStage();
      }
    }, 600);
  }

  function updateStage() {
    const stage = document.querySelector(
      `.stage[data-stage="${currentStage}"]`,
    );
    if (stage) {
      stage.classList.add("active");
      stage.querySelector(".stage-icon").textContent = "●";
    }
  }

  function hideLoading() {
    document.getElementById("loadingSection").classList.add("hidden");
    if (loadingInterval) {
      clearInterval(loadingInterval);
      loadingInterval = null;
    }
  }

  function showError(msg) {
    hideLoading();
    const el = document.getElementById("errorSection");
    el.textContent = msg + " (API: " + API_URL + ")";
    el.classList.remove("hidden");
  }

  function resetToHome() {
    history.pushState({}, "", location.pathname);
    document.getElementById("heroSection").classList.remove("hidden");
    document.getElementById("resultsSection").classList.remove("show");
    document.getElementById("sharedBanner").classList.add("hidden");
    document.getElementById("shareResult").classList.add("hidden");
    document.getElementById("errorSection").classList.add("hidden");
    currentData = currentShareId = null;
  }

  function toggleCard(id) {
    const el = document.getElementById(id);
    el.style.display = el.style.display === "none" ? "block" : "none";
  }

  function getColor(s) {
    return s >= 80 ? "var(--green)" : s >= 65 ? "var(--yellow)" : "var(--red)";
  }

  jQuery("section-analyzer__form").on("submit", function (e) {
    e.preventDefault();
    analyze();
  });
  loadSharedReport();
});

// Category Breakdown
const API_DATA = {
  aiAccess: 20,
  content: 100,
  structured: 60,
  technical: 80,
};

/*
fetch('/api/endpoint')
  .then(res => res.json())
  .then(data => initCharts(data));
*/

initCharts(API_DATA);

function initCharts(data) {
  const cards = document.querySelectorAll(".category-card");

  cards.forEach((card) => {
    const key = card.dataset.key;
    const value = data[key];

    const progressCircle = card.querySelector(".progress");
    const percentText = card.querySelector(".percent");
    const marker = card.querySelector(".marker");

    const totalLength = progressCircle.getTotalLength();

    // progress
    progressCircle.style.strokeDasharray = totalLength;
    progressCircle.style.strokeDashoffset = totalLength * (1 - value / 100);

    progressCircle.style.stroke = getColor(value);

    percentText.textContent = `${value}%`;

    // position marker
    const point = progressCircle.getPointAtLength(totalLength * (value / 100));

    marker.setAttribute("cx", point.x);
    marker.setAttribute("cy", point.y);
  });
}
