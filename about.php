<?php
require __DIR__ . '/includes/auth.php';

$pageTitle = 'About';
$activePage = 'about';
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero pitch">
  <div class="container">
    <p class="kicker"><span class="kicker-dot"></span>About Footy</p>
    <h1>Made by fans,<br><span class="grad">for fans.</span></h1>
    <p class="lead">Passionate about football. Footy brings you the latest news, live league tables and everything you need to follow Europe's biggest leagues.</p>
  </div>
</section>

<section class="container section">
  <div class="stats-row">
    <div><strong>5</strong><span>top European leagues</span></div>
    <div><strong>96</strong><span>clubs followed</span></div>
    <div><strong>15 min</strong><span>between table updates</span></div>
    <div><strong>24/7</strong><span>football news</span></div>
  </div>
</section>

<section class="container section">
  <div class="section-head">
    <div>
      <p class="eyebrow">What we do</p>
      <h2>Everything in one place</h2>
    </div>
  </div>

  <div class="feature-grid">
    <article class="feature">
      <span class="feature-icon">
        <svg width="26" height="26" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 5h13v14H6a2 2 0 0 1-2-2V5zM17 9h3v8a2 2 0 0 1-2 2M8 9h5M8 13h5M8 16h3" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </span>
      <h3>Latest news</h3>
      <p>We deliver the latest football news, match results and transfer updates as they happen.</p>
    </article>
    <article class="feature">
      <span class="feature-icon">
        <svg width="26" height="26" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 20V10M10 20V4M16 20v-7M22 20H2" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
      </span>
      <h3>Tables &amp; stats</h3>
      <p>Live league standings with points, goal difference, wins, draws and losses for every club in the top five leagues.</p>
    </article>
    <article class="feature">
      <span class="feature-icon">
        <svg width="26" height="26" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M12 7.5l4 2.9-1.5 4.6h-5L8 10.4z" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
      </span>
      <h3>Built for fans</h3>
      <p>One free account gives you all five leagues. Simple, fast and made for people who love the game.</p>
    </article>
  </div>
</section>

<section class="container section">
  <div class="cta-band pitch">
    <div>
      <h2>Have an idea for Footy?</h2>
      <p>We'd love to hear your suggestions.</p>
    </div>
    <a class="btn btn-primary" href="contacts.php">Contact us</a>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
