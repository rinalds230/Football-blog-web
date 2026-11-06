<?php
// <head> for every page. Set $pageTitle (and optionally $bodyClass) before including.
require_once __DIR__ . '/helpers.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= h($pageTitle ?? 'Footy') ?> · Footy</title>
  <meta name="description" content="Footy – football news and live league tables from the Premier League, LaLiga, Serie A, Bundesliga and Ligue 1.">
  <meta name="theme-color" content="#070b09">
  <link rel="icon" href="images/logo-mark.svg" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,600;0,700;0,800;1,800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/footy.css">
</head>
<body class="<?= h($bodyClass ?? '') ?>">
