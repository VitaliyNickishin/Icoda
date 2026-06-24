jQuery(document).ready(function ($) {
  const appliedFilters = {};

  $(".nav-link").on("click", function () {
    let topics = $(this).attr("data-topics")?.trim();
    let isPrevious = $(this).attr("data-previous");
    let section = $(this).parents(".section-all-events");
    const dateDropdown = section.find(
      ".event-filters-dropdowns [data-key='date']",
    );

    delete appliedFilters["previous"];

    if (isPrevious === "true") {
      delete appliedFilters["topic"];
      appliedFilters["previous"] = true;
      dateDropdown.addClass("d-none");
    } else {
      dateDropdown.removeClass("d-none");
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
    if (Array.isArray(data.topic)) {
      data.topic = JSON.stringify(data.topic);
    }
    $.post("/wp-json/events/v1/filter", data, function (data) {
      // console.log("send post request:", data);
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
  render();
});

/* ============================================================
   ICODA Crypto Events Calendar — vanilla JS
   ============================================================ */

/* Demo "today" pinned to the calendar period so the current
   month opens populated with events. */
const TODAY = new Date();

const CATEGORIES = [
  "All",
  "Crypto",
  "Bitcoin",
  "Ethereum",
  "Web3",
  "DeFi",
  "AI",
  "NFT",
];
const CAT_COLOR = {
  Crypto: "var(--cat-crypto)",
  Bitcoin: "var(--cat-bitcoin)",
  Ethereum: "var(--cat-ethereum)",
  Web3: "var(--cat-web3)",
  DeFi: "var(--cat-defi)",
  AI: "var(--cat-ai)",
  NFT: "var(--cat-nft)",
};

const EVENTS = window.eventsData || [];

/* ---------- state ---------- */
const state = {
  search: "",
  category: "All",
  region: "All",
  view: "grid",
  calYear: TODAY.getFullYear(),
  calMonth: TODAY.getMonth(),
  selectedDate: null,
  visibleMonths: 1,
};

/* ---------- date helpers ---------- */
const MONTHS = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];
const MONTHS_SHORT = [
  "Jan",
  "Feb",
  "Mar",
  "Apr",
  "May",
  "Jun",
  "Jul",
  "Aug",
  "Sep",
  "Oct",
  "Nov",
  "Dec",
];
const WEEKDAYS = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];

function parseDate(s) {
  const [y, m, d] = s.split("-").map(Number);
  return new Date(y, m - 1, d);
}
function sameDay(a, b) {
  return (
    a.getFullYear() === b.getFullYear() &&
    a.getMonth() === b.getMonth() &&
    a.getDate() === b.getDate()
  );
}
function ymd(d) {
  return (
    d.getFullYear() +
    "-" +
    String(d.getMonth() + 1).padStart(2, "0") +
    "-" +
    String(d.getDate()).padStart(2, "0")
  );
}

function formatRange(ev) {
  const s = parseDate(ev.start),
    e = parseDate(ev.end);
  const sm = MONTHS_SHORT[s.getMonth()],
    em = MONTHS_SHORT[e.getMonth()];
  const sy = s.getFullYear(),
    ey = e.getFullYear();
  if (sameDay(s, e)) return sm + " " + s.getDate() + ", " + sy;
  if (sy !== ey)
    return (
      sm +
      " " +
      s.getDate() +
      ", " +
      sy +
      " – " +
      em +
      " " +
      e.getDate() +
      ", " +
      ey
    );
  if (s.getMonth() === e.getMonth())
    return sm + " " + s.getDate() + "–" + e.getDate() + ", " + sy;
  return sm + " " + s.getDate() + " – " + em + " " + e.getDate() + ", " + sy;
}
/* long form for the conference list: "07 - 08 October, 2026" */
function formatRangeLong(ev) {
  const s = parseDate(ev.start),
    e = parseDate(ev.end);
  const pad = (n) => String(n).padStart(2, "0");
  const sM = MONTHS[s.getMonth()],
    eM = MONTHS[e.getMonth()];
  const sy = s.getFullYear(),
    ey = e.getFullYear();
  if (sameDay(s, e)) return pad(s.getDate()) + " " + sM + ", " + sy;
  if (sy !== ey)
    return (
      pad(s.getDate()) +
      " " +
      sM +
      ", " +
      sy +
      " – " +
      pad(e.getDate()) +
      " " +
      eM +
      ", " +
      ey
    );
  if (s.getMonth() === e.getMonth())
    return pad(s.getDate()) + " - " + pad(e.getDate()) + " " + sM + ", " + sy;
  return (
    pad(s.getDate()) +
    " " +
    sM +
    " – " +
    pad(e.getDate()) +
    " " +
    eM +
    ", " +
    sy
  );
}

function filterEvents() {
  const q = state.search.trim().toLowerCase();

  return EVENTS.filter((ev) => {
    if (state.category !== "All" && !ev.categories.includes(state.category))
      return false;
    if (state.region !== "All" && ev.region !== state.region) return false;
    if (q) {
      const hay = (
        ev.title +
        " " +
        ev.location +
        " " +
        ev.country +
        " " +
        ev.description
      ).toLowerCase();
      if (!hay.includes(q)) return false;
    }
    return true;
  }).sort((a, b) => parseDate(a.start) - parseDate(b.start));
}

/* events occurring on a specific date (inclusive multi-day) */
function getEventsForDate(list, year, month, day) {
  const target = new Date(year, month, day).setHours(0, 0, 0, 0);
  return list.filter((ev) => {
    const s = parseDate(ev.start).setHours(0, 0, 0, 0);
    const e = parseDate(ev.end).setHours(0, 0, 0, 0);
    return target >= s && target <= e;
  });
}
/* map of day -> events[] for a month */
function getEventDatesForMonth(list, year, month) {
  const map = new Map();
  const daysInMonth = new Date(year, month + 1, 0).getDate();
  for (let d = 1; d <= daysInMonth; d++) {
    const evs = getEventsForDate(list, year, month, d);
    if (evs.length) map.set(d, evs);
  }
  return map;
}

function tagsHTML(ev) {
  return ev.categories
    .map((c) => `<span class="topic-pill">${c}</span>`)
    .join("");
}

/* ---------- grouping by month ---------- */
function groupByMonth(list) {
  const groups = new Map();
  list.forEach((ev) => {
    const s = parseDate(ev.start);
    const key = s.getFullYear() + "-" + String(s.getMonth()).padStart(2, "0");
    if (!groups.has(key))
      groups.set(key, {
        year: s.getFullYear(),
        month: s.getMonth(),
        events: [],
      });
    groups.get(key).events.push(ev);
  });
  return [...groups.values()].sort(
    (a, b) => a.year - b.year || a.month - b.month,
  );
}

/* idx lookup: map filtered event back to EVENTS index */
function evIndex(ev) {
  return EVENTS.indexOf(ev);
}

/* ============================================================
   RENDER
   ============================================================ */
function render() {
  const list = filterEvents();
  // const active = filtersActive();

  overlay.addEventListener("click", (e) => {
    if (e.target === overlay) closeModal();
  });
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && overlay.classList.contains("open")) closeModal();
  });

  // single page: calendar + featured + full conference list, all on same filtered data
  renderCalendar(list);

  const container = document.querySelector(".card-event-list");
  container.addEventListener("click", function (e) {
    var item = e.target.closest(".card-event[data-index]");
    const index = Number(item.dataset.index);
    // if (item) openModal(evIndex(list[+item.getAttribute("data-index")]));
    if (item) openModal(evIndex(list[index]));
  });
}

