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
      steps.forEach((_, index) => {
        const dot = document.createElement("div");
        dot.classList.add("progress-dot");
        if (index === 0) dot.classList.add("active");
        dotsWrapper.appendChild(dot);
      });

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
        }, 2000);
      }

      // For testing purposes, you can call startProgress() directly to see the animation without submitting the form
      //   window.startFakeAnalyze = startProgress;
      startProgress();
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

  //score-card(overall score)
  document.querySelectorAll(".gauge").forEach((gauge) => {
    const value = parseInt(gauge.dataset.value);
    const color = gauge.dataset.color;

    const fill = gauge.querySelector(".gauge-fill");
    const dot = gauge.querySelector(".gauge-dot");
    const pointer = gauge.querySelector(".gauge-pointer");

    // общая длина дуги
    const totalLength = fill.getTotalLength();

    // устанавливаем dash
    fill.style.stroke = color;
    fill.style.strokeDasharray = totalLength;
    fill.style.strokeDashoffset = totalLength * (1 - value / 100);

    // 🔥 получаем точку конца заполнения
    const point = fill.getPointAtLength(totalLength * (value / 100));

    const x = point.x;
    const y = point.y;

    // центрируем белую точку
    dot.setAttribute("cx", x);
    dot.setAttribute("cy", y);

    // позиция стрелки (центрируем по точке)
    // const width = 2;
    // const height = 101;

    pointer.setAttribute("x", x);
    pointer.setAttribute("y", y);
    pointer.style.fill = color;

    // 🔥 вычисляем направление касательной
    const delta = 0.01; // маленький шаг
    const point2 = fill.getPointAtLength(totalLength * (value / 100) - delta);

    const angle = Math.atan2(point.y - point2.y, point.x - point2.x);

    const angleDeg = (angle * 180) / Math.PI;

    // поворачиваем перпендикулярно дуге
    pointer.setAttribute("transform", `rotate(${angleDeg} ${x} ${y})`);

    // скрываем стрелку при 100%
    if (value >= 100) {
      pointer.style.opacity = "0";
    }
  });

  // function setProgress(score) {
  //   const dots = document.querySelectorAll(".dot");

  //   const steps = [
  //     { limit: 25, class: "red" },
  //     { limit: 50, class: "orange" },
  //     { limit: 75, class: "yellow" },
  //     { limit: 100, class: "green" },
  //   ];

  //   dots.forEach((dot) =>
  //     dot.classList.remove("red", "orange", "yellow", "green"),
  //   );

  //   let activeIndex = 0;

  //   if (score >= 100) activeIndex = 4;
  //   else if (score >= 75) activeIndex = 3;
  //   else if (score >= 50) activeIndex = 2;
  //   else if (score >= 25) activeIndex = 1;
  //   else activeIndex = 0;

  //   for (let i = 0; i <= activeIndex; i++) {
  //     const dot = dots[i];

  //     if (i <= 1) dot.classList.add("red");
  //     if (i === 2) dot.classList.add("orange");
  //     if (i === 3) dot.classList.add("yellow");
  //     if (i === 4) dot.classList.add("green");
  //   }
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

  setProgress(75);

  // fetch('/api/score')
  // .then(res => res.json())
  // .then(data => {
  //   setProgress(data.score);
  // });
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

function getColor(value) {
  if (value < 50) return "#FE8C3A"; // orange
  if (value < 70) return "#F31212"; // red
  if (value < 85) return "#F2D516"; // yellow
  return "#07BD47"; // green
}

//next
