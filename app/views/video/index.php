<?php
// ... existing code ...
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="h4">Découvrir</h2>
  <a href="/video/upload" class="btn btn-primary">Téléverser</a>
</div>
<div class="row g-3">
<?php foreach (($videos ?? []) as $v): ?>
  <div class="col-6 col-md-4 col-lg-3">
    <div class="card shadow-sm h-100">
      <video class="w-100" src="/uploads/videos/<?= htmlspecialchars($v['filename']) ?>#t=0.1" preload="metadata"></video>
      <div class="card-body">
        <a class="stretched-link text-decoration-none" href="/video/watch?id=<?= $v['id'] ?>">
          <div class="fw-semibold text-truncate" title="<?= htmlspecialchars($v['title']) ?>"><?= htmlspecialchars($v['title']) ?></div>
        </a>
        <div class="small text-muted mt-1">par <?= htmlspecialchars($v['author_name']) ?></div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>