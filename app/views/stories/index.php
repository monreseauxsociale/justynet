<?php
// ... existing code ...
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="h4">Statuts</h2>
  <a href="/stories/create" class="btn btn-primary">Nouveau</a>
</div>
<div class="row g-3">
<?php foreach(($stories??[]) as $s): ?>
  <div class="col-6 col-md-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="small text-muted mb-1">par <?= htmlspecialchars($s['author']) ?></div>
        <?php if($s['kind']==='text'): ?>
          <div><?= nl2br(htmlspecialchars($s['text'])) ?></div>
        <?php else: ?>
          <img src="<?= htmlspecialchars($s['media_path']) ?>" class="img-fluid rounded">
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>