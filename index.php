<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}

$pageTitle = 'Welcome';
$bodyClass = 'landing';
require __DIR__ . '/includes/head.php';
?>
<div class="landing-wrap pitch">
  <header class="landing-top container">
    <?= footy_brand('index.php') ?>
    <div class="landing-top-actions">
      <a class="btn btn-ghost btn-sm" href="login.php">Log in</a>
      <a class="btn btn-primary btn-sm" href="signup.php">Sign up</a>
    </div>
  </header>

  <main class="landing-hero container">
    <p class="kicker"><span class="kicker-dot"></span>Europe's top five leagues</p>
    <h1>All your football.<br><span class="grad">One place.</span></h1>
    <p class="lead">Breaking news and live league tables from the Premier League, LaLiga, Serie A, Bundesliga and Ligue 1.</p>
    <div class="actions">
      <a class="btn btn-primary btn-lg" href="signup.php">Create free account</a>
      <a class="btn btn-ghost btn-lg" href="login.php">I already have one</a>
    </div>

    <ul class="league-pills" aria-label="Leagues">
      <?php foreach ($LEAGUES as $league): ?>
        <li style="--c: <?= h($league['color']) ?>"><span class="dd-dot"></span><?= h($league['name']) ?></li>
      <?php endforeach; ?>
    </ul>
  </main>

  <section class="container landing-features">
    <div class="feature">
      <span class="feature-icon"><svg width="24" height="24" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 20V10M10 20V4M16 20v-7M22 20H2" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></span>
      <h3>Live tables</h3>
      <p>Full standings with club crests, updated every 15 minutes.</p>
    </div>
    <div class="feature">
      <span class="feature-icon"><svg width="24" height="24" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5h13v14H6a2 2 0 0 1-2-2V5zM17 9h3v8a2 2 0 0 1-2 2M8 9h5M8 13h5M8 16h3" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
      <h3>Latest news</h3>
      <p>Transfers, match reports and headlines from trusted sources.</p>
    </div>
    <div class="feature">
      <span class="feature-icon"><svg width="24" height="24" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M12 7.5l4 2.9-1.5 4.6h-5L8 10.4z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg></span>
      <h3>Five leagues</h3>
      <p>England, Spain, Italy, Germany and France in one account.</p>
    </div>
  </section>

  <footer class="landing-footer container">
    <p>&copy; 2026 Footy. All rights reserved.</p>
  </footer>
</div>
</body>
</html>
