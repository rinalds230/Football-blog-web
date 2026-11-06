<?php
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/football.php';

$newsItems = get_rss_news("https://football-espana.net/category/la-liga/feed", "laliga_rss.json");
$data = get_standings('PD');
$leagueKey = 'laliga';
require __DIR__ . '/includes/league_view.php';
