<?php
// ... existing code ...
?>
<h2 class="h4 mb-3">Créer un événement</h2>
<form method="post" action="/events/create" class="card p-3 shadow-sm">
  <div class="mb-3"><label class="form-label">Nom</label><input name="name" class="form-control" required></div>
  <div class="mb-3"><label class="form-label">Lieu</label><input name="location" class="form-control"></div>
  <div class="mb-3"><label class="form-label">Date et heure</label><input name="start_at" type="datetime-local" class="form-control" required></div>
  <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3"></textarea></div>
  <button class="btn btn-primary">Créer</button>
</form>