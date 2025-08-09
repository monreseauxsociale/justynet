<?php
// ... existing code ...
?>
<div class="row g-3">
  <div class="col-12 col-lg-8">
    <div class="ratio ratio-16x9 bg-black rounded shadow-sm">
      <video controls preload="metadata" src="/uploads/videos/<?= htmlspecialchars($video['filename']) ?>"></video>
    </div>
    <h1 class="h4 mt-3"><?= htmlspecialchars($video['title']) ?></h1>
    <div class="text-muted small">Visibilité: <?= htmlspecialchars($video['visibility']) ?> • <?= htmlspecialchars($video['created_at']) ?></div>
  </div>
</div>