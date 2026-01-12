//SEARCH FUNCTION 
const pages = [
  { name: "About", url: "about.php" },
  { name: "Bundesliga", url: "bundesliga.php" },
  { name: "Contacts", url: "contacts.php" },
  { name: "Home", url: "home.php" },
  { name: "LaLiga", url: "laliga.php" },
  { name: "Ligue 1", url: "ligue.php" },
  { name: "News", url: "news.php" },
  { name: "Premier League", url: "premier.php" },
  { name: "Serie A", url: "seria.php" },
  { name: "Messages", url: "messages.php" }
];

function searchPages() {
  const input = document.getElementById("searchInput").value.toLowerCase();
  const resultsContainer = document.getElementById("searchResults");
  resultsContainer.innerHTML = "";

  if (!input) return;

  let results = pages.filter(page => page.name.toLowerCase().startsWith(input));
  results.sort((a, b) => a.name.localeCompare(b.name));

  if (results.length === 0) {
    resultsContainer.innerHTML = "<p>No results found</p>";
    return;
  }

  results.forEach(page => {
    const div = document.createElement("div");
    div.className = "result-item";
    div.innerHTML = `<a href="${page.url}">${page.name}</a>`;
    resultsContainer.appendChild(div);
  });
}

// Close search results when clicking outside
window.addEventListener("click", function(event) {
  const searchContainer = document.querySelector(".search");
  const resultsContainer = document.getElementById("searchResults");
  if (!searchContainer.contains(event.target)) {
    resultsContainer.innerHTML = "";
  }
});

// DROPDOWN TOGGLE 
function toggleDropdown() {
  document.getElementById("myDropdown").classList.toggle("show");
}

window.addEventListener("click", function(event) {
  if (!event.target.matches('.dropbtn')) {
    const dropdowns = document.getElementsByClassName("dropdown-content");
    for (let i = 0; i < dropdowns.length; i++) {
      dropdowns[i].classList.remove('show');
    }
  }
});

// NEWS FETCH
function fetchNews() {
  const newsElement = document.getElementById("news1");
  const loadingElement = document.getElementById("loading");
  if (!newsElement || !loadingElement) return;

  fetch("news1.php")
    .then(res => res.json())
    .then(articles => {
      newsElement.innerHTML = '';
      if (!articles || articles.length === 0) {
        newsElement.innerHTML = "<p>No recent football news found.</p>";
        return;
      }

      articles.forEach(article => {
        const articleDiv = document.createElement("div");
        articleDiv.className = "article";

        const imageURL = article.image || "https://via.placeholder.com/200";
        articleDiv.innerHTML = `
          <div class="article-content">
            <img src="${imageURL}" alt="News image" />
            <h3 class="headline"><a href="${article.link}" target="_blank">${article.title || "News"}</a></h3>
            <p class="description">${article.description || ""}</p>
          </div>
        `;
        newsElement.appendChild(articleDiv);
        setTimeout(() => articleDiv.classList.add("show"), 100);
      });

      loadingElement.style.display = "none";
    })
    .catch(err => {
      loadingElement.textContent = "⚠️ Failed to load news.";
      console.error(err);
    });
}


// Contact form submission
document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById("contactForm");
  const status = document.getElementById("status");

  if (form) {
    form.addEventListener("submit", function(e) {
      e.preventDefault();
      const formData = new FormData(form);

      fetch("send_message.php", {
        method: "POST",
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        status.textContent = data.message;
        status.style.color = data.success ? "green" : "red";
        if (data.success) form.reset();
      })
      .catch(() => {
        status.textContent = "⚠️ Server error.";
        status.style.color = "red";
      });
    });
  }
});
function closeWelcome() {
  document.getElementById('welcomeOverlay').remove();
  document.querySelector('.dashboard-content').style.opacity = "1";
}

function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

const originalMap = new WeakMap();

const slides = document.querySelectorAll('.slide');
let currentIndex = 0;
let intervalTime = 5000; 
let slideInterval;

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.remove('active');
    if (i === index) slide.classList.add('active');
  });
}

// show the first slide
showSlide(currentIndex);

// function to go to the next slide
function nextSlide() {
  currentIndex = (currentIndex + 1) % slides.length;
  showSlide(currentIndex);
}

// start automatic slideshow
slideInterval = setInterval(nextSlide, intervalTime);



const searchInput = document.getElementById("searchInput");
const searchResults = document.getElementById("searchResults");

searchInput.addEventListener("input", () => {
  const hasResults = searchResults.children.length > 0;

  if (searchInput.value.trim() !== "" && hasResults) {
    searchResults.classList.add("active");
  } else {
    searchResults.classList.remove("active");
  }
});

/* Hide when clicking outside */
document.addEventListener("click", (e) => {
  if (!e.target.closest(".search-function")) {
    searchResults.classList.remove("active");
  }
});
