<?php
// Top navigation for logged-in pages. Set $pageTitle and $activePage before including.
require __DIR__ . '/head.php';

$user = $_SESSION['username'] ?? '';
$activePage = $activePage ?? '';
$initial = $user !== '' ? strtoupper(substr($user, 0, 1)) : '?';

function nav_class($page, $active)
{
    return $page === $active ? ' class="active" aria-current="page"' : '';
}
?>
<header class="topbar">
  <div class="topbar-inner container">
    <?= footy_brand('home.php') ?>

    <nav class="mainnav" id="mainnav" aria-label="Main">
      <a href="home.php"<?= nav_class('home', $activePage) ?>>Home</a>
      <a href="news.php"<?= nav_class('news', $activePage) ?>>News</a>
      <div class="dropdown">
        <button class="dropbtn<?= $activePage === 'leagues' ? ' active' : '' ?>" type="button" aria-expanded="false" aria-haspopup="true">
          Leagues
          <svg width="12" height="12" viewBox="0 0 12 12" aria-hidden="true"><path d="M3 4.5l3 3 3-3" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
        <div class="dropdown-menu">
          <?php foreach ($LEAGUES as $navKey => $navLeague): ?>
            <a href="<?= h($navKey) ?>.php" style="--c: <?= h($navLeague['color']) ?>">
              <span class="dd-dot"></span>
              <span><?= h($navLeague['name']) ?><small><?= h($navLeague['country']) ?></small></span>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
      <a href="about.php"<?= nav_class('about', $activePage) ?>>About</a>
      <a href="contacts.php"<?= nav_class('contacts', $activePage) ?>>Contacts</a>
    </nav>

    <div class="topbar-tools">
      <div class="search">
        <svg width="16" height="16" viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="7" fill="none" stroke="currentColor" stroke-width="2"/><path d="M20 20l-3.5-3.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        <input id="searchInput" type="search" placeholder="Search pages…" autocomplete="off" aria-label="Search pages">
        <div id="searchResults" class="search-results" role="listbox"></div>
      </div>

      <div class="user" title="Logged in as <?= h($user) ?>">
        <span class="avatar"><?= h($initial) ?></span>
        <span class="user-name"><?= h($user) ?></span>
      </div>
      <a class="icon-btn" href="?logout=1" title="Log out" aria-label="Log out">
        <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true"><path d="M15 4h3a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-3M10 17l5-5-5-5M15 12H4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </a>
      <button class="icon-btn menu-toggle" id="menuToggle" type="button" aria-label="Open menu" aria-expanded="false">
        <svg width="20" height="20" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
      </button>
    </div>
  </div>
</header>
<main class="page">