/* ---------- CALENDAR ---------- */
function renderCalendar(list) {
  const view = document.getElementById("calendarView");
  const y = state.calYear,
    m = state.calMonth;
  const eventMap = getEventDatesForMonth(list, y, m);
  const firstDow = (new Date(y, m, 1).getDay() + 6) % 7;
  const dim = new Date(y, m + 1, 0).getDate();
  const prevDays = new Date(y, m, 0).getDate();
  let cells = "";

  for (let i = firstDow - 1; i >= 0; i--)
    cells += `<div class="cal-cell outside"><span class="cal-daynum">${prevDays - i}</span></div>`;

  for (let d = 1; d <= dim; d++) {
    const evs = eventMap.get(d) || [];
    const isToday = sameDay(new Date(y, m, d), TODAY);
    const isSel =
      state.selectedDate &&
      state.selectedDate.y === y &&
      state.selectedDate.m === m &&
      state.selectedDate.d === d;
    const dots = evs
      .slice(0, 4)
      .map(() => `<span class="cal-dot" style="background:#3c61e2"></span>`)
      .join("");
    const overflow =
      evs.length > 4
        ? `<span class="cal-overflow">+${evs.length - 4}</span>`
        : "";
    cells += `<div class="cal-cell${evs.length ? " has-events" : ""}${isToday ? " today" : ""}${isSel ? " selected" : ""}" ${evs.length ? `data-day="${d}"` : ""}  tabindex="${evs.length ? 0 : -1}" role="${evs.length ? "button" : "gridcell"}" aria-label="${MONTHS[m]} ${d}${evs.length ? `, ${evs.length} event${evs.length > 1 ? "s" : ""}` : ""}">
      <span class="cal-daynum">${d}</span>
      ${evs.length ? `<div class="cal-dots">${dots}${overflow}</div>` : ""}
    </div>`;
  }

  const total = firstDow + dim;
  const trail = (7 - (total % 7)) % 7;
  for (let i = 1; i <= trail; i++)
    cells += `<div class="cal-cell outside"><span class="cal-daynum">${i}</span></div>`;

  view.innerHTML = `
     <div class="cal-wrap">
      <div class="cal-head">
        <div class="cal-title">${MONTHS[m]} ${y}</div>
        <div class="cal-nav">
          <button class="cal-arrow" id="calPrev" aria-label="Previous month"><i class="far fa-chevron-left" aria-hidden="true"></i></button>
          <button class="cal-arrow" id="calNext" aria-label="Next month"><i class="far fa-chevron-right" aria-hidden="true"></i></button>
        </div>
      </div>
      <div class="cal-weekdays" role="row">${WEEKDAYS.map((w) => `<span role="columnheader">${w}</span>`).join("")}</div>
      <div class="cal-grid-mask" role="grid"><div class="cal-grid" id="calGrid">${cells}</div></div>
      <div class="cal-foot">
        <div></div>
        <button class="back-today" id="backToday"><i class="far fa-calendar-alt" aria-hidden="true"></i> Jump to today</button>
      </div>
      <div class="day-panel" id="dayPanel"></div>
    </div>`;

  // wire nav
  document.getElementById("calPrev").onclick = () => changeMonth(-1);
  document.getElementById("calNext").onclick = () => changeMonth(1);
  document.getElementById("backToday").onclick = () => {
    state.calYear = TODAY.getFullYear();
    state.calMonth = TODAY.getMonth();
    state.selectedDate = null;
    render();
  };
  // cell clicks
  view.querySelectorAll(".cal-cell.has-events").forEach((cell) => {
    cell.onclick = () => {
      const d = +cell.getAttribute("data-day");
      state.selectedDate = { y, m, d };
      openDayPanel(list, y, m, d);
      view
        .querySelectorAll(".cal-cell")
        .forEach((c) => c.classList.remove("selected"));
      cell.classList.add("selected");
    };
  });

  // restore open day panel if selection in this month
  if (
    state.selectedDate &&
    state.selectedDate.y === y &&
    state.selectedDate.m === m
  ) {
    openDayPanel(list, y, m, state.selectedDate.d);
  }
}

