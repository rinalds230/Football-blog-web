<?php
// Shared helpers and site data used by every page.

if (!function_exists('h')) {
    // Escape text before printing it into HTML
    function h($value)
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}

// The five leagues shown across the site
$LEAGUES = [
    'premier'    => ['name' => 'Premier League', 'country' => 'England', 'img' => 'images/premier.png',     'color' => '#8b5cff'],
    'laliga'     => ['name' => 'LaLiga',         'country' => 'Spain',   'img' => 'images/laliga.webp',     'color' => '#ff5a36'],
    'seria'      => ['name' => 'Serie A',        'country' => 'Italy',   'img' => 'images/seria.webp',      'color' => '#2f80ff'],
    'bundesliga' => ['name' => 'Bundesliga',     'country' => 'Germany', 'img' => 'images/bundesliga.webp', 'color' => '#ff3b4e'],
    'ligue'      => ['name' => 'Ligue 1',        'country' => 'France',  'img' => 'images/ligue.jpg',       'color' => '#d6ff5c'],
];

// Current football season, e.g. "2026/27" (a new season counts from July)
function footy_season()
{
    $year = (int) date('Y');
    $start = (int) date('n') >= 7 ? $year : $year - 1;
    return $start . '/' . substr((string) ($start + 1), -2);
}

// Inline logo mark, so it can be reused anywhere without an extra request
function footy_mark($size = 36)
{
    $s = (int) $size;
    return '<svg class="mark" width="' . $s . '" height="' . $s . '" viewBox="0 0 40 40" aria-hidden="true">'
        . '<defs><linearGradient id="fg' . $s . '" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#d6ff5c"/><stop offset="1" stop-color="#3ee08f"/></linearGradient></defs>'
        . '<rect width="40" height="40" rx="11" fill="url(#fg' . $s . ')"/>'
        . '<g stroke="#08100b" stroke-width="2.4" stroke-linecap="round"><path d="M6.5 15h5M4.5 20h6.5M6.5 25h5"/></g>'
        . '<circle cx="24" cy="20" r="10" fill="#08100b"/>'
        . '<path d="M24 15.2l4.57 3.32-1.75 5.37h-5.64l-1.75-5.37z" fill="url(#fg' . $s . ')"/>'
        . '<g stroke="url(#fg' . $s . ')" stroke-width="1.3" stroke-linecap="round"><path d="M24 15.2v-4.7M28.57 18.52l4.48-1.46M26.82 23.89l2.77 3.81M21.18 23.89l-2.77 3.81M19.43 18.52l-4.48-1.46"/></g>'
        . '</svg>';
}

function footy_brand($href = 'home.php')
{
    return '<a class="brand" href="' . h($href) . '">' . footy_mark(36) . '<span>FOOTY</span></a>';
}
