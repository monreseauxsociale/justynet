<?php
// ... existing code ...
?>
<h2 class="h4 mb-3">Téléverser une vidéo</h2>
<form method="post" action="/video/upload" enctype="multipart/form-data" class="card p-3 shadow-sm">
  <div class="mb-3">
    <label class="form-label">Titre</label>
    <input name="title" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Vidéo</label>
    <input type="file" name="video" class="form-control" accept="video/*" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Visibilité</label>
    <select name="visibility" class="form-select">
      <option value="public">Publique</option>
      <option value="unlisted">Non répertoriée</option>
      <option value="private">Privée</option>
    </select>
  </div>
  <button class="btn btn-primary">Téléverser</button>
</form>