// ===== SEARCH =====
const PAGES = [
  { name: "Home", url: "home.php", hint: "Start page" },
  { name: "News", url: "news.php", hint: "Latest stories" },
  { name: "Premier League", url: "premier.php", hint: "England" },
  { name: "LaLiga", url: "laliga.php", hint: "Spain" },
  { name: "Serie A", url: "seria.php", hint: "Italy" },
  { name: "Bundesliga", url: "bundesliga.php", hint: "Germany" },
  { name: "Ligue 1", url: "ligue.php", hint: "France" },
  { name: "About", url: "about.php", hint: "About Footy" },
  { name: "Contacts", url: "contacts.php", hint: "Get in touch" },
  { name: "Messages", url: "messages.php", hint: "Contact inbox" },
];

const escapeHtml = (text) =>
  String(text ?? "").replace(/[&<>"']/g, (c) => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[c]));

const searchInput = document.getElementById("searchInput");
const searchResults = document.getElementById("searchResults");

function searchPages() {
  const query = searchInput.value.trim().toLowerCase();
  searchResults.innerHTML = "";

  if (!query) {
    searchResults.classList.remove("active");
    return;
  }

  const results = PAGES.filter((p) => p.name.toLowerCase().includes(query) || p.hint.toLowerCase().includes(query));

  searchResults.innerHTML = results.length
    ? results.map((p) => `<a class="result-item" href="${p.url}">${escapeHtml(p.name)}<small>${escapeHtml(p.hint)}</small></a>`).join("")
    : `<p class="no-results">No pages found</p>`;
  searchResults.classList.add("active");
}

if (searchInput) {
  searchInput.addEventListener("input", searchPages);
  searchInput.addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
      const first = searchResults.querySelector("a");
      if (first) window.location = first.href;
    }
    if (e.key === "Escape") {
      searchInput.value = "";
      searchPages();
    }
  });
  document.addEventListener("click", (e) => {
    if (!e.target.closest(".search")) searchResults.classList.remove("active");
  });
}

// ===== LEAGUES DROPDOWN =====
document.querySelectorAll(".dropdown").forEach((dropdown) => {
  const button = dropdown.querySelector(".dropbtn");
  button.addEventListener("click", (e) => {
    e.stopPropagation();
    const open = dropdown.classList.toggle("open");
    button.setAttribute("aria-expanded", open);
  });
});
document.addEventListener("click", () => {
  document.querySelectorAll(".dropdown.open").forEach((d) => {
    d.classList.remove("open");
    d.querySelector(".dropbtn").setAttribute("aria-expanded", "false");
  });
});

// ===== MOBILE MENU =====
const menuToggle = document.getElementById("menuToggle");
if (menuToggle) {
  menuToggle.addEventListener("click", () => {
    const open = document.body.classList.toggle("menu-open");
    menuToggle.setAttribute("aria-expanded", open);
  });
}

// ===== WELCOME POPUP =====
const welcome = document.getElementById("welcome");
if (welcome) {
  const close = () => welcome.remove();
  welcome.querySelectorAll("[data-close]").forEach((b) => b.addEventListener("click", close));
  welcome.addEventListener("click", (e) => { if (e.target === welcome) close(); });
  document.addEventListener("keydown", (e) => { if (e.key === "Escape") close(); });
}

// ===== CONFIRM BEFORE DELETE =====
document.querySelectorAll("form[data-confirm]").forEach((form) => {
  form.addEventListener("submit", (e) => {
    if (!confirm(form.dataset.confirm)) e.preventDefault();
  });
});

// ===== NEWS =====
function timeAgo(dateString) {
  const date = new Date(dateString);
  if (isNaN(date)) return "";
  const minutes = Math.round((Date.now() - date) / 60000);
  if (minutes < 1) return "Just now";
  if (minutes < 60) return `${minutes} min ago`;
  const hours = Math.round(minutes / 60);
  if (hours < 24) return `${hours} h ago`;
  return date.toLocaleDateString("en-GB", { day: "numeric", month: "short" });
}

// BBC sends small thumbnails – ask for a bigger version
const biggerImage = (url) => (url ? url.replace(/\/standard\/\d+\//, "/standard/800/") : "");

function newsCard(article, featured) {
  const img = biggerImage(article.image);
  return `
    <a class="news-card${featured ? " featured" : ""}" href="${escapeHtml(article.link)}" target="_blank" rel="noopener">
      <div class="news-img">
        ${img ? `<img src="${escapeHtml(img)}" alt="" loading="lazy">` : ""}
      </div>
      <div class="news-body">
        <span class="news-meta">BBC Sport${article.date ? ` · ${timeAgo(article.date)}` : ""}</span>
        <h3>${escapeHtml(article.title)}</h3>
        ${article.description ? `<p>${escapeHtml(article.description)}</p>` : ""}
      </div>
    </a>`;
}

function skeletons(count) {
  return Array.from({ length: count }, () => `
    <div class="news-card skeleton">
      <div class="news-img"></div>
      <div class="news-body"><span></span><span></span><span class="short"></span></div>
    </div>`).join("");
}

function fetchNews() {
  const grid = document.getElementById("newsGrid");
  if (!grid) return;

  const limit = Number(grid.dataset.limit) || 10;
  const featured = grid.dataset.featured === "1";
  if (!grid.children.length) grid.innerHTML = skeletons(Math.min(limit, 6));

  fetch("news1.php")
    .then((res) => res.json())
    .then((articles) => {
      if (!Array.isArray(articles) || articles.length === 0) {
        grid.innerHTML = `<div class="card empty"><p class="empty-title">No news right now</p><p>Check back in a few minutes.</p></div>`;
        return;
      }
      grid.innerHTML = articles.slice(0, limit).map((a, i) => newsCard(a, featured && i === 0)).join("");
    })
    .catch(() => {
      grid.innerHTML = `<div class="card empty"><p class="empty-title">Couldn't load the news</p><p>Please try again later.</p></div>`;
    });
}

const newsGrid = document.getElementById("newsGrid");
if (newsGrid) {
  fetchNews();
  const refresh = Number(newsGrid.dataset.refresh);
  if (refresh) setInterval(fetchNews, refresh * 1000);
}

// ===== CONTACT FORM =====
const contactForm = document.getElementById("contactForm");
if (contactForm) {
  const status = document.getElementById("status");
  const button = contactForm.querySelector("button[type=submit]");

  contactForm.addEventListener("submit", (e) => {
    e.preventDefault();
    if (!contactForm.checkValidity()) {
      status.textContent = "Please fill in all fields with a valid email.";
      status.className = "form-status error";
      return;
    }

    button.disabled = true;
    button.textContent = "Sending…";

    fetch("send_message.php", { method: "POST", body: new FormData(contactForm) })
      .then((res) => res.json())
      .then((data) => {
        status.textContent = data.message;
        status.className = "form-status " + (data.success ? "success" : "error");
        if (data.success) contactForm.reset();
      })
      .catch(() => {
        status.textContent = "Server error. Please try again.";
        status.className = "form-status error";
      })
      .finally(() => {
        button.disabled = false;
        button.textContent = "Send message";
      });
  });
}
