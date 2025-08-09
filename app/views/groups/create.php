<?php
// ... existing code ...
?>
<h2 class="h4 mb-3">Créer un groupe</h2>
<form method="post" action="/groups/create" class="card p-3 shadow-sm">
  <div class="mb-3"><label class="form-label">Nom</label><input name="name" class="form-control" required></div>
  <div class="mb-3"><label class="form-label">Confidentialité</label><select name="privacy" class="form-select"><option value="public">Public</option><option value="private">Privé</option></select></div>
  <button class="btn btn-primary">Créer</button>
</form>