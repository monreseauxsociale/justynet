<?php
// ... existing code ...
?>
<div class="row justify-content-center">
  <div class="col-12 col-md-6 col-lg-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <h2 class="h4 mb-3">Connexion</h2>
        <?php if (!empty($error)): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <form method="post" action="/login">
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input name="password" type="password" class="form-control" required>
          </div>
          <button class="btn btn-primary w-100">Se connecter</button>
        </form>
      </div>
    </div>
  </div>
</div>