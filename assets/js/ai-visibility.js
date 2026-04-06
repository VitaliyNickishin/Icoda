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
    const pattern = /^(https?:\/\/)?([a-z0-9-]+\.)+[a-z]{2,}(\/.*)?$/i;

    return pattern.test(value.trim());
  };

  forms.forEach((form) => {
    const input = form.querySelector(".site-url");
    const button = form.querySelector("button[type='submit']");
    const feedback = form.querySelector(".invalid-feedback");
    const container = document.querySelector(".progress-analyzing-container");

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

      runAnalyzeURL();
    });
  });

  function updateEnteredUrl() {
    const input = document.querySelector(".site-url");
    if (!input) return;

    let url = input.value.trim();

    if (!url) return;

    url = url.replace(/^https?:\/\//, "");
    url = url.replace(/^www\./, "");

    // keep only domen
    // url = url.split("/")[0];

    document.querySelectorAll(".entered-url").forEach((el) => {
      el.textContent = url;
    });
  }

  let currentStepAnalyze = 0,
    progressInterval = null;

  function startProgress() {
    const container = document.querySelector(".progress-analyzing-container");

    resetProgress();

    container.classList.remove("d-none");

    progressInterval = setInterval(() => {
      currentStepAnalyze++;

      if (currentStepAnalyze < steps.length) {
        updateProgress(currentStepAnalyze);
      } else {
        clearInterval(progressInterval);

        setTimeout(() => {
          console.log("Done analyzing");

          isProgressFinished = true;
          tryShowResults();
        }, 600);
      }
    }, 500);
  }

  function resetProgress() {
    initDots();
    const container = document.querySelector(".progress-analyzing-container");
    const fill = container.querySelector(".progress-fill");
    const stepText = container.querySelector(".progress-analyzing-step");
    const dots = container.querySelectorAll(".progress-dot");

    // stop the interval if it's still running
    if (progressInterval) {
      clearInterval(progressInterval);
      progressInterval = null;
    }

    currentStepAnalyze = 0;

    // reset progres bar
    if (fill) fill.style.width = "0%";

    // reset text
    // if (stepText) stepText.textContent = "Checking robots.txt";
    if (stepText) stepText.textContent = steps[0];

    // reset dots
    dots.forEach((dot, index) => {
      dot.classList.remove("active");

      if (index === 0) {
        dot.classList.add("active");
      }
    });
  }

  function updateProgress(stepIndex) {
    const container = document.querySelector(".progress-analyzing-container");
    const dots = container.querySelectorAll(".progress-dot");
    const percent = (stepIndex / (steps.length - 1)) * 100;
    const fill = container.querySelector(".progress-fill");
    const stepText = container.querySelector(".progress-analyzing-step");

    if (!steps[stepIndex]) return;

    if (fill) fill.style.width = percent + "%";
    if (stepText) stepText.textContent = steps[stepIndex];

    // dots.forEach((dot, index) => {
    //   if (index <= stepIndex) {
    //     dot.classList.add("active");
    //   } else {
    //     dot.classList.remove("active");
    //   }
    // });

    dots.forEach((dot, index) => {
      dot.classList.toggle("active", index <= stepIndex);
    });
  }

  // create dots dynamically based on steps length
  function initDots() {
    const container = document.querySelector(".progress-analyzing-container");
    const dotsWrapper = container.querySelector(".progress-dots");
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

  function tryShowResults() {
    const step1 = document.querySelector(".analyzer-step-1");
    const step2 = document.querySelector(".analyzer-step-2");

    if (!isRequestFinished || !isProgressFinished) return;

    // show step2
    step1.classList.add("section-hidden");

    setTimeout(() => {
      step1.classList.add("d-none");

      step2.classList.remove("d-none");
      step2.classList.add("section-visible");

      step2.scrollIntoView({ behavior: "smooth" });

      renderResults(currentData);
    }, 600);
  }

  const COLOR_SCALE = [
    { max: 50, color: "#F31212" }, // red
    { max: 70, color: "#FE8C3A" }, // orange
    { max: 85, color: "#F2D516" }, // yellow
    { max: 100, color: "#07BD47" }, // green
  ];

  function getColor(value) {
    // console.log("score value:", value);
    const num = Number(value);

    if (isNaN(num)) {
      console.warn("Invalid value:", value);
      return "#ccc";
    }
    const found = COLOR_SCALE.find((level) => value < level.max);

    if (!found) {
      // if value greater than all max → take the last color
      return COLOR_SCALE[COLOR_SCALE.length - 1]?.color || "#ccc";
    }

    return found.color;
  }

  const SCORE_STATUS_CONFIG = [
    { limit: 50, className: "status-poor" },
    { limit: 70, className: "status-fair" },
    { limit: 85, className: "status-good" },
    { limit: 100, className: "status-excellent" },
  ];

  function getStatusByScore(score) {
    for (const item of SCORE_STATUS_CONFIG) {
      if (score < item.limit) {
        return item.className;
      }
    }

    return SCORE_STATUS_CONFIG[SCORE_STATUS_CONFIG.length - 1].className;
  }

  //1.score-card(overall score)
  function renderOverallScore(gauge) {
    const value = parseInt(gauge.dataset.score);
    const color = getColor(value);

    const fill = gauge.querySelector(".gauge-fill");
    const dot = gauge.querySelector(".gauge-dot");
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

    valueEl.textContent = value;
  }

  function updateOverallScoreFromApi(apiData) {
    document.querySelectorAll(".gauge").forEach((gauge) => {
      const key = gauge.dataset.key;

      if (!apiData.categories[key]) return;

      const score = Math.round(apiData.categories[key].score);
      gauge.dataset.score = score;

      renderOverallScore(gauge);
    });
  }

  // 2. Overall AI Visibility Score
  function renderOverallVisibilityScore(value) {
    const scoreWrap = document.querySelector(".score-wrapper");
    const fill = document.querySelector(".score-fill");
    const label = document.querySelector(".score-value");

    if (!scoreWrap || !fill || !label) return;

    const percent = Math.max(0, Math.min(value, 100));

    fill.style.width = percent + "%";

    label.textContent = percent;

    scoreWrap.classList.remove(
      "status-poor",
      "status-fair",
      "status-good",
      "status-excellent",
      "is-max",
    );

    const statusClass = getStatusByScore(percent);

    scoreWrap.classList.add(statusClass);

    if (percent === 100) {
      scoreWrap.classList.add("is-max");
    }
  }

  function updateOverallVisibilityScoreFromApi(apiData) {
    if (!apiData.overall_score) return;

    if (typeof apiData.overall_score === "number") {
      renderOverallVisibilityScore(apiData.overall_score);
    }
  }

  //4. Category Breakdown
  function renderCategory(card) {
    const value = parseInt(card.dataset.score);
    const color = getColor(value);
    const progressCircle = card.querySelector(".progress");
    const percentText = card.querySelector(".percent");
    const marker = card.querySelector(".marker");

    const totalLength = progressCircle.getTotalLength();

    // progress
    progressCircle.style.strokeDasharray = totalLength;
    progressCircle.style.strokeDashoffset = totalLength * (1 - value / 100);

    progressCircle.style.stroke = color;

    percentText.textContent = `${value}%`;

    // position marker
    const point = progressCircle.getPointAtLength(totalLength * (value / 100));

    marker.setAttribute("cx", point.x);
    marker.setAttribute("cy", point.y);
  }

  function updateCategoryFromApi(apiData) {
    document.querySelectorAll(".category-circle").forEach((card) => {
      const key = card.dataset.key;

      if (!apiData.categories[key]) return;

      const score = Math.round(apiData.categories[key].score);
      card.dataset.score = score;

      renderCategory(card);
    });
  }

  //modal get-detailed-report and report requested
  function initDetailedReportModal() {
    const modal1 = $("#get-detailed-report");
    const modal2 = $("#report-requested");
    const form = $(".form-detailed-report");
    const emailInput = $(".input-email");
    const sendBtn = $(".send-report");
    const outputEmail = $(".output-email");

    if (!form.length) return;

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

    initEmailValidation(emailInput, sendBtn, emailRegex);

    initFormSubmit(form, emailInput, outputEmail, modal1, modal2);

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
  function initFormSubmit(form, input) {
    form.on("submit", async function (e) {
      e.preventDefault();
      const email = input.val().trim();
      const modal1 = $("#get-detailed-report");
      const modal2 = $("#report-requested");
      const btn = $(".btn.send-report");
      const outputEmail = $(".output-email");
      const isLockedCard = document.querySelectorAll(".report-card.is-locked");

      btn.prop("disabled", true).text("Sending...");

      try {
        const res = await fetch(`${API_URL}/email-report`, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            email,
            url: currentData?.url || currentData?.analyzed_url,
            report_id: currentShareId,
            report_data: currentData, // Include full report data for PDF generation
          }),
        });

        const apiResponse = await res.json();
        console.log("apiResponse:", apiResponse);

        if (!apiResponse.success) {
          throw new Error("API failed");
        }

        await sendDataToBitrix(
          email,
          currentData,
          outputEmail,
          modal1,
          modal2,
          isLockedCard,
        );
      } catch (err) {
        alert("Failed to send: " + err.message);
      } finally {
        btn.prop("disabled", false).text("Send Report");
      }
    });
  }

  function unlockCards(cards) {
    if (!cards || !cards.length) return;

    cards.forEach((card) => {
      card.classList.remove("is-locked");

      // decode data
      const title = card.dataset.title
        ? decodeURIComponent(card.dataset.title)
        : "";
      const description = card.dataset.description
        ? decodeURIComponent(card.dataset.description)
        : "";

      const action = card.dataset.action
        ? decodeURIComponent(card.dataset.action)
        : "";

      const category = card.dataset.category
        ? decodeURIComponent(card.dataset.category)
        : "";

      const time_estimate = card.dataset.time_estimate
        ? decodeURIComponent(card.dataset.time_estimate)
        : "";

      const roi_score = card.dataset.roi_score
        ? decodeURIComponent(card.dataset.roi_score)
        : "";

      const impact = card.dataset.impact
        ? decodeURIComponent(card.dataset.impact)
        : "";

      // find elem
      const titleEl = card.querySelector(".title");
      const descEl = card.querySelector(".text-muted");
      const actionEl = card.querySelector(".text-default");

      const categoryEl = card.querySelector(".category");
      const timeEstimateEl = card.querySelector(".time-estimate");
      const roiScoreEl = card.querySelector(".roi-score");
      const impactEl = card.querySelector(".impact-info");

      // return true content
      if (titleEl) titleEl.textContent = title;
      if (descEl) descEl.textContent = description;
      if (actionEl) actionEl.textContent = action;
      if (categoryEl) categoryEl.textContent = category;
      if (timeEstimateEl) timeEstimateEl.textContent = time_estimate;
      if (roiScoreEl) roiScoreEl.textContent = roi_score;
      if (impactEl) impactEl.textContent = impact;
    });
  }

  function sendDataToBitrix(
    email,
    data,
    outputEmail,
    modal1,
    modal2,
    isLockedCard,
  ) {
    return new Promise((resolve, reject) => {
      $.post(
        "/wp-content/themes/icoda/submit-ai-results.php",
        { email, data },
        function (response) {
          outputEmail.text(email);
          modal1.modal("hide");
          modal2.modal("show");
          unlockCards(isLockedCard);
          resolve(response);
          console.log("responseBitrix:", response);
        },
      ).fail(reject);
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

    const input = document.querySelector(".site-url");
    const button = document.querySelector(".form-check-url button");

    // section return
    step2.classList.remove("section-visible");
    step2.classList.add("d-none");

    step1.classList.remove("d-none");
    step1.classList.remove("section-hidden");

    // smoot scroll to step1
    step1.scrollIntoView({ behavior: "smooth" });

    resetErrorApi();
    resetProgress();

    // hide progress
    container.classList.add("d-none");
    container.classList.remove("section-hidden");

    // clear input site url
    input.value = "";

    // disabled btn analyze
    button.disabled = true;
    button.classList.add("disabled");
  }

  const API_URL = "https://tools.icoda.io";
  let currentData = null,
    currentShareId = null,
    isRequestFinished = false,
    isProgressFinished = false;

  async function runAnalyzeURL() {
    resetErrorApi();
    resetProgress();
    const url = document.getElementById("urlInput").value.trim();
    if (!url) return alert("Please enter a URL");

    const controller = new AbortController();
    // console.log("Controller:", controller);
    const timeout = setTimeout(() => {
      controller.abort(); // kill the request after 8 seconds
    }, 8000);

    try {
      isRequestFinished = false;
      isProgressFinished = false;

      startProgress();

      const res = await fetch(`${API_URL}/analyze`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          url,
        }),
        signal: controller.signal,
      });

      clearTimeout(timeout);

      if (!res.ok) throw new Error(`Error: ${res.status}`);

      currentData = await res.json();
      isRequestFinished = true;

      console.log("currentData:", currentData);

      tryShowResults();
    } catch (err) {
      clearTimeout(timeout);

      if (err.name === "AbortError") {
        handleTimeoutError();
      } else {
        showErrorApi(err.message);
      }
    }
  }

  function handleTimeoutError() {
    const containerProgress = document.querySelector(
      ".progress-analyzing-container",
    );
    isRequestFinished = false;
    isProgressFinished = false;

    resetProgress();

    console.log("Request timeout");

    // останавливаем UI
    containerProgress.classList.add("d-none");

    showErrorApi("Request took too long. Please try again.");
  }

  function showErrorApi(message) {
    const errorBlock = document.getElementById("apiError");
    const text = document.getElementById("apiErrorText");

    if (!errorBlock) return alert(message);

    text.textContent = message;

    errorBlock.classList.remove("d-none");
  }

  function resetErrorApi() {
    const errorBlock = document.getElementById("apiError");
    const text = document.getElementById("apiErrorText");
    if (errorBlock) {
      text.textContent = "";
      errorBlock.classList.add("d-none");
    }
  }

  function renderResults(data) {
    //1.score-card(overall score)
    updateOverallScoreFromApi(data);

    //2.Overall AI Visibility Score
    updateOverallVisibilityScoreFromApi(data);

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

    //4. Category Breakdown
    updateCategoryFromApi(data);

    //5. Ai Bot Access
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

    //6. Technical checklist
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
    //7. Structured data
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

    //8. Content Gaps

    if (!data.content_gaps.length) {
      $(".report-gaps").hide();
    } else {
      $(".report-gaps").show();

      $(".report-gaps").find(".report-card").remove();
      data.content_gaps.forEach(function (element) {
        let impactClass = "excellent";
        if (element.impact === "high") {
          impactClass = "poor";
        } else if (element.impact === "medium") {
          impactClass = "fair";
        }

        const isLocked = impactClass !== "excellent";

        const title = isLocked
          ? "Lorem ipsum dolor sit amet..."
          : element.title;

        const impact = element.impact;

        const description = isLocked
          ? "Lorem ipsum dolor sit amet..."
          : element.description;

        const action = isLocked
          ? "Lorem ipsum dolor sit amet..."
          : element.action;

        const extraClass = isLocked ? "is-locked" : "";
        $(`
          <div class="report-card surface p-3 d-flex flex-column status-${impactClass} ${extraClass}" 
          data-title="${encodeURIComponent(element.title)}"
          data-description="${encodeURIComponent(element.description)}"
          data-action="${encodeURIComponent(element.action)}"
          >
                    <div class="report-card-header d-flex flex-lg-row flex-column-reverse justify-content-lg-between align-items-lg-center">
                        <h3 class="title">${title}</h3>
                        <div>
                            <span class="badge-status">${impact}</span>
                        </div>
                    </div>
                    <div class="text-muted">
                        ${description}
                    </div>
                    <div class="text-default mb-0">
                        ${action}
                    </div>

                </div>
          `).insertBefore($(".report-gaps").find(".content-gaps-btn"));
      });
    }
    //9. Recommendations
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
  }

  function generateRecommendCard(element) {
    let impactClass = "excellent";
    if (element.priority === "high") {
      impactClass = "poor";
    } else if (element.priority === "medium") {
      impactClass = "fair";
    }
    const isLocked = impactClass === "poor";

    const title = isLocked ? "Lorem ipsum dolor sit amet..." : element.title;

    const priority = element.priority;

    const category = isLocked
      ? "Lorem ipsum dolor sit amet..."
      : element.category;

    const description = isLocked
      ? "Lorem ipsum dolor sit amet..."
      : element.description;

    const time_estimate = isLocked ? "Lorem..." : element.time_estimate;
    const roi_score = isLocked ? "Lorem..." : element.roi_score;
    const impact = isLocked ? "Lorem..." : element.impact;

    const extraClass = isLocked ? "is-locked" : "";

    return `
    <div class="report-card surface p-3 d-flex flex-column status-${impactClass} ${extraClass}"
      data-title="${encodeURIComponent(element.title)}"
      data-category="${encodeURIComponent(element.category)}"
      data-description="${encodeURIComponent(element.description)}"
      data-time-estimate="${encodeURIComponent(element.time_estimate)}"
      data-roi-score="${encodeURIComponent(element.roi_score)}"
      data-timpact="${encodeURIComponent(element.impact)}"
    >
            <div class="report-card-header d-flex flex-lg-row flex-column-reverse justify-content-lg-between align-items-lg-center">
                <h3 class="title">${title}</h3>
                <div>
                    <span class="badge-status">${priority}</span>
                </div>
            </div>
            <div class="text-muted">
                <div>
                    ID
                    <span class="category">${category}</span>
                </div>
                <div class="description">
                    ${description}
                </div>
            </div>

            <div class="recommendation-info d-flex align-items-lg-center flex-column flex-lg-row">
                <div class="slot-info ci ci-clock">
                    <span class="time-estimate">${time_estimate}</span>
                </div>
                <div class="slot-info ci ci-roi">
                    <span>ROI:</span>
                    <span class="roi-score">${roi_score}/10</span>
                </div>
                <div class="slot-info ci ci-impact">
                    <span>Impact:</span>
                    <span class="impact-info">${impact}/20</span>
                </div>

            </div>

        </div>
    `;
  }
  //btn download pdf
  jQuery("body").on("click", ".btn-download", downloadPDF);
  async function downloadPDF(event) {
    event.preventDefault();
    if (!currentData) return alert("No report data");
    try {
      const res = await fetch(`${API_URL}/generate-pdf`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          url: currentData.url || currentData.analyzed_url,
          report_data: currentData,
        }),
      });
      if (!res.ok) throw new Error("Failed to generate PDF");
      const blob = await res.blob();
      const url = window.URL.createObjectURL(blob);
      const a = document.createElement("a");
      a.href = url;
      a.download = `AI_Visibility_Report.pdf`;
      a.click();
      window.URL.revokeObjectURL(url);
    } catch (err) {
      alert("Failed: " + err.message);
    }
  }

  /* buttons for retry and reset */
  document.getElementById("retryBtn").addEventListener("click", runAnalyzeURL);
  document.querySelectorAll(".btn-analyze").forEach((btn) => {
    btn.addEventListener("click", resetAnalyze);
  });

  // async function loadSharedReport() {
  //   const id = new URLSearchParams(location.search).get("report");
  //   if (!id) return;
  //   showLoading();
  //   document.getElementById("heroSection").classList.add("hidden");
  //   try {
  //     const res = await fetch(`${API_URL}/report/${id}`);
  //     if (!res.ok) throw new Error("Not found or expired");
  //     const data = await res.json();
  //     currentData = data.report;
  //     currentShareId = id;
  //     renderResults(data.report);
  //     const d = new Date(data.shared_at).toLocaleDateString("en-US", {
  //       month: "long",
  //       day: "numeric",
  //       year: "numeric",
  //       hour: "2-digit",
  //       minute: "2-digit",
  //     });
  //     const days = Math.ceil(
  //       (new Date(data.expires_at) - new Date()) / 86400000,
  //     );
  //     document.getElementById("sharedBannerText").textContent =
  //       `Shared ${d} • Expires in ${days} days • ${data.view_count} views`;
  //     document.getElementById("sharedBanner").classList.remove("hidden");
  //   } catch (err) {
  //     showError(err.message);
  //   }
  // }

  // jQuery("section-analyzer__form").on("submit", function (e) {
  //   e.preventDefault();
  //   analyze();
  // });
  // loadSharedReport();
});
