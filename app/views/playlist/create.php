<?php
// ... existing code ...
?>
<h2 class="h4 mb-3">Créer une playlist</h2>
<form method="post" action="/playlist/create" class="card p-3 shadow-sm">
  <div class="mb-3"><label class="form-label">Titre</label><input name="title" class="form-control" required></div>
  <div class="mb-3"><label class="form-label">Visibilité</label>
    <select name="visibility" class="form-select"><option value="public">Publique</option><option value="private">Privée</option></select>
  </div>
  <button class="btn btn-primary">Créer</button>
</form>