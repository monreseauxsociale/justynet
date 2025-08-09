<?php
// ... existing code ...
?>
<div class="row g-3">
  <div class="col-12 col-lg-6 mx-auto">
    <div class="card shadow-sm">
      <div class="card-body">
        <form method="post" action="/post/create">
          <div class="d-flex align-items-start gap-2">
            <textarea name="content" class="form-control" rows="3" placeholder="Quoi de neuf ?"></textarea>
          </div>
          <div class="text-end mt-2">
            <button class="btn btn-primary">Publier</button>
          </div>
        </form>
      </div>
    </div>

    <?php foreach (($posts ?? []) as $p): ?>
      <div class="card shadow-sm mt-3">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div class="fw-bold"><?= htmlspecialchars($p['author_name']) ?></div>
            <div class="text-muted small"><?= htmlspecialchars($p['created_at']) ?></div>
          </div>
          <p class="mt-2 mb-2"><?= nl2br(htmlspecialchars($p['content'])) ?></p>
          <div class="d-flex gap-3">
            <button class="btn btn-sm btn-outline-primary react-btn" data-type="like" data-id="<?= $p['id'] ?>">J'aime</button>
            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#c<?= $p['id'] ?>">Commentaires</button>
          </div>
          <div id="c<?= $p['id'] ?>" class="collapse mt-2">
            <div class="input-group">
              <input class="form-control comment-input" placeholder="Écrire un commentaire">
              <button class="btn btn-primary comment-send" data-id="<?= $p['id'] ?>">Envoyer</button>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>