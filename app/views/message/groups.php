<?php
// ... existing code ...
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="h4">Groupes</h2>
  <a href="/messages/groups/create" class="btn btn-primary">Créer</a>
</div>
<ul class="list-group" id="groupList">
<?php foreach(($groups??[]) as $g): ?>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    <span><?= htmlspecialchars($g['name']) ?></span>
    <button class="btn btn-sm btn-outline-primary open-group" data-id="<?= $g['id'] ?>">Ouvrir</button>
  </li>
<?php endforeach; ?>
</ul>
<div class="card shadow-sm mt-3">
  <div id="gThread" class="p-3" style="min-height:200px"></div>
  <div class="p-2 border-top">
    <div class="input-group">
      <input id="gInput" class="form-control" placeholder="Écrire...">
      <button id="gSend" class="btn btn-primary">Envoyer</button>
    </div>
  </div>
</div>
<script>
let gid=null;async function loadG(){if(!gid) return;const r=await fetch('/messages/groups/thread?id='+gid);const j=await r.json();document.getElementById('gThread').innerHTML=(j.messages||[]).map(m=>`<div class=\"mb-1\"><span class=\"badge bg-secondary\">#${m.from_id}</span> ${m.text}</div>`).join('');}
document.getElementById('groupList').addEventListener('click',e=>{const b=e.target.closest('.open-group');if(!b) return;gid=b.dataset.id;loadG();});
document.getElementById('gSend').addEventListener('click',async()=>{const t=document.getElementById('gInput');if(!gid||!t.value.trim())return;await fetch('/messages/groups/send',{method:'POST',headers:{'Content-Type':'application/x-www-form-urlencoded'},body:`group_id=${gid}&text=${encodeURIComponent(t.value)}`});t.value='';loadG();});
</script>