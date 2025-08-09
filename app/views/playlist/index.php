<?php
// ... existing code ...
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="h4">Mes Playlists</h2>
  <a href="/playlist/create" class="btn btn-primary">Créer</a>
</div>
<ul class="list-group">
<?php foreach(($playlists??[]) as $pl): ?>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    <a href="/playlist/view?id=<?= $pl['id'] ?>" class="text-decoration-none"><?= htmlspecialchars($pl['title']) ?></a>
    <span class="badge bg-secondary"><?= htmlspecialchars($pl['visibility']) ?></span>
  </li>
<?php endforeach; ?>
</ul>