<?php
// ... existing code ...
?>
<h2 class="h4 mb-3">Explorer</h2>
<div class="row g-3">
  <div class="col-12 col-lg-6">
    <div class="card shadow-sm">
      <div class="card-body">
        <h3 class="h6">Vidéos recommandées</h3>
        <ul class="list-group list-group-flush">
          <?php foreach(($videos??[]) as $v): ?>
            <li class="list-group-item"><a href="/video/watch?id=<?= $v['id'] ?>" class="text-decoration-none"><?= htmlspecialchars($v['title']) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-12 col-lg-6">
    <div class="card shadow-sm">
      <div class="card-body">
        <h3 class="h6">Publications populaires</h3>
        <ul class="list-group list-group-flush">
          <?php foreach(($posts??[]) as $p): ?>
            <li class="list-group-item"><?= htmlspecialchars(mb_strimwidth($p['content'],0,120,'…')) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</div>