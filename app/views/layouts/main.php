<?php
// ... existing code ...
?><!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($title ?? APP_NAME) ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/assets/css/app.css" rel="stylesheet">
<link rel="manifest" href="/manifest.webmanifest">
</head>
<body class="bg-body-tertiary">
<div id="preloader" class="preloader">
  <div class="loader-bar">
    <span class="seg s1"></span>
    <span class="seg s2"></span>
    <span class="seg s3"></span>
    <span class="seg s4"></span>
    <span class="seg s5"></span>
  </div>
  <div class="loader-title">Chargement Justy…</div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="/">Justy</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="/feed">Social</a></li>
        <li class="nav-item"><a class="nav-link" href="/messages">Messages</a></li>
        <li class="nav-item"><a class="nav-link" href="/video">Vidéos</a></li>
        <li class="nav-item"><a class="nav-link" href="/channel">Chaînes</a></li>
        <li class="nav-item"><a class="nav-link" href="/playlist">Playlists</a></li>
        <li class="nav-item"><a class="nav-link" href="/search">Recherche</a></li>
        <li class="nav-item"><a class="nav-link" href="/pages">Pages</a></li>
        <li class="nav-item"><a class="nav-link" href="/groups">Groupes</a></li>
        <li class="nav-item"><a class="nav-link" href="/events">Événements</a></li>
        <li class="nav-item"><a class="nav-link" href="/explorer">Explorer</a></li>
      </ul>
      <ul class="navbar-nav">
        <?php if (!empty($_SESSION['user_id'])): ?>
        <li class="nav-item"><a class="nav-link" href="/profile">Profil</a></li>
        <li class="nav-item"><a class="nav-link" href="/logout">Déconnexion</a></li>
        <?php else: ?>
        <li class="nav-item"><a class="nav-link" href="/login">Connexion</a></li>
        <li class="nav-item"><a class="nav-link" href="/register">Créer un compte</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<?php include __DIR__ . '/../../../public/bootstrap.php'; ?>

<main class="container" style="padding-top: 80px;">
  <?= $content ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/app.js"></script>
</body>
</html>