function changeMonth(dir) {
  const grid = document.getElementById("calGrid");
  if (grid) {
    grid.classList.add(dir > 0 ? "slide-left" : "slide-right");
  }
  let m = state.calMonth + dir,
    y = state.calYear;
  if (m < 0) {
    m = 11;
    y--;
  }
  if (m > 11) {
    m = 0;
    y++;
  }
  state.calMonth = m;
  state.calYear = y;
  state.selectedDate = null;
  setTimeout(() => render(), 180);
}

function openDayPanel(list, y, m, d) {
  const evs = getEventsForDate(list, y, m, d);
  const panel = document.getElementById("dayPanel");
  if (!panel) return;
  const dateLabel =
    WEEKDAYS[(new Date(y, m, d).getDay() + 6) % 7] +
    ", " +
    MONTHS[m] +
    " " +
    d +
    ", " +
    y;
  if (!evs.length) {
    panel.innerHTML = `<div class="day-panel-head"><h4>${dateLabel}</h4><button class="day-panel-close" id="dpClose"><i class="far fa-times"></i></button></div><p style="font-size:14px;color:var(--text-muted);margin:0;">No events on this day.</p>`;
  } else {
    panel.innerHTML = `
      <div class="day-panel-head"><h4>${dateLabel} · ${evs.length} ${evs.length === 1 ? "event" : "events"}</h4><button class="day-panel-close" id="dpClose"><i class="far fa-times"></i></button></div>
      <div class="mini-cards">${evs
        .map(
          (ev) => `
        <div class="mini-card" data-idx="${evIndex(ev)}">
          <div class="mini-info"><h5>${ev.title}</h5><p style="line-height: 1.3;"><i class="fas fa-map-marker-alt"></i> ${ev.location}, ${ev.country}</p></div>
          <span class="mini-arrow"><i class="fas fa-long-arrow-alt-right arrow-long"></i></span>
        </div>`,
        )
        .join("")}</div>`;
  }
  panel.classList.add("open");
  document.getElementById("dpClose").onclick = () => {
    panel.classList.remove("open");
    state.selectedDate = null;
    document
      .querySelectorAll(".cal-cell.selected")
      .forEach((c) => c.classList.remove("selected"));
  };
  panel.querySelectorAll(".mini-card").forEach((c) => {
    c.onclick = () => openModal(+c.getAttribute("data-idx"));
  });
}

/* ---------- MODAL ---------- */
const overlay = document.getElementById("modalOverlay");
const modal = document.getElementById("modal");

