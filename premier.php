<?php
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/football.php';

// BBC football feed, filtered to Premier League stories
$keywords = ['Premier League', 'EPL', 'Manchester', 'Man City', 'Man Utd', 'Man United', 'Liverpool', 'Chelsea', 'Arsenal', 'Tottenham', 'Spurs', 'Leeds', 'Everton', 'Newcastle', 'Wolves', 'Brighton', 'Crystal Palace', 'West Ham', 'Aston Villa', 'Bournemouth', 'Fulham', 'Brentford', 'Nottingham Forest', 'Burnley', 'Sunderland'];

$newsItems = get_rss_news(
    "https://feeds.bbci.co.uk/sport/football/rss.xml",
    "premier_league_rss.json",
    10 * 60,
    function ($item) use ($keywords) {
        foreach ($keywords as $kw) {
            if (stripos($item['title'], $kw) !== false) return true;
        }
        return false;
    }
);

$data = get_standings('PL');
$leagueKey = 'premier';
require __DIR__ . '/includes/league_view.php';
