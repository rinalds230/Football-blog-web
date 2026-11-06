<?php
// Shared league page. Needs: $leagueKey, $newsItems, $data (standings).
require_once __DIR__ . '/helpers.php';

$league = $LEAGUES[$leagueKey];
$pageTitle = $league['name'];
$activePage = 'leagues';
require __DIR__ . '/header.php';

$table = $data['standings'][0]['table'] ?? [];
$teamCount = count($table);
$matchday = $data['season']['currentMatchday'] ?? null;
$leader = $table[0]['team'] ?? null;
?>

<section class="league-banner" style="--c: <?= h($league['color']) ?>">
  <img class="league-banner-bg" src="<?= h($league['img']) ?>" alt="">
  <div class="container league-banner-inner">
    <p class="crumbs"><a href="home.php">Home</a> <span>/</span> Leagues <span>/</span> <?= h($league['name']) ?></p>
    <p class="kicker"><span class="kicker-dot"></span><?= h($league['country']) ?></p>
    <h1><?= h($league['name']) ?></h1>
    <div class="banner-stats">
      <?php if ($matchday): ?>
        <div><span>Matchday</span><strong><?= h($matchday) ?></strong></div>
      <?php endif; ?>
      <?php if ($teamCount): ?>
        <div><span>Clubs</span><strong><?= h($teamCount) ?></strong></div>
      <?php endif; ?>
      <?php if ($leader): ?>
        <div class="leader">
          <span>Leader</span>
          <strong><img src="<?= h($leader['crest']) ?>" alt=""><?= h($leader['shortName'] ?? $leader['name']) ?></strong>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<div class="container league-layout">
  <section class="card standings-card" aria-labelledby="standingsTitle">
    <div class="card-head">
      <h2 id="standingsTitle">Standings</h2>
      <a class="btn btn-ghost btn-sm" href="?refresh=1">
        <svg width="14" height="14" viewBox="0 0 24 24" aria-hidden="true"><path d="M20 12a8 8 0 1 1-2.34-5.66M20 4v5h-5" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        Refresh
      </a>
    </div>

    <?php if (!$table): ?>
      <div class="empty">
        <p class="empty-title">The table isn't available right now</p>
        <p>The data service didn't answer. Try refreshing in a minute.</p>
      </div>
    <?php else: ?>
      <div class="table-scroll">
        <table class="standings">
          <thead>
            <tr>
              <th class="pos">#</th>
              <th class="club">Club</th>
              <th>MP</th>
              <th class="wdl">W</th>
              <th class="wdl">D</th>
              <th class="wdl">L</th>
              <th>GD</th>
              <th class="pts">Pts</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($table as $row):
              $pos = (int) $row['position'];
              $zone = $pos <= 4 ? 'zone-top' : ($pos > $teamCount - 3 ? 'zone-bottom' : '');
              $gd = (int) $row['goalDifference'];
            ?>
              <tr class="<?= $zone ?>">
                <td class="pos"><span><?= $pos ?></span></td>
                <td class="club">
                  <span class="club-inner">
                    <img src="<?= h($row['team']['crest']) ?>" alt="" loading="lazy" width="24" height="24">
                    <span class="name-full"><?= h($row['team']['name']) ?></span>
                    <span class="name-short"><?= h($row['team']['shortName'] ?? $row['team']['name']) ?></span>
                  </span>
                </td>
                <td><?= (int) $row['playedGames'] ?></td>
                <td class="wdl"><?= (int) $row['won'] ?></td>
                <td class="wdl"><?= (int) $row['draw'] ?></td>
                <td class="wdl"><?= (int) $row['lost'] ?></td>
                <td class="<?= $gd > 0 ? 'plus' : ($gd < 0 ? 'minus' : '') ?>"><?= $gd > 0 ? '+' . $gd : $gd ?></td>
                <td class="pts"><?= (int) $row['points'] ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="legend">
        <span><i class="lg-top"></i>Top 4</span>
        <span><i class="lg-bottom"></i>Bottom 3</span>
      </div>
    <?php endif; ?>
  </section>

  <aside class="card side-news" aria-labelledby="newsTitle">
    <div class="card-head">
      <h2 id="newsTitle">Latest news</h2>
    </div>
    <?php if (empty($newsItems)): ?>
      <div class="empty">
        <p class="empty-title">No news right now</p>
        <p>Check back in a few minutes.</p>
      </div>
    <?php else: ?>
      <ol class="news-list">
        <?php foreach ($newsItems as $i => $item):
          $link = $item['link'] ?? ($item['url'] ?? '#');
          $date = $item['date'] ?? ($item['pubDate'] ?? '');
        ?>
          <li>
            <a href="<?= h($link) ?>" target="_blank" rel="noopener">
              <span class="news-num"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
              <span class="news-text">
                <span class="news-title"><?= h($item['title']) ?></span>
                <?php if ($date): ?><span class="news-date"><?= h($date) ?></span><?php endif; ?>
              </span>
            </a>
          </li>
        <?php endforeach; ?>
      </ol>
    <?php endif; ?>
    <a class="link-arrow" href="news.php">More football news <span>→</span></a>
  </aside>
</div>

<?php require __DIR__ . '/footer.php'; ?>
