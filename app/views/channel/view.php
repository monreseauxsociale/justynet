<?php
// ... existing code ...
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h2 class="h4 mb-0"><?= htmlspecialchars($channel['name']) ?></h2>
    <div class="text-muted small">Chaîne</div>
  </div>
  <button class="btn btn-outline-primary" id="subBtn" data-id="<?= $channel['id'] ?>">S'abonner</button>
</div>
<div class="row g-3">
<?php foreach(($videos??[]) as $v): ?>
  <div class="col-6 col-md-4">
    <div class="card shadow-sm h-100">
      <video class="w-100" src="/uploads/videos/<?= htmlspecialchars($v['filename']) ?>#t=0.1" preload="metadata"></video>
      <div class="card-body">
        <a class="stretched-link text-decoration-none" href="/video/watch?id=<?= $v['id'] ?>">
          <div class="fw-semibold text-truncate"><?= htmlspecialchars($v['title']) ?></div>
        </a>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>
<script>
document.getElementById('subBtn').addEventListener('click',async(e)=>{
  await fetch('/channel/subscribe',{method:'POST',headers:{'Content-Type':'application/x-www-form-urlencoded'},body:`id=${e.target.dataset.id}`});
  e.target.classList.toggle('btn-outline-primary');
  e.target.classList.toggle('btn-success');
  e.target.textContent='Abonné';
});
</script>