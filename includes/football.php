<?php
// Loading standings and news, with simple file caching.
// If an API fails, the page still works and shows a friendly message.

const FOOTBALL_DATA_KEY = "063f0699e14d434b94fbaa277a38e2f2";

function footy_cache_dir()
{
    $dir = __DIR__ . '/../cache';
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
    return $dir;
}

function http_get($url, $headers = [])
{
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Footy)',
        CURLOPT_HTTPHEADER => $headers,
    ]);
    $body = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return [$body === false ? '' : $body, $status];
}

function read_cache($file, $maxAge = null)
{
    if (!file_exists($file)) return null;
    if ($maxAge !== null && time() - filemtime($file) >= $maxAge) return null;
    $data = json_decode((string) file_get_contents($file), true);
    return $data ?: null;
}

// League table from football-data.org (cached for 15 minutes)
function get_standings($code)
{
    $file = footy_cache_dir() . "/{$code}_standings.json";

    if (isset($_GET['refresh']) && file_exists($file)) {
        unlink($file);
    }

    $cached = read_cache($file, 15 * 60);
    if (!empty($cached['standings'])) return $cached;

    [$body, $status] = http_get(
        "https://api.football-data.org/v4/competitions/$code/standings",
        ["X-Auth-Token: " . FOOTBALL_DATA_KEY]
    );
    $data = json_decode($body, true);

    if ($status === 200 && !empty($data['standings'])) {
        file_put_contents($file, $body);
        return $data;
    }

    // API failed: use an older copy if there is one
    $old = read_cache($file);
    return !empty($old['standings']) ? $old : null;
}

// News from an RSS feed
function get_rss_news($url, $cacheName, $ttl = 300, $filter = null, $limit = 6)
{
    $file = footy_cache_dir() . "/$cacheName";
    $items = read_cache($file, $ttl);

    if (!$items) {
        [$body] = http_get($url);
        $rss = $body ? @simplexml_load_string($body) : false;
        $items = [];
        if ($rss && isset($rss->channel->item)) {
            foreach ($rss->channel->item as $item) {
                $items[] = [
                    'title' => trim((string) $item->title),
                    'link'  => (string) $item->link,
                    'date'  => date("d M Y", strtotime((string) $item->pubDate)),
                ];
            }
        }
        if ($items) {
            file_put_contents($file, json_encode($items));
        } else {
            $items = read_cache($file) ?: [];
        }
    }

    if ($filter) {
        $items = array_values(array_filter($items, $filter));
    }
    return array_slice($items, 0, $limit);
}

// News from newsapi.org (used for Ligue 1)
function get_newsapi_news($query, $apiKey, $cacheName, $ttl = 300, $limit = 6)
{
    $file = footy_cache_dir() . "/$cacheName";
    $data = read_cache($file, $ttl);

    if (empty($data['articles'])) {
        $url = "https://newsapi.org/v2/everything?" . http_build_query([
            'q' => $query,
            'language' => 'en',
            'sortBy' => 'publishedAt',
            'pageSize' => 10,
            'apiKey' => $apiKey,
        ]);
        [$body, $status] = http_get($url);
        $fresh = json_decode($body, true);
        if ($status === 200 && !empty($fresh['articles'])) {
            file_put_contents($file, $body);
            $data = $fresh;
        } else {
            $data = read_cache($file) ?: [];
        }
    }

    $items = [];
    foreach (array_slice($data['articles'] ?? [], 0, $limit) as $a) {
        $items[] = [
            'title' => $a['title'] ?? '',
            'link'  => $a['url'] ?? '#',
            'date'  => isset($a['publishedAt']) ? date("d M Y", strtotime($a['publishedAt'])) : '',
        ];
    }
    return $items;
}
