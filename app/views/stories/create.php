<?php
// ... existing code ...
?>
<h2 class="h4 mb-3">Nouveau statut</h2>
<form method="post" action="/stories/create" enctype="multipart/form-data" class="card p-3 shadow-sm">
  <div class="mb-3"><label class="form-label">Type</label><select name="kind" class="form-select"><option value="text">Texte</option><option value="image">Image</option></select></div>
  <div class="mb-3"><label class="form-label">Texte</label><textarea name="text" class="form-control" rows="3"></textarea></div>
  <div class="mb-3"><label class="form-label">Média</label><input type="file" name="media" class="form-control" accept="image/*"></div>
  <button class="btn btn-primary">Publier</button>
</form>