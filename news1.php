<?php
// Returns the latest BBC football stories as JSON (used by news.php and home.php)
header('Content-Type: application/json');

$xml = @simplexml_load_file("https://feeds.bbci.co.uk/sport/football/rss.xml");

if ($xml === false) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to fetch news']);
    exit;
}

$articles = [];

foreach ($xml->channel->item as $item) {
    $image = null;
    $namespaces = $item->getNamespaces(true);
    if (isset($namespaces['media'])) {
        $media = $item->children($namespaces['media']);
        if (isset($media->thumbnail)) {
            $image = (string) $media->thumbnail->attributes()->url;
        }
    }

    $articles[] = [
        'title' => (string) $item->title,
        'link' => (string) $item->link,
        'description' => (string) $item->description,
        'image' => $image,
        'date' => (string) $item->pubDate,
    ];

    if (count($articles) >= 15) break;
}

echo json_encode($articles);
