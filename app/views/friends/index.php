<?php
// ... existing code ...
?>
<div class="row g-3">
  <div class="col-12 col-md-6">
    <div class="card shadow-sm">
      <div class="card-body">
        <h3 class="h6">Mes amis</h3>
        <ul class="list-group">
          <?php foreach(($friends??[]) as $f): ?><li class="list-group-item"><?= htmlspecialchars($f['name']) ?></li><?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-6">
    <div class="card shadow-sm">
      <div class="card-body">
        <h3 class="h6">Demandes</h3>
        <ul class="list-group">
          <?php foreach(($requests??[]) as $r): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span><?= htmlspecialchars($r['from_name']) ?></span>
              <span>
                <button class="btn btn-sm btn-success fr-accept" data-id="<?= $r['id'] ?>">Accepter</button>
                <button class="btn btn-sm btn-outline-danger fr-reject" data-id="<?= $r['id'] ?>">Refuser</button>
              </span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener('click',async(e)=>{
  if(e.target.matches('.fr-accept')){
    await fetch('/friends/respond',{method:'POST',headers:{'Content-Type':'application/x-www-form-urlencoded'},body:`id=${e.target.dataset.id}&status=accepted`});location.reload();
  }
  if(e.target.matches('.fr-reject')){
    await fetch('/friends/respond',{method:'POST',headers:{'Content-Type':'application/x-www-form-urlencoded'},body:`id=${e.target.dataset.id}&status=rejected`});location.reload();
  }
});
</script>