function openModal(idx) {
  const ev = EVENTS[idx];
  const catGrads = {
    Crypto: "linear-gradient(150deg,#0f1b5c 0%,#3C61E2 100%)",
    Bitcoin: "linear-gradient(150deg,#5c2800 0%,#FE8C3A 100%)",
    Ethereum: "linear-gradient(150deg,#0f1b5c 0%,#6F93EF 100%)",
    Web3: "linear-gradient(150deg,#003b14 0%,#07BD47 100%)",
    DeFi: "linear-gradient(150deg,#091545 0%,#2E50C4 100%)",
    AI: "linear-gradient(150deg,#1e0545 0%,#7C5CE6 100%)",
    NFT: "linear-gradient(150deg,#450020 0%,#E0568A 100%)",
    iGaming: "linear-gradient(150deg,#1a0545 0%,#6F3AE0 100%)",
  };
  // Always use the Blockchain Life × ICODA co-branded banner for all modals
  const emptyBanner =
    "https://icoda.io/wp-content/uploads/2026/06/blockchain-life-icoda.jpg";
  const realBanner = ev.modal_banner;
  const bannerSrc = realBanner || emptyBanner;
  const heroGrad = catGrads[ev.categories[0]] || catGrads.Crypto;
  const discHTML =
    ev.with_promo_code && ev.discount_codes
      ? `
    <p class="modal-section-label">Discount code</p>
    <div class="discount-row">
      
      <div class="lc-discount">
        <div class="lc-disc-info">
          <span class="lc-disc-label">Promo code</span>
          <span class="lc-disc-code">${ev.discount_codes}</span>
        </div>
        <button class="lc-copy modal-copy" data-code="${ev.discount_codes}">Copy</button>
      </div>
    </div>`
      : "";

  // Build modal hero
  const heroImgHTML = `
    <img
        src="${bannerSrc}"
        alt="${ev.title}"
        style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;"
    >
`;
  const reviewBtnHTML =
    ev.is_related_post && ev.url_related_post.url
      ? '<a class="btn btn-read-review btn-outline-blue" href="' +
        ev.url_related_post.url +
        '" target="_blank" rel="noopener">Read our review</a>'
      : "";

  modal.innerHTML =
    '<div class="modal-hero" style="background:' +
    heroGrad +
    '">' +
    heroImgHTML +
    '<button class="modal-close" id="modalClose" aria-label="Close dialog"><i class="far fa-times" aria-hidden="true"></i></button>' +
    '<div class="modal-hero-foot">' +
    '<span class="modal-hero-cat">' +
    ev.categories[0] +
    "</span>" +
    "</div>" +
    "</div>" +
    '<div class="modal-body">' +
    '<div class="modal-meta">' +
    '<div class="mm"><span class="mm-label">Date</span><span class="mm-val"><i class="far fa-calendar" style="color:#3c61e2" aria-hidden="true"></i> ' +
    formatRange(ev) +
    "</span></div>" +
    '<div class="mm"><span class="mm-label">Location</span><span class="mm-val"><i class="fas fa-map-marker-alt" style="color:#3c61e2" aria-hidden="true"></i> ' +
    ev.location +
    ", " +
    ev.country +
    "</span></div>" +
    "</div>" +
    "<h2>" +
    ev.title +
    "</h2>" +
    '<p class="modal-desc">' +
    ev.description +
    "</p>" +
    '<p class="modal-section-label">Categories</p>' +
    '<div class="modal-tags">' +
    tagsHTML(ev) +
    "</div>" +
    discHTML +
    '<div class="modal-actions">' +
    '<a class="btn btn-blue" href="' +
    ev.url_website +
    '" target="_blank" rel="noopener">Grab your spot <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:11px" aria-hidden="true"></i></a>' +
    reviewBtnHTML +
    "</div>" +
    "</div>";
  overlay.classList.add("open");
  // overlay.setAttribute("aria-hidden", "false");
  document.body.style.overflow = "hidden";
  const _mc = document.getElementById("modalClose");
  if (_mc) _mc.addEventListener("click", closeModal);
  const _cta = document.getElementById("modalCTA");
  if (_cta) _cta.addEventListener("click", closeModal);
  modal.querySelectorAll(".modal-copy").forEach((btn) => {
    btn.addEventListener("click", () => {
      navigator.clipboard &&
        navigator.clipboard.writeText(btn.getAttribute("data-code"));
      const prev = btn.textContent;
      btn.textContent = "Copied!";
      setTimeout(() => (btn.textContent = prev), 1400);
    });
  });
}
function closeModal() {
  overlay.classList.remove("open");
  // overlay.setAttribute("aria-hidden", "true");
  document.body.style.overflow = "";
}
