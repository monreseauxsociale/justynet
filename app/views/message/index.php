<?php
// ... existing code ...
?>
<div class="row g-3">
  <div class="col-12 col-md-4">
    <div class="card shadow-sm h-100">
      <div class="list-group list-group-flush" id="userList">
        <?php foreach (($users ?? []) as $u): ?>
          <button class="list-group-item list-group-item-action d-flex justify-content-between align-items-center user-item" data-id="<?= $u['id'] ?>">
            <span><?= htmlspecialchars($u['name']) ?></span>
            <span class="badge bg-success">en ligne</span>
          </button>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-8">
    <div class="card shadow-sm h-100 d-flex">
      <div id="thread" class="p-3 flex-grow-1 overflow-auto" style="min-height: 300px; max-height: 60vh;"></div>
      <div class="p-2 border-top">
        <div class="input-group">
          <input id="msgInput" class="form-control" placeholder="Écrire un message">
          <button id="msgSend" class="btn btn-primary">Envoyer</button>
        </div>
      </div>
    </div>
  </div>
</div>