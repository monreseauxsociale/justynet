<?php
// ... existing code ...
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="h4">Pages</h2>
  <a href="/pages/create" class="btn btn-primary">Créer</a>
</div>
<ul class="list-group">
<?php foreach(($pages??[]) as $p): ?>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    <span><?= htmlspecialchars($p['name']) ?></span>
    <span class="small text-muted">par <?= htmlspecialchars($p['owner_name']) ?></span>
  </li>
<?php endforeach; ?>
</ul>