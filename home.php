<?php
require __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/helpers.php';

$pageTitle = 'Home';
$activePage = 'home';
require __DIR__ . '/includes/header.php';
?>

<?php if (!empty($showWelcome)): ?>
  <div class="modal" id="welcome" role="dialog" aria-modal="true" aria-labelledby="welcomeTitle">
    <div class="modal-card">
      <button class="modal-close" type="button" data-close aria-label="Close">&times;</button>
      <?= footy_mark(56) ?>
      <h2 id="welcomeTitle">Hello, <?= h($user) ?>!</h2>
      <p>Welcome to Footy. Here you can follow the latest football news and live standings from Europe's top five leagues.</p>
      <button class="btn btn-primary" type="button" data-close>Let's go</button>
    </div>
  </div>
<?php endif; ?>

<section class="home-hero pitch">
  <div class="container home-hero-inner">
    <div class="home-hero-text">
      <p class="kicker"><span class="kicker-dot"></span>Your matchday hub</p>
      <h1>Welcome back,<br><span class="grad"><?= h($user) ?></span></h1>
      <p class="lead">The latest headlines and live tables from the Premier League, LaLiga, Serie A, Bundesliga and Ligue 1 – all in one place.</p>
      <div class="actions">
        <a class="btn btn-primary" href="news.php">Read the news</a>
        <a class="btn btn-ghost" href="premier.php">View standings</a>
      </div>
    </div>

    <div class="scoreboard" aria-label="Footy in numbers">
      <div class="scoreboard-top">
        <span class="live"><span class="kicker-dot"></span>Live data</span>
        <span>Season <?= h(footy_season()) ?></span>
      </div>
      <div class="scoreboard-grid">
        <div><strong>5</strong><span>top leagues</span></div>
        <div><strong>96</strong><span>clubs</span></div>
        <div><strong>15'</strong><span>table refresh</span></div>
        <div><strong>24/7</strong><span>news feed</span></div>
      </div>
    </div>
  </div>
</section>

<section class="container section">
  <div class="section-head">
    <div>
      <p class="eyebrow">Top leagues</p>
      <h2>Pick a league</h2>
    </div>
    <p class="section-sub">See the full table and the latest stories for each league.</p>
  </div>

  <div class="league-grid">
    <?php foreach ($LEAGUES as $key => $league): ?>
      <a class="league-card" href="<?= h($key) ?>.php" style="--c: <?= h($league['color']) ?>">
        <img src="<?= h($league['img']) ?>" alt="" loading="lazy">
        <div class="league-card-body">
          <span class="league-country"><?= h($league['country']) ?></span>
          <h3><?= h($league['name']) ?></h3>
          <span class="league-go">Table &amp; news <span>→</span></span>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
</section>

<section class="container section">
  <div class="section-head">
    <div>
      <p class="eyebrow">Headlines</p>
      <h2>Latest football news</h2>
    </div>
    <a class="link-arrow" href="news.php">All news <span>→</span></a>
  </div>
  <div class="news-grid compact" id="newsGrid" data-limit="4"></div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
