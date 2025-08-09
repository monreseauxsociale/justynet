<?php
// ... existing code ...
?>
<div class="row justify-content-center">
  <div class="col-12 col-md-8 col-lg-6">
    <div class="card shadow-sm">
      <div class="card-body">
        <h2 class="h5 mb-3">Mon profil</h2>
        <form method="post" action="/profile/update">
          <div class="mb-3">
            <label class="form-label">Nom</label>
            <input name="name" class="form-control" value="<?= htmlspecialchars($user['name'] ?? '') ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Bio</label>
            <textarea name="bio" class="form-control" rows="3"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
          </div>
          <button class="btn btn-primary">Enregistrer</button>
        </form>
      </div>
    </div>
  </div>
</div>