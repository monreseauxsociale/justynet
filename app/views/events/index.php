<?php
// ... existing code ...
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="h4">Événements</h2>
  <a href="/events/create" class="btn btn-primary">Créer</a>
</div>
<ul class="list-group">
<?php foreach(($events??[]) as $e): ?>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    <span>
      <strong><?= htmlspecialchars($e['name']) ?></strong>
      <span class="text-muted small"> • <?= htmlspecialchars($e['location']) ?> • <?= htmlspecialchars($e['start_at']) ?></span>
    </span>
    <span class="small text-muted">par <?= htmlspecialchars($e['creator']) ?></span>
  </li>
<?php endforeach; ?>
</ul>