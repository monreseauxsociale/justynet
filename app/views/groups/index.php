<?php
// ... existing code ...
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="h4">Groupes</h2>
  <a href="/groups/create" class="btn btn-primary">Créer</a>
</div>
<ul class="list-group">
<?php foreach(($groups??[]) as $g): ?>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    <span><?= htmlspecialchars($g['name']) ?></span>
    <span class="badge bg-secondary"><?= htmlspecialchars($g['privacy']) ?></span>
  </li>
<?php endforeach; ?>
</ul>