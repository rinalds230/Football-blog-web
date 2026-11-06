<?php
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/football.php';

$newsItems = get_rss_news("https://football-italia.net/feed", "seriea_rss.json");
$data = get_standings('SA');
$leagueKey = 'seria';
require __DIR__ . '/includes/league_view.php';
