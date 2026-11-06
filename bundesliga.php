<?php
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/football.php';

$newsItems = get_rss_news("https://bulinews.com/rss.xml", "bundesliga_rss.json");
$data = get_standings('BL1');
$leagueKey = 'bundesliga';
require __DIR__ . '/includes/league_view.php';
