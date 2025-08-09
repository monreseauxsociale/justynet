<?php
// ... existing code ...
?>
<h2 class="h5 mb-3"><?= htmlspecialchars($playlist['title']) ?></h2>
<div class="row g-3">
<?php foreach(($videos??[]) as $v): ?>
  <div class="col-6 col-md-4">
    <div class="card shadow-sm h-100">
      <video class="w-100" src="/uploads/videos/<?= htmlspecialchars($v['filename']) ?>#t=0.1" preload="metadata"></video>
      <div class="card-body">
        <a class="stretched-link" href="/video/watch?id=<?= $v['id'] ?>"><?= htmlspecialchars($v['title']) ?></a>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>