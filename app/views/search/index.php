<?php
// ... existing code ...
?>
<form class="mb-3" method="get" action="/search">
  <div class="input-group">
    <input name="q" class="form-control" placeholder="Rechercher..." value="<?= htmlspecialchars($q??'') ?>">
    <button class="btn btn-primary">Rechercher</button>
  </div>
</form>
<?php if(($q??'')!==''): ?>
<h3 class="h6 mt-3">Vidéos</h3>
<div class="row g-3">
<?php foreach(($videos??[]) as $v): ?>
  <div class="col-6 col-md-4"><a href="/video/watch?id=<?= $v['id'] ?>" class="card card-body text-decoration-none"><?= htmlspecialchars($v['title']) ?></a></div>
<?php endforeach; ?>
</div>
<h3 class="h6 mt-4">Chaînes</h3>
<ul class="list-group">
<?php foreach(($channels??[]) as $c): ?>
  <li class="list-group-item"><a href="/channel/view?id=<?= $c['id'] ?>" class="text-decoration-none"><?= htmlspecialchars($c['name']) ?></a></li>
<?php endforeach; ?>
</ul>
<h3 class="h6 mt-4">Publications</h3>
<ul class="list-group">
<?php foreach(($posts??[]) as $p): ?>
  <li class="list-group-item"><?= htmlspecialchars(mb_strimwidth($p['content'],0,120,'…')) ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>