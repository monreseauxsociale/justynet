<?php
// ... existing code ...
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="h4">Chaînes</h2>
  <a href="/channel/create" class="btn btn-primary">Créer</a>
</div>
<div class="row g-3">
<?php foreach(($channels??[]) as $c): ?>
  <div class="col-12 col-md-6 col-lg-4">
    <div class="card shadow-sm h-100">
      <div class="card-body">
        <h3 class="h6 mb-1"><a class="text-decoration-none" href="/channel/view?id=<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></a></h3>
        <div class="small text-muted">par <?= htmlspecialchars($c['owner_name']) ?> • <?= (int)$c['subs'] ?> abonnés</div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>