<?php
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/football.php';

$newsItems = get_newsapi_news("Ligue 1", "e1271738e8454dbd827d3f58cee8aee8", "ligue1_news.json");
$data = get_standings('FL1');
$leagueKey = 'ligue';
require __DIR__ . '/includes/league_view.php';
