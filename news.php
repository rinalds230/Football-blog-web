<?php
require __DIR__ . '/includes/auth.php';

$pageTitle = 'News';
$activePage = 'news';
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero pitch">
  <div class="container">
    <p class="kicker"><span class="kicker-dot"></span>Updated every minute</p>
    <h1>Latest football news</h1>
    <p class="lead">Top stories from BBC Sport – transfers, match reports and everything in between.</p>
  </div>
</section>

<section class="container section">
  <div class="news-grid" id="newsGrid" data-limit="13" data-featured="1" data-refresh="60"></div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
